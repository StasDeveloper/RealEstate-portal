<?php
class SavedSearchEmail extends CActiveRecord{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{saved_search_emails}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, saved_search_id', 'required'),
            array('saved_search_id', 'numerical', 'integerOnly'=>true),
            array('email', 'length', 'max'=>255),
            array('email', 'email'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            //array('name, type, description, bizrule, data', 'safe', 'on'=>'search'),
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


} 