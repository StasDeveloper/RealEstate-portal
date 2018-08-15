<?php

/**
 * This is the model class for table "{{ad_client_city}}".
 *
 * The followings are the available columns in table '{{ad_client_city}}':
 * @property integer $id
 * @property integer $ad_client_id
 * @property integer $ad_city_id
 *
 * The followings are the available model relations:
 * @property AdClient $adClient
 */
class AdClientCity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ad_client_city}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ad_client_id, ad_city_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ad_client_id, ad_city_id', 'safe', 'on'=>'search'),
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
			'adClient' => array(self::BELONGS_TO, 'AdClient', 'ad_client_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ad_client_id' => 'Ad Client',
			'ad_city_id' => 'Ad City',
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
		$criteria->compare('ad_client_id',$this->ad_client_id);
		$criteria->compare('ad_city_id',$this->ad_city_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdClientCity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getAds($id) {
            $result = array();
            $models = self::model()->findAllByAttributes(array('ad_client_id' => $id));
            if(!empty($models)) {
                foreach ($models as $model) {
                    $result[]=$model->ad_city_id;
                }
            }
            return $result;
        }
        
        public static function getCountAds($id) {
            $counts = self::model()->countByAttributes(array('ad_client_id' => $id));
            return $counts;
        }
        
        public static function saveAds(AdClient $model, $ids) {
            foreach($ids as $key=>$id) {
                if(empty($id))
                    continue;

                $savedModel = new AdClientCity('create');

                $savedModel->setAttributes(array(
                    'ad_client_id' => $model->id,
                    'ad_city_id' => $id,
                ));

                $savedModel->save();
            }
        }
}
