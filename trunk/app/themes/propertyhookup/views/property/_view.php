<?php
/* @var $this PropertyController */
/* @var $data PropertyInfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->property_id),array('view','id'=>$data->property_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year_biult_id')); ?>:</b>
	<?php echo CHtml::encode($data->year_biult_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pool')); ?>:</b>
	<?php echo CHtml::encode($data->pool); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('garages')); ?>:</b>
	<?php echo CHtml::encode($data->garages); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mid')); ?>:</b>
	<?php echo CHtml::encode($data->mid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_title')); ?>:</b>
	<?php echo CHtml::encode($data->property_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('house_square_footage')); ?>:</b>
	<?php echo CHtml::encode($data->house_square_footage); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('lot_acreage')); ?>:</b>
	<?php echo CHtml::encode($data->lot_acreage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_type')); ?>:</b>
	<?php echo CHtml::encode($data->property_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_price')); ?>:</b>
	<?php echo CHtml::encode($data->property_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bathrooms')); ?>:</b>
	<?php echo CHtml::encode($data->bathrooms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bedrooms')); ?>:</b>
	<?php echo CHtml::encode($data->bedrooms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_street')); ?>:</b>
	<?php echo CHtml::encode($data->property_street); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_state_id')); ?>:</b>
	<?php echo CHtml::encode($data->property_state_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_county_id')); ?>:</b>
	<?php echo CHtml::encode($data->property_county_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_city_id')); ?>:</b>
	<?php echo CHtml::encode($data->property_city_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_zipcode')); ?>:</b>
	<?php echo CHtml::encode($data->property_zipcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_uploaded_date')); ?>:</b>
	<?php echo CHtml::encode($data->property_uploaded_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_updated_date')); ?>:</b>
	<?php echo CHtml::encode($data->property_updated_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_expire_date')); ?>:</b>
	<?php echo CHtml::encode($data->property_expire_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo1')); ?>:</b>
	<?php echo CHtml::encode($data->photo1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caption1')); ?>:</b>
	<?php echo CHtml::encode($data->caption1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('getlongitude')); ?>:</b>
	<?php echo CHtml::encode($data->getlongitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('getlatitude')); ?>:</b>
	<?php echo CHtml::encode($data->getlatitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estimated_price')); ?>:</b>
	<?php echo CHtml::encode($data->estimated_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('percentage_depreciation_value')); ?>:</b>
	<?php echo CHtml::encode($data->percentage_depreciation_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_status')); ?>:</b>
	<?php echo CHtml::encode($data->property_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_session_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_session_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visible')); ?>:</b>
	<?php echo CHtml::encode($data->visible); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sub_type')); ?>:</b>
	<?php echo CHtml::encode($data->sub_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area')); ?>:</b>
	<?php echo CHtml::encode($data->area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subdivision')); ?>:</b>
	<?php echo CHtml::encode($data->subdivision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('schools')); ?>:</b>
	<?php echo CHtml::encode($data->schools); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('community_name')); ?>:</b>
	<?php echo CHtml::encode($data->community_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('community_features')); ?>:</b>
	<?php echo CHtml::encode($data->community_features); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_fetatures')); ?>:</b>
	<?php echo CHtml::encode($data->property_fetatures); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mls_sysid')); ?>:</b>
	<?php echo CHtml::encode($data->mls_sysid); ?>
	<br />

	*/ ?>

</div>