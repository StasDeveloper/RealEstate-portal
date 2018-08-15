<?php
class DebugController extends Controller {

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
                            'actions'=>array('emailAlertCheck'),
                            'roles'=>array('admin'),
//                                'expression'=>'Yii::app()->controller->isAdmin()'
                    ),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('@'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
                    array('deny',  // deny all users
                            'users'=>array('*'),
                    ),
            );
    }

    public function actionEmailAlertCheck(){
        $db_format = 'Y-m-d';
        $db_full_format = 'Y-m-d H:i:s';

        $date = Yii::app()->getRequest()->getParam('date');
        if(!$date)
            die("no 'date' in request");

        $savedSearchID = intval(Yii::app()->getRequest()->getParam('searchid'));
        if(!$savedSearchID)
            die("no 'searchid' in request");

        $from_data = DateTime::createFromFormat($db_format, $date);
        $to_data = DateTime::createFromFormat($db_format, $date);

        if(!$from_data || !$to_data)
        {
            die('Invalid date param');
        }


        $criteria = new CDbCriteria;
        $criteria->condition ='(DATE(property_uploaded_date) >= \''.$from_data->format($db_format).'\' AND ';
        $criteria->condition .='DATE(property_uploaded_date) <= \''.$to_data->format($db_format).'\') OR ';
        $criteria->condition .='(DATE(property_updated_date) >= \''.$from_data->format($db_format).'\' AND ';
        $criteria->condition .='DATE(property_updated_date) <= \''.$to_data->format($db_format).'\')';
        $criteria->order ='property_id DESC';

        $propertyModels = PropertyInfo::model()->findAll($criteria);

        $savedSearchModel = SavedSearch::model()->findByPk($savedSearchID);
        if(!$savedSearchModel)
        {
            die('Saved Search Model not Found');
        }



        foreach($propertyModels as $propertyModel){

            $match = $savedSearchModel->isMatch($propertyModel);

            if($match === true){
                echo '<span style="color:green">'.$propertyModel->property_id.': true</span><br>';
            }else{
                if($match !== false){
                    var_dump($match);
                    var_dump('BIG ERROR');
                }
                echo '<span style="color:gray"><small>'.$propertyModel->property_id.': false</small></span><br>';
            }
        }
    }

}