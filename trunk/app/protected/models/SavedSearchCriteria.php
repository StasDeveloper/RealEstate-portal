<?php
class SavedSearchCriteria extends CActiveRecord{

    public static $labels = array(
        'address' => 'Address',
        'keywords'=> 'Keywords',

        'property_type' => 'Property Type',
        'sale_type' => 'Sale Type',

        'min_sqft' => 'Min Sq Ft',
        'max_sqft' => 'Max Sq Ft',

        'min_year_built'=>'Min Year Built',
        'max_year_built'=>'Max Year Built',

        'min_price'=>'Min Price',
        'max_price'=>'Max Price',

        'min_lot_size'=>'Min Lot Size',
        'max_lot_size'=>'Max Lot Size',

        'bed'=>'Beds',
        'bath'=>'Baths',

        'geodistance_rectangle'=>'Rectangle Map Boundary',
        'geodistance_circle'=>'Circle Map Boundary',
        'geodistance_polygon'=>'Polygon Map Boundary',
    );

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{saved_search_criteria}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('saved_search_id', 'required'),
            array('saved_search_id', 'numerical', 'integerOnly'=>true),
            array('attr_name', 'length', 'max'=>255),
            array('attr_value', 'safe'),
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
            'savedSearch' => array(self::BELONGS_TO, 'SavedSearch', 'id'),
            //'authAssignments' => array(self::HAS_MANY, 'AuthAssignment', 'itemname'),
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

    public static function getLabel($attr_name){
        if(!array_key_exists($attr_name, self::$labels))
            return '';

        return self::$labels[$attr_name];
    }
} 