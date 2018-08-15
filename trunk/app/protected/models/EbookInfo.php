<?php

/**
 * This is the model class for table "ebook_info".
 *
 * The followings are the available columns in table 'ebook_info':
 * @property integer $ebook_id
 * @property string $ebook_title
 * @property string $upload_image
 * @property string $ebook_short_description
 * @property string $ebook_description
 * @property integer $ebook_price
 * @property string $upload_pdf_file
 */
class EbookInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ebook_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ebook_title, upload_image, ebook_short_description, ebook_description, ebook_price, upload_pdf_file', 'required'),
			array('ebook_price', 'numerical', 'integerOnly'=>true),
			array('ebook_title', 'length', 'max'=>60),
			array('upload_image', 'length', 'max'=>100),
			array('ebook_short_description', 'length', 'max'=>200),
			array('upload_pdf_file', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ebook_id, ebook_title, upload_image, ebook_short_description, ebook_description, ebook_price, upload_pdf_file', 'safe', 'on'=>'search'),
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
			'ebook_id' => 'Ebook',
			'ebook_title' => 'Ebook Title',
			'upload_image' => 'Upload Image',
			'ebook_short_description' => 'Ebook Short Description',
			'ebook_description' => 'Ebook Description',
			'ebook_price' => 'Ebook Price',
			'upload_pdf_file' => 'Upload Pdf File',
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

		$criteria->compare('ebook_id',$this->ebook_id);
		$criteria->compare('ebook_title',$this->ebook_title,true);
		$criteria->compare('upload_image',$this->upload_image,true);
		$criteria->compare('ebook_short_description',$this->ebook_short_description,true);
		$criteria->compare('ebook_description',$this->ebook_description,true);
		$criteria->compare('ebook_price',$this->ebook_price);
		$criteria->compare('upload_pdf_file',$this->upload_pdf_file,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EbookInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
