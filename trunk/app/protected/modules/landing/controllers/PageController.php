<?php

class PageController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/irradii';

    /**
     * @return array action filters
     */

    public function filters()
    {
        $filters = array();
        $filters[] = 'accessControl'; // perform access control for CRUD operations
        $filters[] = 'postOnly + delete'; // we only allow deletion via POST request

        // do caching only if guest user
        if (Yii::app()->user->isGuest) {    
            // output caching
            $filters[] = array(
                'COutputCache + index, view',
                'duration' => 3600,
                'varyByRoute' => true,
                'varyByParam' => array('id'),
            );
        }

        return $filters;
    }
    
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('addsearch'),
                'users'=>array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
//				'users'=>array('@'),
                'roles' => array('admin'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'roles' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $modelLanding = $this->loadModel($id);
        
        $pageConfig = array(
            'rowsInSearchResultTable' => 1000,
        );
        $result = array(
            'count_result' => 0,
            'result' => array(),
            'res_map_layout' => array(),
            'status' => 'failed',
            'latlon' => array(0,0),
        );

        $savedSearch = SavedSearch::model()->findByPk($modelLanding->search_id);
        
        if($savedSearch) {

            $searchResults = $savedSearch->makeSearch(array(
                'limit' => $pageConfig['rowsInSearchResultTable']
            ));
            // @doto Set cache with CDbCacheDependency
            $property_models = PropertyInfo::model()/*->cache(1000, null, 8)*/
                    ->with('city', 'county', 'state', 'zipcode',
                            'propertyInfoAdditionalBrokerageDetails', 'brokerage_join', 'slug',
                            'propertyInfoPhoto')->findAllByAttributes(array('property_id' => $searchResults),array('order'=>'t.property_id DESC'));
            if (!empty($property_models)) {
                $result = array(
                    'count_result' => count($property_models),
                    'result' => array(),
                    'res_map_layout' => SiteHelper::getSearchMapResult($property_models),
                    'status' => 'success',
                    'latlon' => SiteHelper::getLatLonResult($property_models),
                    );
            }
        }
                
        $this->render('view', array(
            'model' => $modelLanding,
            'profile'=>$this->loadUserData(),
            'search_results' =>  $result,

        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new LandingPage;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['LandingPage'])) {
            $model->attributes = $_POST['LandingPage'];
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('create', array(
            'model' => $model,
            'profile'=>$this->loadUserData(),
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['LandingPage'])) {
            $model->attributes = $_POST['LandingPage'];
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('update', array(
            'model' => $model,
            'profile'=>$this->loadUserData(),
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('LandingPage', array(
			'criteria'=>array(
        			'condition'=>'t.status='.LandingPage::STATUS_PUBLISHED,
				'with'=>array('search', 'postTop', 'postBottom'),
				'order'=>'t.updated_at DESC',
			),
            ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'profile'=>$this->loadUserData(),
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new LandingPage('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['LandingPage']))
            $model->attributes = $_GET['LandingPage'];

        $this->render('admin', array(
            'model' => $model,
            'profile'=>$this->loadUserData(),
        ));
    }

    /**
     * 
     */
    public function actionAddSearch() {
        if(Yii::app()->request->isAjaxRequest){
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            $result = array(
                'success' => false,
                'errors' => 'error',
            );

            $model = $this->loadModel($id);
            if($model) {
                $savedSearch = SavedSearch::model()->with('savedSearchCriteria')->findByPk($model->search_id);
                if($savedSearch) {
                    $newName = $model->title;
                    $alreadyExistSearch = SavedSearch::model()->find(array(
                        'condition' => 't.user_id=:user_id AND t.name=:name',
                        'params'  => array(':user_id'=>Yii::app()->user->id, ':name' => $newName)
                    ));
                    if(empty($alreadyExistSearch)) { 
                        $result = $this->copySearchSaved($savedSearch, $newName);
                    } else {
                        $result = array(
                            'success' => false,
                            'errors' => 'exist',
                        );
                    }
                }
            }
            header('Content-Type: application/json; charset="UTF-8"');
            echo CJSON::encode($result);
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return LandingPage the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        if(Yii::app()->user->isGuest) {
                $condition='t.status='.LandingPage::STATUS_PUBLISHED.' OR t.status='.LandingPage::STATUS_ARCHIVED;
        } else {
            if(SiteHelper::isAdmin()) {
                $condition='';
            } else {
                $condition='t.status='.LandingPage::STATUS_PUBLISHED.' OR t.status='.LandingPage::STATUS_ARCHIVED;
            }
        }
        $model = LandingPage::model()->with('search', 'postTop', 'postBottom')->findByPk($id, $condition);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param LandingPage $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'landing-page-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function loadUserData() {

        if (Yii::app()->user->id) {
            $dependency = new CDbCacheDependency('SELECT lastvisit_at FROM tbl_users WHERE id=' . Yii::app()->user->id);
            $_user = User::model()->cache(36000, $dependency, 3)->with('profile', 'profession')->findByPk(Yii::app()->user->id);
        } else {
            $_user = false;
        }

        return $_user;
    }

    protected function copySearchSaved(SavedSearch $savedSearchModelOrg, $tag = '') {
        $db_datetime_format = 'Y-m-d H:i:s';
        $now = new DateTime('now');

        if ($savedSearchModelOrg) {
            $savedSearchModel = new SavedSearch('create');

            $expiry = clone $now;
            $expiry->add(new DateInterval("P1Y"));

            $savedSearchModel->setAttributes(array(
                'name' => !empty($tag)?$tag:'Copy '.$savedSearchModelOrg->name,
                'user_id' => Yii::app()->user->id,
                'email_alert_freq' => SavedSearch::EMAIL_FREQ_DAILY,
                'expiry_date' => $expiry->format($db_datetime_format),
            ));

            if ($savedSearchModel->save()) {
                $savedSearchModel->refresh();
            }

            foreach ($savedSearchModelOrg->savedSearchCriteria as $value) {
                $savedSearchCriteriaModel = new SavedSearchCriteria('create');

                $savedSearchCriteriaModel->setAttributes(array(
                    'saved_search_id' => $savedSearchModel->id,
                    'attr_name' =>  $value->attr_name,
                    'attr_value' => $value->attr_value,
                ));

                $savedSearchCriteriaModel->save();
            }

            $model = new SavedSearchEmail();
            $model->saved_search_id = $savedSearchModel->id;
            $model->email = Yii::app()->user->username;

            if($model->save()){
                $response['success'] = true;
            }else{
                $response = array(
                    'success' => false,
                    'errors' => $model->getErrors(),
                );
            }
        }else{
            $response = array(
                'success' => false,
                'errors' => 'error',
            );
        }

        return $response;        
    }

}
