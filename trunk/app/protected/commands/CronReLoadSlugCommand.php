<?php

/**
 * Reload slug 
 *  ./yiic CronReLoadSlug    // create if slug is empty
 *  ./yiic CronReLoadSlug all
 */
class CronReLoadSlugCommand extends CConsoleCommand {
    private $reloadAll = false;

    public function run($args = array()) {
        ini_set("memory_limit","512M");
        $this->getParams($args);
        $start = time();
        $this->writeToLog("\r\n Start ReLoadSlug at ". date('Y-m-d H:i:s', $start)); 
        $this->createSlug();
        $end = time();
        $this->writeToLog('Finished ReLoadSlug at '. date('Y-m-d H:i:s', $end) . ' time=' . SiteHelper::timeElapsed($end-$start));
    }
    
    private function writeToLog($content) {
        $filename = Yii::app()->basePath.'/runtime/cronReLoadSlug.log';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }
        
        fclose($fp); 
    }
    
    public function createSlug(){
        $start = time();
        $propertiesPerStage = 10000;
        $lastPropertyId = 0;
        $cycle = 0;
        do {
            $cycle++;

            $ids = PropertyInfo::model()->with('city', 'county', 'state', 'zipcode', 'slug')->findAll( array(
                            'condition'=>"t.property_id > :property_id",
                            'params' => array(':property_id' => $lastPropertyId),
    //                        'order' => 't.property_id desc',
                            'limit' => $propertiesPerStage,
                        ));
    //print_r($ids);
            if ( $ids !== false ){
                $count_rows = count($ids);
                $sum_time = 0;
                if($count_rows > 0) {
                    $this->writeToLog("$cycle: Total ". $count_rows ." rec. ");
                    foreach ($ids as $key => $value) {
                        $lastPropertyId = $value->property_id;
                        $slug = $value->makeFullSlug();
                        if(!empty($slug)) {
                            if(empty($value->slug)) {
                                $new = new PropertyInfoSlug();
                                $new->attributes = array('slug'=>$slug,'property_id'=>$value->property_id);
                                $new->insert();
                            } else if ( empty($value->slug->slug) 
                                        || $this->reloadAll === true
                                    ) {
                                PropertyInfoSlug::model()->updateByPk($value->slug->id,array('slug'=>$slug, 'updated_at' => new CDbExpression('NOW()')));
                            }
                        }
                    }
                    $end = time();
                    $query_took = $end-$start;
                    $this->writeToLog("Query took ".$query_took." sec. ");
                }
            } else {
                $this->writeToLog("Error");
            }
        } while ( $ids && $count_rows );

    }

    public function getParams($args) {
        foreach ($args as $value) {
            switch (strtolower($value)) {
                case 'all':
                    $this->reloadAll = true;
                    break;

                default:
                    break;
            }
        }
    }
    
}
