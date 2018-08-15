<?php

class ActivityController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/irradii';


	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('submit', 'captcha'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
//				'users'=>array('@'),
                            'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
//                                'testLimit'=>'1',
			),
		);
	}

	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionView($id)
	{
                $user = $this->loadUserData();

		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'profile' =>$user,
		));
	}

//	/**
//	* Creates a new model.
//	* If creation is successful, the browser will be redirected to the 'view' page.
//	*/
//	public function actionCreate()
//	{
//		$model=new AdClientActivity;
//
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//		if(isset($_POST['AdClientActivity']))
//		{
//			$model->attributes=$_POST['AdClientActivity'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->id));
//		}
//
//		$this->render('create',array(
//		'model'=>$model,
//		));
//	}
//
//	/**
//	* Updates a particular model.
//	* If update is successful, the browser will be redirected to the 'view' page.
//	* @param integer $id the ID of the model to be updated
//	*/
//	public function actionUpdate($id)
//	{
//		$model=$this->loadModel($id);
//
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//		if(isset($_POST['AdClientActivity']))
//		{
//			$model->attributes=$_POST['AdClientActivity'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->id));
//		}
//
//		$this->render('update',array(
//			'model'=>$model,
//		));
//	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

//	/**
//	* Lists all models.
//	*/
//	public function actionIndex()
//	{
//		$dataProvider=new CActiveDataProvider('AdClientActivity');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
//	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new AdClientActivity('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AdClientActivity']))
			$model->attributes=$_GET['AdClientActivity'];

                $user = $this->loadUserData();
                
		$this->render('admin',array(
			'model'=>$model,
                        'profile'=>$user,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return AdClientActivity the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=AdClientActivity::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param AdClientActivity $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ad-client-activity-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
    public function loadUserData(){

        if (Yii::app()->user->id) {
            $dependency = new CDbCacheDependency('SELECT lastvisit_at FROM tbl_users WHERE id='.Yii::app()->user->id);
            $_user = User::model()->cache(36000, $dependency, 3)->with('profile','profession')->findByPk(Yii::app()->user->id);
        } else {
            $_user = false;
        }

        return $_user;
    }
        
	/**
	* Creates a new model activity.
	*/
	public function actionSubmit()
	{
		if(
			Yii::app()->request->isAjaxRequest
			&& isset($_GET['id'])
			&& ($client = AdClient::model()->with(array('adCategory'))->findByPk(intval($_GET['id'])))
		)
		{
			if(!Yii::app()->user->isGuest) {
				$model=new AdClientActivity;
			} else {
				$model=new AdClientActivity('guest');
			}

			$model->client_id = $client->id;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidationActivity($model);

			if(isset($_POST['AdClientActivity']))
			{
				$result = array(
					'success' => false,
					'errors' => 'error',
				);
				$model->attributes=$_POST['AdClientActivity'];
				if(!Yii::app()->user->isGuest) {
					$model->user_id = Yii::app()->user->id ;
				}
				if($model->save()) {
								$result = array(
									'adCompany' => $client,
									'adCategory' => $client->adCategory,
									'success' => true,
									'errors' => '',
								);
	//                            $this->redirect(array('view','id'=>$model->id));
							} else {
								$result['errors']=CHtml::errorSummary($model);
							}

				$email = Yii::app()->params['adminEmailForLocalVendorActivities'];
//				$email = 'gulosaurus@gmail.com';	//use this email for testing
				$this->sendEmailToAdmin($model, $client, $email);

				header('Content-Type: application/json; charset="UTF-8"');
				echo CJSON::encode($result);
				Yii::app()->end();
			}

			$this->renderPartial('_formModalUser',array(
			'model'=>$model, 'client'=>$client,
			), false, true);
		} else {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
	}

	/**
	 * Send local service activity email to Admin
	 *
	 * @param AdClientActivity $model
	 * @param AdClient $client
	 * @param $email
	 * @return bool
	 * @throws CException
	 * @throws Exception
	 * @throws phpmailerException
	 */
	public function sendEmailToAdmin(AdClientActivity $model, AdClient $client, $email){

		$templateData = array(
			'customerInfo' => $model,
			'clientCompany' => $client
		);
		$html = $this->renderPartial('emailToAdminTpl', $templateData, true);
		$mail = new YiiMailer();
		$mail->clearLayout();//if layout is already set in config
		$mail->setFrom('noreply@irradii.com', 'irradii.com');
		$mail->setTo($email);
		$mail->setSubject('Local Services');
		$mail->setBody($html);
		if($result = $mail->send()) {
			//              Yii::log('Email Alert: Sent to ' . $email ,'ERROR');
		} else {
			Yii::log('Email Alert: NOT Sent to ' . $email ,'ERROR');
		}
		return $result;
	}


	/**
	 * Send email to the advertiser.
	 *
	 * @param $id
	 * @throws CHttpException
	 */
	public function actionEmail($id)
	{
            $model=$this->loadModel($id);
			$client = AdClient::model()->with(array('adCategory'))->findByPk($model->client_id);
            if( $model->status_activity != AdClientActivity::SENDED) {

                if($this->sendEmailToAdmin($model, $client, $client->contact_email)) // send email
                {
                        $model->status_activity = AdClientActivity::SENDED;
                        if($model->save()) {
                            Yii::app()->user->setFlash('profileMessage','Has been sent');
                        } else {
                            Yii::app()->user->setFlash('profileMessage','Error save status ( Sent )');
                        }
                } else {
                    Yii::app()->user->setFlash('profileMessage','Not Sent');
                }
            } else {
                Yii::app()->user->setFlash('profileMessage','Already Sent');
            }
            $this->redirect(array('admin'));
        }
}