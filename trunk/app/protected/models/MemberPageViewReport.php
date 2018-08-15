<?php

/**
 * This is the model class for table "member_page_view_report".
 *
 * The followings are the available columns in table 'member_page_view_report':
 * @property integer $member_page_view_id
 * @property integer $mid
 * @property integer $card_view
 * @property integer $profile_view
 * @property integer $website_view
 */
class MemberPageViewReport extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'member_page_view_report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mid, card_view, profile_view, website_view', 'required'),
			array('mid, card_view, profile_view, website_view', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('member_page_view_id, mid, card_view, profile_view, website_view', 'safe', 'on'=>'search'),
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
			'member_page_view_id' => 'Member Page View',
			'mid' => 'Mid',
			'card_view' => 'Card View',
			'profile_view' => 'Profile View',
			'website_view' => 'Website View',
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

		$criteria->compare('member_page_view_id',$this->member_page_view_id);
		$criteria->compare('mid',$this->mid);
		$criteria->compare('card_view',$this->card_view);
		$criteria->compare('profile_view',$this->profile_view);
		$criteria->compare('website_view',$this->website_view);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MemberPageViewReport the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
