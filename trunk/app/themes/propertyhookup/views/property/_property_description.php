<div class="col-xs-12 padding-top-10 padding-bottom-10">
    <div class="panel-group smart-accordion-default" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> General Information </a></h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->getAttributeLabel('property_street')=>$details->property_street,
    $details->getAttributeLabel('street_number')=>$details->street_number,
    $details->getAttributeLabel('street_name')=>$details->street_name,
    $details->getAttributeLabel('building_number')=>$details->building_number,
    $details->propertyInfoDetails->getAttributeLabel('apt_suite')=>$details->propertyInfoDetails->apt_suite,
    $details->getAttributeLabel('property_title')=>$details->property_title,
    $details->getAttributeLabel('description')=>$details->description,
    $details->getAttributeLabel('property_fetatures')=>$details->property_fetatures,
    $details->getAttributeLabel('house_square_footage')=>$details->house_square_footage,
    $details->getAttributeLabel('property_type')=>$details->propertyType,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('over_all_property')=>$details->propertyInfoAdditionalDetails->over_all_property,
    $details->getAttributeLabel('property_id')=>$details->property_id,
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Building and Construction </a></h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->getAttributeLabel('property_type_mls')=>$details->property_type_mls,
    $details->propertyInfoDetails->getAttributeLabel('built_desc')=>$details->propertyInfoDetails->built_desc,
    $details->getAttributeLabel('sub_type')=>$details->sub_type,
    $details->getAttributeLabel('building_description')=>$details->building_description,
    $details->propertyInfoDetails->getAttributeLabel('stories')=>$details->propertyInfoDetails->stories,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('unit_description')=>$details->propertyInfoAdditionalDetails->unit_description,
    $details->propertyInfoDetails->getAttributeLabel('model')=>$details->propertyInfoDetails->model,
    $details->propertyInfoDetails->getAttributeLabel('unit_desc')=>$details->propertyInfoDetails->unit_desc,
    $details->propertyInfoDetails->getAttributeLabel('compass_point')=>$details->propertyInfoDetails->compass_point,
    $details->getAttributeLabel('lot_acreage')=>$details->lot_acreage,
    $details->getAttributeLabel('year_biult_id')=>$details->year_biult_id,
    $details->getAttributeLabel('elevator_floor')=>$details->elevator_floor,
    $details->propertyInfoDetails->getAttributeLabel('prop_desc')=>$details->propertyInfoDetails->prop_desc,
    
    $details->propertyInfoDetails->getAttributeLabel('studio')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->studio),
    $details->propertyInfoDetails->getAttributeLabel('condo_conversion')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->condo_conversion),
    $details->propertyInfoDetails->getAttributeLabel('converted_garage')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->converted_garage),
    $details->getAttributeLabel('manufactured')=>  SiteHelper::forMembersOnly($details->manufactured),
    $details->getAttributeLabel('converted_to_real_property')=>  SiteHelper::forMembersOnly($details->converted_to_real_property),
    $details->propertyInfoDetails->getAttributeLabel('mh_year_built')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->mh_year_built),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('exterior_construction_features')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->exterior_construction_features),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('roof')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->roof),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('roofing_features')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->roofing_features),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Bedrooms </a></h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->getAttributeLabel('bedrooms')=>$details->bedrooms,
    $details->propertyInfoDetails->getAttributeLabel('beds_total_poss')=>$details->propertyInfoDetails->beds_total_poss,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_downstairs')=>$details->propertyInfoAdditionalDetails->bedroom_downstairs,
    
    $details->propertyInfoAdditionalDetails->getAttributeLabel('master_bedroom_description')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->master_bedroom_description),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('master_bedroom_dimensions')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->master_bedroom_dimensions),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2nd_description')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->bedroom_2nd_description),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2nd_dimensions')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->bedroom_2nd_dimensions),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3rd_description')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->bedroom_3rd_description),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3rd_dimensions')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->bedroom_3rd_dimensions),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_4th_description')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->bedroom_4th_description),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_4th_dimensions')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->bedroom_4th_dimensions),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_5th_description')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->bedroom_5th_description),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_5th_dimensions')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->bedroom_5th_dimensions),
    
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Bathrooms </a></h4>
            </div>
            <div id="collapse4" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->getAttributeLabel('bathrooms')=>$details->bathrooms,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('full_baths')=>$details->propertyInfoAdditionalDetails->full_baths,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('baths_34')=>$details->propertyInfoAdditionalDetails->baths_34,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('half_bath')=>$details->propertyInfoAdditionalDetails->half_bath,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('master_bath_description')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->master_bath_description),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bath_downstairs')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->bath_downstairs),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bath_downstairs_description')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->bath_downstairs_description),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Kitchen and Dining </a></h4>
            </div>
            <div id="collapse5" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoAdditionalDetails->getAttributeLabel('kitchen')=>$details->propertyInfoAdditionalDetails->kitchen,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('kitchen_countertops')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->kitchen_countertops),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('kitchen_flooring')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->kitchen_flooring),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('dining_room_dimensions')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->dining_room_dimensions),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('dining_room_description')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->dining_room_description),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse6" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Other Rooms </a></h4>
            </div>
            <div id="collapse6" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoAdditionalDetails->getAttributeLabel('great_room')=>$details->propertyInfoAdditionalDetails->great_room,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('great_room_dimensions')=>$details->propertyInfoAdditionalDetails->great_room_dimensions,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('living_room_dimensions')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->living_room_dimensions),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('living_room_description')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->living_room_description),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('family_room_dimensions')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->family_room_dimensions),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('family_room_description')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->family_room_description),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('numdenother')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->numdenother),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('denother_dimensions')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->denother_dimensions),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('num_of_loft_areas')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->num_of_loft_areas),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('numloft')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->numloft),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('loft_dimensions')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->loft_dimensions),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('loft_description')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->loft_description),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('loft_dimensions_1st_floor')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->loft_dimensions_1st_floor),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('loft_dimensions_2nd_floor')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->loft_dimensions_2nd_floor),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse7" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Interior Features </a></h4>
            </div>
            <div id="collapse7" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoAdditionalDetails->getAttributeLabel('interior_description')=>$details->propertyInfoAdditionalDetails->interior_description,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('interior_features')=>  $details->propertyInfoAdditionalBrokerageDetails->interior_features,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('interior_structure')=>$details->propertyInfoAdditionalDetails->interior_structure,
    $details->propertyInfoDetails->getAttributeLabel('interior_features')=>$details->propertyInfoDetails->interior_features,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('flooring_description')=>$details->propertyInfoAdditionalDetails->flooring_description,
    $details->propertyInfoDetails->getAttributeLabel('amenities_fireplace_id')=>$details->propertyInfoDetails->amenities_fireplace_id,
    $details->propertyInfoDetails->getAttributeLabel('fireplace_location')=>$details->propertyInfoDetails->fireplace_location,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('fireplace_features')=>  $details->propertyInfoAdditionalBrokerageDetails->fireplace_features,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('furnishings_description')=>$details->propertyInfoAdditionalDetails->furnishings_description,
    $details->propertyInfoDetails->getAttributeLabel('add_liv_area')=>$details->propertyInfoDetails->add_liv_area,
    $details->propertyInfoDetails->getAttributeLabel('total_liv_area')=>$details->propertyInfoDetails->total_liv_area,
    $details->propertyInfoDetails->getAttributeLabel('pool_indoor')=>$details->propertyInfoDetails->pool_indoor,
    $details->propertyInfoDetails->getAttributeLabel('spa_indoor')=>$details->propertyInfoDetails->spa_indoor,
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse8" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Appliances </a></h4>
            </div>
            <div id="collapse8" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoDetails->getAttributeLabel('amenities_stove_id')=>$details->propertyInfoDetails->amenities_stove_id,
    $details->propertyInfoDetails->getAttributeLabel('amenities_refrigerator')=>$details->propertyInfoDetails->amenities_refrigerator,
    $details->propertyInfoDetails->getAttributeLabel('refrigerator_description')=>$details->propertyInfoDetails->refrigerator_description,
    $details->propertyInfoDetails->getAttributeLabel('amenities_dishwasher')=>$details->propertyInfoDetails->amenities_dishwasher,
    $details->propertyInfoDetails->getAttributeLabel('dishwasher_description')=>$details->propertyInfoDetails->dishwasher_description,
    $details->propertyInfoDetails->getAttributeLabel('amenities_washer_id')=>$details->propertyInfoDetails->amenities_washer_id,
    $details->propertyInfoDetails->getAttributeLabel('amenities_microwave')=>$details->propertyInfoDetails->amenities_microwave,
    $details->propertyInfoDetails->getAttributeLabel('disposal_included')=>$details->propertyInfoDetails->disposal_included,
    $details->propertyInfoDetails->getAttributeLabel('dryer_included')=>$details->propertyInfoDetails->dryer_included,
    $details->propertyInfoDetails->getAttributeLabel('washer_dryer_location')=>$details->propertyInfoDetails->washer_dryer_location,
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse9" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Utilities </a></h4>
            </div>
            <div id="collapse9" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoDetails->getAttributeLabel('energy_description')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->energy_description),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('electrical_system')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->electrical_system),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('plumbing_system')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->plumbing_system),
    $details->propertyInfoDetails->getAttributeLabel('dryer_utilities')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->dryer_utilities),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('new_water_heater_qty')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->new_water_heater_qty),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse10" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Heating and Cooling </a></h4>
            </div>
            <div id="collapse10" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoAdditionalDetails->getAttributeLabel('ac_system')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->ac_system),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('heating_features')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->heating_features),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse11" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Exterior Features </a></h4>
            </div>
            <div id="collapse11" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('exterior_features')=>  $details->propertyInfoAdditionalBrokerageDetails->exterior_features,
    $details->propertyInfoDetails->getAttributeLabel('exterior_features')=>  $details->propertyInfoDetails->exterior_features,
    $details->propertyInfoDetails->getAttributeLabel('prop_amenities_description')=>  $details->propertyInfoDetails->prop_amenities_description,
    $details->propertyInfoDetails->getAttributeLabel('num_terraces')=>  $details->propertyInfoDetails->num_terraces,
    $details->propertyInfoDetails->getAttributeLabel('terrace_location')=>  $details->propertyInfoDetails->terrace_location,
    $details->propertyInfoDetails->getAttributeLabel('terrace_total_sqft')=>  $details->propertyInfoDetails->terrace_total_sqft,
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse12" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Exterior Grounds </a></h4>
            </div>
            <div id="collapse12" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoDetails->getAttributeLabel('lot_description')=>  $details->propertyInfoDetails->lot_description,
    $details->propertyInfoDetails->getAttributeLabel('lot_sqft')=>  $details->propertyInfoDetails->lot_sqft,

    $details->propertyInfoDetails->getAttributeLabel('lot_depth')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->lot_depth),
    $details->propertyInfoDetails->getAttributeLabel('lot_frontage')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->lot_frontage),

    $details->propertyInfoAdditionalDetails->getAttributeLabel('exterior_grounds')=>  $details->propertyInfoAdditionalDetails->exterior_grounds,
    $details->propertyInfoAdditionalDetails->getAttributeLabel('exterior_structure')=>  $details->propertyInfoAdditionalDetails->exterior_structure,
    $details->propertyInfoDetails->getAttributeLabel('fence')=>  $details->propertyInfoDetails->fence,
    $details->propertyInfoDetails->getAttributeLabel('fence_type')=>  $details->propertyInfoDetails->fence_type,
    $details->getAttributeLabel('pool')=>  $details->pool,
    $details->propertyInfoDetails->getAttributeLabel('pool_description')=>  $details->propertyInfoDetails->pool_description,

    $details->propertyInfoDetails->getAttributeLabel('pool_length')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->pool_length),
    $details->propertyInfoDetails->getAttributeLabel('pool_width')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->pool_width),
    $details->propertyInfoDetails->getAttributeLabel('spa')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->spa),
    $details->propertyInfoDetails->getAttributeLabel('spa_description')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->spa_description),
    $details->propertyInfoDetails->getAttributeLabel('equestrian_description')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->equestrian_description),
    $details->propertyInfoDetails->getAttributeLabel('fall_spectacular')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->fall_spectacular),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse13" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Garage and Parking </a></h4>
            </div>
            <div id="collapse13" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->getAttributeLabel('garages')=>  $details->garages,
    $details->propertyInfoDetails->getAttributeLabel('carport_type')=>  $details->propertyInfoDetails->carport_type,
    $details->propertyInfoDetails->getAttributeLabel('carport')=>  $details->propertyInfoDetails->carport,
    $details->propertyInfoDetails->getAttributeLabel('amenities_parking_id')=>  $details->propertyInfoDetails->amenities_parking_id,
    $details->propertyInfoDetails->getAttributeLabel('parking_spaces')=>  $details->propertyInfoDetails->parking_spaces,
    $details->propertyInfoDetails->getAttributeLabel('parking_description')=>  $details->propertyInfoDetails->parking_description,
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse14" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Neighborhood </a></h4>
            </div>
            <div id="collapse14" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoDetails->getAttributeLabel('house_faces')=>  $details->propertyInfoDetails->house_faces,
    $details->propertyInfoDetails->getAttributeLabel('house_views')=>  $details->propertyInfoDetails->house_views,
    $details->propertyInfoDetails->getAttributeLabel('subdivision_name_xp')=>  $details->propertyInfoDetails->subdivision_name_xp,
    $details->getAttributeLabel('location')=>  $details->location,
    $details->getAttributeLabel('area')=>  $details->area,
    $details->getAttributeLabel('subdivision')=>  $details->subdivision,
    $details->propertyInfoDetails->getAttributeLabel('town')=>  $details->propertyInfoDetails->town,
    $details->propertyInfoDetails->getAttributeLabel('city')=>  $details->propertyInfoDetails->city,
    $details->propertyInfoDetails->getAttributeLabel('county')=>  $details->propertyInfoDetails->county,
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse15" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Schools </a></h4>
            </div>
            <div id="collapse15" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->getAttributeLabel('schools')=>  $details->schools,
    $details->propertyInfoDetails->getAttributeLabel('elementary_school')=>  $details->propertyInfoDetails->elementary_school,
    $details->propertyInfoDetails->getAttributeLabel('jr_high_school')=>  $details->propertyInfoDetails->jr_high_school,
    $details->propertyInfoDetails->getAttributeLabel('high_school')=>  $details->propertyInfoDetails->high_school,
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse16" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Community Features </a></h4>
            </div>
            <div id="collapse16" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->getAttributeLabel('community_name')=>  $details->community_name,
    $details->getAttributeLabel('community_features')=>  SiteHelper::forMembersOnly($details->community_features),
    $details->propertyInfoDetails->getAttributeLabel('amenities_gated_community')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->amenities_gated_community),
    $details->propertyInfoDetails->getAttributeLabel('age_restricted_community')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->age_restricted_community),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse17" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Homeowners Association </a></h4>
            </div>
            <div id="collapse17" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoDetails->getAttributeLabel('association_features_available')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->association_features_available),
    $details->propertyInfoDetails->getAttributeLabel('association_fee_1')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->association_fee_1),
    $details->propertyInfoDetails->getAttributeLabel('association_fee_1_type')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->association_fee_1_type),
    $details->propertyInfoDetails->getAttributeLabel('association_name')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->association_name),

    $details->propertyInfoDetails->getAttributeLabel('association_fee_includes')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->association_fee_includes),
    $details->propertyInfoDetails->getAttributeLabel('association_fee_2')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->association_fee_2),
    $details->propertyInfoDetails->getAttributeLabel('association_fee_2_type')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->association_fee_2_type),
    $details->propertyInfoDetails->getAttributeLabel('master_plan_fee_amount')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->master_plan_fee_amount),
    $details->propertyInfoDetails->getAttributeLabel('master_plan_fee_type')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->master_plan_fee_type),
    $details->propertyInfoDetails->getAttributeLabel('security')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->security),
    $details->propertyInfoDetails->getAttributeLabel('hoa_minimum_rental_cycle')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->hoa_minimum_rental_cycle),
    $details->propertyInfoDetails->getAttributeLabel('services_available_on_site')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->services_available_on_site),
    $details->propertyInfoDetails->getAttributeLabel('on_site_staff')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->on_site_staff),
    $details->propertyInfoDetails->getAttributeLabel('on_site_staff_includes')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->on_site_staff_includes),
    $details->propertyInfoDetails->getAttributeLabel('association_phone')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->association_phone),
    $details->propertyInfoDetails->getAttributeLabel('restrictions')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->restrictions),
    $details->propertyInfoDetails->getAttributeLabel('maintenance')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->maintenance),
    $details->propertyInfoDetails->getAttributeLabel('management')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->management),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse18" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Legal Information </a></h4>
            </div>
            <div id="collapse18" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->getAttributeLabel('ownership')=>  $details->ownership,
    $details->propertyInfoDetails->getAttributeLabel('subdivision_number')=>  $details->propertyInfoDetails->subdivision_number,
    $details->propertyInfoDetails->getAttributeLabel('subdivision_num_search')=>  $details->propertyInfoDetails->subdivision_num_search,
    $details->propertyInfoDetails->getAttributeLabel('assessment')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->assessment),
    $details->propertyInfoDetails->getAttributeLabel('assessment_amount')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->assessment_amount),
    $details->propertyInfoDetails->getAttributeLabel('assessment_amount_type')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->assessment_amount_type),
    $details->propertyInfoDetails->getAttributeLabel('sidlid')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->sidlid),
    $details->propertyInfoDetails->getAttributeLabel('sidlid_annual_amount')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->sidlid_annual_amount),
    $details->propertyInfoDetails->getAttributeLabel('sidlid_balance')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->sidlid_balance),
    $details->propertyInfoDetails->getAttributeLabel('metro_map_coor')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->metro_map_coor),
    $details->propertyInfoDetails->getAttributeLabel('metro_map_page')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->metro_map_page),
    $details->propertyInfoDetails->getAttributeLabel('metro_map_coor_xp')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->metro_map_coor_xp),
    $details->propertyInfoDetails->getAttributeLabel('metro_map_page_xp')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->metro_map_page_xp),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('parcel_num')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->parcel_num),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('legal_location_range')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->legal_location_range),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('legal_lctn_range_search')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->legal_lctn_range_search),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('legal_location_section')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->legal_location_section),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('legal_lctn_section_search')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->legal_lctn_section_search),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('legal_location_township')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->legal_location_township),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('legal_lctntownship_search')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->legal_lctntownship_search),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('tax_district')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->tax_district),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('assessed_imp_value')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->assessed_imp_value),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('assessed_land_value')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->assessed_land_value),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('block_number')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->block_number),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('lot_number')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->lot_number),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse19" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Sales Information </a></h4>
            </div>
            <div id="collapse19" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('status')=>  $details->propertyInfoAdditionalBrokerageDetails->status,
    $details->getAttributeLabel('property_price')=>  $details->property_price,
    $details->getAttributeLabel('mls_sysid')=>  SiteHelper::forMembersOnly($details->mls_sysid),
    $details->propertyInfoDetails->getAttributeLabel('first_sale_type')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->first_sale_type),
    $details->propertyInfoDetails->getAttributeLabel('second_sale_type')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->second_sale_type),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('list_date')=>  $details->propertyInfoAdditionalBrokerageDetails->list_date,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('list_price')=>  $details->propertyInfoAdditionalBrokerageDetails->list_price,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('original_list_price')=>  $details->propertyInfoAdditionalBrokerageDetails->original_list_price,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pricechgdate')=>  $details->propertyInfoAdditionalBrokerageDetails->pricechgdate,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('previous_price')=>  $details->propertyInfoAdditionalBrokerageDetails->previous_price,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('sale_price')=>  $details->propertyInfoAdditionalBrokerageDetails->sale_price,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('status_updates')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->status_updates),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('t_status_date')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->t_status_date),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('internet')=>  $details->propertyInfoAdditionalBrokerageDetails->internet,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('idx')=>  $details->propertyInfoAdditionalBrokerageDetails->idx,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('images')=>  $details->propertyInfoAdditionalBrokerageDetails->images,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('photo_excluded')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->photo_excluded),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('last_image_trans_date')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->last_image_trans_date),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('lpsqft_wcents')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->lpsqft_wcents),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('lpsqft')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->lpsqft),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('spsqft_wcents')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->spsqft_wcents),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('splp')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->splp),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('directions')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->directions),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('contingency_desc')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->contingency_desc),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('temp_off_mrkt_status_desc')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->temp_off_mrkt_status_desc),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('possession_description')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->possession_description),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('statuschangedate')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->statuschangedate),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('entry_date')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->entry_date),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('acceptance_date')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->acceptance_date),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('dom')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->dom),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('active_dom')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->active_dom),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('est_clolse_dt')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->est_clolse_dt),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('actual_close_date')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->actual_close_date),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('days_from_listing_to_close')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->days_from_listing_to_close),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('package_available')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->package_available),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('financing_considered')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->financing_considered),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('auction_date')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->auction_date),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('auction_type')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->auction_type),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('additional_au_sold_terms')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->additional_au_sold_terms),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('avg_sqft_amt_for_a_1_bd')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->avg_sqft_amt_for_a_1_bd),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('avg_sqft_amt_for_a_2_bd')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->avg_sqft_amt_for_a_2_bd),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('avg_sqft_amt_for_a_3_bd')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->avg_sqft_amt_for_a_3_bd),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('avg_sqft_amt_for_a_stud')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalDetails->avg_sqft_amt_for_a_stud),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse20" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Financial Information </a></h4>
            </div>
            <div id="collapse20" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('foreclosure')=>  $details->propertyInfoAdditionalBrokerageDetails->foreclosure,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('nod_date')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->nod_date),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('reporeo')=>  $details->propertyInfoAdditionalBrokerageDetails->reporeo,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('short_sale')=>  $details->propertyInfoAdditionalBrokerageDetails->short_sale,
    $details->propertyInfoDetails->getAttributeLabel('court_approval')=>  SiteHelper::forMembersOnly($details->propertyInfoDetails->court_approval),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('litigation')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->litigation),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('litigation_type')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->litigation_type),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('property_insurance')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->property_insurance),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('sold_appraisal')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->sold_appraisal),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('sold_down_payment')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->sold_down_payment),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('earnest_deposit')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->earnest_deposit),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('sellers_contribution')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->sellers_contribution),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('other_encumbrance_desc')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->other_encumbrance_desc),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('other_income_description')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->other_income_description),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('owner_will_carry')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->owner_will_carry),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('amount_owner_will_carry')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->amount_owner_will_carry),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('amt_owner_will_carry')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->amt_owner_will_carry),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('existing_rent')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->existing_rent),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('cap_rate')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->cap_rate),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('cash_to_assume')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->cash_to_assume),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('cost_per_unit')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->cost_per_unit),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('current_loan_assumable')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->current_loan_assumable),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse21" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Rental Information </a></h4>
            </div>
            <div id="collapse21" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('expense_source')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->expense_source),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('tenant_pays')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->tenant_pays),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('noi')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->noi),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('pet_description')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->pet_description),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('pets_allowed')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->pets_allowed),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('number_of_pets')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->number_of_pets),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('service_contract_inc')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->service_contract_inc),
    $details->propertyInfoDetails->getAttributeLabel('storage_secure')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->storage_secure),
    $details->propertyInfoDetails->getAttributeLabel('storage_unit_desc')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->storage_unit_desc),
    $details->propertyInfoDetails->getAttributeLabel('storage_unit_dim')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->storage_unit_dim),
    $details->propertyInfoDetails->getAttributeLabel('storage_units_num')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoDetails->storage_units_num),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('studio_1_12_bath')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->studio_1_12_bath),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('studio_1_bath')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->studio_1_bath),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('studio_2_bath')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->studio_2_bath),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('studio_rent')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->studio_rent),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('vacancy')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->vacancy),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('weight_limit')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->weight_limit),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('yearly_operating_expense')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->yearly_operating_expense),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('yearly_operating_income')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->yearly_operating_income),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('yearly_other_income')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->yearly_other_income),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_1_1_12_bath')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_1_1_12_bath),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_1_1_bath')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_1_1_bath),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_1_2_bath')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_1_2_bath),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_1_num_unfurn')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_1_num_unfurn),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_1_rent')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_1_rent),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2_1_12_bath')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_2_1_12_bath),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2_1_bath')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_2_1_bath),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2_2_bath')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_2_2_bath),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2_num_unfurn')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_2_num_unfurn),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_2_rent')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_2_rent),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3_1_12_bath')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_3_1_12_bath),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3_1_bath')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_3_1_bath),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3_2_bath')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_3_2_bath),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3_num_unfurn')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_3_num_unfurn),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('bedroom_3_rent')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalDetails->bedroom_3_rent),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('gross_operating_income')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->gross_operating_income),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('gross_rent_multiplier')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->gross_rent_multiplier),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse22" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Tax and Sales History </a></h4>
            </div>
            <div id="collapse22" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('sales_history')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->sales_history),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('tax_history')=>  SiteHelper::forMembersOnly($details->propertyInfoAdditionalBrokerageDetails->tax_history),
    ) )); ?>
                </div>
            </div>
        </div>
        <?php
        function checkHttp($string){
            if(strpos($string, 'http') === 0){
                return $string;
            }else{
                return 'http://'.$string;
            }
        }
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse23" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Listing Provider </a></h4>
            </div>
            <div id="collapse23" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->propertyInfoDetails->getAttributeLabel('reference')=>  $details->propertyInfoDetails->reference,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('mls_id')=>  $details->propertyInfoAdditionalBrokerageDetails->mls_id,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pagent_name')=>  $details->propertyInfoAdditionalBrokerageDetails->pagent_name,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('list_agent_public_id')=>  $details->propertyInfoAdditionalBrokerageDetails->list_agent_public_id,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('email')=>  $details->propertyInfoAdditionalBrokerageDetails->email,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pagent_phone')=>  $details->propertyInfoAdditionalBrokerageDetails->pagent_phone,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pagent_phone_fax')=>  $details->propertyInfoAdditionalBrokerageDetails->pagent_phone_fax,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pagent_phone_home')=>  $details->propertyInfoAdditionalBrokerageDetails->pagent_phone_home,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pagent_phone_mobile')=>  $details->propertyInfoAdditionalBrokerageDetails->pagent_phone_mobile,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('pagent_website')=>  $details->propertyInfoAdditionalBrokerageDetails->pagent_website,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('page_link')=>  checkHttp($details->propertyInfoAdditionalBrokerageDetails->page_link),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('buyer_broker_code')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->buyer_broker_code),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('buyer_agent_public_id')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->buyer_agent_public_id),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('lo_phone')=>  $details->propertyInfoAdditionalBrokerageDetails->lo_phone,
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('list_office_code')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->list_office_code),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('owner_licensee')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->owner_licensee),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('realtor')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->realtor),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('sale_office_bonus')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->sale_office_bonus),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('commission_excluded')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->commission_excluded),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('commission_variable')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->commission_variable),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('additional_showing')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->additional_showing),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('ladom')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->ladom),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('home_protection_plan')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->home_protection_plan),
    $details->propertyInfoAdditionalBrokerageDetails->getAttributeLabel('open_house_flag')=>  SiteHelper::forFullPaidMembersOnly($details->propertyInfoAdditionalBrokerageDetails->open_house_flag),
    $details->propertyInfoAdditionalDetails->getAttributeLabel('miscellaneous_description')=>  $details->propertyInfoAdditionalDetails->miscellaneous_description,
    $details->getAttributeLabel('property_updated_date')=>  SiteHelper::forFullPaidMembersOnly($details->property_updated_date),
    $details->getAttributeLabel('property_uploaded_date')=>  SiteHelper::forFullPaidMembersOnly($details->property_uploaded_date),
    ) )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse24" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> Valuation Information </a></h4>
            </div>
            <div id="collapse24" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    $details->getAttributeLabel('estimated_price')=>  $details->estimated_price,
    $details->getAttributeLabel('percentage_depreciation_value')=>  $details->percentage_depreciation_value,
    $details->getAttributeLabel('comp_stage')=>  SiteHelper::forMembersOnly($details->comp_stage),
    $details->getAttributeLabel('comps')=>  $details->comps,
    $details->getAttributeLabel('low_range')=>  $details->low_range,
    $details->getAttributeLabel('high_range')=>  $details->high_range,
    $details->getAttributeLabel('fundamentals_factor')=>  SiteHelper::forMembersOnly($details->fundamentals_factor),
    $details->getAttributeLabel('conditional_factor')=>  SiteHelper::forMembersOnly($details->conditional_factor),
    ) )); ?>
                </div>
            </div>
        </div>

<?php

/*/ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseX" class="collapsed font-md"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> ZZZZZZZZZZ </a></h4>
            </div>
            <div id="collapseX" class="panel-collapse collapse">
                <div class="panel-body no-padding table-responsive">
<?php $this->renderPartial('//property/_property_description_item', array('array' =>array(
    ) )); ?>
                </div>
            </div>
        </div>
<?php /*/ ?>
    </div>
</div>
