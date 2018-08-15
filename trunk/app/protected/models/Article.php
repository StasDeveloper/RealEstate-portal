<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $article_id
 * @property string $art_title_catch_word
 * @property integer $art_category
 * @property string $art_discription
 * @property string $art_short_discription
 * @property string $art_auther_name
 * @property string $art_upload_date
 */
class Article extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('art_title_catch_word, art_category, art_discription, art_short_discription, art_auther_name, art_upload_date', 'required'),
			array('art_category', 'numerical', 'integerOnly'=>true),
			array('art_title_catch_word', 'length', 'max'=>60),
			array('art_short_discription', 'length', 'max'=>200),
			array('art_auther_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('article_id, art_title_catch_word, art_category, art_discription, art_short_discription, art_auther_name, art_upload_date', 'safe', 'on'=>'search'),
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
			'article_id' => 'Article',
			'art_title_catch_word' => 'Art Title Catch Word',
			'art_category' => 'Art Category',
			'art_discription' => 'Art Discription',
			'art_short_discription' => 'Art Short Discription',
			'art_auther_name' => 'Art Auther Name',
			'art_upload_date' => 'Art Upload Date',
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

		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('art_title_catch_word',$this->art_title_catch_word,true);
		$criteria->compare('art_category',$this->art_category);
		$criteria->compare('art_discription',$this->art_discription,true);
		$criteria->compare('art_short_discription',$this->art_short_discription,true);
		$criteria->compare('art_auther_name',$this->art_auther_name,true);
		$criteria->compare('art_upload_date',$this->art_upload_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
