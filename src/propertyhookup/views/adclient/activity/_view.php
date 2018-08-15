<?php
/* @var $this AdclientactivityController */
/* @var $data AdClientActivity */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_id')); ?>:</b>
	<?php echo CHtml::encode($data->client_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_first_name')); ?>:</b>
	<?php echo CHtml::encode($data->user_first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_last_name')); ?>:</b>
	<?php echo CHtml::encode($data->user_last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_phone_number')); ?>:</b>
	<?php echo CHtml::encode($data->user_phone_number); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_email')); ?>:</b>
	<?php echo CHtml::encode($data->user_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_address')); ?>:</b>
	<?php echo CHtml::encode($data->user_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_comment')); ?>:</b>
	<?php echo CHtml::encode($data->user_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_lon')); ?>:</b>
	<?php echo CHtml::encode($data->user_lon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_lat')); ?>:</b>
	<?php echo CHtml::encode($data->user_lat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	*/ ?>

</div>