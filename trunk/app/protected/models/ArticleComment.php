<?php

/**
 * This is the model class for table "article_comment".
 *
 * The followings are the available columns in table 'article_comment':
 * @property integer $article_comment_id
 * @property integer $mid
 * @property string $article_comment_aricle_id
 * @property string $article_comment_date
 * @property string $article_comment_message
 */
class ArticleComment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'article_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mid, article_comment_aricle_id, article_comment_date, article_comment_message', 'required'),
			array('mid', 'numerical', 'integerOnly'=>true),
			array('article_comment_aricle_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('article_comment_id, mid, article_comment_aricle_id, article_comment_date, article_comment_message', 'safe', 'on'=>'search'),
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
			'article_comment_id' => 'Article Comment',
			'mid' => 'Mid',
			'article_comment_aricle_id' => 'Article Comment Aricle',
			'article_comment_date' => 'Article Comment Date',
			'article_comment_message' => 'Article Comment Message',
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

		$criteria->compare('article_comment_id',$this->article_comment_id);
		$criteria->compare('mid',$this->mid);
		$criteria->compare('article_comment_aricle_id',$this->article_comment_aricle_id,true);
		$criteria->compare('article_comment_date',$this->article_comment_date,true);
		$criteria->compare('article_comment_message',$this->article_comment_message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ArticleComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
