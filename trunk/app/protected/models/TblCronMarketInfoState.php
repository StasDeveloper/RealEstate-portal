<?php

/**
 * This is the model class for table "{{cron_market_info_state}}".
 *
 * The followings are the available columns in table '{{cron_market_info_state}}':
 * @property integer $id
 * @property integer $state_id
 * @property string $date
 * @property integer $total
 * @property integer $sale
 * @property integer $sold
 * @property integer $foreclosure
 * @property integer $short_sales
 * @property double $avg_price
 * @property double $high_ppsf
 * @property double $low_ppsf
 * @property double $avg_ppsf
 */
class TblCronMarketInfoState extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{cron_market_info_state}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('state_id, date, total, sale, sold, foreclosure, short_sales, avg_price, high_ppsf, low_ppsf, avg_ppsf', 'required'),
			array('state_id, total, sale, sold, foreclosure, short_sales', 'numerical', 'integerOnly'=>true),
			array('avg_price, high_ppsf, low_ppsf, avg_ppsf', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, state_id, date, total, sale, sold, foreclosure, short_sales, avg_price, high_ppsf, low_ppsf, avg_ppsf', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'state_id' => 'State',
			'date' => 'Date',
			'total' => 'Total',
			'sale' => 'Sale',
			'sold' => 'Sold',
			'foreclosure' => 'Foreclosure',
			'short_sales' => 'Short Sales',
			'avg_price' => 'Avg Price',
			'high_ppsf' => 'High Ppsf',
			'low_ppsf' => 'Low Ppsf',
			'avg_ppsf' => 'Avg Ppsf',
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
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('sale',$this->sale);
		$criteria->compare('sold',$this->sold);
		$criteria->compare('foreclosure',$this->foreclosure);
		$criteria->compare('short_sales',$this->short_sales);
		$criteria->compare('avg_price',$this->avg_price);
		$criteria->compare('high_ppsf',$this->high_ppsf);
		$criteria->compare('low_ppsf',$this->low_ppsf);
		$criteria->compare('avg_ppsf',$this->avg_ppsf);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblCronMarketInfoState the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
