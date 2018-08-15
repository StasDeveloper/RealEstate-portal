<?php

/**
 * This is the model class for table "property_info_additional_details_history".
 *
 * The followings are the available columns in table 'property_info_additional_details_history':
 * @property integer $property_additional_detail_id
 * @property integer $property_id
 * @property integer $over_all_property
 * @property string $exterior_grounds
 * @property string $exterior_structure
 * @property string $roof
 * @property string $ac_system
 * @property string $electrical_system
 * @property string $interior_structure
 * @property string $plumbing_system
 * @property string $kitchen
 * @property integer $bath_sink_qty
 * @property integer $bath_sink_top_qty
 * @property integer $bath_faucets_standard_qty
 * @property integer $bath_faucets_upgraded_qty
 * @property integer $bath_medicine_cabinet_qty
 * @property integer $bath_wall_mirrors_qty
 * @property integer $bath_plas_shower_surround_qty
 * @property integer $bath_shower_wall_surrounds_qty
 * @property integer $bath_shower_doorset_qty
 * @property integer $bath_tub_shower_pan_qty
 * @property integer $bath_toilet_qty
 * @property integer $bath_upgraded_kitchen_cabinet_qty
 * @property integer $bath_stand_kitchen_cabinet_qty
 * @property integer $door_replace_garage_qty
 * @property integer $door_replace_interior_qty
 * @property integer $door_replace_garage_motor_qty
 * @property integer $door_replace_new_windows_qty
 * @property integer $new_water_heater_qty
 * @property integer $kitchen_dishwasher_qty
 * @property integer $kitchen_garbage_disposal_qty
 * @property integer $kitchen_microwave_qty
 * @property integer $kitchen_refridgerator_qty
 * @property integer $kitchen_sink_faucet_qty
 * @property integer $kitchen_sink_qty
 * @property integer $kitchen_stove_qty
 * @property integer $kitchen_sink_hoods_qty
 * @property integer $flooring_carpeting_covers_per
 * @property string $floor_carpeting_covers_select
 * @property integer $floor_vinyl_covers_per
 * @property string $floor_vinyl_covers_select
 * @property integer $floor_ceramic_tile_covers_per
 * @property string $floor_ceramic_tile_covers_select
 * @property integer $floor_porcelain_tile_covers_per
 * @property string $floor_porcelain_tile_covers_select
 * @property integer $floor_stone_tile_covers_per
 * @property string $floor_stone_tile_covers_select
 * @property integer $floor_wood_pergo_covers_per
 * @property string $floor_wood_pergo_covers_select
 * @property integer $floor_other_finish_covers_per
 */
class PropertyInfoAdditionalDetailsHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'property_info_additional_details_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('property_id, over_all_property, exterior_grounds, exterior_structure, roof, ac_system, electrical_system, interior_structure, plumbing_system, kitchen, bath_sink_qty, bath_sink_top_qty, bath_faucets_standard_qty, bath_faucets_upgraded_qty, bath_medicine_cabinet_qty, bath_wall_mirrors_qty, bath_plas_shower_surround_qty, bath_shower_wall_surrounds_qty, bath_shower_doorset_qty, bath_tub_shower_pan_qty, bath_toilet_qty, bath_upgraded_kitchen_cabinet_qty, bath_stand_kitchen_cabinet_qty, door_replace_garage_qty, door_replace_interior_qty, door_replace_garage_motor_qty, door_replace_new_windows_qty, new_water_heater_qty, kitchen_dishwasher_qty, kitchen_garbage_disposal_qty, kitchen_microwave_qty, kitchen_refridgerator_qty, kitchen_sink_faucet_qty, kitchen_sink_qty, kitchen_stove_qty, kitchen_sink_hoods_qty, flooring_carpeting_covers_per, floor_carpeting_covers_select, floor_vinyl_covers_per, floor_vinyl_covers_select, floor_ceramic_tile_covers_per, floor_ceramic_tile_covers_select, floor_porcelain_tile_covers_per, floor_porcelain_tile_covers_select, floor_stone_tile_covers_per, floor_stone_tile_covers_select, floor_wood_pergo_covers_per, floor_wood_pergo_covers_select, floor_other_finish_covers_per', 'required'),
			array('property_id, over_all_property, bath_sink_qty, bath_sink_top_qty, bath_faucets_standard_qty, bath_faucets_upgraded_qty, bath_medicine_cabinet_qty, bath_wall_mirrors_qty, bath_plas_shower_surround_qty, bath_shower_wall_surrounds_qty, bath_shower_doorset_qty, bath_tub_shower_pan_qty, bath_toilet_qty, bath_upgraded_kitchen_cabinet_qty, bath_stand_kitchen_cabinet_qty, door_replace_garage_qty, door_replace_interior_qty, door_replace_garage_motor_qty, door_replace_new_windows_qty, new_water_heater_qty, kitchen_dishwasher_qty, kitchen_garbage_disposal_qty, kitchen_microwave_qty, kitchen_refridgerator_qty, kitchen_sink_faucet_qty, kitchen_sink_qty, kitchen_stove_qty, kitchen_sink_hoods_qty, flooring_carpeting_covers_per, floor_vinyl_covers_per, floor_ceramic_tile_covers_per, floor_porcelain_tile_covers_per, floor_stone_tile_covers_per, floor_wood_pergo_covers_per, floor_other_finish_covers_per', 'numerical', 'integerOnly'=>true),
			array('exterior_grounds, exterior_structure, roof, ac_system, electrical_system, interior_structure, plumbing_system, kitchen, floor_carpeting_covers_select, floor_vinyl_covers_select, floor_ceramic_tile_covers_select, floor_porcelain_tile_covers_select, floor_stone_tile_covers_select, floor_wood_pergo_covers_select', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('property_additional_detail_id, property_id, over_all_property, exterior_grounds, exterior_structure, roof, ac_system, electrical_system, interior_structure, plumbing_system, kitchen, bath_sink_qty, bath_sink_top_qty, bath_faucets_standard_qty, bath_faucets_upgraded_qty, bath_medicine_cabinet_qty, bath_wall_mirrors_qty, bath_plas_shower_surround_qty, bath_shower_wall_surrounds_qty, bath_shower_doorset_qty, bath_tub_shower_pan_qty, bath_toilet_qty, bath_upgraded_kitchen_cabinet_qty, bath_stand_kitchen_cabinet_qty, door_replace_garage_qty, door_replace_interior_qty, door_replace_garage_motor_qty, door_replace_new_windows_qty, new_water_heater_qty, kitchen_dishwasher_qty, kitchen_garbage_disposal_qty, kitchen_microwave_qty, kitchen_refridgerator_qty, kitchen_sink_faucet_qty, kitchen_sink_qty, kitchen_stove_qty, kitchen_sink_hoods_qty, flooring_carpeting_covers_per, floor_carpeting_covers_select, floor_vinyl_covers_per, floor_vinyl_covers_select, floor_ceramic_tile_covers_per, floor_ceramic_tile_covers_select, floor_porcelain_tile_covers_per, floor_porcelain_tile_covers_select, floor_stone_tile_covers_per, floor_stone_tile_covers_select, floor_wood_pergo_covers_per, floor_wood_pergo_covers_select, floor_other_finish_covers_per', 'safe', 'on'=>'search'),
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
			'property_additional_detail_id' => 'Property Additional Detail',
			'property_id' => 'Property',
			'over_all_property' => 'Over All Property',
			'exterior_grounds' => 'Exterior Grounds',
			'exterior_structure' => 'Exterior Structure',
			'roof' => 'Roof',
			'ac_system' => 'Ac System',
			'electrical_system' => 'Electrical System',
			'interior_structure' => 'Interior Structure',
			'plumbing_system' => 'Plumbing System',
			'kitchen' => 'Kitchen',
			'bath_sink_qty' => 'Bath Sink Qty',
			'bath_sink_top_qty' => 'Bath Sink Top Qty',
			'bath_faucets_standard_qty' => 'Bath Faucets Standard Qty',
			'bath_faucets_upgraded_qty' => 'Bath Faucets Upgraded Qty',
			'bath_medicine_cabinet_qty' => 'Bath Medicine Cabinet Qty',
			'bath_wall_mirrors_qty' => 'Bath Wall Mirrors Qty',
			'bath_plas_shower_surround_qty' => 'Bath Plas Shower Surround Qty',
			'bath_shower_wall_surrounds_qty' => 'Bath Shower Wall Surrounds Qty',
			'bath_shower_doorset_qty' => 'Bath Shower Doorset Qty',
			'bath_tub_shower_pan_qty' => 'Bath Tub Shower Pan Qty',
			'bath_toilet_qty' => 'Bath Toilet Qty',
			'bath_upgraded_kitchen_cabinet_qty' => 'Bath Upgraded Kitchen Cabinet Qty',
			'bath_stand_kitchen_cabinet_qty' => 'Bath Stand Kitchen Cabinet Qty',
			'door_replace_garage_qty' => 'Door Replace Garage Qty',
			'door_replace_interior_qty' => 'Door Replace Interior Qty',
			'door_replace_garage_motor_qty' => 'Door Replace Garage Motor Qty',
			'door_replace_new_windows_qty' => 'Door Replace New Windows Qty',
			'new_water_heater_qty' => 'New Water Heater Qty',
			'kitchen_dishwasher_qty' => 'Kitchen Dishwasher Qty',
			'kitchen_garbage_disposal_qty' => 'Kitchen Garbage Disposal Qty',
			'kitchen_microwave_qty' => 'Kitchen Microwave Qty',
			'kitchen_refridgerator_qty' => 'Kitchen Refridgerator Qty',
			'kitchen_sink_faucet_qty' => 'Kitchen Sink Faucet Qty',
			'kitchen_sink_qty' => 'Kitchen Sink Qty',
			'kitchen_stove_qty' => 'Kitchen Stove Qty',
			'kitchen_sink_hoods_qty' => 'Kitchen Sink Hoods Qty',
			'flooring_carpeting_covers_per' => 'Flooring Carpeting Covers Per',
			'floor_carpeting_covers_select' => 'Floor Carpeting Covers Select',
			'floor_vinyl_covers_per' => 'Floor Vinyl Covers Per',
			'floor_vinyl_covers_select' => 'Floor Vinyl Covers Select',
			'floor_ceramic_tile_covers_per' => 'Floor Ceramic Tile Covers Per',
			'floor_ceramic_tile_covers_select' => 'Floor Ceramic Tile Covers Select',
			'floor_porcelain_tile_covers_per' => 'Floor Porcelain Tile Covers Per',
			'floor_porcelain_tile_covers_select' => 'Floor Porcelain Tile Covers Select',
			'floor_stone_tile_covers_per' => 'Floor Stone Tile Covers Per',
			'floor_stone_tile_covers_select' => 'Floor Stone Tile Covers Select',
			'floor_wood_pergo_covers_per' => 'Floor Wood Pergo Covers Per',
			'floor_wood_pergo_covers_select' => 'Floor Wood Pergo Covers Select',
			'floor_other_finish_covers_per' => 'Floor Other Finish Covers Per',
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

		$criteria->compare('property_additional_detail_id',$this->property_additional_detail_id);
		$criteria->compare('property_id',$this->property_id);
		$criteria->compare('over_all_property',$this->over_all_property);
		$criteria->compare('exterior_grounds',$this->exterior_grounds,true);
		$criteria->compare('exterior_structure',$this->exterior_structure,true);
		$criteria->compare('roof',$this->roof,true);
		$criteria->compare('ac_system',$this->ac_system,true);
		$criteria->compare('electrical_system',$this->electrical_system,true);
		$criteria->compare('interior_structure',$this->interior_structure,true);
		$criteria->compare('plumbing_system',$this->plumbing_system,true);
		$criteria->compare('kitchen',$this->kitchen,true);
		$criteria->compare('bath_sink_qty',$this->bath_sink_qty);
		$criteria->compare('bath_sink_top_qty',$this->bath_sink_top_qty);
		$criteria->compare('bath_faucets_standard_qty',$this->bath_faucets_standard_qty);
		$criteria->compare('bath_faucets_upgraded_qty',$this->bath_faucets_upgraded_qty);
		$criteria->compare('bath_medicine_cabinet_qty',$this->bath_medicine_cabinet_qty);
		$criteria->compare('bath_wall_mirrors_qty',$this->bath_wall_mirrors_qty);
		$criteria->compare('bath_plas_shower_surround_qty',$this->bath_plas_shower_surround_qty);
		$criteria->compare('bath_shower_wall_surrounds_qty',$this->bath_shower_wall_surrounds_qty);
		$criteria->compare('bath_shower_doorset_qty',$this->bath_shower_doorset_qty);
		$criteria->compare('bath_tub_shower_pan_qty',$this->bath_tub_shower_pan_qty);
		$criteria->compare('bath_toilet_qty',$this->bath_toilet_qty);
		$criteria->compare('bath_upgraded_kitchen_cabinet_qty',$this->bath_upgraded_kitchen_cabinet_qty);
		$criteria->compare('bath_stand_kitchen_cabinet_qty',$this->bath_stand_kitchen_cabinet_qty);
		$criteria->compare('door_replace_garage_qty',$this->door_replace_garage_qty);
		$criteria->compare('door_replace_interior_qty',$this->door_replace_interior_qty);
		$criteria->compare('door_replace_garage_motor_qty',$this->door_replace_garage_motor_qty);
		$criteria->compare('door_replace_new_windows_qty',$this->door_replace_new_windows_qty);
		$criteria->compare('new_water_heater_qty',$this->new_water_heater_qty);
		$criteria->compare('kitchen_dishwasher_qty',$this->kitchen_dishwasher_qty);
		$criteria->compare('kitchen_garbage_disposal_qty',$this->kitchen_garbage_disposal_qty);
		$criteria->compare('kitchen_microwave_qty',$this->kitchen_microwave_qty);
		$criteria->compare('kitchen_refridgerator_qty',$this->kitchen_refridgerator_qty);
		$criteria->compare('kitchen_sink_faucet_qty',$this->kitchen_sink_faucet_qty);
		$criteria->compare('kitchen_sink_qty',$this->kitchen_sink_qty);
		$criteria->compare('kitchen_stove_qty',$this->kitchen_stove_qty);
		$criteria->compare('kitchen_sink_hoods_qty',$this->kitchen_sink_hoods_qty);
		$criteria->compare('flooring_carpeting_covers_per',$this->flooring_carpeting_covers_per);
		$criteria->compare('floor_carpeting_covers_select',$this->floor_carpeting_covers_select,true);
		$criteria->compare('floor_vinyl_covers_per',$this->floor_vinyl_covers_per);
		$criteria->compare('floor_vinyl_covers_select',$this->floor_vinyl_covers_select,true);
		$criteria->compare('floor_ceramic_tile_covers_per',$this->floor_ceramic_tile_covers_per);
		$criteria->compare('floor_ceramic_tile_covers_select',$this->floor_ceramic_tile_covers_select,true);
		$criteria->compare('floor_porcelain_tile_covers_per',$this->floor_porcelain_tile_covers_per);
		$criteria->compare('floor_porcelain_tile_covers_select',$this->floor_porcelain_tile_covers_select,true);
		$criteria->compare('floor_stone_tile_covers_per',$this->floor_stone_tile_covers_per);
		$criteria->compare('floor_stone_tile_covers_select',$this->floor_stone_tile_covers_select,true);
		$criteria->compare('floor_wood_pergo_covers_per',$this->floor_wood_pergo_covers_per);
		$criteria->compare('floor_wood_pergo_covers_select',$this->floor_wood_pergo_covers_select,true);
		$criteria->compare('floor_other_finish_covers_per',$this->floor_other_finish_covers_per);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PropertyInfoAdditionalDetailsHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
