<?php
/**
 * @property integer $id
 * @property string $document
 */
class AlertsMessages extends CActiveRecord{

    public function tableName(){
        return '{{alerts_messages}}';
    }

    public $document;

    public function rules(){
        return array(
            array('document', 'file', 'types'=>'csv'),
        );
    }

    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    protected function beforeSave(){

        if(!parent::beforeSave())
            return false;

        if(($this->scenario=='insert' || $this->scenario=='update') && ($document=CUploadedFile::getInstance($this,'document'))){
            $this->document=$document;
            $this->deleteDocument(); // delete old document, because new one is being uploaded

            $this->document->saveAs($path = Yii::getPathOfAlias('webroot.upload').DIRECTORY_SEPARATOR.$this->document);
//            Yii::log('path to new file -> '.print_r($path,1), 'error');

            $processor = new AlertsMessagesProcessor();
            $processor->processAlertsMessagesFile($path);
        }
        return true;
    }

    public function deleteDocument(){
        $documentPath=Yii::getPathOfAlias('webroot.upload').DIRECTORY_SEPARATOR.$this->document;
        if(is_file($documentPath))
            unlink($documentPath);
    }




}