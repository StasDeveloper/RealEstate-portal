<?php

class ChatOnline extends CAction {
    
        public function run() {
            $this->setLastVisit();
        }


        private function setLastVisit() {
                $result['messages'] = array();
                $result['messages'] = 'error';
                if (Yii::app()->user->id) {
                    $lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
                    if(!empty($lastVisit)) {
                    $lastVisit->lastvisit_at = date('Y-m-d H:i:s');
                        if($lastVisit->save()){
                            $result['messages'] = 'the last visit was updated successfully';
                        }
                    }
                }
                header("Content-type: application/json");
                echo CJSON::encode($result);
                exit();
	}
}
