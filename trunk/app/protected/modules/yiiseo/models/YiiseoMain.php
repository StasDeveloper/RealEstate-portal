<?php

/**
 * This is the model class for table "yiiseo_main".
 *
 * The followings are the available columns in table 'yiiseo_main':
 * @property integer $id
 * @property integer $url
 * @property string $name
 * @property string $content
 * @property integer $active
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property YiiseoUrl $url0
 */
class YiiseoMain extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yiiseo_main';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url, name, content, active', 'required'),
			array('url, active', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('content, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, url, name, content, active, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

        public function behaviors(){
                return array(
                        'CTimestampBehavior' => array(
                                'class' => 'zii.behaviors.CTimestampBehavior',
                                'timestampExpression' => new CDbExpression('UTC_TIMESTAMP()'),
                                'createAttribute' => 'created_at',
                                'updateAttribute' => 'updated_at',
                        )
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
			'url0' => array(self::BELONGS_TO, 'YiiseoUrl', 'url'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'url' => 'Url',
			'name' => 'Name',
			'content' => 'Content',
			'active' => 'Active',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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
		$criteria->compare('url',$this->url);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return YiiseoMain the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
