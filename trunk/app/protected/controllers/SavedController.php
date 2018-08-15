<?php

class SavedController extends Controller {

    public $layout = '//layouts/irradii';

    public $status_types = array(
        'Viewed',
        'Dismissed',
        'Saved',
        'Offered',
        'Purchased',
        'Rejected'
    );

    public $default_excluded_status_types = array('Viewed');

    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'accessControl', // perform access control for CRUD operations
//            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('properties', 'getSavedProperties' ),
                'users'=>array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionProperties()
	{
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->createUrl('/user/login'));
            exit();
        } else {
            $model = User::model()->cache(1000, null, 3)->with('profile', 'profession')->findByPk(Yii::app()->user->id);
            $profile = $model->profile;
            $user_id = $model->id;
        }

        $breadcrumbs = array(
            array(
                'title'=>'Saved Properties',
                'action'=>'saved',
            )
        );

        $this->render('saved', array(
            'model' => Yii::app()->user->isGuest ? '' : $model,
            'profile' => Yii::app()->user->isGuest ? '' : $profile,
            'breadcrumbs'=> isset($breadcrumbs) ? $breadcrumbs : '',
            'user_id' => $user_id,
        ));
	}

    public function actionGetSavedProperties(){
        $user_id = null;
        if (!Yii::app()->user->isGuest) {
            $dependency = new CDbCacheDependency('SELECT lastvisit_at FROM tbl_users WHERE id='.Yii::app()->user->id);
            $model = User::model()->cache(1000,$dependency, 1)->with('profile', 'profession')->findByPk(Yii::app()->user->id);
            if (!is_object($model)) {
                $this->redirect(Yii::app()->createUrl('/user/login'));
            }
            $profile = $model->profile;
            $user_id = $model->id;
        } else {
            $result = array(
                'status'=>'error',
                'message'=>'Unauthorized'
            );
            echo 'Is loggined?';
        }
        if(Yii::app()->request->isAjaxRequest) {
            $obj = $_POST;
            $statuses = $this->status_types;
            if (isset($obj['excluded_statuses'])){
                $statuses = array_diff($this->status_types, $obj['excluded_statuses']);
            }
            $properties = Yii::app()->db->createCommand()
                ->setFetchMode(PDO::FETCH_OBJ)
                ->select('*')
                ->from('property_info p')
                ->join('tbl_user_property_info u','p.mls_sysid=u.mls_sysid AND p.mls_name=u.mls_name')
                ->join('property_info_details pd','pd.property_id=p.property_id')
                ->join('property_info_additional_brokerage_details ab','ab.property_id=p.property_id')
                ->join('tbl_property_info_slug s','s.property_id=p.property_id')
                ->join('zipcode z','z.zip_id=p.property_zipcode')
                ->join('city ci','ci.cityid=p.property_city_id')
                ->join('county co','co.county_id=p.property_county_id')
                ->join('state st','st.stid=p.property_state_id')
                ->where('user_id=:user_id',array(':user_id'=>$user_id))
                ->andWhere(array('in', 'user_property_status' ,$statuses ))
                ->queryAll();
            $result = array();
            if($obj['fields']){
                foreach ($properties as $property){
                    array_push($result,$this->makeDataTable($property));
                }
            }

            echo json_encode($result);
            Yii::app()->end();
        }
    }
    private function makeDataTable($property){
        $ex_class = 'fa-times';
        $ex_class_i = 0;
        $widget__property_status='';
        $discont = 0;
        if (($property->percentage_depreciation_value >= Yii::app()->params['underValueDeals'])) {
            $discont = $property->percentage_depreciation_value;
        }
        if ($discont == 0) {
            if (( ($property->estimated_price > 0) &&
                (100 - ($property->property_price * 100 / $property->estimated_price)) > 0)) {
                $discont = 100 - ($property->property_price * 100 / $property->estimated_price);
            }
        }

        if (isset($property->status)) {
            $comp_stat = strtoupper($property->status);
            $conditon = $discont >= Yii::app()->params['underValueDeals'];
            $colorScheme = SiteHelper::getColorScheme($comp_stat, $conditon);

            $widget__property_status = '<span class="label '.$colorScheme['label-color'].' ">';
        }

        if(!empty($colorScheme['status'])){
            $status_p = $colorScheme['status'];
        }else {
            $status_p = '';
        }
        //<!--Address -->

        $col0 = '';
        $col0 .= '<a class="property_info_row"
                  data-lat="' . $property->getlatitude . '"
                  data-lon="' . $property->getlongitude . '"
                  data-status="'.$status_p.'"
                  data-address= "' . $property->property_street . '"
                  data-property_id= "' . $property->property_id . '"
                  data-property="' . Yii::app()->createUrl('property/details',array('slug'=> $property->slug)) . '"    
                  href="'. Yii::app()->createUrl('property/details',array('slug'=> $property->slug)) . '">';
        if ($property->photo1) {
            $col0 .= CPathCDN::checkPhoto($property, "thumb-img-140", 0 );
        }
        $col0 .= '</a>';
        $col1 = '';
        $col1 .= $property->property_street.'<br>';
        $col1 .= $property->city_name ? $property->city_name . ', ' : '';
        $col1 .= $property->state_code ? $property->state_code . ' ' : '';
        $col1 .= $property->zip_code ? $property->zip_code : '';
        $col1 .= '<br>';
        $community = $property->community_name ? $property->community_name : '';
        if ($community == '' || $community == 'None') {
            $community = $property->subdivision ? $property->subdivision : '';
        }
        if ($community == '' || $community == 'None') {
            $community = $property->area ? $property->area : '';
        }

        $col1 .= $community ? ucwords(strtolower($community)) . '<br>' : '';
        $col1 = "<a href=" . Yii::app()->createUrl('property/details' , array( 'slug'=>$property->slug)) . " >".$col1."</a>";
        //$col1 .= '</div>';

        //<!--Status -->
        $col2 = '';
        $col2 .= $widget__property_status;
        if(isset($property->status)){
            $col2 .= $property->status;
            $col2 .= $property->status ? '</span>' : '';
        }
        if($property->user_id != null){
//            $user_property_info = SiteHelper::getUserPropertyStatus($user_id,$search_result->mls_sysid,$search_result->mls_name);
            $user_status = '';
            if(isset($property->user_property_status)){
                $user_status = $property->user_property_status;
                if(strtotime($property->property_uploaded_date) > strtotime($property->last_viewed_date)){
                    $user_status = 'Updated';
                }
            }
            $label_of_user_status = SiteHelper::getColorSchemeOfUserPropertyStatus($user_status);
            $col2 .= '<br><br><span class="label-user-property-status '.$label_of_user_status.'">'.$user_status.'</span>';
        }


        //<!--List Price -->
        $col3 = '';

        if (empty($property->selfProp) && isset($property->status) &&
            ((strtoupper($property->status) == 'HISTORY') ||
                (strtoupper($property->status) == 'RECENTLY SOLD') ||
                (strtoupper($property->status) == 'CLOSED') ||
                (strtoupper($property->status) == 'SOLD') ||
                (strtoupper($property->status) == 'TEMPOFF') ||
                (strtoupper($property->status) == 'NOT FOR SALE') ||
                (strtoupper($property->status) == 'TEMPORARILY OFF THE MARKET'))) {
            if( (strtoupper($property->status) == 'HISTORY') ||
                (strtoupper($property->status) == 'SOLD') ||
                (strtoupper($property->status) == 'CLOSED')) {
                $col3 .= '$' . number_format($property->list_price);
            } else {
                $col3 .= '-';
            }
        } else {
            $col3 .= '$' . number_format($property->property_price);
        }

        //<!--Sale Price -->
        $col4 = '';
        if (isset($property->status) &&
            ((strtoupper($property->status) == 'HISTORY') ||
                (strtoupper($property->status) == 'SOLD') ||
                (strtoupper($property->status) == 'LEASED') ||
                (strtoupper($property->status) == 'CLOSED'))) {
            $col4 .= '$' . number_format($property->property_price);
        } else {
            $col4 .= '-';
        }

        //<!--Sale Type -->
        $col5 = '';
        if($property->estimated_price > 0){
            $col5 .= '$' . number_format($property->estimated_price);
        } else {
            $col5 .= '-';
        }
        //<!--Date -->
        $col6 = '';
        if (isset($property->status) && (strtoupper($property->status) == 'HISTORY')) {
            $date = DateTime::createFromFormat('Y-m-d', $property->property_updated_date)->sub(new DateInterval('P1Y'))->format('Y-m-d');
            $col6 .= $date;
        } else {
            $col6 .= $property->property_updated_date;
        }

        //<!--$/SqFt -->
        $col7 = '';
        $col7 .= '$';
        $col7 .= ($property->house_square_footage!=0)?number_format(($property->property_price / $property->house_square_footage),2,'.',','):0;

        //<!--Sq Ft -->
        $col8 = '';
        $col8 .= round($property->house_square_footage);
        //<!--Bed -->
        $col9 = '';
        $col9 .= $property->bedrooms;
        //<!--Bath -->
        $col10 = '';
        $col10 .= $property->bathrooms;
        //<!--Lot -->
        $col11 = '';
        $col11 .= sprintf("%01.2f", round($property->lot_acreage, 2));
        //<!--Yr Blt -->
        $col12 = '';
        $col12 .= $property->year_biult_id;
        //<!--Stories -->
        $col15 = '';
        $col15 .= !empty($property->stories)?$property->stories:'';

        //<!--Spa -->
        $col16 = '';

        $col16 .= !empty($property->spa)?$property->spa:'';


        //<!--Condition -->
        $col17 = '';
        $col17 .= !empty($property->over_all_property)?$property->over_all_property:'';

        //<!--Foreclosure -->
        $col18 = '';
        $col18 .= !empty($property->foreclosure)?$property->foreclosure:'';

        //<!--Short Sale -->
        $col19 = '';
        $col19 .= !empty($property->short_sale)?$property->short_sale:'';

        //<!--Bank Owned -->
        $col20 = '';
        $col20 .= !empty($property->reporeo)?$property->reporeo:'';
        //<!--Original Price -->
        $col21 = '';
        $col21 .= !empty($property->original_list_price)?'$' . number_format($property->original_list_price):'';

        //<!--Days on Market -->
        $col22 = '';
        $dtz  = new DateTimeZone(isset(Yii::app()->timeZone)?Yii::app()->timeZone:"UTC");

        $datetime_now = new DateTime();

        $datetime_now->setTimezone($dtz);

        $propertyDate = !empty($property->entry_date) ?$property->entry_date:$property->property_uploaded_date ;

        $datetime_exp = new DateTime($propertyDate, $dtz);

        $interval = $datetime_now->diff($datetime_exp);

        $col22 .= $interval->days;

        //<!--Garage -->
        $col23 = '';
        $col23 .= $property->garages;

        //<!--Pool -->
        $col24 = '';
        $col24 .= $property->pool;

        //<!--House Faces -->
        $col25 = '';
        $col25 .= !empty($property->house_faces)?$property->house_faces:'';

        //<!--House Views -->
        $col26 = '';
        $col26 .= !empty($property->house_views)?$property->house_views:'';

        //<!--Flooring -->
        $col27 = '';
        $col27 .= !empty($property->flooring_description)?$property->flooring_description:'';

        //<!--Furnishings -->
        $col28 = '';
        $col28 .= !empty($property->furnishings_description)?$property->furnishings_description:'';
        //<!--Financing -->
        $col29 = '';
        $col29 .= !empty($property->financing_considered)?$property->financing_considered:'';

        $result = array($col0,$col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col23, $col11, $col12
        ,$col15, $col24, $col16, $col17, $col25, $col26, $col27, $col28, $col29 , $col18, $col19, $col20, $col21, $col22
        );

        return $result;
    }

    public function getFullAddress( $property = false ) {
        if(!$property) {
            return '';
        }
        $address = $property->property_street;
        $address .= !empty($address)?' ':'';
        if(empty($property->city_name)) {
            $address .= !empty($property->city->city_name)?$property->city->city_name:'';
        } else {
            $address .= $property->city_name;
        }
        $address = ucwords(strtolower($address));

        $address .= !empty($address)?', ':'';
        if(empty($property->state_code)) {
            $address .= !empty($property->state->state_code)?strtoupper($property->state->state_code):'';
        } else {
            $address .= $property->state_code;
        }

        $address .= !empty($address)?' ':'';
        if(empty($property->zip_code)) {
            $address .= !empty($property->zipcode->zip_code)?strtoupper($property->zipcode->zip_code):'';
        } else {
            $address .= $property->zip_code;
        }

        return $address;
    }
}