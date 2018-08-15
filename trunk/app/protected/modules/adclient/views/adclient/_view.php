<?php
/* @var $this AdClientController */
/* @var $data AdClient */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->ad_category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_name')); ?>:</b>
	<?php echo CHtml::encode($data->company_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rep_name')); ?>:</b>
	<?php echo CHtml::encode($data->rep_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_logo')); ?>:</b>
	<?php echo CHtml::encode($data->company_logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_address')); ?>:</b>
	<?php echo CHtml::encode($data->company_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_website')); ?>:</b>
	<?php echo CHtml::encode($data->company_website); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_phone_number')); ?>:</b>
	<?php echo CHtml::encode($data->contact_phone_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alt_contact_phone_number')); ?>:</b>
	<?php echo CHtml::encode($data->alt_contact_phone_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_email')); ?>:</b>
	<?php echo CHtml::encode($data->contact_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alt_contact_email')); ?>:</b>
	<?php echo CHtml::encode($data->alt_contact_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_tag_line')); ?>:</b>
	<?php echo CHtml::encode($data->ad_tag_line); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_description')); ?>:</b>
	<?php echo CHtml::encode($data->ad_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_confirmation_message')); ?>:</b>
	<?php echo CHtml::encode($data->ad_confirmation_message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message_to_advertiser')); ?>:</b>
	<?php echo CHtml::encode($data->message_to_advertiser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	*/ ?>

</div>