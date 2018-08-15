<?php

/**
 * This is the model class for table "property_info_photo".
 *
 * The followings are the available columns in table 'property_info_photo':
 * @property integer $property_id
 * @property string $photo2
 * @property string $caption2
 * @property string $photo3
 * @property string $caption3
 * @property string $photo4
 * @property string $caption4
 * @property string $photo5
 * @property string $caption5
 * @property string $photo6
 * @property string $photo7
 * @property string $photo8
 * @property string $photo9
 * @property string $photo10
 * @property string $photo11
 * @property string $photo12
 * @property string $photo13
 * @property string $photo14
 * @property string $photo15
 * @property string $photo16
 * @property string $photo17
 * @property string $photo18
 * @property string $photo19
 * @property string $photo20
 * @property string $photo21
 * @property string $photo22
 * @property string $photo23
 * @property string $photo24
 * @property string $photo25
 * @property string $photo26
 * @property string $photo27
 * @property string $photo28
 * @property string $photo29
 * @property string $photo30
 * @property string $photo31
 * @property string $photo32
 * @property string $photo33
 * @property string $photo34
 * @property string $photo35
 * @property string $photo36
 * @property string $photo37
 * @property string $photo38
 * @property string $photo39
 * @property string $photo40
 */
class PropertyInfoPhoto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'property_info_photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('property_id, photo2, caption2, photo3, caption3, photo4, caption4, photo5, caption5', 'required'),
			array('property_id', 'numerical', 'integerOnly'=>true),
			array('photo2, photo3, photo4, photo5, photo6, photo7, photo8, photo9, photo10, photo11, photo12, photo13, photo14, photo15, photo16, photo17, photo18, photo19, photo20, photo21, photo22, photo23, photo24, photo25, photo26, photo27, photo28, photo29, photo30, photo31, photo32, photo33, photo34, photo35, photo36, photo37, photo38, photo39, photo40', 'length', 'max'=>250),
			array('caption2, caption3, caption4, caption5', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('property_id, photo2, caption2, photo3, caption3, photo4, caption4, photo5, caption5, photo6, photo7, photo8, photo9, photo10, photo11, photo12, photo13, photo14, photo15, photo16, photo17, photo18, photo19, photo20, photo21, photo22, photo23, photo24, photo25, photo26, photo27, photo28, photo29, photo30, photo31, photo32, photo33, photo34, photo35, photo36, photo37, photo38, photo39, photo40', 'safe', 'on'=>'search'),
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
                     'property_info'=> array(self::BELONGS_TO, 'PropertyInfo', 'property_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'property_id' => 'Property',
			'photo2' => 'Photo2',
			'caption2' => 'Caption2',
			'photo3' => 'Photo3',
			'caption3' => 'Caption3',
			'photo4' => 'Photo4',
			'caption4' => 'Caption4',
			'photo5' => 'Photo5',
			'caption5' => 'Caption5',
			'photo6' => 'Photo6',
			'photo7' => 'Photo7',
			'photo8' => 'Photo8',
			'photo9' => 'Photo9',
			'photo10' => 'Photo10',
			'photo11' => 'Photo11',
			'photo12' => 'Photo12',
			'photo13' => 'Photo13',
			'photo14' => 'Photo14',
			'photo15' => 'Photo15',
			'photo16' => 'Photo16',
			'photo17' => 'Photo17',
			'photo18' => 'Photo18',
			'photo19' => 'Photo19',
			'photo20' => 'Photo20',
			'photo21' => 'Photo21',
			'photo22' => 'Photo22',
			'photo23' => 'Photo23',
			'photo24' => 'Photo24',
			'photo25' => 'Photo25',
			'photo26' => 'Photo26',
			'photo27' => 'Photo27',
			'photo28' => 'Photo28',
			'photo29' => 'Photo29',
			'photo30' => 'Photo30',
			'photo31' => 'Photo31',
			'photo32' => 'Photo32',
			'photo33' => 'Photo33',
			'photo34' => 'Photo34',
			'photo35' => 'Photo35',
			'photo36' => 'Photo36',
			'photo37' => 'Photo37',
			'photo38' => 'Photo38',
			'photo39' => 'Photo39',
			'photo40' => 'Photo40',
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

		$criteria->compare('property_id',$this->property_id);
		$criteria->compare('photo2',$this->photo2,true);
		$criteria->compare('caption2',$this->caption2,true);
		$criteria->compare('photo3',$this->photo3,true);
		$criteria->compare('caption3',$this->caption3,true);
		$criteria->compare('photo4',$this->photo4,true);
		$criteria->compare('caption4',$this->caption4,true);
		$criteria->compare('photo5',$this->photo5,true);
		$criteria->compare('caption5',$this->caption5,true);
		$criteria->compare('photo6',$this->photo6,true);
		$criteria->compare('photo7',$this->photo7,true);
		$criteria->compare('photo8',$this->photo8,true);
		$criteria->compare('photo9',$this->photo9,true);
		$criteria->compare('photo10',$this->photo10,true);
		$criteria->compare('photo11',$this->photo11,true);
		$criteria->compare('photo12',$this->photo12,true);
		$criteria->compare('photo13',$this->photo13,true);
		$criteria->compare('photo14',$this->photo14,true);
		$criteria->compare('photo15',$this->photo15,true);
		$criteria->compare('photo16',$this->photo16,true);
		$criteria->compare('photo17',$this->photo17,true);
		$criteria->compare('photo18',$this->photo18,true);
		$criteria->compare('photo19',$this->photo19,true);
		$criteria->compare('photo20',$this->photo20,true);
		$criteria->compare('photo21',$this->photo21,true);
		$criteria->compare('photo22',$this->photo22,true);
		$criteria->compare('photo23',$this->photo23,true);
		$criteria->compare('photo24',$this->photo24,true);
		$criteria->compare('photo25',$this->photo25,true);
		$criteria->compare('photo26',$this->photo26,true);
		$criteria->compare('photo27',$this->photo27,true);
		$criteria->compare('photo28',$this->photo28,true);
		$criteria->compare('photo29',$this->photo29,true);
		$criteria->compare('photo30',$this->photo30,true);
		$criteria->compare('photo31',$this->photo31,true);
		$criteria->compare('photo32',$this->photo32,true);
		$criteria->compare('photo33',$this->photo33,true);
		$criteria->compare('photo34',$this->photo34,true);
		$criteria->compare('photo35',$this->photo35,true);
		$criteria->compare('photo36',$this->photo36,true);
		$criteria->compare('photo37',$this->photo37,true);
		$criteria->compare('photo38',$this->photo38,true);
		$criteria->compare('photo39',$this->photo39,true);
		$criteria->compare('photo40',$this->photo40,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PropertyInfoPhoto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
