<?php

/**
 * This is the model class for table "meta_title".
 *
 * The followings are the available columns in table 'meta_title':
 * @property integer $metaid
 * @property string $page_name
 * @property string $titles
 * @property string $descriptions
 * @property string $keywords
 * @property string $creator
 * @property string $publisher
 * @property string $language
 * @property string $rights
 * @property string $type
 * @property string $coverage
 * @property string $icbm
 * @property string $region
 * @property string $placename
 * @property string $content_type
 * @property string $robot_1
 * @property string $robot_2
 * @property string $robot_3
 * @property string $glooglebot
 * @property string $msnbot
 * @property string $slurp
 * @property string $classification
 * @property string $rating
 * @property string $document_type
 * @property string $distribution
 * @property string $dc_subject
 * @property string $dc_description
 * @property string $dc_title
 */
class MetaTitle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'meta_title';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_name, creator, publisher, language, rights, type, coverage, icbm, region, placename, content_type, robot_1, robot_2, robot_3, glooglebot, msnbot, slurp, classification, rating, document_type, distribution, dc_subject, dc_description, dc_title', 'required'),
			array('page_name', 'length', 'max'=>50),
			array('titles', 'length', 'max'=>300),
			array('creator, publisher, language, rights, type, coverage, icbm, region, placename, content_type, robot_1, robot_2, robot_3, glooglebot, msnbot, slurp, classification, rating, document_type, distribution', 'length', 'max'=>200),
			array('descriptions, keywords', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('metaid, page_name, titles, descriptions, keywords, creator, publisher, language, rights, type, coverage, icbm, region, placename, content_type, robot_1, robot_2, robot_3, glooglebot, msnbot, slurp, classification, rating, document_type, distribution, dc_subject, dc_description, dc_title', 'safe', 'on'=>'search'),
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
			'metaid' => 'Metaid',
			'page_name' => 'Page Name',
			'titles' => 'Titles',
			'descriptions' => 'Descriptions',
			'keywords' => 'Keywords',
			'creator' => 'Creator',
			'publisher' => 'Publisher',
			'language' => 'Language',
			'rights' => 'Rights',
			'type' => 'Type',
			'coverage' => 'Coverage',
			'icbm' => 'Icbm',
			'region' => 'Region',
			'placename' => 'Placename',
			'content_type' => 'Content Type',
			'robot_1' => 'Robot 1',
			'robot_2' => 'Robot 2',
			'robot_3' => 'Robot 3',
			'glooglebot' => 'Glooglebot',
			'msnbot' => 'Msnbot',
			'slurp' => 'Slurp',
			'classification' => 'Classification',
			'rating' => 'Rating',
			'document_type' => 'Document Type',
			'distribution' => 'Distribution',
			'dc_subject' => 'Dc Subject',
			'dc_description' => 'Dc Description',
			'dc_title' => 'Dc Title',
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

		$criteria->compare('metaid',$this->metaid);
		$criteria->compare('page_name',$this->page_name,true);
		$criteria->compare('titles',$this->titles,true);
		$criteria->compare('descriptions',$this->descriptions,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('creator',$this->creator,true);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('rights',$this->rights,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('coverage',$this->coverage,true);
		$criteria->compare('icbm',$this->icbm,true);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('placename',$this->placename,true);
		$criteria->compare('content_type',$this->content_type,true);
		$criteria->compare('robot_1',$this->robot_1,true);
		$criteria->compare('robot_2',$this->robot_2,true);
		$criteria->compare('robot_3',$this->robot_3,true);
		$criteria->compare('glooglebot',$this->glooglebot,true);
		$criteria->compare('msnbot',$this->msnbot,true);
		$criteria->compare('slurp',$this->slurp,true);
		$criteria->compare('classification',$this->classification,true);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('document_type',$this->document_type,true);
		$criteria->compare('distribution',$this->distribution,true);
		$criteria->compare('dc_subject',$this->dc_subject,true);
		$criteria->compare('dc_description',$this->dc_description,true);
		$criteria->compare('dc_title',$this->dc_title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MetaTitle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
