<?php

class SearchesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $defaultAction = 'details';
    public $layout = '//layouts/irradii';

    public $defaultAction = 'alerts';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            //'postOnly + delete', // we only allow deletion via POST request
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('alerts', 'delete', 'editable'),
                'users'=>array('@'),
            ),
            array('allow',
                'actions'=>array('unsubscribe'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actions() {
        return array(
            //'yiichat' => array('class' => 'YiiChatAction'),
            //'chat' => array('class' => 'ChatAction'),
            //'messages' => array('class' => 'ChatMessages'),
            //'online' => array('class' => 'ChatOnline'),
        );
    }


    public function actionAlerts(){

        if(Yii::app()->user->isGuest)
            $this->redirect('/user/login');

        $model = User::model()->cache(1000)->with('profile', 'profession')->findByPk(Yii::app()->user->id);
        if (!is_object($model)) {
            $this->redirect(Yii::app()->createUrl('/user/login'));
        }
        $profile = $model->profile;


        $pageConfig = array(
            'totalSearchResultTables' => 5,
            'rowsInSearchResultTable' => 3,
        );



        $criteria = new CDbCriteria(array(
            'condition'=>"user_id=".Yii::app()->user->getId(),
            'order'=>'t.id DESC',
            'with'=>array('savedSearchCriteria', 'alertEmails'),
        ));
        $savedSearches = SavedSearch::model()->findAll($criteria);


//foreach($savedSearches as $savedSearch){
//    var_dump($savedSearch->id);
//}
         $count = 0;
         $partials = array();
         foreach($savedSearches as $savedSearch){

             if($count >= $pageConfig['totalSearchResultTables'])
                 break;

             $searchResults = $savedSearch->makeSearch(array(
                 'limit' => $pageConfig['rowsInSearchResultTable']
             ));

             $property_models = PropertyInfo::model()/*->cache(1000, null, 7)*/->with('city', 'county', 'state', 'zipcode', 'propertyInfoAdditionalBrokerageDetails', 'brokerage_join', 'slug')->findAllByAttributes(array('property_id' => $searchResults),array('order'=>'t.property_id DESC'));

//var_dump($property_models);

             $partialViewData = array(
                 'table_header' => $savedSearch->name,
                 'property_models' => $property_models
             );

             $partials[] = $this->renderPartial('_recentSearchResultTable', $partialViewData, true);

             $count++;
         }



        $viewData = array(
            'profile' => $profile,
            'savedSearches' => $savedSearches,
            'partials' => $partials,
        );

        $this->render('alerts', $viewData);
    }

    public function actionDelete(){
        if (!YII_DEBUG && !Yii::app()->request->isAjaxRequest) {
            throw new CHttpException('403', 'Forbidden access.');
        }

        $id = Yii::app()->request->getParam('id');
        if (!$id) {
            throw new CHttpException('404', 'Missing "id" POST parameter.');
        }

        $model = SavedSearch::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');

        if($model->user_id != Yii::app()->user->getId())
            throw new CHttpException('403', 'Forbidden access.');

        $model->delete();

        $response = array(
            'success' => true,
        );

        header('Content-Type: application/json; charset="UTF-8"');
        echo json_encode($response);
        Yii::app()->end();
    }

    public function actionEditable(){
        if (!YII_DEBUG && !Yii::app()->request->isAjaxRequest) {
            throw new CHttpException('403', 'Forbidden access.');
        }

        $name = Yii::app()->request->getParam('name');
        if (!$name) {
            throw new CHttpException('404', 'Missing "name" POST parameter.');
        }

        $additionalResponse = array();
        switch($name){
            case 'name':
                $additionalResponse = $this->editableName(Yii::app()->request);
                break;
            case 'email':
                $additionalResponse = $this->editableEmail(Yii::app()->request);
                break;

            case 'email_alert_freq':
                $additionalResponse = $this->editableEmailAlertFreq(Yii::app()->request);
                break;

            case 'expiry_date':
                $additionalResponse = $this->editableExpiryDate(Yii::app()->request);
                break;
            default:
                throw new CHttpException('404', 'Unknown "name" parameter.');
                break;
        }


        /*
        $id = Yii::app()->request->getParam('id');
        if (!$id) {
            throw new CHttpException('404', 'Missing "id" POST parameter.');
        }

        $model = SavedSearch::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');

        if($model->user_id != Yii::app()->user->getId())
            throw new CHttpException('403', 'Forbidden access.');
*/


        $response = array();

        $response = array_merge($response, $additionalResponse);

        header('Content-Type: application/json; charset="UTF-8"');
        echo json_encode($response);
        Yii::app()->end();
    }


    public function editableName(CHttpRequest $request){
        $response = array();

        $pk = intval($request->getParam('pk'));
        $value = trim($request->getParam('value'));

        $model = SavedSearch::model()->findByPk($pk);
        $model->name = $value;

        if(!$model->validate()){
            return array(
                'success' => false,
                'errors' => $model->getErrors(),
            );
        }

        $model->save(false);

        return $response;
    }

    public function editableExpiryDate(CHttpRequest $request){
        $response = array();

        $pk = intval($request->getParam('pk'));
        $value = trim($request->getParam('value'));

        $expiriDateTime = DateTime::createFromFormat('Y-m-d', $value);

        $model = SavedSearch::model()->findByPk($pk);
        $model->expiry_date = $expiriDateTime->format('Y-m-d H:i:s');
        $model->save(false);

        return $response;
    }

    public function editableEmailAlertFreq(CHttpRequest $request){
        $response = array();

        $pk = intval($request->getParam('pk'));
        $value = trim($request->getParam('value'));

        $model = SavedSearch::model()->findByPk($pk);
        $model->email_alert_freq = $value;
        $model->save(false);

        return $response;
    }

    public function editableEmail(CHttpRequest $request){

        $pk = intval($request->getParam('pk'));
        $value = trim($request->getParam('value'));

        if($pk == 0){ // add new record

            return $this->editableAddEmail($request);
        }elseif($value == ''){// delete record

            return $this->editableDeleteEmail($request);
        }else{// update record

            return $this->editableUpdateEmail($request);
        }
    }

    protected function editableAddEmail(CHttpRequest $request){
        $saved_search_id = intval($request->getParam('saved_search_id'));
        $value = trim($request->getParam('value'));

        $model = new SavedSearchEmail();
        $model->saved_search_id = $saved_search_id;
        $model->email = $value;

        if($model->save()){
            $response['success'] = true;
            $response['new_id'] = $model->id;

        }else{
            $response = array(
                'success' => false,
                'errors' => $model->getErrors(),
            );
        }

        return $response;
    }

    protected function editableUpdateEmail(CHttpRequest $request){
        $pk = intval($request->getParam('pk'));
        $value = trim($request->getParam('value'));

        $model = SavedSearchEmail::model()->findByPk($pk);
        $model->email = $value;

        if($model->save()){
            $response['success'] = true;
        }else{
            $response = array(
                'success' => false,
                'errors' => $model->getErrors(),
            );
        }

        return $response;
    }

    protected function editableDeleteEmail(CHttpRequest $request){
        $pk = intval($request->getParam('pk'));

        $model = SavedSearchEmail::model()->deleteAll(
            'id = :id',
            array('id' => $pk));

        $response['success'] = true;
        $response['deleted_id'] = $pk;


        return $response;
    }

    public function actionUnsubscribe($email){
        $email = trim($email);

        if(!$email)
            $this->redirect('/searches/alerts/');

        $user = User::model()->find('username=:username', array(':username'=>$email));

        if(is_object($user)){

            // find saved searche by this user and set them frequency = never
            var_dump($user->id);

            SavedSearch::model()->updateAll(array('email_alert_freq'=>SavedSearch::EMAIL_FREQ_NEVER),'user_id = :user_id',array(':user_id'=>$user->id));

            $this->redirect('/searches/alerts/');

            Yii::app()->end();
        }

        SavedSearchEmail::model()->deleteAll('email = :email',
            array(':email' => $email));

        $this->redirect('/searches/alerts/');

        //echo Yii::app()->createAbsoluteUrl('/searches/unsubscribe/', array('email'=>'ddd@ddd.ru'));

        //$this->redirect('/searches/alerts/');

    }
} 