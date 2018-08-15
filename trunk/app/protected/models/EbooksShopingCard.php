<?php

/**
 * This is the model class for table "ebooks_shoping_card".
 *
 * The followings are the available columns in table 'ebooks_shoping_card':
 * @property integer $ebooks_shoping_card_id
 * @property integer $ebooks_shoping_card_mid
 * @property integer $ebooks_shoping_card_ebook_id
 * @property string $ebooks_shoping_card_payment_status
 * @property string $ebooks_shoping_card_date
 * @property string $ebooks_user_session_id
 */
class EbooksShopingCard extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ebooks_shoping_card';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ebooks_shoping_card_mid, ebooks_shoping_card_ebook_id, ebooks_shoping_card_date, ebooks_user_session_id', 'required'),
			array('ebooks_shoping_card_mid, ebooks_shoping_card_ebook_id', 'numerical', 'integerOnly'=>true),
			array('ebooks_shoping_card_payment_status', 'length', 'max'=>1),
			array('ebooks_user_session_id', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ebooks_shoping_card_id, ebooks_shoping_card_mid, ebooks_shoping_card_ebook_id, ebooks_shoping_card_payment_status, ebooks_shoping_card_date, ebooks_user_session_id', 'safe', 'on'=>'search'),
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
			'ebooks_shoping_card_id' => 'Ebooks Shoping Card',
			'ebooks_shoping_card_mid' => 'Ebooks Shoping Card Mid',
			'ebooks_shoping_card_ebook_id' => 'Ebooks Shoping Card Ebook',
			'ebooks_shoping_card_payment_status' => 'Ebooks Shoping Card Payment Status',
			'ebooks_shoping_card_date' => 'Ebooks Shoping Card Date',
			'ebooks_user_session_id' => 'Ebooks User Session',
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

		$criteria->compare('ebooks_shoping_card_id',$this->ebooks_shoping_card_id);
		$criteria->compare('ebooks_shoping_card_mid',$this->ebooks_shoping_card_mid);
		$criteria->compare('ebooks_shoping_card_ebook_id',$this->ebooks_shoping_card_ebook_id);
		$criteria->compare('ebooks_shoping_card_payment_status',$this->ebooks_shoping_card_payment_status,true);
		$criteria->compare('ebooks_shoping_card_date',$this->ebooks_shoping_card_date,true);
		$criteria->compare('ebooks_user_session_id',$this->ebooks_user_session_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EbooksShopingCard the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
