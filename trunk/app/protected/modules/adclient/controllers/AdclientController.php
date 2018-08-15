<?php

class AdclientController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/irradii';

        public $allowed_types = array(
            'image/jpeg'=>'image/jpeg',
            'image/png'=>'image/png',
            'image/gif'=>'image/gif'
        );

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
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('*'),
//			),
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

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new AdClient;
                
                $adStates = array();
                $adCounties = array();
                $adCities = array();
                $adZipcodes = array();


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AdClient']))
		{
                        $adStates = !empty($_POST['ad_state_id'])?$_POST['ad_state_id']:array();
                        $adCounties = !empty($_POST['ad_county_id'])?$_POST['ad_county_id']:array();
                        $adCities = !empty($_POST['ad_city_id'])?$_POST['ad_city_id']:array();
                        $adZipcodes = !empty($_POST['ad_zipcode_id'])?$_POST['ad_zipcode_id']:array();
                        
			$model->attributes=$_POST['AdClient'];
                        $logo = $this->uploadLogo('AdClient[company_logo]');
                        if(!empty($logo)) {
                            $model->company_logo = $logo;
                        }
			if($model->save()) {
                            $countAdClientStateOld = AdClientState::getCountAds($model->id);
                            if(!empty($countAdClientStateOld)){
                                AdClientState::model()->deleteAll('ad_client_id = ?' , array($model->id));
                            }
                            if(!empty($_POST['ad_state_id'])) {
                                AdClientState::saveAds($model, $_POST['ad_state_id']);
                            }

                            $countAdClientCountyOld = AdClientCounty::getCountAds($model->id);
                            if(!empty($countAdClientCountyOld)){
                                AdClientCounty::model()->deleteAll('ad_client_id = ?' , array($model->id));
                            }
                            if(!empty($_POST['ad_county_id'])) {
                                AdClientCounty::saveAds($model, $_POST['ad_county_id']);
                            }

                            $countAdClientCityOld = AdClientCity::getCountAds($model->id);
                            if(!empty($countAdClientCityOld)){
                                AdClientCity::model()->deleteAll('ad_client_id = ?' , array($model->id));
                            }
                            if(!empty($_POST['ad_city_id'])) {
                                AdClientCity::saveAds($model, $_POST['ad_city_id']);
                            }

                            $countAdClientZipcodeOld = AdClientZipcode::getCountAds($model->id);
                            if(!empty($countAdClientZipcodeOld)){
                                AdClientZipcode::model()->deleteAll('ad_client_id = ?' , array($model->id));
                            }
                            if(!empty($_POST['ad_zipcode_id'])) {
                                AdClientZipcode::saveAds($model, $_POST['ad_zipcode_id']);
                            }

				$this->redirect(array('admin'));
                        }
		}

                $user = $this->loadUserData();

		$this->render('create',array(
			'model' =>$model,
                        'adStates' => $adStates,
                        'adCounties' => $adCounties,
                        'adCities' => $adCities,
                        'adZipcodes' => $adZipcodes,
                        'profile' =>$user,
		));
	}

	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	* @param integer $id the ID of the model to be updated
	*/
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                
                $adStates = AdClientState::getAds($model->id);
                $adCounties = AdClientCounty::getAds($model->id);
                $adCities = AdClientCity::getAds($model->id);
                $adZipcodes = AdClientZipcode::getAds($model->id);
                

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AdClient']))
		{
                        $adStates = !empty($_POST['ad_state_id'])?$_POST['ad_state_id']:array();
                        $adCounties = !empty($_POST['ad_county_id'])?$_POST['ad_county_id']:array();
                        $adCities = !empty($_POST['ad_city_id'])?$_POST['ad_city_id']:array();
                        $adZipcodes = !empty($_POST['ad_zipcode_id'])?$_POST['ad_zipcode_id']:array();
                        
                        $logoOld = $model->company_logo;
			$model->attributes=$_POST['AdClient'];
                        $logo = $this->uploadLogo('AdClient[company_logo]');
                        if(!empty($logo)) {
                            $model->company_logo = $logo;
                        } else {
                            $model->company_logo = $logoOld;
                        }
			if($model->save()) {
                            $countAdClientStateOld = AdClientState::getCountAds($model->id);
                            if(!empty($countAdClientStateOld)){
                                AdClientState::model()->deleteAll('ad_client_id = ?' , array($model->id));
                            }
                            if(!empty($_POST['ad_state_id'])) {
                                AdClientState::saveAds($model, $_POST['ad_state_id']);
                            }

                            $countAdClientCountyOld = AdClientCounty::getCountAds($model->id);
                            if(!empty($countAdClientCountyOld)){
                                AdClientCounty::model()->deleteAll('ad_client_id = ?' , array($model->id));
                            }
                            if(!empty($_POST['ad_county_id'])) {
                                AdClientCounty::saveAds($model, $_POST['ad_county_id']);
                            }

                            $countAdClientCityOld = AdClientCity::getCountAds($model->id);
                            if(!empty($countAdClientCityOld)){
                                AdClientCity::model()->deleteAll('ad_client_id = ?' , array($model->id));
                            }
                            if(!empty($_POST['ad_city_id'])) {
                                AdClientCity::saveAds($model, $_POST['ad_city_id']);
                            }

                            $countAdClientZipcodeOld = AdClientZipcode::getCountAds($model->id);
                            if(!empty($countAdClientZipcodeOld)){
                                AdClientZipcode::model()->deleteAll('ad_client_id = ?' , array($model->id));
                            }
                            if(!empty($_POST['ad_zipcode_id'])) {
                                AdClientZipcode::saveAds($model, $_POST['ad_zipcode_id']);
                            }

				$this->redirect(array('admin'));
                        }
		}

                $user = $this->loadUserData();

		$this->render('update',array(
			'model' =>$model,
                        'adStates' => $adStates,
                        'adCounties' => $adCounties,
                        'adCities' => $adCities,
                        'adZipcodes' => $adZipcodes,
                        'profile' =>$user,
		));
	}

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

	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AdClient');
		$user = $this->loadUserData();
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
                        'profile'=>$user,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new AdClient('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AdClient']))
			$model->attributes=$_GET['AdClient'];

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
	* @return AdClient the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=AdClient::model() // ->with('adClientStates','adClientCities','adClientCounties','adClientZipcodes')
                        ->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param AdClient $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ad-client-form')
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
	 * Upload file logo
	 */
	public function uploadLogo($file =  'file')
	{
            $url = '';
            $error = 1;
            $result = '';
                $cdnImages = Yii::app()->params['cdnImages'];
                $upload_image =  CUploadedFile::getInstanceByName($file);
                if($upload_image){
                    // Check to make sure the image type is allowed
                    if ( isset($this->allowed_types[$upload_image->type])) {
                        $filename_avatar = mktime().$upload_image->name;
                        if(!empty($cdnImages)) {
                            CPathCDN::uploadS3Files($upload_image, 'adclient', $filename_avatar );
                            $url = $cdnImages . '/images/adclient/' . $filename_avatar;
                            $result = 'Success upload file';
                            $error = 0;
                        } else {
                            $result = 'Error upload file';
                        }
                    } else {
			$result = 'Image type not allowed';
                    }
                } else {
                    $result = 'File not uploaded';
                }
            return $url;
	}
        
	/**
	 * Suggests Cities based on the current user input.
	 * This is called via AJAX when the user is entering the Cities input.
	 */
	public function actionSuggestcities()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
                    if(isset($_GET['page']) && intval($_GET['page'])> 0 ) {
                        $page = intval($_GET['page']);
                    } else {
                        $page = 1;
                    }
                    $items=City::model()->suggestItems($keyword, 30, $page);
                    $itemsCount=City::model()->countSuggestItems($keyword);
			
                    echo CJSON::encode(array('items'=>$items, 'total_count'=>$itemsCount,'incomplete_results'=>false));
                    Yii::app()->end();
		}
                echo CJSON::encode(array('items'=>array(), 'total_count'=>0,'incomplete_results'=>false));
                Yii::app()->end();
                
	}

	/**
	 * Suggests zipcode based on the current user input.
	 * This is called via AJAX when the user is entering the zip input.
	 */
	public function actionSuggestzip()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
                    if(isset($_GET['page']) && intval($_GET['page'])> 0 ) {
                        $page = intval($_GET['page']);
                    } else {
                        $page = 1;
                    }
                    $items=Zipcode::model()->suggestItems($keyword, 30, $page);
                    $itemsCount=Zipcode::model()->countSuggestItems($keyword);
			
                    echo CJSON::encode(array('items'=>$items, 'total_count'=>$itemsCount,'incomplete_results'=>false));
                    Yii::app()->end();
		}
                echo CJSON::encode(array('items'=>array(), 'total_count'=>0,'incomplete_results'=>false));
                Yii::app()->end();
                
	}

}