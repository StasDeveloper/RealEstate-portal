<?php

/**
 * This is the model class for table "{{property_info_cron_load_photo}}".
 *
 * The followings are the available columns in table '{{property_info_cron_load_photo}}':
 * @property integer $id
 * @property string $mls_sysid
 * @property integer $process
 * @property string $created_at
 * @property string $process_at
 */
class TblPropertyInfoCronLoadPhoto extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{property_info_cron_load_photo}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_at', 'required'),
            array('process', 'numerical', 'integerOnly'=>true),
            array('mls_sysid', 'length', 'max'=>20),
            array('process_at', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, mls_sysid, process, created_at, process_at', 'safe', 'on'=>'search'),
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
            'mls_sysid' => 'Mls Sysid',
            'process' => 'Process',
            'created_at' => 'Created At',
            'process_at' => 'Process At',
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
        $criteria->compare('mls_sysid',$this->mls_sysid,true);
        $criteria->compare('process',$this->process);
        $criteria->compare('created_at',$this->created_at,true);
        $criteria->compare('process_at',$this->process_at,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TblPropertyInfoCronLoadPhoto the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
