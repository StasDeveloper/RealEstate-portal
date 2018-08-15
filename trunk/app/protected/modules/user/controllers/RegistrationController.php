<?php

class RegistrationController extends Controller
{
	public $defaultAction = 'registration';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}
	/**
	 * Registration user
	 */
	public function actionRegistration() {
        //Profile::$regMode = true;
        $model = new RegistrationForm;
        
        $profile=new TblUsersProfiles;
        
        $criteria = new CDbCriteria;
        $criteria->select = 'name';
        $criteria->condition = "t.name!=:admin AND t.name!=:authenticated AND t.name!=:guest";
        $criteria->params = array(':admin'=>'Admin',':authenticated'=>'Authenticated', ':guest'=>'Guest');
        $profession = TblAuthItem::model()->findAll($criteria);
        
        //echo '<pre>',  print_r($_POST),'</pre>';die();
        // ajax validator
        if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form-form')
        {
            echo UActiveForm::validate(array($model,$profile));
            Yii::app()->end();
        }

        if (Yii::app()->user->id) {
            if (Yii::app()->request->isAjaxRequest) {
                header('Content-Type: application/json; charset="UTF-8"');
                echo CJSON::encode(array('login'=>'success'));
                Yii::app()->end();
            } else {
                $this->redirect(Yii::app()->controller->module->profileUrl);
            }
        } else {
            if(isset($_POST['RegistrationForm'])) {
                $message = 'Thank you for your registration.';
                $model->attributes=$_POST['RegistrationForm'];
//                $profile->attributes=$_POST['TblUsersProfiles'];
                $profile->attributes=((isset($_POST['TblUsersProfiles'])?$_POST['TblUsersProfiles']:array()));
                
                if($model->validate()&&$profile->validate())
                {
                    $soucePassword = $model->password;
                    $model->activkey=UserModule::encrypting(microtime().$model->password);
                    $model->password=UserModule::encrypting($model->password);
                    $model->verifyPassword=UserModule::encrypting($model->verifyPassword);
                    $model->superuser=0;
                    $model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);

                    if ($model->save()) {
                        $profile->mid=$model->id;
                        Rights::assign($_POST['RegistrationForm']['professionRole'], $model->id);
                        $profile->save();
                    
                        if (Yii::app()->controller->module->sendActivationMail) {
                            $activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $model->activkey, "email" => $model->username));
//                            UserModule::sendMail($model->username,UserModule::t("zYou registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
                            SiteHelper::sendMail($model->username,UserModule::t("Your new {site_name} real estate account is ready, let's get started",array('{site_name}'=>Yii::app()->name)),UserModule::t("Get started with Irradii real estate by clicking the activation link {activation_url}",array('{activation_url}'=>$activation_url)));
                        }

                        if ((Yii::app()->controller->module->loginNotActiv||
                                (Yii::app()->controller->module->activeAfterRegister
                                    &&Yii::app()->controller->module->sendActivationMail==false))&&
                                Yii::app()->controller->module->autoLogin)
                        {

                            $this->redirectAfterSuccessfulRegistration($model->username,$soucePassword);

                        } else {
                            if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
                                Yii::app()->user->setFlash('registration',$message = UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                            } elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
                                Yii::app()->user->setFlash('registration',$message = UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
                            } elseif(Yii::app()->controller->module->loginNotActiv) {
                                Yii::app()->user->setFlash('registration',$message = UserModule::t("Thank you for your registration. Please check your email or login."));
                            } else {
                                Yii::app()->user->setFlash('registration',$message = UserModule::t("Thank you for registering with Irradii.com! <br/> We\'ve sent an activation link to your email address. Please check your email and click on the link, and don\'t forget to check your junk mail boxes."));
                            }
                            if (Yii::app()->request->isAjaxRequest) {
                                header('Content-Type: application/json; charset="UTF-8"');
                                echo CJSON::encode(array('login'=>'registered','message'=>$message));
                                Yii::app()->end();
                            } else {
                                $this->refresh();
                            }
                        }
                    }
                }elseif(
                    User::model()->find('username=:username AND lastvisit_at=:lastvisit_at',array(':username'=>$model->attributes['username'], ':lastvisit_at'=>'0000-00-00 00:00:00'))
                    && $profile->validate()
                    && strlen($model->attributes['password']) >= 4
                    && $_POST['RegistrationForm']['terms'] == true
                ){
                    $existedUser = User::model()->find('username=:username',array(':username'=>$model->attributes['username']));

                    $soucePassword = $model->password;
                    $existedUser->password = UserModule::encrypting($model->password);
                    if($existedUser->save()){
                        $existedProfile = TblUsersProfiles::model()->find('mid=:mid', array(':mid'=>$existedUser->id));
                        $existedProfile->attributes=((isset($_POST['TblUsersProfiles'])?$_POST['TblUsersProfiles']:array()));
                        Rights::assign($_POST['RegistrationForm']['professionRole'], $existedUser->id);
                        $existedProfile->save();

                        $this->redirectAfterSuccessfulRegistration($model->username,$soucePassword);

                    }

                } else {

                    if (Yii::app()->request->isAjaxRequest) {
                        header('Content-Type: application/json; charset="UTF-8"');
//                        echo CJSON::encode(array('login'=>'error','message'=>UActiveForm::validate(array($model,$profile))));
                        echo CJSON::encode(array('login'=>'error','message'=>$this->renderPartial('/user/registrationmodal',array('model'=>$model,'profile'=>$profile, 'profession'=>$profession), true, true)));
                        Yii::app()->end();
                    } else {
                        $profile->validate();
                    }
                }
            }
            if (Yii::app()->request->isAjaxRequest) {
                $this->renderPartial('/user/registrationmodal',array('model'=>$model,'profile'=>$profile, 'profession'=>$profession), false, true);
            } else {
                $this->render('/user/registration',array('model'=>$model,'profile'=>$profile, 'profession'=>$profession));
            }
        }
	}
        

	public function filters()
	{
		return array();
	}

    /**
     * @param $username
     * @param $sourcePass
     */
    public function redirectAfterSuccessfulRegistration($username, $sourcePass){
        $identity=new UserIdentity($username,$sourcePass);
        $identity->authenticate();
        Yii::app()->user->login($identity,0);
        if (Yii::app()->request->isAjaxRequest) {
            header('Content-Type: application/json; charset="UTF-8"');
            echo CJSON::encode(array('login'=>'success'));
            Yii::app()->end();
        } else {
//            $this->redirect(Yii::app()->controller->module->returnUrl);
            if(SiteHelper::forFullPaidMembersOnly(1) === 1){
                $this->redirect(Yii::app()->controller->module->returnUrl);
            }else{
                $this->redirect(User::NON_PAID_USER_URL);
            }
        }
    }
}
