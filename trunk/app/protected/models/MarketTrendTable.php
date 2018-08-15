<?php

/**
 * This is the model class for table "market_trend_table".
 *
 * The followings are the available columns in table 'market_trend_table':
 * @property integer $id
 * @property integer $property_type
 * @property integer $property_zipcode
 * @property integer $t_count
 * @property string $avg_percentage_diff
 * @property string $fundamentals_factor
 * @property string $conditional_factor
 * @property string $compass_point
 * @property string $house_faces
 * @property string $house_views
 * @property string $street_name
 * @property integer $pool
 * @property string $spa
 * @property string $stories
 * @property string $lot_description
 * @property string $building_description
 * @property string $carport_type
 * @property string $converted_garage
 * @property string $exterior_structure
 * @property string $roof
 * @property string $electrical_system
 * @property string $plumbing_system
 * @property string $built_desc
 * @property string $exterior_grounds
 * @property string $prop_desc
 * @property string $over_all_property
 * @property string $foreclosure
 * @property string $short_sale
 * @property string $sub_type
 * @property integer $factor_included
 * @property string $studio
 * @property string $condo_conversion
 * @property string $association_features_available
 * @property integer $association_fee_1
 * @property string $assessment
 * @property string $sidlid
 * @property string $parking_description
 * @property string $fence_type
 * @property string $court_approval
 * @property string $bath_downstairs
 * @property string $bedroom_downstairs
 * @property string $great_room
 * @property string $bath_downstairs_description
 * @property string $flooring_description
 * @property string $furnishings_description
 * @property string $heating_features
 * @property string $possession_description
 * @property string $financing_considered
 * @property string $reporeo
 * @property string $litigation
 */
class MarketTrendTable extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'market_trend_table';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('property_type, property_zipcode, t_count, pool, factor_included, association_fee_1', 'numerical', 'integerOnly'=>true),
            array('avg_percentage_diff, compass_point, house_faces', 'length', 'max'=>5),
            array('fundamentals_factor, conditional_factor, plumbing_system, over_all_property', 'length', 'max'=>12),
            array('house_views, lot_description, roof, electrical_system, exterior_grounds', 'length', 'max'=>100),
            array('street_name, sub_type, association_features_available, parking_description, heating_features', 'length', 'max'=>50),
            array('spa, converted_garage, foreclosure, short_sale, studio, condo_conversion, assessment, sidlid, court_approval, bath_downstairs, bedroom_downstairs, great_room, reporeo', 'length', 'max'=>3),
            array('stories', 'length', 'max'=>30),
            array('building_description', 'length', 'max'=>64),
            array('carport_type', 'length', 'max'=>16),
            array('exterior_structure', 'length', 'max'=>10),
            array('built_desc', 'length', 'max'=>18),
            array('prop_desc', 'length', 'max'=>128),
            array('fence_type', 'length', 'max'=>60),
            array('bath_downstairs_description, flooring_description, financing_considered', 'length', 'max'=>20),
            array('furnishings_description', 'length', 'max'=>36),
            array('possession_description', 'length', 'max'=>25),
            array('litigation', 'length', 'max'=>7),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, property_type, property_zipcode, t_count, avg_percentage_diff, fundamentals_factor, conditional_factor, compass_point, house_faces, house_views, street_name, pool, spa, stories, lot_description, building_description, carport_type, converted_garage, exterior_structure, roof, electrical_system, plumbing_system, built_desc, exterior_grounds, prop_desc, over_all_property, foreclosure, short_sale, sub_type, factor_included, studio, condo_conversion, association_features_available, association_fee_1, assessment, sidlid, parking_description, fence_type, court_approval, bath_downstairs, bedroom_downstairs, great_room, bath_downstairs_description, flooring_description, furnishings_description, heating_features, possession_description, financing_considered, reporeo, litigation', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'property_type' => 'Property Type',
            'property_zipcode' => 'Property Zipcode',
            't_count' => 'T Count',
            'avg_percentage_diff' => 'Avg Percentage Diff',
            'fundamentals_factor' => 'Fundamentals Factor',
            'conditional_factor' => 'Conditional Factor',
            'compass_point' => 'Compass Point',
            'house_faces' => 'House Faces',
            'house_views' => 'House Views',
            'street_name' => 'Street Name',
            'pool' => 'Pool',
            'spa' => 'Spa',
            'stories' => 'Stories',
            'lot_description' => 'Lot Description',
            'building_description' => 'Building Description',
            'carport_type' => 'Carport Type',
            'converted_garage' => 'Converted Garage',
            'exterior_structure' => 'Exterior Structure',
            'roof' => 'Roof',
            'electrical_system' => 'Electrical System',
            'plumbing_system' => 'Plumbing System',
            'built_desc' => 'Built Desc',
            'exterior_grounds' => 'Exterior Grounds',
            'prop_desc' => 'Prop Desc',
            'over_all_property' => 'Over All Property',
            'foreclosure' => 'Foreclosure',
            'short_sale' => 'Short Sale',
            'sub_type' => 'Sub Type',
            'factor_included' => 'Factor Included',
            'studio' => 'Studio',
            'condo_conversion' => 'Condo Conversion',
            'association_features_available' => 'Association Features Available',
            'association_fee_1' => 'Association Fee 1',
            'assessment' => 'Assessment',
            'sidlid' => 'Sidlid',
            'parking_description' => 'Parking Description',
            'fence_type' => 'Fence Type',
            'court_approval' => 'Court Approval',
            'bath_downstairs' => 'Bath Downstairs',
            'bedroom_downstairs' => 'Bedroom Downstairs',
            'great_room' => 'Great Room',
            'bath_downstairs_description' => 'Bath Downstairs Description',
            'flooring_description' => 'Flooring Description',
            'furnishings_description' => 'Furnishings Description',
            'heating_features' => 'Heating Features',
            'possession_description' => 'Possession Description',
            'financing_considered' => 'Financing Considered',
            'reporeo' => 'Reporeo',
            'litigation' => 'Litigation',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('property_type',$this->property_type);
        $criteria->compare('property_zipcode',$this->property_zipcode);
        $criteria->compare('t_count',$this->t_count);
        $criteria->compare('avg_percentage_diff',$this->avg_percentage_diff,true);
        $criteria->compare('fundamentals_factor',$this->fundamentals_factor,true);
        $criteria->compare('conditional_factor',$this->conditional_factor,true);
        $criteria->compare('compass_point',$this->compass_point,true);
        $criteria->compare('house_faces',$this->house_faces,true);
        $criteria->compare('house_views',$this->house_views,true);
        $criteria->compare('street_name',$this->street_name,true);
        $criteria->compare('pool',$this->pool);
        $criteria->compare('spa',$this->spa,true);
        $criteria->compare('stories',$this->stories,true);
        $criteria->compare('lot_description',$this->lot_description,true);
        $criteria->compare('building_description',$this->building_description,true);
        $criteria->compare('carport_type',$this->carport_type,true);
        $criteria->compare('converted_garage',$this->converted_garage,true);
        $criteria->compare('exterior_structure',$this->exterior_structure,true);
        $criteria->compare('roof',$this->roof,true);
        $criteria->compare('electrical_system',$this->electrical_system,true);
        $criteria->compare('plumbing_system',$this->plumbing_system,true);
        $criteria->compare('built_desc',$this->built_desc,true);
        $criteria->compare('exterior_grounds',$this->exterior_grounds,true);
        $criteria->compare('prop_desc',$this->prop_desc,true);
        $criteria->compare('over_all_property',$this->over_all_property,true);
        $criteria->compare('foreclosure',$this->foreclosure,true);
        $criteria->compare('short_sale',$this->short_sale,true);
        $criteria->compare('sub_type',$this->sub_type,true);
        $criteria->compare('factor_included',$this->factor_included);
        $criteria->compare('studio',$this->studio,true);
        $criteria->compare('condo_conversion',$this->condo_conversion,true);
        $criteria->compare('association_features_available',$this->association_features_available,true);
        $criteria->compare('association_fee_1',$this->association_fee_1);
        $criteria->compare('assessment',$this->assessment,true);
        $criteria->compare('sidlid',$this->sidlid,true);
        $criteria->compare('parking_description',$this->parking_description,true);
        $criteria->compare('fence_type',$this->fence_type,true);
        $criteria->compare('court_approval',$this->court_approval,true);
        $criteria->compare('bath_downstairs',$this->bath_downstairs,true);
        $criteria->compare('bedroom_downstairs',$this->bedroom_downstairs,true);
        $criteria->compare('great_room',$this->great_room,true);
        $criteria->compare('bath_downstairs_description',$this->bath_downstairs_description,true);
        $criteria->compare('flooring_description',$this->flooring_description,true);
        $criteria->compare('furnishings_description',$this->furnishings_description,true);
        $criteria->compare('heating_features',$this->heating_features,true);
        $criteria->compare('possession_description',$this->possession_description,true);
        $criteria->compare('financing_considered',$this->financing_considered,true);
        $criteria->compare('reporeo',$this->reporeo,true);
        $criteria->compare('litigation',$this->litigation,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MarketTrendTable the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
        
        public static function searchFactors( $maths = array(), $newMode = false ){
            $whereStr =  '';

            if(empty($maths)) {
                return $whereStr;
            }

            foreach ($maths as $key => $value) {
                $orEmpty    = " OR ($key = '') OR ( $key IS NULL ) ";
                $orEmptyNum = " OR ($key = 0 ) OR ( $key IS NULL ) ";
                switch ($key) {
                    // long string
                    case 'house_views':
                    case 'stories':
                    case 'lot_description':
                    case 'building_description':
                    case 'exterior_structure':
                    case 'roof':
                    case 'electrical_system':
                    case 'plumbing_system':
                    case 'exterior_grounds':
                    case 'prop_desc':

                    case 'association_features_available':
                    case 'flooring_description':
                    case 'heating_features':
                    case 'financing_considered':
                        if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                        $whereStr .= "((LOWER(:$key) LIKE CONCAT('%',LOWER($key),'%') ) $orEmpty ) ";
                        break;
                    // numeric
                    case 'pool':
                    case 'association_fee_1':
                        if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                        $whereStr .= "(($key = :$key) $orEmptyNum) ";
                        break;

                    case 'property_type':
                        if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                        $whereStr .= "($key = :$key) ";
                        break;
                    
                    case 'property_zipcode':
                        if(!$newMode) {
                            if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                            $whereStr .= "(($key = :$key) $orEmptyNum) ";
                        }
                        break;
                    case 'property_id':
                    case 'fundamentals_factor':
                    case 'conditional_factor':
                    case 'estimated_price':
                    case 'property_price':
                    case 'comp_stage':
                    case 'comps':
                    case 'house_square_footage_gravity':
                    case 'lot_footage_gravity':
                    case 'estimated_price_recalc_at':
                        break;
                    
                    default:
                        if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                        $whereStr .= "((LOWER($key) = LOWER(:$key)) $orEmpty) ";
                        break;
                }
            }
            return $whereStr;
        }
        
        public static function searchFactorsParam( $maths = array(), $newMode = false){
            $whereParam =  array();

            if(empty($maths)) {
                return $whereParam;
            }
            foreach ($maths as $key => $value) {
                switch ($key) {
                    case 'property_id':
                    case 'fundamentals_factor':
                    case 'conditional_factor':
                    case 'estimated_price':
                    case 'property_price':
                    case 'comp_stage':
                    case 'comps':
                    case 'house_square_footage_gravity':
                    case 'lot_footage_gravity':
                    case 'estimated_price_recalc_at':
                        break;
                    case 'property_zipcode':
                        if(!$newMode) {
                            $whereParam[':'. $key] = $value;
                        }
                        break;
                    
                    default:
                        $whereParam[':'. $key] = $value;
                        break;
                }
            }
            return $whereParam;
        }
        
        public static function searchProperties( $maths = array()){
            $whereStr =  '';

            if(empty($maths)) {
                return $whereStr;
            }

            foreach ($maths as $key => $value) {
                if(!empty($value)) {
                    switch ($key) {
                        // long string
                        case 'house_views':
                        case 'stories':
                        case 'lot_description':
                        case 'building_description':
                        case 'exterior_structure':
                        case 'roof':
                        case 'electrical_system':
                        case 'plumbing_system':
                        case 'exterior_grounds':
                        case 'prop_desc':

                        case 'association_features_available':
                        case 'flooring_description':
                        case 'heating_features':
                        case 'financing_considered':
                            if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                            $whereStr .= "((LOWER($key) LIKE CONCAT('%',LOWER(:$key),'%') )) ";
                            break;
                        // numeric
                        case 'property_zipcode':
                        case 'pool':
                        case 'association_fee_1':
                            if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                            $whereStr .= "(($key = :$key)) ";
                            break;

                        case 'property_type':
                            if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                            $whereStr .= "($key = :$key) ";
                            break;

                        case 'id':
                        case 't_count':
                        case 'avg_percentage_diff':
                        case 'fundamentals_factor':
                        case 'conditional_factor':
                        case 'factor_included':
                        case 'factor_min':
                        case 'factor_max':
                        case 'factor_type':
                        case 'factor_value':
                        case 'created_at':
                        case 'updated_at':
                            break;

                        default:
                            if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                            $whereStr .= "((LOWER($key) = LOWER(:$key))) ";
                            break;
                    }
                }
            }
            return $whereStr;
        }
        
        public static function searchPropertiesParam( $maths = array()){
            $whereParam =  array();

            if(empty($maths)) {
                return $whereParam;
            }
            foreach ($maths as $key => $value) {
                if(!empty($value)) {
                    switch ($key) {
                        case 'id':
                        case 't_count':
                        case 'avg_percentage_diff':
                        case 'fundamentals_factor':
                        case 'conditional_factor':
                        case 'factor_included':
                        case 'factor_min':
                        case 'factor_max':
                        case 'factor_type':
                        case 'factor_value':
                        case 'created_at':
                        case 'updated_at':
                            break;

                        default:
                            $whereParam[':'. $key] = $value;
                            break;
                    }
                }
            }
            return $whereParam;
        }

        public static function getPropertyInfo($id) {
            $property = array();
            $details = PropertyInfo::model()->with(
                    'propertyInfoAdditionalBrokerageDetails', 
                    'propertyInfoAdditionalDetails', 
                    'propertyInfoDetails'
                    )->findByPk($id);
            
            if(!empty($details)) {
                $property = array(
                    'fundamentals_factor'=> $details->fundamentals_factor,
                    'conditional_factor'=> $details->conditional_factor,
                    'property_price'=> $details->property_price,
                    'estimated_price'=> $details->estimated_price,
                    'comp_stage'=> $details->comp_stage,
                    'comps'=> $details->comps,
                    'house_square_footage_gravity'=>$details->house_square_footage_gravity,
                    'lot_footage_gravity'=>$details->lot_footage_gravity,
                    'property_type'=> $details->property_type,
                    'property_zipcode'=> $details->property_zipcode,
                    'compass_point'=> $details->propertyInfoDetails->compass_point,
                    'house_faces'=> $details->propertyInfoDetails->house_faces,
                    'house_views'=> $details->propertyInfoDetails->house_views,
                    'street_name'=> $details->street_name,
                    'pool'=> $details->pool,
                    'spa'=> $details->propertyInfoDetails->spa,
                    'stories'=> $details->propertyInfoDetails->stories,
                    'lot_description'=> $details->propertyInfoDetails->lot_description,
                    'building_description'=> $details->building_description,
                    'carport_type'=> $details->propertyInfoDetails->carport_type,
                    'converted_garage'=> $details->propertyInfoDetails->converted_garage,
                    'exterior_structure'=> $details->propertyInfoAdditionalDetails->exterior_structure,
                    'roof'=> $details->propertyInfoAdditionalDetails->roof,
                    'electrical_system'=> $details->propertyInfoAdditionalDetails->electrical_system,
                    'plumbing_system'=> $details->propertyInfoAdditionalDetails->plumbing_system,
                    'built_desc'=> $details->propertyInfoDetails->built_desc,
                    'exterior_grounds'=> $details->propertyInfoAdditionalDetails->exterior_grounds,
                    'prop_desc'=> $details->propertyInfoDetails->prop_desc,
                    'over_all_property'=> $details->propertyInfoAdditionalDetails->over_all_property,
                    'foreclosure'=> $details->propertyInfoAdditionalBrokerageDetails->foreclosure,
                    'short_sale'=> $details->propertyInfoAdditionalBrokerageDetails->short_sale,
                    'sub_type'=> $details->sub_type,

                    'studio' => $details->propertyInfoDetails->studio ,
                    'condo_conversion' => $details->propertyInfoDetails->condo_conversion ,
                    'association_features_available' => $details->propertyInfoDetails->association_features_available ,
                    'association_fee_1' => $details->propertyInfoDetails->association_fee_1 ,
                    'assessment' => $details->propertyInfoDetails->assessment ,
                    'sidlid' => $details->propertyInfoDetails->sidlid ,
                    'parking_description' => $details->propertyInfoDetails->parking_description ,
                    'fence_type' => $details->propertyInfoDetails->fence_type ,
                    'court_approval' => $details->propertyInfoDetails->court_approval ,
                   
                    'bath_downstairs' => $details->propertyInfoAdditionalDetails->bath_downstairs ,
                    'bedroom_downstairs' => $details->propertyInfoAdditionalDetails->bedroom_downstairs ,
                    'great_room' => $details->propertyInfoAdditionalDetails->great_room ,
                    'bath_downstairs_description' => $details->propertyInfoAdditionalDetails->bath_downstairs_description ,
                    'flooring_description' => $details->propertyInfoAdditionalDetails->flooring_description ,
                    'furnishings_description' => $details->propertyInfoAdditionalDetails->furnishings_description ,

                    'heating_features' => $details->propertyInfoAdditionalBrokerageDetails->heating_features ,
                    'possession_description' => $details->propertyInfoAdditionalBrokerageDetails->possession_description ,
                    'financing_considered' => $details->propertyInfoAdditionalBrokerageDetails->financing_considered ,
                    'reporeo' => $details->propertyInfoAdditionalBrokerageDetails->reporeo ,
                    'litigation' => $details->propertyInfoAdditionalBrokerageDetails->litigation ,
                        );
            }
            return $property;
        }
        
	public function houseViewsList() {
            $house_views_arr = array();
            $criteria = new CDbCriteria;
            $criteria->select = 'house_views';
            $criteria->condition = "house_views!=''AND house_views IS NOT NULL";
            $criteria->group = 'house_views';
//            $criteria->params=array(':postID'=>10);
            $house_views_result = self::model()->findAll($criteria);
            if(empty($house_views_result)) {
                $house_views_arr = array();
            } else {
                foreach ($house_views_result as $value) {
                    $house_views_arr[] = strtolower($value->house_views);
                }
            }
            return $house_views_arr;
        }

        public static function getFactorsRow($property) {
            $excludeCol = array('id','t_count','avg_percentage_diff','fundamentals_factor','conditional_factor','factor_included', 'property_zipcode','factor_min', 'factor_max','estimated_price', 'property_price', 'factor_type', 'factor_value', 'comp_stage', 'comps', 'created_at', 'updated_at');
            
            $sqlTcount = isset(Yii::app()->params['minTcountResearch'])? Yii::app()->params['minTcountResearch'] : 8;
            $factors = array('fundamentals_factor'=>0.0, 'conditional_factor'=>0.0 );
            $whereStr = self::searchFactors( $property, 1 );
            $whereParam = self::searchFactorsParam( $property, 1 );
            
            $rowSum = array();
            
            if(!empty($whereStr)) {
                foreach (array('fundamentals_factor', 'conditional_factor') as $factor) {
                    $row0 = array();
                    $row = array();
                    
                    $critFactor0 = new CDbCriteria();
                    $critFactor0->condition = "(factor_value IS NOT NULL AND factor_value != 0.0 ) AND ((property_zipcode = 0 ) OR ( property_zipcode IS NULL )) AND factor_type = '{$factor}' AND factor_included > 0 AND t_count >= {$sqlTcount} AND " . $whereStr ;
                    $critFactor0->params = $whereParam;

                    $row0 = MarketTrendTable::model()->findAll($critFactor0);
                    
                    if(!empty($property['property_zipcode'])) {
                        $critFactor = new CDbCriteria();
                        $critFactor->condition = ($condStr = "(factor_value IS NOT NULL AND factor_value != 0.0 ) AND (property_zipcode = {$property['property_zipcode']}) AND factor_type = '{$factor}' AND factor_included > 0 AND t_count >= {$sqlTcount} AND " . $whereStr );
                        $critFactor->params = $whereParam;
                        $row = MarketTrendTable::model()->findAll($critFactor);
                    }
                    
                    foreach ($row0 as $key0 => $value0) {
                        $equal = false;
                        foreach ($row as $key => $value) {
                            $equal = true;
                            foreach ($value as $col => $valueCol) {
                                if(in_array($col,$excludeCol)) continue;
                                if($value0[$col] !== $value[$col]) {
                                    $equal = false;
                                }
                            }
                            if($equal) {
                                break;
                            }
                        }
                        if(!$equal) {
                            $rowSum[] = $row0[$key0] ;
                        }
                    }
                    foreach ($row as $key => $value) {
                        $rowSum[] = $row[$key] ;
                    }
//Yii::log(print_r($row0,1 ) ,'ERROR'); 
//Yii::log(print_r($row,1 ) ,'ERROR'); 

                }
            }
            if(!empty($rowSum)) {
                usort($rowSum, function($a, $b) {
                    return $a['id'] - $b['id'];
                });
            }
            return $rowSum;
        }
        
        public static function getFactors($property) {
            $excludeCol = array('id','t_count','avg_percentage_diff','fundamentals_factor','conditional_factor','factor_included', 'property_zipcode', 'factor_min', 'factor_max','estimated_price', 'property_price', 'factor_type', 'factor_value', 'comp_stage', 'comps', 'created_at', 'updated_at');
            
            $sqlTcount = isset(Yii::app()->params['minTcountResearch'])? Yii::app()->params['minTcountResearch'] : 8;
            $factors = array('fundamentals_factor'=>0.0, 'conditional_factor'=>0.0 );
            $whereStr = self::searchFactors( $property, 1 );
            $whereParam = self::searchFactorsParam( $property, 1 );
            if(!empty($whereStr)) {
                foreach (array('fundamentals_factor', 'conditional_factor') as $factor) {
                    $rowSum = array();
                    $critFactor0 = new CDbCriteria();
                    $critFactor0->condition = ($condStr = "(factor_value IS NOT NULL AND factor_value != 0.0 ) AND ((property_zipcode = 0 ) OR ( property_zipcode IS NULL )) AND factor_type = '{$factor}' AND factor_included > 0 AND t_count >= {$sqlTcount} AND " . $whereStr );
                    $critFactor0->params = $whereParam;
                    $row0 = MarketTrendTable::model()->findAll($critFactor0);

                    if(!empty($property['property_zipcode'])) {
                        $critFactor = new CDbCriteria();
                        $critFactor->condition = "(factor_value IS NOT NULL AND factor_value != 0.0 ) AND (property_zipcode = {$property['property_zipcode']}) AND factor_type = '{$factor}' AND factor_included > 0 AND t_count >= {$sqlTcount} AND " . $whereStr ;
                        $critFactor->params = $whereParam;
                        $row = MarketTrendTable::model()->findAll($critFactor);
                    }
                    
                    if(!empty($row) && !empty($row0)){
                        foreach ($row0 as $key0 => $value0) {
                            foreach ($row as $key => $value) {
                                $equal = true;
                                foreach ($value as $col => $valueCol) {
                                    if(in_array($col,$excludeCol)) continue;
                                    if($value0[$col] !== $value[$col]) {
                                        $equal = false;
                                    }
                                }
                                if($equal) {
                                    break;
                                }
                            }
                            if(!$equal) {
                                $rowSum[] = $row0[$key0] ;
                            }
                        }
                        foreach ($row as $key => $value) {
                            $rowSum[] = $row[$key] ;
                        }
                    } else {
                        if(!empty($row) && empty($row0)) {
                            $rowSum = $row ;
                        } else {
                            $rowSum = $row0 ;
                        }
                    }

                    $sum = 0;
                    foreach ($rowSum as $key0 => $value0) {
                        $sum += $value0['factor_value'];
                    }
//Yii::log(print_r($row0,1 ) ,'ERROR'); 
//Yii::log(print_r($row,1 ) ,'ERROR');
                    $factors[$factor] = $sum;
                }
            }
            return $factors;
        }
}
