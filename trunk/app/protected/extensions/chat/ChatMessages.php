<?php

class ChatMessages extends CAction {

    public function run() {
        
        $owner_room = isset($_POST['owner_room']) ? $_POST['owner_room']:'';
        $collocutor = isset($_POST['collocutor']) ? $_POST['collocutor'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';
        $m_type = isset($_POST['m_type']) ? $_POST['m_type'] : '';
        
        
       
        $result = array();
         if(!empty($message) && ($collocutor != 0 || '')){
            $model = new TblChat;
            $arr = array();
            $arr['owner_room'] = $owner_room;
            $arr['collocutor_id'] = $collocutor;
            $arr['author_id'] = Yii::app()->user->id;
            $arr['chat_message'] = $message;
            $arr['chat_created'] = date("Y-m-d H:i:s");
            $arr['type'] = $m_type == 'yes' ? 'chat' : 'message';
            $model->attributes = $arr;
            if ($model->validate()) {
                $model->save();
            } else {
                echo $model->getErrors();
            }
            if($arr['type'] == 'message'){
                $to = User::model()->findByPk($owner_room);
                $from = User::model()->findByPk(Yii::app()->user->id);
                $subject = Yii::app()->params['chatMessage'];
                $headers="From: ".$from->username."\r\nReply-To: ".Yii::app()->params['adminEmail'];
                mail($to->username,'=?UTF-8?B?'.base64_encode($subject).'?=',$message,$headers);
            }
        }
       
        if($collocutor != 0 || ''){
           $result = $this->getMessagesList($collocutor, $owner_room);
        } 
        
        //echo '<pre>',  print_r($response),'</pre>';die();
        header("Content-type: application/json");
        echo CJSON::encode($result);
        exit();
    }
    
    private function getMessagesList($collocutor, $owner_room) {
        $result['messages'] = array();
        $response = TblChat::model()->with('users')->findAllByAttributes(array('collocutor_id'=>$collocutor, 'owner_room'=>$owner_room));
        $datetime_now = new DateTime();
        foreach ($response as $value) {
            $online = 'no';
            $datetime_exp = new DateTime($value->users->lastvisit_at);
            $interval = $datetime_now->diff($datetime_exp);
            if(($interval->days == 0) && ($interval->h == 0) && ($interval->i < 5)){
                $online = 'yes';
            } 
            $result['messages'][] = array('message'=>$value,'user'=>$online);
            unset($online);
            unset($datetime_exp);
            unset($interval);
        }
        return $result;
    }
    
}


