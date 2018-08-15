<div class="col-xs-12 padding-top-10 padding-bottom-10">
    <div class="panel-group smart-accordion-default" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> General Information </a></h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_1($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->getAttributeLabel('property_street')=>$info->property_street,
                            $info->getAttributeLabel('street_number')=>$info->street_number,
                            $info->getAttributeLabel('street_name')=>$info->street_name,
                            $info->getAttributeLabel('building_number')=>$info->building_number,
                            $info->propertyInfoDetails->getAttributeLabel('apt_suite')=>$info->propertyInfoDetails->apt_suite,
                            $info->getAttributeLabel('property_title')=>$info->property_title,
                            $info->getAttributeLabel('description')=>$info->description,
                            $info->getAttributeLabel('property_fetatures')=>$info->property_fetatures,
                            $info->getAttributeLabel('house_square_footage')=>$info->house_square_footage,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('over_all_property')=>$info->propertyInfoAdditionalDetails->over_all_property,
                            $info->getAttributeLabel('property_id')=>$info->property_id,
                        );
                    }
                        $this->renderPartial('//property/_property_description_item_comparison', array(
                            'array1' => create_params_1($details),
                            'array2' =>create_params_1($actual)
                        ));

                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Building and Construction </a></h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_2($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->getAttributeLabel('property_type_mls')=>$info->property_type_mls,
                            $info->propertyInfoDetails->getAttributeLabel('built_desc')=>$info->propertyInfoDetails->built_desc,
                            $info->getAttributeLabel('sub_type')=>$info->sub_type,
                            $info->getAttributeLabel('building_description')=>$info->building_description,
                            $info->propertyInfoDetails->getAttributeLabel('stories')=>$info->propertyInfoDetails->stories,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('unit_description')=>$info->propertyInfoAdditionalDetails->unit_description,
                            $info->propertyInfoDetails->getAttributeLabel('model')=>$info->propertyInfoDetails->model,
                            $info->propertyInfoDetails->getAttributeLabel('unit_desc')=>$info->propertyInfoDetails->unit_desc,
                            $info->propertyInfoDetails->getAttributeLabel('compass_point')=>$info->propertyInfoDetails->compass_point,
                            $info->getAttributeLabel('lot_acreage')=>$info->lot_acreage,
                            $info->getAttributeLabel('year_biult_id')=>$info->year_biult_id,
                            $info->getAttributeLabel('elevator_floor')=>$info->elevator_floor,
                            $info->propertyInfoDetails->getAttributeLabel('prop_desc')=>$info->propertyInfoDetails->prop_desc,

                            $info->propertyInfoDetails->getAttributeLabel('studio')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->studio),
                            $info->propertyInfoDetails->getAttributeLabel('condo_conversion')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->condo_conversion),
                            $info->propertyInfoDetails->getAttributeLabel('converted_garage')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->converted_garage),
                            $info->getAttributeLabel('manufactured')=>  SiteHelper::forMembersOnly($info->manufactured),
                            $info->getAttributeLabel('converted_to_real_property')=>  SiteHelper::forMembersOnly($info->converted_to_real_property),
                            $info->propertyInfoDetails->getAttributeLabel('mh_year_built')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->mh_year_built),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('exterior_construction_features')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->exterior_construction_features),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('roof')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->roof),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('roofing_features')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->roofing_features),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_2($details),
                        'array2' => create_params_2($actual)
                        ));

                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Bedrooms </a></h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_3($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->getAttributeLabel('bedrooms')=>$info->bedrooms,
                            $info->propertyInfoDetails->getAttributeLabel('beds_total_poss')=>$info->propertyInfoDetails->beds_total_poss,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_downstairs')=>$info->propertyInfoAdditionalDetails->bedroom_downstairs,

                            $info->propertyInfoAdditionalDetails->getAttributeLabel('master_bedroom_description')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->master_bedroom_description),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('master_bedroom_dimensions')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->master_bedroom_dimensions),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2nd_description')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->bedroom_2nd_description),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2nd_dimensions')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->bedroom_2nd_dimensions),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3rd_description')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->bedroom_3rd_description),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3rd_dimensions')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->bedroom_3rd_dimensions),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_4th_description')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->bedroom_4th_description),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_4th_dimensions')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->bedroom_4th_dimensions),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_5th_description')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->bedroom_5th_description),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_5th_dimensions')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->bedroom_5th_dimensions),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_3($details),
                        'array2' =>create_params_info_3($actual)
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Bathrooms </a></h4>
            </div>
            <div id="collapse4" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php

                    function create_params_info_4($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->getAttributeLabel('bathrooms')=>$info->bathrooms,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('full_baths')=>$info->propertyInfoAdditionalDetails->full_baths,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('baths_34')=>$info->propertyInfoAdditionalDetails->baths_34,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('half_bath')=>$info->propertyInfoAdditionalDetails->half_bath,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('master_bath_description')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->master_bath_description),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bath_downstairs')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->bath_downstairs),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bath_downstairs_description')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->bath_downstairs_description),
                        );
                    }

                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_4($details) ,
                        'array2' => create_params_info_4($actual)
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Kitchen and Dining </a></h4>
            </div>
            <div id="collapse5" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_5($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('kitchen')=>$info->propertyInfoAdditionalDetails->kitchen,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('kitchen_countertops')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->kitchen_countertops),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('kitchen_flooring')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->kitchen_flooring),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('dining_room_dimensions')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->dining_room_dimensions),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('dining_room_description')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->dining_room_description),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_5($details),
                        'array2' => create_params_info_5($actual)
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse6" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Other Rooms </a></h4>
            </div>
            <div id="collapse6" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_6($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('great_room')=>$info->propertyInfoAdditionalDetails->great_room,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('great_room_dimensions')=>$info->propertyInfoAdditionalDetails->great_room_dimensions,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('living_room_dimensions')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->living_room_dimensions),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('living_room_description')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->living_room_description),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('family_room_dimensions')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->family_room_dimensions),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('family_room_description')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->family_room_description),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('numdenother')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->numdenother),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('denother_dimensions')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->denother_dimensions),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('num_of_loft_areas')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->num_of_loft_areas),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('numloft')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->numloft),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('loft_dimensions')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->loft_dimensions),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('loft_description')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->loft_description),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('loft_dimensions_1st_floor')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->loft_dimensions_1st_floor),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('loft_dimensions_2nd_floor')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->loft_dimensions_2nd_floor),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_6($details),
                        'array2' => create_params_info_6($actual)
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse7" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Interior Features </a></h4>
            </div>
            <div id="collapse7" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_7($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('interior_description')=>$info->propertyInfoAdditionalDetails->interior_description,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('interior_features')=>  $info->propertyInfoAdditionalBrokerageDetails->interior_features,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('interior_structure')=>$info->propertyInfoAdditionalDetails->interior_structure,
                            $info->propertyInfoDetails->getAttributeLabel('interior_features')=>$info->propertyInfoDetails->interior_features,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('flooring_description')=>$info->propertyInfoAdditionalDetails->flooring_description,
                            $info->propertyInfoDetails->getAttributeLabel('amenities_fireplace_id')=>$info->propertyInfoDetails->amenities_fireplace_id,
                            $info->propertyInfoDetails->getAttributeLabel('fireplace_location')=>$info->propertyInfoDetails->fireplace_location,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('fireplace_features')=>  $info->propertyInfoAdditionalBrokerageDetails->fireplace_features,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('furnishings_description')=>$info->propertyInfoAdditionalDetails->furnishings_description,
                            $info->propertyInfoDetails->getAttributeLabel('add_liv_area')=>$info->propertyInfoDetails->add_liv_area,
                            $info->propertyInfoDetails->getAttributeLabel('total_liv_area')=>$info->propertyInfoDetails->total_liv_area,
                            $info->propertyInfoDetails->getAttributeLabel('pool_indoor')=>$info->propertyInfoDetails->pool_indoor,
                            $info->propertyInfoDetails->getAttributeLabel('spa_indoor')=>$info->propertyInfoDetails->spa_indoor,
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' =>create_params_info_7($details),
                        'array2' =>create_params_info_7($actual)
                        ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse8" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Appliances </a></h4>
            </div>
            <div id="collapse8" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_8($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoDetails->getAttributeLabel('amenities_stove_id')=>$info->propertyInfoDetails->amenities_stove_id,
                            $info->propertyInfoDetails->getAttributeLabel('amenities_refrigerator')=>$info->propertyInfoDetails->amenities_refrigerator,
                            $info->propertyInfoDetails->getAttributeLabel('refrigerator_description')=>$info->propertyInfoDetails->refrigerator_description,
                            $info->propertyInfoDetails->getAttributeLabel('amenities_dishwasher')=>$info->propertyInfoDetails->amenities_dishwasher,
                            $info->propertyInfoDetails->getAttributeLabel('dishwasher_description')=>$info->propertyInfoDetails->dishwasher_description,
                            $info->propertyInfoDetails->getAttributeLabel('amenities_washer_id')=>$info->propertyInfoDetails->amenities_washer_id,
                            $info->propertyInfoDetails->getAttributeLabel('amenities_microwave')=>$info->propertyInfoDetails->amenities_microwave,
                            $info->propertyInfoDetails->getAttributeLabel('disposal_included')=>$info->propertyInfoDetails->disposal_included,
                            $info->propertyInfoDetails->getAttributeLabel('dryer_included')=>$info->propertyInfoDetails->dryer_included,
                            $info->propertyInfoDetails->getAttributeLabel('washer_dryer_location')=>$info->propertyInfoDetails->washer_dryer_location,
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_8($details),
                        'array2' => create_params_info_8($actual)
                        ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse9" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Utilities </a></h4>
            </div>
            <div id="collapse9" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_9($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoDetails->getAttributeLabel('energy_description')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->energy_description),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('electrical_system')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->electrical_system),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('plumbing_system')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->plumbing_system),
                            $info->propertyInfoDetails->getAttributeLabel('dryer_utilities')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->dryer_utilities),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('new_water_heater_qty')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->new_water_heater_qty),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_9($details),
                        'array2' => create_params_info_9($actual),

                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse10" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Heating and Cooling </a></h4>
            </div>
            <div id="collapse10" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_10($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('ac_system')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->ac_system),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('heating_features')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->heating_features),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_10($details),
                        'array2' => create_params_info_10($actual),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse11" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Exterior Features </a></h4>
            </div>
            <div id="collapse11" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_11($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('exterior_features')=>  $info->propertyInfoAdditionalBrokerageDetails->exterior_features,
                            $info->propertyInfoDetails->getAttributeLabel('exterior_features')=>  $info->propertyInfoDetails->exterior_features,
                            $info->propertyInfoDetails->getAttributeLabel('prop_amenities_description')=>  $info->propertyInfoDetails->prop_amenities_description,
                            $info->propertyInfoDetails->getAttributeLabel('num_terraces')=>  $info->propertyInfoDetails->num_terraces,
                            $info->propertyInfoDetails->getAttributeLabel('terrace_location')=>  $info->propertyInfoDetails->terrace_location,
                            $info->propertyInfoDetails->getAttributeLabel('terrace_total_sqft')=>  $info->propertyInfoDetails->terrace_total_sqft,
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_11($details),
                        'array2' => create_params_info_11($actual),

                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse12" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Exterior Grounds </a></h4>
            </div>
            <div id="collapse12" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_12($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoDetails->getAttributeLabel('lot_description')=>  $info->propertyInfoDetails->lot_description,
                            $info->propertyInfoDetails->getAttributeLabel('lot_sqft')=>  $info->propertyInfoDetails->lot_sqft,

                            $info->propertyInfoDetails->getAttributeLabel('lot_depth')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->lot_depth),
                            $info->propertyInfoDetails->getAttributeLabel('lot_frontage')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->lot_frontage),

                            $info->propertyInfoAdditionalDetails->getAttributeLabel('exterior_grounds')=>  $info->propertyInfoAdditionalDetails->exterior_grounds,
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('exterior_structure')=>  $info->propertyInfoAdditionalDetails->exterior_structure,
                            $info->propertyInfoDetails->getAttributeLabel('fence')=>  $info->propertyInfoDetails->fence,
                            $info->propertyInfoDetails->getAttributeLabel('fence_type')=>  $info->propertyInfoDetails->fence_type,
                            $info->getAttributeLabel('pool')=>  $info->pool,
                            $info->propertyInfoDetails->getAttributeLabel('pool_description')=>  $info->propertyInfoDetails->pool_description,

                            $info->propertyInfoDetails->getAttributeLabel('pool_length')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->pool_length),
                            $info->propertyInfoDetails->getAttributeLabel('pool_width')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->pool_width),
                            $info->propertyInfoDetails->getAttributeLabel('spa')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->spa),
                            $info->propertyInfoDetails->getAttributeLabel('spa_description')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->spa_description),
                            $info->propertyInfoDetails->getAttributeLabel('equestrian_description')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->equestrian_description),
                            $info->propertyInfoDetails->getAttributeLabel('fall_spectacular')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->fall_spectacular),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_12($details),
                        'array2' => create_params_info_12($actual),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse13" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Garage and Parking </a></h4>
            </div>
            <div id="collapse13" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_13($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->getAttributeLabel('garages')=>  $info->garages,
                            $info->propertyInfoDetails->getAttributeLabel('carport_type')=>  $info->propertyInfoDetails->carport_type,
                            $info->propertyInfoDetails->getAttributeLabel('carport')=>  $info->propertyInfoDetails->carport,
                            $info->propertyInfoDetails->getAttributeLabel('amenities_parking_id')=>  $info->propertyInfoDetails->amenities_parking_id,
                            $info->propertyInfoDetails->getAttributeLabel('parking_spaces')=>  $info->propertyInfoDetails->parking_spaces,
                            $info->propertyInfoDetails->getAttributeLabel('parking_description')=>  $info->propertyInfoDetails->parking_description,
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_13($details),
                        'array2' => create_params_info_13($actual),
                    )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse14" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Neighborhood </a></h4>
            </div>
            <div id="collapse14" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_14($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoDetails->getAttributeLabel('house_faces')=>  $info->propertyInfoDetails->house_faces,
                            $info->propertyInfoDetails->getAttributeLabel('house_views')=>  $info->propertyInfoDetails->house_views,
                            $info->propertyInfoDetails->getAttributeLabel('subdivision_name_xp')=>  $info->propertyInfoDetails->subdivision_name_xp,
                            $info->getAttributeLabel('location')=>  $info->location,
                            $info->getAttributeLabel('area')=>  $info->area,
                            $info->getAttributeLabel('subdivision')=>  $info->subdivision,
                            $info->propertyInfoDetails->getAttributeLabel('town')=>  $info->propertyInfoDetails->town,
                            $info->propertyInfoDetails->getAttributeLabel('city')=>  $info->propertyInfoDetails->city,
                            $info->propertyInfoDetails->getAttributeLabel('county')=>  $info->propertyInfoDetails->county,
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_14($details),
                        'array2' => create_params_info_14($actual),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse15" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Schools </a></h4>
            </div>
            <div id="collapse15" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_15($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->getAttributeLabel('schools')=>  $info->schools,
                            $info->propertyInfoDetails->getAttributeLabel('elementary_school')=>  $info->propertyInfoDetails->elementary_school,
                            $info->propertyInfoDetails->getAttributeLabel('jr_high_school')=>  $info->propertyInfoDetails->jr_high_school,
                            $info->propertyInfoDetails->getAttributeLabel('high_school')=>  $info->propertyInfoDetails->high_school,
                        );
                    }

                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_15($details),
                        'array2' => create_params_info_15($actual),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse16" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Community Features </a></h4>
            </div>
            <div id="collapse16" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_16($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->getAttributeLabel('community_name')=>  $info->community_name,
                            $info->getAttributeLabel('community_features')=>  SiteHelper::forMembersOnly($info->community_features),
                            $info->propertyInfoDetails->getAttributeLabel('amenities_gated_community')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->amenities_gated_community),
                            $info->propertyInfoDetails->getAttributeLabel('age_restricted_community')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->age_restricted_community),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_16($details),
                        'array2' => create_params_info_16($actual),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse17" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Homeowners Association </a></h4>
            </div>
            <div id="collapse17" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_17($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoDetails->getAttributeLabel('association_features_available')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->association_features_available),
                            $info->propertyInfoDetails->getAttributeLabel('association_fee_1')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->association_fee_1),
                            $info->propertyInfoDetails->getAttributeLabel('association_fee_1_type')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->association_fee_1_type),
                            $info->propertyInfoDetails->getAttributeLabel('association_name')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->association_name),
                            $info->propertyInfoDetails->getAttributeLabel('association_fee_includes')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->association_fee_includes),
                            $info->propertyInfoDetails->getAttributeLabel('association_fee_2')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->association_fee_2),
                            $info->propertyInfoDetails->getAttributeLabel('association_fee_2_type')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->association_fee_2_type),
                            $info->propertyInfoDetails->getAttributeLabel('master_plan_fee_amount')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->master_plan_fee_amount),
                            $info->propertyInfoDetails->getAttributeLabel('master_plan_fee_type')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->master_plan_fee_type),
                            $info->propertyInfoDetails->getAttributeLabel('security')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->security),
                            $info->propertyInfoDetails->getAttributeLabel('hoa_minimum_rental_cycle')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->hoa_minimum_rental_cycle),
                            $info->propertyInfoDetails->getAttributeLabel('services_available_on_site')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->services_available_on_site),
                            $info->propertyInfoDetails->getAttributeLabel('on_site_staff')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->on_site_staff),
                            $info->propertyInfoDetails->getAttributeLabel('on_site_staff_includes')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->on_site_staff_includes),
                            $info->propertyInfoDetails->getAttributeLabel('association_phone')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->association_phone),
                            $info->propertyInfoDetails->getAttributeLabel('restrictions')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->restrictions),
                            $info->propertyInfoDetails->getAttributeLabel('maintenance')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->maintenance),
                            $info->propertyInfoDetails->getAttributeLabel('management')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->management),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_17($details),
                        'array2' => create_params_info_17($actual),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse18" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Legal Information </a></h4>
            </div>
            <div id="collapse18" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_18($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->getAttributeLabel('ownership')=>  $info->ownership,
                            $info->propertyInfoDetails->getAttributeLabel('subdivision_number')=>  $info->propertyInfoDetails->subdivision_number,
                            $info->propertyInfoDetails->getAttributeLabel('subdivision_num_search')=>  $info->propertyInfoDetails->subdivision_num_search,
                            $info->propertyInfoDetails->getAttributeLabel('assessment')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->assessment),
                            $info->propertyInfoDetails->getAttributeLabel('assessment_amount')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->assessment_amount),
                            $info->propertyInfoDetails->getAttributeLabel('assessment_amount_type')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->assessment_amount_type),
                            $info->propertyInfoDetails->getAttributeLabel('sidlid')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->sidlid),
                            $info->propertyInfoDetails->getAttributeLabel('sidlid_annual_amount')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->sidlid_annual_amount),
                            $info->propertyInfoDetails->getAttributeLabel('sidlid_balance')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->sidlid_balance),
                            $info->propertyInfoDetails->getAttributeLabel('metro_map_coor')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->metro_map_coor),
                            $info->propertyInfoDetails->getAttributeLabel('metro_map_page')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->metro_map_page),
                            $info->propertyInfoDetails->getAttributeLabel('metro_map_coor_xp')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->metro_map_coor_xp),
                            $info->propertyInfoDetails->getAttributeLabel('metro_map_page_xp')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->metro_map_page_xp),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('parcel_num')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->parcel_num),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('legal_location_range')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->legal_location_range),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('legal_lctn_range_search')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->legal_lctn_range_search),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('legal_location_section')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->legal_location_section),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('legal_lctn_section_search')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->legal_lctn_section_search),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('legal_location_township')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->legal_location_township),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('legal_lctntownship_search')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->legal_lctntownship_search),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('tax_district')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->tax_district),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('assessed_imp_value')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->assessed_imp_value),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('assessed_land_value')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->assessed_land_value),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('block_number')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->block_number),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('lot_number')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->lot_number),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_18($details),
                        'array2' => create_params_info_18($actual),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse19" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Sales Information </a></h4>
            </div>
            <div id="collapse19" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php

                    function create_params_info_19($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('status')=>  $info->propertyInfoAdditionalBrokerageDetails->status,
                            $info->getAttributeLabel('property_price')=>  $info->property_price,
                            $info->getAttributeLabel('mls_sysid')=>  SiteHelper::forMembersOnly($info->mls_sysid),
                            $info->propertyInfoDetails->getAttributeLabel('first_sale_type')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->first_sale_type),
                            $info->propertyInfoDetails->getAttributeLabel('second_sale_type')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->second_sale_type),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('list_date')=>  $info->propertyInfoAdditionalBrokerageDetails->list_date,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('list_price')=>  $info->propertyInfoAdditionalBrokerageDetails->list_price,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('original_list_price')=>  $info->propertyInfoAdditionalBrokerageDetails->original_list_price,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pricechgdate')=>  $info->propertyInfoAdditionalBrokerageDetails->pricechgdate,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('previous_price')=>  $info->propertyInfoAdditionalBrokerageDetails->previous_price,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('sale_price')=>  $info->propertyInfoAdditionalBrokerageDetails->sale_price,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('status_updates')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->status_updates),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('t_status_date')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->t_status_date),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('internet')=>  $info->propertyInfoAdditionalBrokerageDetails->internet,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('idx')=>  $info->propertyInfoAdditionalBrokerageDetails->idx,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('images')=>  $info->propertyInfoAdditionalBrokerageDetails->images,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('photo_excluded')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->photo_excluded),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('last_image_trans_date')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->last_image_trans_date),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('lpsqft_wcents')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->lpsqft_wcents),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('lpsqft')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->lpsqft),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('spsqft_wcents')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->spsqft_wcents),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('splp')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->splp),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('directions')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->directions),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('contingency_desc')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->contingency_desc),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('temp_off_mrkt_status_desc')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->temp_off_mrkt_status_desc),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('possession_description')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->possession_description),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('statuschangedate')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->statuschangedate),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('entry_date')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->entry_date),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('acceptance_date')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->acceptance_date),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('dom')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->dom),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('active_dom')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->active_dom),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('est_clolse_dt')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->est_clolse_dt),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('actual_close_date')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->actual_close_date),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('days_from_listing_to_close')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->days_from_listing_to_close),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('package_available')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->package_available),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('financing_considered')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->financing_considered),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('auction_date')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->auction_date),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('auction_type')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->auction_type),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('additional_au_sold_terms')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->additional_au_sold_terms),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('avg_sqft_amt_for_a_1_bd')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->avg_sqft_amt_for_a_1_bd),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('avg_sqft_amt_for_a_2_bd')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->avg_sqft_amt_for_a_2_bd),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('avg_sqft_amt_for_a_3_bd')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->avg_sqft_amt_for_a_3_bd),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('avg_sqft_amt_for_a_stud')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalDetails->avg_sqft_amt_for_a_stud),
                        );
                    }

                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_19($details),
                        'array2' => create_params_info_19($actual),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse20" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Financial Information </a></h4>
            </div>
            <div id="collapse20" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_20($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('foreclosure')=>  $info->propertyInfoAdditionalBrokerageDetails->foreclosure,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('nod_date')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->nod_date),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('reporeo')=>  $info->propertyInfoAdditionalBrokerageDetails->reporeo,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('short_sale')=>  $info->propertyInfoAdditionalBrokerageDetails->short_sale,
                            $info->propertyInfoDetails->getAttributeLabel('court_approval')=>  SiteHelper::forMembersOnly($info->propertyInfoDetails->court_approval),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('litigation')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->litigation),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('litigation_type')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->litigation_type),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('property_insurance')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->property_insurance),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('sold_appraisal')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->sold_appraisal),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('sold_down_payment')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->sold_down_payment),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('earnest_deposit')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->earnest_deposit),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('sellers_contribution')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->sellers_contribution),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('other_encumbrance_desc')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->other_encumbrance_desc),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('other_income_description')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->other_income_description),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('owner_will_carry')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->owner_will_carry),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('amount_owner_will_carry')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->amount_owner_will_carry),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('amt_owner_will_carry')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->amt_owner_will_carry),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('existing_rent')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->existing_rent),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('cap_rate')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->cap_rate),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('cash_to_assume')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->cash_to_assume),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('cost_per_unit')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->cost_per_unit),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('current_loan_assumable')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->current_loan_assumable),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_20($details),
                        'array2' => create_params_info_20($actual),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse21" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Rental Information </a></h4>
            </div>
            <div id="collapse21" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_21($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('expense_source')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->expense_source),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('tenant_pays')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->tenant_pays),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('noi')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->noi),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('pet_description')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->pet_description),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('pets_allowed')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->pets_allowed),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('number_of_pets')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->number_of_pets),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('service_contract_inc')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->service_contract_inc),
                            $info->propertyInfoDetails->getAttributeLabel('storage_secure')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->storage_secure),
                            $info->propertyInfoDetails->getAttributeLabel('storage_unit_desc')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->storage_unit_desc),
                            $info->propertyInfoDetails->getAttributeLabel('storage_unit_dim')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->storage_unit_dim),
                            $info->propertyInfoDetails->getAttributeLabel('storage_units_num')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoDetails->storage_units_num),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('studio_1_12_bath')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->studio_1_12_bath),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('studio_1_bath')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->studio_1_bath),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('studio_2_bath')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->studio_2_bath),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('studio_rent')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->studio_rent),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('vacancy')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->vacancy),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('weight_limit')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->weight_limit),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('yearly_operating_expense')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->yearly_operating_expense),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('yearly_operating_income')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->yearly_operating_income),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('yearly_other_income')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->yearly_other_income),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_1_1_12_bath')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_1_1_12_bath),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_1_1_bath')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_1_1_bath),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_1_2_bath')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_1_2_bath),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_1_num_unfurn')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_1_num_unfurn),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_1_rent')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_1_rent),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2_1_12_bath')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_2_1_12_bath),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2_1_bath')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_2_1_bath),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2_2_bath')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_2_2_bath),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2_num_unfurn')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_2_num_unfurn),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2_rent')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_2_rent),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3_1_12_bath')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_3_1_12_bath),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3_1_bath')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_3_1_bath),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3_2_bath')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_3_2_bath),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3_num_unfurn')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_3_num_unfurn),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3_rent')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalDetails->bedroom_3_rent),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('gross_operating_income')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->gross_operating_income),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('gross_rent_multiplier')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->gross_rent_multiplier),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_21($details),
                        'array2' => create_params_info_21($actual),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse22" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Tax and Sales History </a></h4>
            </div>
            <div id="collapse22" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_22($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('sales_history')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->sales_history),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('tax_history')=>  SiteHelper::forMembersOnly($info->propertyInfoAdditionalBrokerageDetails->tax_history),
                        );
                    }
                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_22($details),
                        'array2' => create_params_info_22($actual),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse23" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Listing Provider </a></h4>
            </div>
            <div id="collapse23" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
                    <?php
                    function create_params_info_23($info){
                        if(is_string($info->propertyInfoDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalDetails)){
                            return new ActualInfoIsNull();
                        }
                        if(is_string($info->propertyInfoAdditionalBrokerageDetails)){
                            return new ActualInfoIsNull();
                        }
                        return array(
                            $info->propertyInfoDetails->getAttributeLabel('reference')=>  $info->propertyInfoDetails->reference,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('mls_id')=>  $info->propertyInfoAdditionalBrokerageDetails->mls_id,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pagent_name')=>  $info->propertyInfoAdditionalBrokerageDetails->pagent_name,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('list_agent_public_id')=>  $info->propertyInfoAdditionalBrokerageDetails->list_agent_public_id,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('email')=>  $info->propertyInfoAdditionalBrokerageDetails->email,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pagent_phone')=>  $info->propertyInfoAdditionalBrokerageDetails->pagent_phone,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pagent_phone_fax')=>  $info->propertyInfoAdditionalBrokerageDetails->pagent_phone_fax,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pagent_phone_home')=>  $info->propertyInfoAdditionalBrokerageDetails->pagent_phone_home,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pagent_phone_mobile')=>  $info->propertyInfoAdditionalBrokerageDetails->pagent_phone_mobile,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pagent_website')=>  $info->propertyInfoAdditionalBrokerageDetails->pagent_website,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('page_link')=>  $info->propertyInfoAdditionalBrokerageDetails->page_link,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('buyer_broker_code')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->buyer_broker_code),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('buyer_agent_public_id')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->buyer_agent_public_id),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('lo_phone')=>  $info->propertyInfoAdditionalBrokerageDetails->lo_phone,
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('list_office_code')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->list_office_code),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('owner_licensee')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->owner_licensee),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('realtor')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->realtor),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('sale_office_bonus')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->sale_office_bonus),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('commission_excluded')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->commission_excluded),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('commission_variable')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->commission_variable),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('additional_showing')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->additional_showing),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('ladom')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->ladom),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('home_protection_plan')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->home_protection_plan),
                            $info->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('open_house_flag')=>  SiteHelper::forFullPaidMembersOnly($info->propertyInfoAdditionalBrokerageDetails->open_house_flag),
                            $info->propertyInfoAdditionalDetails->getAttributeLabel('miscellaneous_description')=>  $info->propertyInfoAdditionalDetails->miscellaneous_description,
                            $info->getAttributeLabel('property_updated_date')=>  SiteHelper::forFullPaidMembersOnly($info->property_updated_date),
                            $info->getAttributeLabel('property_uploaded_date')=>  SiteHelper::forFullPaidMembersOnly($info->property_uploaded_date),
                        );
                    }

                    $this->renderPartial('//property/_property_description_item_comparison', array(
                        'array1' => create_params_info_23($details),
                        'array2' => create_params_info_23($actual),
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</div>
