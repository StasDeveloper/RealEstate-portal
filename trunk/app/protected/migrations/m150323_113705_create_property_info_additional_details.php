<?php

class m150323_113705_create_property_info_additional_details extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{property_info_additional_details}}', array(
            'property_additional_detail_id' => 'integer',
            'property_id' => 'integer',
            'over_all_property' => 'integer',
            'exterior_grounds' => 'string',
            'exterior_structure' => 'string',
            'roof' => 'string',
            'ac_system' => 'string',
            'electrical_system' => 'string',
            'interior_structure' => 'string',
            'plumbing_system' => 'string',
            'kitchen' => 'string',
            'bath_sink_qty' => 'integer',
            'bath_sink_top_qty' => 'integer',
            'bath_faucets_standard_qty' => 'integer',
            'bath_faucets_upgraded_qty' => 'integer',
            'bath_medicine_cabinet_qty' => 'integer',
            'bath_wall_mirrors_qty' => 'integer',
            'bath_plas_shower_surround_qty' => 'integer',
            'bath_shower_wall_surrounds_qty' => 'integer',
            'bath_shower_doorset_qty' => 'integer',
            'bath_tub_shower_pan_qty' => 'integer',
            'bath_toilet_qty' => 'integer',
            'bath_upgraded_kitchen_cabinet_qty' => 'integer',
            'bath_stand_kitchen_cabinet_qty' => 'integer',
            'door_replace_garage_qty' => 'integer',
            'door_replace_interior_qty' => 'integer',
            'door_replace_garage_motor_qty' => 'integer',
            'door_replace_new_windows_qty' => 'integer',
            'new_water_heater_qty' => 'integer',
            'kitchen_dishwasher_qty' => 'integer',
            'kitchen_garbage_disposal_qty' => 'integer',
            'kitchen_microwave_qty' => 'integer',
            'kitchen_refridgerator_qty' => 'integer',
            'kitchen_sink_faucet_qty' => 'integer',
            'kitchen_sink_qty' => 'integer',
            'kitchen_stove_qty' => 'integer',
            'kitchen_sink_hoods_qty' => 'integer',
            'flooring_carpeting_covers_per' => 'integer',
            'floor_carpeting_covers_select' => 'string',
            'floor_vinyl_covers_per' => 'integer',
            'floor_vinyl_covers_select' => 'string',
            'floor_ceramic_tile_covers_per' => 'integer',
            'floor_ceramic_tile_covers_select' => 'string',
            'floor_porcelain_tile_covers_per' => 'integer',
            'floor_porcelain_tile_covers_select' => 'string',
            'floor_stone_tile_covers_per' => 'integer',
            'floor_stone_tile_covers_select' => 'string',
            'floor_wood_pergo_covers_per' => 'integer',
            'floor_wood_pergo_covers_select' => 'string',
            'floor_other_finish_covers_per' => 'integer',

        ));
    }

    public function down()
    {
        $this->dropTable('{{property_info_additional_details}}');
    }
}