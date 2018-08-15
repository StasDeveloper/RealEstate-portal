<?php

class ActivationController extends Controller
{
	public $defaultAction = 'activation';

	
	/**
	 * Activation user account
	 */
	public function actionActivation () {
		$email = $_GET['email'];
		$activkey = $_GET['activkey'];
                $model=new UserLogin;
		if ($email&&$activkey) {
			$find = User::model()->notsafe()->findByAttributes(array('username'=>$email));
			if (isset($find)&&$find->status) {
			    //$this->render('/user/login',array('model'=>$model,'title'=>UserModule::t("User activation"),'content'=>UserModule::t("You account is active.")));
                            $this->redirect(array('/user/login', 'title'=>UserModule::t("User activation"),'content'=>UserModule::t("You account is active.")));
			} elseif(isset($find->activkey) && ($find->activkey==$activkey)) {
				$find->activkey = UserModule::encrypting(microtime());
				$find->status = 1;
				$find->save();
                                //$this->render('/user/login',array('model'=>$model,'title'=>UserModule::t("User activation"),'content'=>UserModule::t("You account is activated.")));
                                $this->redirect(array('/user/login', 'title'=>UserModule::t("User activation"),'content'=>UserModule::t("Your account is activated.")));
			} else {
			    //$this->render('/user/login',array('model'=>$model,'title'=>UserModule::t("User activation"),'content'=>UserModule::t("Incorrect activation URL.")));
                            $this->redirect(array('/user/login', 'title'=>UserModule::t("User activation"),'content'=>UserModule::t("Incorrect activation URL.")));
			}
		} else {
                    
			//$this->render('/user/login',array('model'=>$model,'title'=>UserModule::t("User activation"),'content'=>UserModule::t("Incorrect activation URL.")));
                        $this->redirect(array('/user/login', 'title'=>UserModule::t("User activation"),'content'=>UserModule::t("Incorrect activation URL.")));
		}
	}
        
        public function filters()
	{
		return array();
	}   

}