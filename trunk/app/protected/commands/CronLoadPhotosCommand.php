<?php

/**
 * Command load photos from queue
 *  ./yiic CronLoadPhotos
 *  ./yiic CronLoadPhotos all
 *  ./yiic CronLoadPhotos 1234567 2345678 // mls_sysid
 *  ./yiic CronLoadPhotos 64497307 all // load all photos for 64497307-mls_sysid
 */
class CronLoadPhotosCommand extends CConsoleCommand {
    private $onePhoto = false;
    private $allPhoto = false;
    private $idPhotos = array();

    private $rets;
    private $photo_url = 'http://img1.irradii.com/photo/';
    private $photo_path = 'photo/';
    private $bucket = 'props3photos';
    
    public function run($args = array()) {
        $this->getParams($args);
        $start = time();
        $this->writeToLog("Start LoadPhotos at ". date('Y-m-d H:i:s', $start)); 
        // random pause for multy threading
        $sleep = rand(1, 30);
        $this->writeToLog('Sleep '. $sleep);
        sleep($sleep);
        
        $this->loadPhotos();

        $end = time();
        $this->writeToLog('Finished LoadPhotos at '. date('Y-m-d H:i:s', $end) . ' time=' . SiteHelper::timeElapsed($end-$start));
    }
    
    private function writeToLog($content) {
        $filename = Yii::app()->basePath.'/runtime/cronLoadPhotoslog.txt';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }
        
        fclose($fp); 
    }
    
    private function connectRets(){
        
        $rets_login_url = Yii::app()->params['rets_login_url'];
        $rets_username = Yii::app()->params['rets_username'];
        $rets_password = Yii::app()->params['rets_password'];
  
        // connect to RETS
        $this->rets = new phRETS;
        return $this->rets->Connect($rets_login_url, $rets_username, $rets_password);
    }
    
    public function loadPhotos(){
        if(empty($this->idPhotos)) {
        $ids = Yii::app()->db->createCommand("
SELECT * 
FROM  `tbl_property_info_cron_load_photo` 
WHERE `process` is NULL OR (`process` is NOT NULL AND 60 <= TIMESTAMPDIFF(MINUTE,process_at,NOW()))
LIMIT 60
        ")->queryAll();
        } else {
            foreach ($this->idPhotos as $value) {
                Yii::app()->db->createCommand("INSERT IGNORE INTO  `bucontra_propertyhookup`.`tbl_property_info_cron_load_photo` SET `mls_sysid`={$value}, `process`=1, `process_at`=NOW()")->query();
            }
        $ids = Yii::app()->db->createCommand("
SELECT * 
FROM  `tbl_property_info_cron_load_photo` 
WHERE mls_sysid IN (". implode(',', $this->idPhotos) . ")
        ")->queryAll();
        }
        if(count($ids)) {
            $this->writeToLog("Total ".count($ids)." rec. ");
        }
        if ( !empty($ids) ){
            if($this->connectRets() && Yii::app()->s3) {
                $idUpdate = array();
                foreach ($ids as $key => $value) {
                    $idUpdate[]=$value['id'];
                }
                if(!empty($idUpdate) && Yii::app()->db->createCommand($r="
                    UPDATE `tbl_property_info_cron_load_photo` SET `process`=1, `process_at`=NOW() 
                    WHERE `id` IN (". implode(',', $idUpdate) . ")
                ")->execute()) {
    // echo $r, PHP_EOL;            
                    foreach ($ids as $key => $value) {
                        $start = time();

                        $id = $value['mls_sysid'];
                        $photos = $this->rets->GetObject("Property", "LargePhoto", $id, '*');
                        if(!empty($photos) && is_array($photos)) {
                        $temp = "";
                        $number = 0;

                        foreach ($photos as $photo) {
                            $listing = $photo['Content-ID'];
                            
                            if($photo['Object-ID'] == 0 && !$this->allPhoto) {
                                $number++;
                                continue; // first photo already loaded
                            }
                            $number++;

                            if($number>25) {
                                break; // other photo not load
                            }
                          if ($photo['Success'] == true) {
                            Yii::app()->s3->putObjectString($photo['Data'], $this->bucket,  $this->photo_path . $id . "/image-".$id."-{$photo['Object-ID']}.jpg");
                            if($number != 0 && $number != 1) {
                                $temp .= ", `photo{$number}` = '{$this->photo_url}" . $id . "/image-".$id."-{$photo['Object-ID']}.jpg'";
                            }
                          } else {
                            $this->writeToLog( "({$listing}-{$photo['Object-ID']}): {$photo['ReplyCode']} = {$photo['ReplyText']}");
                          }
                        }

                        $sql = "REPLACE INTO `bucontra_propertyhookup`.`property_info_photo` SET `property_id`= '$id' ";
                        $sql = $sql . $temp ;
       
                        if(Yii::app()->db->createCommand($sql)->execute()) {
                            Yii::app()->db->createCommand("DELETE FROM `tbl_property_info_cron_load_photo` WHERE id={$value['id']}")->execute();
                        } else {
                            $this->writeToLog('ERROR in ' . $sql);
                        }
                        $end = time();
                        $query_took = $end-$start;
                        $this->writeToLog("#{$id} Query took ".$query_took." sec. ");
                        } else {
                            $this->writeToLog("#{$id} Error connect ");
                            if(Yii::app()->db->createCommand($r="
                                UPDATE `tbl_property_info_cron_load_photo` SET `process`=NULL, `process_at`=NOW() 
                                WHERE `id` IN (". $value['id'] . ")
                            ")->execute()) {
                                
                            } else {
                                $this->writeToLog('ERROR in ' . $r);
                            }
                        }
                    }
                } else {
                    $this->writeToLog('ERROR in ' . $r);
                }
            } else {
                $this->writeToLog('You need to configure the S3 component or set the variable s3Component properly');
            }

        } else {
            $this->writeToLog("Empty list");
        }
    }

    public function getParams($args) {
        foreach ($args as $value) {
            switch (strtolower($value)) {
                case 'all':
                    $this->allPhoto = true;
                    break;
                case 'one':
                    $this->onePhoto = true;
                    break;

                default:
                    if(intval($value) != 0){
                        $this->idPhotos[] = intval($value);
                    }
                    break;
            }
        }
    }

}
