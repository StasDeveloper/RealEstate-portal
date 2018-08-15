<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';

        public $layout = '//layouts/irradii';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('oauthadmin'),
                                'roles'=>array('admin'),
//				'users'=>UserModule::getAdmins(),
			),
			array('deny',  // deny all users
                            'actions'=>array('oauthadmin'),
                            'users'=>array('*'),
			),
		);
	}

        public function actions()
        {
            return array(
              'oauth' => array(
                'class'=>'ext.hoauth.HOAuthAction',
              ),
              'oauthadmin' => array(
                'class'=>'ext.hoauth.HOAuthAdminAction',
              ),
            );
        }

        /**
	 * Displays the login page
	 */
	public function actionLogin()
	{

        if (Yii::app()->request->isAjaxRequest) {
            if (Yii::app()->user->isGuest) {
                $model=new UserLogin;
                // collect user input data
                if(isset($_POST['UserLogin']))
                {

                    $model->attributes=$_POST['UserLogin'];
                    $model->rememberMe = $_POST['remember'] == 'on' ? true : false;
                    // validate user input and redirect to previous page if valid
                    if($model->validate()) {
                        $this->lastViset();
                                            header('Content-Type: application/json; charset="UTF-8"');
                                            echo CJSON::encode(array('login'=>'success'));
                                            Yii::app()->end();
                    } else {
                                            echo CActiveForm::validate($model);
                                            Yii::app()->end();
                                    }
                }
                // display the login form
                $this->renderPartial('/user/loginmodal',array('model'=>$model, 'title'=>'','content'=>''), false, true);
            } else {
                header('Content-Type: application/json; charset="UTF-8"');
                echo CJSON::encode(array('login'=>'success'));
                Yii::app()->end();
            }
        } else {
            if (Yii::app()->user->isGuest) {
                $model=new UserLogin;
                // collect user input data
                if(isset($_POST['UserLogin']))
                {
                    $model->attributes=$_POST['UserLogin'];
                    $model->rememberMe = $_POST['remember'] == 'on' ? true : false;
                    $trialPeriod = isset($_POST['yt0']) ? true : false;
                    // validate user input and redirect to previous page if valid
                    if($model->validate()) {
                        $this->lastViset();
                        if (Yii::app()->getBaseUrl()."/index.php" === Yii::app()->user->returnUrl)
                            //$this->redirect(Yii::app()->controller->module->returnUrl);
                            if(SiteHelper::forFullPaidMembersOnly(1) === 1){
                                $this->redirect(Yii::app()->createUrl('/user/profile'));
                            }else{
                                if($trialPeriod){
                                    $this->redirect(Yii::app()->params['linkToBuyingSubscrFreeTrial30days']);
                                } else {
                                    $this->redirect(Yii::app()->params['linkToBuyingSubscr']);
                                }
                            }
                        else
                            //$this->redirect(Yii::app()->user->returnUrl);
                            if(SiteHelper::forFullPaidMembersOnly(1) === 1){
                                $this->redirect(Yii::app()->createUrl('/user/profile'));
                            }else{
                                if($trialPeriod){
                                    $this->redirect(Yii::app()->params['linkToBuyingSubscrFreeTrial30days']);
                                } else {
                                    $this->redirect(Yii::app()->params['linkToBuyingSubscr']);
                                }
                            }
                    }
                }
                // display the login form
                $this->render('/user/login',array('model'=>$model, 'title'=>'','content'=>''));
            } else {
                $this->redirect(Yii::app()->controller->module->returnUrl);
            }
        }
	}
        
        


        private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit_at = date('Y-m-d H:i:s');
		$lastVisit->save();
	}

}