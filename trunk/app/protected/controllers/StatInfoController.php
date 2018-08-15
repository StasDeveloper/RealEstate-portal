<?php

class StatInfoController extends Controller
{
    public $dollar_value = array();


    /**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/column1';

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
				'actions'=>array('index','view','factor', 'factorupdate', 'propertyupdate', 'history', 'uploadalertsmessages'),
				'roles'=>array('admin'),
//                                'expression'=>'Yii::app()->controller->isAdmin()'
			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('history'),
//				'users'=>array('*'),
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

	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
            $modelPhoto = new CArrayDataProvider(Yii::app()->db->createCommand("
SELECT * , COUNT( * ) as count_by
FROM `tbl_property_info_cron_load_photo` 
GROUP BY `process_at` 
            ")->queryAll());

            $totalPhoto = Yii::app()->db->createCommand("
SELECT COUNT( * ) as countAll
FROM `tbl_property_info_cron_load_photo` 
            ")->queryScalar();

            $modelCoord = new CArrayDataProvider(Yii::app()->db->createCommand("
SELECT property_info.property_id as id, property_info.property_street, property_info.property_zipcode, property_updated_date, COUNT(property_updated_date )  as count_by 
FROM property_info
INNER JOIN property_info_details ON property_info_details.property_id = property_info.property_id
WHERE property_info.getlongitude = '0.000000'
AND property_info.getlatitude = '0.000000'
AND UPPER( `property_info`.`property_status` ) = 'ACTIVE'
GROUP BY property_updated_date
ORDER BY property_info.property_id DESC 
            ")->queryAll());

            $totalCoord = Yii::app()->db->createCommand("
SELECT COUNT( * ) as countAll
FROM property_info
INNER JOIN property_info_details ON property_info_details.property_id = property_info.property_id
WHERE property_info.getlongitude = '0.000000'
AND property_info.getlatitude = '0.000000'
AND UPPER( `property_info`.`property_status` ) = 'ACTIVE'
GROUP BY property_updated_date
ORDER BY property_info.property_id DESC 
            ")->queryScalar();
            
            $modelPrice = new CArrayDataProvider(Yii::app()->db->createCommand("
SELECT est_id as id, property_zipcode, last_property_id, created_at , COUNT( * ) as count_by
FROM `property_info_cron_estimated_price` 
WHERE 1 
GROUP BY `property_zipcode` 
ORDER BY  `created_at` ASC 
            ")->queryAll());

            $totalPrice = Yii::app()->db->createCommand("
SELECT COUNT( * ) as countAll
FROM (
    SELECT COUNT( * ) as countAll
    FROM `property_info_cron_estimated_price` as t1
    WHERE 1 
    GROUP BY t1.`property_zipcode` 
) as t0
WHERE 1 
            ")->queryScalar();
            
            $modelProperty = new CArrayDataProvider(Yii::app()->db->createCommand("
SELECT  `property_id` AS id,  `property_updated_date` ,  `property_expire_date` , COUNT( * ) AS count_by
FROM  `property_info` 
WHERE 1 
GROUP BY  `property_updated_date` 
ORDER BY  `property_updated_date` DESC 
LIMIT 0 , 7
            ")->queryAll());

            $totalProperty = Yii::app()->db->createCommand("
SELECT COUNT( * ) as countAll
FROM `property_info` 
WHERE 1 
            ")->queryScalar();

            $modelProperty1 = new CArrayDataProvider(Yii::app()->db->createCommand("
SELECT  `property_id` AS id,  `property_uploaded_date` ,  `property_expire_date` , COUNT( * ) AS count_by
FROM  `property_info` 
WHERE 1 
GROUP BY  `property_uploaded_date` 
ORDER BY  `property_uploaded_date` DESC 
LIMIT 0 , 7
            ")->queryAll());

            $modelPriceDate = new CArrayDataProvider(Yii::app()->db->createCommand("
SELECT  `property_id` AS id,  DATE(`estimated_price_recalc_at`) as estimated_price_recalc_at , COUNT( * ) AS count_by
FROM  `property_info` 
WHERE     `property_type` NOT IN (0,4,5) AND
    UPPER(`property_info`.`property_status`)='ACTIVE' 
GROUP BY  DATE(`estimated_price_recalc_at`) 
ORDER BY  `estimated_price_recalc_at` DESC 
LIMIT 0 , 7
            ")->queryAll());
$maxEstimatedPriceRecalc = isset(Yii::app()->params['maxEstimatedPriceRecalc'])? Yii::app()->params['maxEstimatedPriceRecalc'] : 2;
            $needRecalculate = Yii::app()->db->createCommand("
SELECT COUNT( * ) as countAll
FROM `property_info` 
WHERE UPPER(`property_info`.`property_status`)='ACTIVE' AND
    `property_type` NOT IN (0,4,5) AND
    `estimated_price_recalc_at` <= DATE_ADD(CURDATE(), INTERVAL -{$maxEstimatedPriceRecalc} DAY) 
            ")->queryScalar();

            $this->render('index',array(
			'modelPhoto'=>$modelPhoto,
                        'totalPhoto'=>$totalPhoto,
			'modelCoord'=>$modelCoord,
                        'totalCoord'=>$totalCoord,
			'modelPrice'=>$modelPrice,
                        'totalPrice'=>$totalPrice,
                        'modelProperty'=>$modelProperty,
                        'modelProperty1'=>$modelProperty1,
                        'totalProperty'=>$totalProperty,
                        'modelPriceDate'=>$modelPriceDate,
                        'needRecalculate'=>$needRecalculate,
		));
	}


    /**
     *  Show Search page for property history searching
     */
    public function actionHistory(){
            $model=new PropertyInfoHistory('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['PropertyInfoHistory'])) {
                $model->attributes = $_GET['PropertyInfoHistory'];
            }
                $this->render('propertyHistorySearch',array(
                    'model'=>$model
                ));
    }

        
	public function actionFactor( $id = null)
	{
            if(!empty($id)) {

                $property = MarketTrendTable::getPropertyInfo($id);

                if(!empty($property)) {

                    $factorsStr = MarketTrendTable::searchFactors( $property );
                    $factorsParam = MarketTrendTable::searchFactorsParam( $property );
    //Yii::log(print_r($factorsStr,1 ) ,'ERROR'); 
    //Yii::log(print_r($factorsParam,1 ) ,'ERROR'); 
                    $factorsNew = (array)MarketTrendTable::getFactorsRow($property);
                    $newFactors = MarketTrendTable::getFactors($property);

                    $details = PropertyInfo::model()->with(
                                'propertyInfoDetails'
                                )->findByPk($id);

                    $estimatedValues = $this->recalcEstimatedPrice($details, $newFactors['fundamentals_factor'], $newFactors['conditional_factor'] );

                    $estimatedValueTable = array();
                    foreach ($factorsNew as $key => $value) {
                        if(!empty($estimatedValues['result_query'])) {
                            if($value->factor_type == 'conditional_factor') {
                                $estimatedPriceDelta = EstimatedPrice::getEstimatedPriceValue(  
                                                            $newFactors['fundamentals_factor'], $newFactors['conditional_factor']-$value->factor_value , $estimatedValues['comps'], 
                                                            $estimatedValues,
                                                            $details->house_square_footage, $details->lot_acreage, $details->bathrooms, $details->garages, $details->pool, $details->bedrooms
                                                            , $estimatedValueTable
                                );
                                $this->dollar_value[$value->id] = '$'. number_format($estimatedValues['estimated_price'] - $estimatedPriceDelta,2);
                            } else {
                                if($value->factor_type == 'fundamentals_factor') {
                                    $estimatedPriceDelta = EstimatedPrice::getEstimatedPriceValue(  
                                                                $newFactors['fundamentals_factor']-$value->factor_value, $newFactors['conditional_factor'], $estimatedValues['comps'], 
                                                                $estimatedValues,
                                                                $details->house_square_footage, $details->lot_acreage, $details->bathrooms, $details->garages, $details->pool, $details->bedrooms
                                                                , $estimatedValueTable
                                    );
                                    $this->dollar_value[$value->id] = '$'. number_format($estimatedValues['estimated_price'] - $estimatedPriceDelta,2);
                                } else {
                                    $this->dollar_value[$value->id] = '';
                                }
                            }
                        } else {
                            $this->dollar_value[$value->id] = '';
                        }
                    }
                    if(!empty($estimatedValues['result_query'])) {
                        $estimatedPrice = EstimatedPrice::getEstimatedPriceValue(  
                                                    $newFactors['fundamentals_factor'], $newFactors['conditional_factor'], $estimatedValues['comps'], 
                                                    $estimatedValues,
                                                    $details->house_square_footage, $details->lot_acreage, $details->bathrooms, $details->garages, $details->pool, $details->bedrooms
                                                    , $estimatedValueTable
                        );
                    } else {
                        $estimatedPrice = '';
                    }
    //Yii::log(print_r($this->dollar_value,1 ) ,'ERROR'); 

                    $property['id'] = $id;
                    $result_query = (!empty($estimatedValues['result_query']))?(array)$estimatedValues['result_query']:array();
                    $result_query['id'] = 1;
                    $result_query_all = array();
                    if(!empty($estimatedValues['result_queryAllRows'])) {
                        foreach ($estimatedValues['result_queryAllRows'] as $key => $value) {
                            $result_query_tmp = $value;
                            $result_query_tmp['id'] = $key;
                            $result_query_all[] = $result_query_tmp;
                        }
                    }
                    $this->render('factor',array(
                            'property_id'=>$id,
                            'property_price'=>$property['property_price'],
                            'property'=>new CArrayDataProvider(array($property)),
    //                        'factors'=>new CArrayDataProvider($factors),
                            'factorsNew'=>new CArrayDataProvider($factorsNew,array('pagination'=>array('pageSize'=>30))),
                            'factorsStr'=>$factorsStr,
    //                        'fundamentalFactor'=>$fundamentalFactor,
    //                        'conditionalFactor'=>$conditionalFactor,
                            'newFactors'=>$newFactors,
                            'estimatedValues'=>$estimatedValues,
                            'estimatedPrice' => $estimatedPrice,
                            'estimatedValueTable' => new CArrayDataProvider($estimatedValueTable),
                            'result_query' => new CArrayDataProvider(array($result_query)),
                            'result_query_columns' => array_keys($result_query),
                            'result_query_all' => new CArrayDataProvider($result_query_all),
                            'result_query_all_columns' => !empty($result_query_all[0])?array_keys($result_query_all[0]):array(),
                    ));

                } else {
                    throw new CHttpException(404, 'The requested page does not exist.');
                }
            } else {
                $model=new PropertyInfoSlug('search');
                $model->unsetAttributes();  // clear any default values
                if(isset($_GET['PropertyInfoSlug']))
                        $model->attributes=$_GET['PropertyInfoSlug'];

                $this->render('admin',array(
                        'model'=>$model,
                ));
            }
        }
        
    private function recalcEstimatedPrice($details, $fundamentals_factor, $conditional_factor ){

            if (!empty($details) && ($details->getlatitude != 0.000000) && ($details->getlongitude != 0.000000)) {
                $estimatedValues = EstimatedPrice::getComparePropertyInfo(
                                                                    '', 
                                                                    $details->property_id, 
                                                                    $details->property_type, 
                                                                    $details->property_zipcode, 
                                                                    $details->getlatitude, 
                                                                    $details->getlongitude, 
                                                                    $details->year_biult_id, 
                                                                    $details->lot_acreage, 
                                                                    $details->house_square_footage, 
                                                                    $details->bathrooms, 
                                                                    $details->garages, 
                                                                    $details->pool, 
                                                                    $details->percentage_depreciation_value, 
                                                                    $details->estimated_price,
                                                                    $details->bedrooms,
                                                                    $details->subdivision, $fundamentals_factor, $conditional_factor
                                                                    , !empty($details->propertyInfoDetails->house_views)?$details->propertyInfoDetails->house_views:''
                                                                    , $details->sub_type
                                                                    , $details->property_price
                            );
//Yii::log(print_r($estimatedValues,1) ,'ERROR');
                if(!empty($estimatedValues) && !empty($estimatedValues['comps'])) {
                    return  array(
                                'estimated_price'=>$estimatedValues['estimated_value_subject_property'],
                                'percentage_depreciation_value'=>$estimatedValues['percentage_depreciation_value'],
                                'comp_stage'=>$estimatedValues['current_stage'],
                                'low_range'=>$estimatedValues['low_range'],
                                'high_range'=>$estimatedValues['high_range'],
                                'comps'=>$estimatedValues['comps'],
                        
                                'house_weighted'=>$estimatedValues['house_weighted'],
                                'lot_weighted'=>$estimatedValues['lot_weighted'],
                                'bathrooms_weighted'=>$estimatedValues['bathrooms_weighted'],
                                'bedrooms_weighted'=>$estimatedValues['bedrooms_weighted'],
                                'garages_weighted'=>$estimatedValues['garages_weighted'],
                                'pool_weighted'=>$estimatedValues['pool_weighted'],
                                'result_query'=>$estimatedValues['result_query'],
                                'result_queryAllRows'=>$estimatedValues['result_queryAllRows'],
                            );
                } else {
                    return array(
                                'estimated_price'=>0,
                                'percentage_depreciation_value'=>0,
                                'comp_stage'=>0,
                                'low_range'=>0,
                                'high_range'=>0,
                                'comps'=>0
                        );
                }

            }
        
    }

    public function actionFactorUpdate( $id )
    {
        $property=  PropertyInfo::model()->findByPk($id);
        
        if($property===null || !isset($_POST['pk']) || !isset($_POST['name'])) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
        $model=MarketTrendTable::model()->findByPk($_POST['pk']);
        
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        $avgs = array( $_POST['name']=>$_POST['value']);
        MarketTrendTable::model()->updateByPk($_POST['pk'],$avgs);

//Yii::log(print_r($_POST,1) ,'ERROR');
//Yii::log(print_r($avgs,1) ,'ERROR');
    }
    
    public function actionPropertyUpdate( $id )
    {
        $details=  PropertyInfo::model()->findByPk($id);
        
        if($details===null || !isset($_POST['factors'])) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
        $factors = $_POST['factors'];
        if(!empty($factors)) {
            $estimatedValues = $this->recalcEstimatedPrice($details, $factors['fundamentals_factor'], $factors['conditional_factor'] );

            PropertyInfo::model()->updateByPk($id,array(
                'fundamentals_factor'=>$factors['fundamentals_factor'], 
                'conditional_factor'=>$factors['conditional_factor'],
                'estimated_price'=>$estimatedValues['estimated_price'],
                'percentage_depreciation_value'=>$estimatedValues['percentage_depreciation_value'],
                'comp_stage'=>$estimatedValues['comp_stage'],
                'low_range'=>$estimatedValues['low_range'],
                'high_range'=>$estimatedValues['high_range'],
                'comps'=>$estimatedValues['comps'],
            ));
        }

//Yii::log(print_r($_POST,1) ,'ERROR');
//Yii::log(print_r($avgs,1) ,'ERROR');
    }

    /**
     * Upload .csv file and save it to DB
     *
     * @param null $id
     * @throws CHttpException
     */
    public function actionUploadAlertsMessages($id = null){
        $user = User::model()->cache(1000,null,3)->with('profile', 'profession')->findByPk(Yii::app()->user->id);
        $profile = $user->profile;

        $model=new AlertsMessages;

        if(isset($_POST['AlertsMessages'])){
            $model->attributes=$_POST['AlertsMessages'];

            if($model->save()){
//                Yii::log('Saved saccessfully', 'error');
                Yii::app()->user->setFlash('success','<i class="fa fa-upload"></i> File was successfully uploaded and saved to DB.');
                $this->refresh();
            }
            else{
                Yii::app()->user->setFlash('error','<i class="fa fa-meh-o"></i> Error occured. May be you havn\'t chosen a file at last time. Try Again.');
                $this->refresh();
            }

        }else{
            $this->render('uploadAlertsMessView',array('model'=>$model, 'profile'=>$profile));
        }
    }

    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
            $this->render('error', $error);
    }

}