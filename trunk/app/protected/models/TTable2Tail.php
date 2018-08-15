<?php

/**
 * This is the model class for table "t_table_2_tail".
 *
 * The followings are the available columns in table 't_table_2_tail':
 * @property integer $df
 * @property double $tail_50
 * @property double $tail_60
 * @property double $tail_70
 * @property double $tail_80
 * @property double $tail_90
 * @property double $tail_95
 * @property double $tail_96
 * @property double $tail_98
 * @property double $tail_99
 * @property double $tail_99_5
 * @property double $tail_99_8
 * @property double $tail_99_9
 * @property double $tail_99_975
 * @property double $tail_99_99
 * @property double $tail_99_995
 */
class TTable2Tail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_table_2_tail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('df, tail_50, tail_60, tail_70, tail_80, tail_90, tail_95, tail_96, tail_98, tail_99, tail_99_5, tail_99_8, tail_99_9, tail_99_975, tail_99_99, tail_99_995', 'required'),
			array('df', 'numerical', 'integerOnly'=>true),
			array('tail_50, tail_60, tail_70, tail_80, tail_90, tail_95, tail_96, tail_98, tail_99, tail_99_5, tail_99_8, tail_99_9, tail_99_975, tail_99_99, tail_99_995', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('df, tail_50, tail_60, tail_70, tail_80, tail_90, tail_95, tail_96, tail_98, tail_99, tail_99_5, tail_99_8, tail_99_9, tail_99_975, tail_99_99, tail_99_995', 'safe', 'on'=>'search'),
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
			'df' => 'Df',
			'tail_50' => 'Tail 50',
			'tail_60' => 'Tail 60',
			'tail_70' => 'Tail 70',
			'tail_80' => 'Tail 80',
			'tail_90' => 'Tail 90',
			'tail_95' => 'Tail 95',
			'tail_96' => 'Tail 96',
			'tail_98' => 'Tail 98',
			'tail_99' => 'Tail 99',
			'tail_99_5' => 'Tail 99 5',
			'tail_99_8' => 'Tail 99 8',
			'tail_99_9' => 'Tail 99 9',
			'tail_99_975' => 'Tail 99 975',
			'tail_99_99' => 'Tail 99 99',
			'tail_99_995' => 'Tail 99 995',
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

		$criteria->compare('df',$this->df);
		$criteria->compare('tail_50',$this->tail_50);
		$criteria->compare('tail_60',$this->tail_60);
		$criteria->compare('tail_70',$this->tail_70);
		$criteria->compare('tail_80',$this->tail_80);
		$criteria->compare('tail_90',$this->tail_90);
		$criteria->compare('tail_95',$this->tail_95);
		$criteria->compare('tail_96',$this->tail_96);
		$criteria->compare('tail_98',$this->tail_98);
		$criteria->compare('tail_99',$this->tail_99);
		$criteria->compare('tail_99_5',$this->tail_99_5);
		$criteria->compare('tail_99_8',$this->tail_99_8);
		$criteria->compare('tail_99_9',$this->tail_99_9);
		$criteria->compare('tail_99_975',$this->tail_99_975);
		$criteria->compare('tail_99_99',$this->tail_99_99);
		$criteria->compare('tail_99_995',$this->tail_99_995);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TTable2Tail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
