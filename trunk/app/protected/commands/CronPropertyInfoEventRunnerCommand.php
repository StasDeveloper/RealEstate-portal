<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);

class CronPropertyInfoEventRunnerCommand extends CConsoleCommand {

    public function run(){

        $PropertyInfoEventRunnerStatus = Yii::app()->redisCache->executeCommand('GET', array('PropertyInfoEventRunnerStatus'));
        if($PropertyInfoEventRunnerStatus == 'runned'){
            $this->writeToLog('Event Runner now is working, status of PropertyInfoEventRunnerStatus: ' .$PropertyInfoEventRunnerStatus);
            return;
        }
        $PropertyInfoEventRunnerStatus = Yii::app()->redisCache->executeCommand('GET', array('PropertyInfoEventRunnerStatus'));
        Yii::app()->redisCache->executeCommand('SETEX', array('PropertyInfoEventRunnerStatus', 172800,'runned'));
        $this->writeToLog('Event Runner started, status of PropertyInfoEventRunnerStatus: ' .$PropertyInfoEventRunnerStatus);
        $start = time();
        $startPeriod = $start;
        $this->writeToLog("Start at ". date('Y-m-d H:i:s', $start)); 
        
        ini_set("memory_limit","256M");
        $db_format = 'Y-m-d';
        $db_full_format = 'Y-m-d H:i:s';
        $today = new DateTime('now');
        $yesterday = new DateTime('-1 day');

//$today = DateTime::createFromFormat($db_format, '2015-05-19');
//$yesterday = DateTime::createFromFormat($db_format, '2015-05-18');

        // Delete All Old Logs
        PropertyInfoEventLog::model()->deleteAll('run_at<:run_at' , array(':run_at'=>$yesterday->format($db_format).' 00:00:00'));
        
        $end = time();
        $this->writeToLog('End Delete All Old Logs : time=' . SiteHelper::timeElapsed($end-$startPeriod));
        $startPeriod = $end;
        // CREATE EVENT
        $createdModels = PropertyInfo::model()->with('eventLogs')->findAll('property_uploaded_date>=:property_uploaded_date AND getlongitude != 0.0 AND getlatitude != 0.0 AND (comp_stage !=0 OR property_type IN ( 4, 5 ))',array(':property_uploaded_date' => $yesterday->format($db_format)));
        $multi = new CDbMultiInsertCommand(new PropertyInfoEventLog());
        foreach($createdModels as $createdModel){

            if($createdModel->isTodayAlreadyRunEvent(PropertyInfoEventLog::EVENT_TYPE_CREATE, $today) == true)
                continue;

            $createdModel->onCreateEvent();

            // create log
            $log = new PropertyInfoEventLog();
            $log->type = PropertyInfoEventLog::EVENT_TYPE_CREATE;
            $log->property_id = $createdModel->property_id;
            $log->run_at = $today->format($db_full_format);
            var_dump($log);
            $multi->add($log, false);
        }
        $multi->execute();

        $end = time();
        $this->writeToLog('End CREATE EVENT : time=' . SiteHelper::timeElapsed($end-$startPeriod));
        $startPeriod = $end;

        // UPDATE EVENT
        $updatedModels = PropertyInfo::model()->with('eventLogs')->findAll('property_updated_date>=:property_updated_date AND property_updated_date!=property_uploaded_date AND getlongitude != 0.0 AND getlatitude != 0.0 AND (comp_stage !=0 OR property_type IN ( 4, 5 ))', array(':property_updated_date' => $yesterday->format($db_format)));
        $multi = new CDbMultiInsertCommand(new PropertyInfoEventLog());
        foreach($updatedModels as $updatedModel){

            if($updatedModel->isTodayAlreadyRunEvent(PropertyInfoEventLog::EVENT_TYPE_UPDATE, $today) == true)
                continue;

            $updatedModel->onUpdateEvent();

            // create log


            $log = new PropertyInfoEventLog();
            $log->type = PropertyInfoEventLog::EVENT_TYPE_UPDATE;
            $log->property_id = $updatedModel->property_id;
            $log->run_at = $today->format($db_full_format);
            $multi->add($log, false);

            //$log = new PropertyInfoEventLog();
            //$log->type = PropertyInfoEventLog::EVENT_TYPE_UPDATE;
            //$log->property_id = $updatedModel->property_id;
            //$log->run_at = $today->format($db_full_format);
            //$log->save(false);
        }
        $multi->execute();

        $end = time();
        $this->writeToLog('End UPDATE EVENT : time=' . SiteHelper::timeElapsed($end-$startPeriod));
        $startPeriod = $end;

        $end = time();
        $this->writeToLog('Finished at '. date('Y-m-d H:i:s', $end) . ' time=' . SiteHelper::timeElapsed($end-$start));
        Yii::app()->redisCache->executeCommand('DEL', array('PropertyInfoEventRunnerStatus'));
    }
    
    private function writeToLog($content) {
        $filename = Yii::app()->basePath.'/runtime/CronEventRunner.log';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }
        
        fclose($fp); 
    }

}