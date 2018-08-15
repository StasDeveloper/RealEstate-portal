<?php
class SavedSearch extends CActiveRecord{

    const EMAIL_FREQ_NEVER = 0;
    const EMAIL_FREQ_IMMEDIATELY = 1;
    const EMAIL_FREQ_DAILY = 2;     // 7AM
    const EMAIL_FREQ_WEEKLY = 3;    // Monday 7AM

    const EMAIL_FREQ_DAILY_HOUR = 7; // at 7 AM
    const EMAIL_FREQ_WEEKLY_DAY = 1; // Monday (w from 0 (sunday) to 6 (saturday))
    const EMAIL_FREQ_WEEKLY_HOUR = 7; // at 7 AM

    private static $allSaleTypes = array(
        'For Sale',
        'Under Value',
        'Equity Deals',
        'Foreclosures',
        'Shortsales',
        'Owner Will Carry',
        'AITD Opportunities',
        'Mid Cap Rental Potential',
        'High Cap Rental Potential',
        'Rental Properties With Equity',
        'High Cap And High Equity Opportunities',
    );

    public static $allowedAttrs = array(

        'address',
        'street_number',
        'street_address',
        'city',
        'state',
        'zipcode',
        'country',

        'keywords',

        'property_type',
        'sale_type',

        'min_sqft',
        'max_sqft',

        'min_price_sqft',
        'max_price_sqft',

        'min_year_built',
        'max_year_built',

        'min_price',
        'max_price',

        'min_lot_size',
        'max_lot_size',

        'bed',
        'bath',

        'geodistance_rectangle',
        'latitude1',
        'latitude2',
        'longitude1',
        'longitude2',

        'geodistance_circle',
        'latitude',
        'longitude',
        'radius',

        'geodistance_polygon',
    );

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{saved_searches}}';
    }

    public static function getAllSaleTypes(){
        return self::$allSaleTypes;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, user_id', 'required'),
            array('user_id, email_alert_freq', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('expiry_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            //array('name, type, description, bizrule, data', 'safe', 'on'=>'search'),
        );
    }

    public function behaviors(){
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_at',
                'updateAttribute' => 'updated_at',
            )
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
            'savedSearchCriteria' => array(self::HAS_MANY, 'SavedSearchCriteria', 'saved_search_id'),
            'alertEmails' => array(self::HAS_MANY, 'SavedSearchEmail', 'saved_search_id'),
            //'authItemChildren' => array(self::HAS_MANY, 'AuthItemChild', 'parent'),
            //'authItemChildren1' => array(self::HAS_MANY, 'AuthItemChild', 'child'),
            //'collectionField'=> array(self::HAS_MANY, 'TblProfessionFieldCollection', 'authitem_name'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            //'name' => 'Name',
            //'type' => 'Type',
            //'description' => 'Description',
            //'bizrule' => 'Bizrule',
            //'data' => 'Data',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        //$criteria->compare('name',$this->name,true);
        //$criteria->compare('type',$this->type);
        //$criteria->compare('description',$this->description,true);
        //$criteria->compare('bizrule',$this->bizrule,true);
        //$criteria->compare('data',$this->data,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TblAuthItem the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function beforeDelete()
    {
        SavedSearchEmail::model()->deleteAll('saved_search_id=:saved_search_id', array(':saved_search_id'=>$this->id));
        SavedSearchCriteria::model()->deleteAll('saved_search_id=:saved_search_id', array(':saved_search_id'=>$this->id));

        return parent::beforeDelete();
    }

    public function saveRelatedSearchCriteria(SavedSearch $savedSearchModel, $post){



        foreach($post as $key=>$value)
        {
            if(!in_array($key, self::$allowedAttrs))
                continue;

            if(SiteHelper::isValueEmpty($value))
                continue;

            $savedSearchCriteriaModel = new SavedSearchCriteria('create');

            $savedSearchCriteriaModel->setAttributes(array(
                'saved_search_id' => $savedSearchModel->id,
                'attr_name' => trim($key),
                'attr_value' => @serialize($value),
            ));

            $savedSearchCriteriaModel->save();
        }
    }

    public function isMatch(PropertyInfo $property){
        // if property fit to saved search criteria -> plan email
        $searchResult = $this->makeSearch(array(
            'limit'=>1,
            'property_id' => $property->property_id,
        ));

        if(in_array($property->property_id, $searchResult)){
            return true;
        }

        return false;

    }

    /**
     * @param $params = array(

     *      'limit' => 100,
     *
     * )
     * @return mixed
     */
    public function makeSearch($params){

        $search = Yii::App()->search;
        $search->resetFilters();

        if(isset($params['property_id'])){
            //$search->setFilter('property_id', array(intval($params['property_id'])));
            $search->setIDRange(intval($params['property_id']), intval($params['property_id']));
        }

        $search->setSelect('*');
        $search->setArrayResult(true);
        $search->setMatchMode(SPH_MATCH_EXTENDED2);
        $search->SetLimits(0, $params['limit'], $params['limit']);
//        $search->SetSortMode(SPH_SORT_EXTENDED,'@id desc');
//        //$search->SetFieldWeights(array('property_street' => 50, 'city_name' => 30, 'state_code' => 20));
        $search->setSortMode(SPH_SORT_RELEVANCE);
        $search->SetFieldWeights(array('property_street' => 50, 'city_name' => 30, 'state_code' => 20));

        //$search->setFilterRange("property_price", 0, 2000.0);



        $sqft_criteria = new SearchFilterRange();
        $price_sqft_criteria = new SearchFilterRange();
        $year_criteria = new SearchFilterRange();
        $price_criteria = new SearchFilterRange();
        $bed_criteria = new SearchFilterRange();
        $bath_criteria = new SearchFilterRange();
        $lot_size_criteria = new SearchFilterFloatRange();

        $mapBoundary_criteria = array();

        $query = '';
        $queryArr = array();

        $criteria = $this->savedSearchCriteria;
        foreach($criteria as $criteria_item){

            $attr_name = $criteria_item->attr_name;
            $attr_value = @unserialize($criteria_item->attr_value);

            switch($attr_name){

                case 'address':
                    $address = $this->clearExistItemAddress($attr_value, $criteria);
//Yii::log(print_r($address,1),'ERROR');
                    $addr_query_str = '';

                    $address = str_replace('-','',$address);

                    $expl_address = explode(',',$address);

                    foreach($expl_address as $address_component){
                        $address_component = trim($address_component);

                        if($address_component =='')
                            continue;

                        // # Min length indexed word  (dafault value)
                        // min_word_len = 2
                        /**/
                        if(strpos($address_component, ' ')){
                            $address_component = str_replace(' ', ' | ', trim($address_component));
                        }
//Yii::log(print_r('addr_query_str - '.$address_component,1),'ERROR');
                        /**/


                        if(strlen($address_component) <=1 )
                        continue;

                        $addr_query_str .= ''.$address_component.' | ';
                    }
                    $addr_query_str = trim($addr_query_str, '| ');


                    if(!empty($addr_query_str)) {
                        $queryArr[$attr_name] = ' ( @* ' . $addr_query_str . ' ) ';

//Yii::log(print_r('queryArr[address]'.$queryArr[$attr_name],1),'ERROR');

                    }
                    break;
                case 'street_number':
                    //$query .=' @property_street "' . $attr_value . '"';
                    break;
                case 'street_address':
                    //$query .=' @property_street "' . $attr_value . '"';
                    break;
                case 'city':
                    $query .=' @city_name "' . $attr_value . '" ';
                    break;
                case 'state':
                    $query .=' @state_code "' . $attr_value . '"';
                    break;
                case 'zipcode':
                    $query .=' @zip_code "' . $attr_value . '" ';
                    break;
                case 'country':

                    break;
                case 'keywords':
                    $expl_keywords = explode(',',$attr_value);
                    $keyword_str = '';
                    foreach($expl_keywords as $keyword){
                        $keyword = trim($keyword);

                        if($keyword =='')
                            continue;

                        $keyword_str .= '"'.$keyword.'" | ';

                    }
                    $keyword_str = trim($keyword_str, '| ');

                    $query .= ' @* (' . $keyword_str . ')';
                    break;

                case 'property_type':
                    $query_property_type_arr = array();
                    $subquerty_property_type = array();

                    foreach ($attr_value as $property_type) {
                        switch ($property_type) {
                            case 'AK':
                                $query_property_type_arr[] = 1;
                                $subquerty_property_type[] = "Attached";
                                break;
                            case 'HI':
                                $query_property_type_arr[] = 1;
                                $subquerty_property_type[] = "Detached";
                                break;
                            //case 'CA':
                            case 'CA1':
                                $query_property_type_arr[] = 2;
                                break;
                            //case 'NV':
                            case 'OR':
                                $query_property_type_arr[] = 16;
                                break;
                            case 'TH':
                                $query_property_type_arr[] = 3;
                                break;
                            case 'DP':
                                $query_property_type_arr[] = 4;
                                $subquerty_property_type[] = "Duplex";
                                break;
                            case 'TP':
                                $query_property_type_arr[] = 4;
                                $subquerty_property_type[]  = "Triplex";
                                break;
                            case 'FP':
                                $query_property_type_arr[] = 4;
                                $subquerty_property_type[] = "Fourplex";
                                break;
                            case 'AZ':
                                $query_property_type_arr[] = 6;
                                break;
                            case 'CO':
                                $query_property_type_arr[] = 7;
                                break;
                            case 'AL':
                                $query_property_type_arr[] = 5;
                                break;
                        }
                    }
                    if($subquerty_property_type){
                        $query .= ( ' @sub_type (' . implode(' | ', $subquerty_property_type).') ' );
                    }

                    if ($query_property_type_arr) {
                        $search->setFilter("property_type", $query_property_type_arr);

                    }
                    break;

                case 'sale_type':
                    $query .= $attr_value == 'ALL Sale Types' ? '  @status ("Active" | "Active Exclusive Right" | "Active-Exclusive Right" | "Auction" | "Closed" | "Contingent Offer" | "Exclusive Agency" | "For Sale" | "History" | "Leased" | "Pending Offer" | "Sold" | "Temporarily Off the Market" | "Temporarily Off The Market")  ( @property_status  ("Active") ) ' : '';
                    $query .= $attr_value == 'For Sale' ? '  @status ("Active" | "For Sale" | "Auction" | "Active Exclusive Right" | "Active-Exclusive Right" | "Exclusive Agency") ( @property_status  ("Active") ) ' : '';
                    $query .= $attr_value == 'Under Value' ? ' ( @status "Active" | "Active Exclusive Right" | "Active-Exclusive Right" | Auction | "Exclusive Agency" | "For Sale") ( @property_status  Active ) ' : '';
                    $query .= $attr_value == 'Equity Deals' ? ' ( @status "Active" | "Active Exclusive Right" | "Active-Exclusive Right" | Auction | "Exclusive Agency" | "For Sale") ( @property_status  Active ) ' : '';
                    $query .= $attr_value == 'Foreclosures' ? ' @status ("Active" | "Active Exclusive Right" | "Active-Exclusive Right" | Auction | "Exclusive Agency" | "For Sale")   @foreclosure ("yes") ( @property_status  ("Active") ) ' : '';
                    $query .= $attr_value == 'Shortsales' ? ' @status ("Active" | "Active Exclusive Right" | "Active-Exclusive Right" | Auction | "Exclusive Agency" | "For Sale")   @short_sale ("yes") ( @property_status  ("Active") ) ' : '';
                    $query .= $attr_value == 'All Property Records' ? ' @property_status  (Active) ( @property_status  ("Active") ) ' : '';
                    $query .= $attr_value == 'For Rent' ? ' @status ( "Active" | "Active-Exclusive Right" | "Contingent Offer" | "Exclusive Agency" ) ( @property_status  "Active" ) ' : '';
                    $query .= $attr_value == 'Owner Will Carry' ? ' ( @status "Active" | "Active-Exclusive Right" | Auction | "Exclusive Agency" | "For Sale" ) (@financing_considered "OWC") ( @property_status  Active )' : '';
                    $query .= $attr_value == 'AITD Opportunities' ? ' ( @status "Active" | "Active-Exclusive Right" | Auction | "Exclusive Agency" | "For Sale" ) (@financing_considered "AITD") ( @property_status  Active )' : '';
                    $query .= $attr_value == 'Mid Cap Rental Potential' ? ' ( @status "Active" | "Active-Exclusive Right" | Auction | "Exclusive Agency" | "For Sale" ) ( @property_status  Active )' : '';
                    $query .= $attr_value == 'High Cap Rental Potential' ? ' ( @status "Active" | "Active-Exclusive Right" | Auction | "Exclusive Agency" | "For Sale" ) ( @property_status  Active )' : '';
                    $query .= $attr_value == 'Rental Properties With Equity' ? ' ( @status "Active" | "Active-Exclusive Right" | Auction | "Exclusive Agency" | "For Sale" ) ( @property_status  Active )' : '';
                    $query .= $attr_value == 'High Cap And High Equity Opportunities' ? ' ( @status "Active" | "Active-Exclusive Right" | Auction | "Exclusive Agency" | "For Sale" ) ( @property_status  Active )' : '';

                    //Exclude property_type = 9 (that is rental) from sale type search
                    if(in_array($attr_value, self::getAllSaleTypes())){
                        $search->setFilter("property_type", array(9), true);
                        $flag = 1;
                    }

                    if ($attr_value == 'Under Value') {
                        $search->setFilterRange("persentage", 5, 14.999999);
                        $search->setFilter("property_type", array(0,1,2,3,4,5,6,7,8,16));
                    }

                    if ($attr_value == 'Equity Deals') {
                        $search->setFilterRange("persentage", 15, 9999999999999);
                        $search->setFilter("property_type", array(0,1,2,3,4,5,6,7,8,16));
                    }

                    if ($attr_value == 'Mid Cap Rental Potential') {
                        $search->setFilter("mid_cap", array(1));
                    }

                    if ($attr_value == 'High Cap Rental Potential') {
                        $search->setFilter("high_cap", array(1));
                    }

                    if ($attr_value == 'Rental Properties With Equity') {
                        $search->setFilterRange("persentage", 6.001, 9999999999999);
                        $search->setFilter("rent_equity", array(1));
                    }
                    if ($attr_value == 'High Cap And High Equity Opportunities') {
                        $search->setFilterRange("persentage", 10.001, 9999999999999);
                        $search->setFilter("high_rent_equity", array(1));
                    }

                    if ($attr_value == 'All Property Records') {
                        $search->setFilter("visible", array(1));
                    }
                    if ($attr_value == 'For Rent') {
                        $search->setFilter("property_type", array(9));
                    }
                    if ($attr_value == 'ALL Sale Types') {
                        $search->setFilter("visible", array(1));
                    }

                    break;

                case 'min_sqft':
                    $sqft_criteria->setMin($attr_value);
                    break;
                case 'max_sqft':
                    $sqft_criteria->setMax($attr_value);
                    break;

                case 'min_price_sqft':
                    $price_sqft_criteria->setMin($attr_value);
                    break;
                case 'max_price_sqft':
                    $price_sqft_criteria->setMax($attr_value);
                    break;
                
                case 'min_year_built':
                    $attr_value = trim($attr_value, 'Yr');
                    $year_criteria->setMin($attr_value);
                    break;

                case 'max_year_built':
                    $attr_value = trim($attr_value, 'Yr');
                    $year_criteria->setMax($attr_value);
                    break;

                case 'min_price':
                    $price_criteria->setMin($attr_value);
                    break;
                case 'max_price':
                    $price_criteria->setMax($attr_value);
                    break;
                case 'min_lot_size':
                    $lot_size_criteria->setMin($attr_value);
                    break;
                case 'max_lot_size':
                    $lot_size_criteria->setMax($attr_value);
                    break;
                case 'bed':
                    if($attr_value != 0)
                        $bed_criteria->setMin($attr_value);
                    break;
                case 'bath':
                    if($attr_value != 0)
                        $bath_criteria->setMin($attr_value);
                    break;

                case 'geodistance_rectangle':
                case 'latitude1':
                case 'latitude2':
                case 'longitude1':
                case 'longitude2':
                    $mapBoundary_criteria['rectangle'][$attr_name] = $attr_value;
                    break;

                case 'geodistance_circle':
                case 'radius':
                    $mapBoundary_criteria['circle'][$attr_name] = $attr_value;

                    break;

                case 'geodistance_polygon':
                    $mapBoundary_criteria['polygon'][$attr_name] = $attr_value;
                    break;

                case 'latitude':
                case 'longitude':
                    $mapBoundary_criteria['circle'][$attr_name] = $attr_value;
                    $mapBoundary_criteria['polygon'][$attr_name] = $attr_value;
                    break;

                default:

                    break;
            }// end switch
        }// end foreach


        $sqft_criteria->setFilter($search, 'house_square_footage');
        $price_sqft_criteria->setFilter($search, 'sqft_wcents');
        $year_criteria->setFilter($search, 'year_biult_id');
        $price_criteria->setFilter($search, 'property_price');
        $lot_size_criteria->setFilter($search, 'lot_acreage');

        $bed_criteria->setFilter($search, 'bedrooms');
        $bath_criteria->setFilter($search, 'bathrooms');

        $mapBoundaryClass = new MapBoundaryEmpty();
        $mapBoundaryFactory = new MapBoundaryFactory();
        foreach($mapBoundary_criteria as $mapBoundary){
            $temp = $mapBoundaryFactory->create($mapBoundary);

            if($temp->getType() == 'empty')
                continue;

            $mapBoundaryClass = $temp;
            break;

        }

        $searchMapBoundaryFactory = new SearchMapBoundaryFactory();

        $searchMapBoundary = $searchMapBoundaryFactory->create($mapBoundaryClass);
        $searchMapBoundary->setFilter($search,'latitude', 'longitude');


        // if no map boundary - make search by address
        if($mapBoundaryClass->getType() == 'empty' && !empty($queryArr['address'])){
            $query .= $queryArr['address'];
        }



        //$resArray = $search->query($query, '*');
        if($query != ''){
//Yii::log('FINAL alerts QUERY -'.print_r($query,1),'ERROR');
            $search->addQuery($query);
        }

        $resArray = $search->runQueries();
//Yii::log(print_r($resArray,1),'ERROR');
        if(empty($resArray[0]['matches'])){
            return array();
        }

        $property_ids = array();
        foreach($resArray[0]['matches'] as $match){
            $property_ids[] = $match['id'];
        }

        return $property_ids;
    }

    public static function getEmailFreqName($id){

        switch($id){
            case self::EMAIL_FREQ_NEVER:
                return 'Never';
                break;
            case self::EMAIL_FREQ_IMMEDIATELY:
                return 'Immediately';
                break;
            case self::EMAIL_FREQ_DAILY:
                return 'Daily';
                break;
            case self::EMAIL_FREQ_WEEKLY:
                return 'Weekly';
                break;
        }
    }

    public static function getEmailFreqArr(){
        $arr[self::EMAIL_FREQ_NEVER] = self::getEmailFreqName(self::EMAIL_FREQ_NEVER);
        $arr[self::EMAIL_FREQ_IMMEDIATELY] = self::getEmailFreqName(self::EMAIL_FREQ_IMMEDIATELY);
        $arr[self::EMAIL_FREQ_DAILY] = self::getEmailFreqName(self::EMAIL_FREQ_DAILY);
        $arr[self::EMAIL_FREQ_WEEKLY] = self::getEmailFreqName(self::EMAIL_FREQ_WEEKLY);

        return $arr;
    }

    public function getEmails(){

        $emails = array();
        
        foreach($this->alertEmails as $email){
            $emails[]=$email->email;
        }

        if(empty($emails)) {
            $emails[]=$this->user->username;
        }

        return $emails;
    }

    public static function getEmailFreqXEditableFormat(){
        $arr = self::getEmailFreqArr();

        $str = '';

        foreach($arr as $key=>$value){
            $str .= '{value: '.$key.', text: "'.$value.'"} ,';
        }

        $str = trim($str, ',');
        $str = '['.$str.']';

        return $str;
    }
    
    private function clearExistItemAddress($address, $criteria) {
//Yii::log(print_r($address,1),'ERROR');
        foreach($criteria as $criteria_item){

            $attr_name = $criteria_item->attr_name;
            $attr_value = @unserialize($criteria_item->attr_value);

            switch($attr_name){
                case 'address':
                case 'street_number':
                case 'street_address':
                    break;
                case 'city':
                case 'state':
                case 'zipcode':
                case 'country':
                    if (!empty($attr_value)) {
                        $address = str_replace($attr_value, '', $address);
                    }
                    break;
                default:

                    break;
            }// end switch
//Yii::log(print_r($address,1),'ERROR');
        }// end foreach

        if (trim($address)) {
            $address = strpos($address, '-') ?
                    trim(str_replace("-", "", $address)) : $address;

            $pos_arr = explode(" ", $address);
            $address_arr = array();
            for ($i = 0; $i < count($pos_arr); $i++) {
                $len = strlen(trim($pos_arr[$i]));
                if ($len == 0) {
                    continue;
                }
                $address_arr[] = trim($pos_arr[$i]);

            }
            $address = implode(' ', $address_arr);
        }
        return $address;
    }
}