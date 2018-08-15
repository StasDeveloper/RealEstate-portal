<?php

class CronChatCommand extends CConsoleCommand {
    
    public function run(){
        $date = new DateTime();
        $date->modify('-6 months');
        
        $model = TblChat::model()->deleteAll('chat_created < "'.$date->format('Y-m-d H:i:s').'"');
        
        if(!$model){
            echo print_r($model->getErrors());
        } else {
            echo 'Done. '.$date->format('Y-m-d H:i:s').'\r\n';
        }
    }
}
