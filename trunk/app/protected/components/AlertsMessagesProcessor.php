<?php
/**
 * Class AlertsMessagesProcessor
 * Pars .csv file and composes an array from its rows. Save array items as row to data base.
 */

class AlertsMessagesProcessor{

    private $rowArray = array();
    private $command;

    public function __construct(){
        $this->command = Yii::app()->db->createCommand();
    }

    public function processAlertsMessagesFile($path){
        $this->readFileToArray($path);
        $this->deleteMessagesInTable();
        $this->saveArrayToDB();
    }

    private function readFileToArray($path){
        $row = 0;
        $handle = fopen($path, "r");
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            for ($c=0; $c < $num; $c++) {
                if($row != 0){
                    $this->rowArray[$row-1][$c] = $data[$c];
//                    Yii::log(print_r($data[$c], 1), 'error');
                }
            }
            $row++;
        }
        fclose($handle);
//        Yii::log(print_r($this->rowArray,1), 'error');
    }


    private function saveArrayToDB(){
        foreach($this->rowArray as $row){
//            Yii::log(print_r($row,1), 'error');

            $this->command->insert('tbl_alerts_scheduled_messages', array(
                'date'=>date('Y-m-d', strtotime($row[0])),
                'message_1'=>$row[1],
                'message_2'=>$row[2],
                'message_3'=>$row[3],
            ));

        }
    }

    public function deleteMessagesInTable(){
        $this->command->delete('tbl_alerts_scheduled_messages');
    }




}