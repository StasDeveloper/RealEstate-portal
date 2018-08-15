<?php
/* @var $this CollectionController */
/* @var $data TblProfessionFieldCollection */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('collection_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->collection_id),array('view','id'=>$data->collection_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('authitem_name')); ?>:</b>
	<?php echo CHtml::encode($data->authitem_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('middle_name')); ?>:</b>
	<?php echo CHtml::encode($data->middle_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office')); ?>:</b>
	<?php echo CHtml::encode($data->office); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street_address')); ?>:</b>
	<?php echo CHtml::encode($data->street_address); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('address1')); ?>:</b>
	<?php echo CHtml::encode($data->address1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address2')); ?>:</b>
	<?php echo CHtml::encode($data->address2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('county')); ?>:</b>
	<?php echo CHtml::encode($data->county); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zipcode')); ?>:</b>
	<?php echo CHtml::encode($data->zipcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_office')); ?>:</b>
	<?php echo CHtml::encode($data->phone_office); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_fax')); ?>:</b>
	<?php echo CHtml::encode($data->phone_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_home')); ?>:</b>
	<?php echo CHtml::encode($data->phone_home); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_mobile')); ?>:</b>
	<?php echo CHtml::encode($data->phone_mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website_url')); ?>:</b>
	<?php echo CHtml::encode($data->website_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tagline')); ?>:</b>
	<?php echo CHtml::encode($data->tagline); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('years_of_experience')); ?>:</b>
	<?php echo CHtml::encode($data->years_of_experience); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('years_of_experience_text')); ?>:</b>
	<?php echo CHtml::encode($data->years_of_experience_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_expertise')); ?>:</b>
	<?php echo CHtml::encode($data->area_expertise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_expertise_text')); ?>:</b>
	<?php echo CHtml::encode($data->area_expertise_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('about_me')); ?>:</b>
	<?php echo CHtml::encode($data->about_me); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upload_photo')); ?>:</b>
	<?php echo CHtml::encode($data->upload_photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_logo')); ?>:</b>
	<?php echo CHtml::encode($data->office_logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upload_logo')); ?>:</b>
	<?php echo CHtml::encode($data->upload_logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('listing_type')); ?>:</b>
	<?php echo CHtml::encode($data->listing_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_type')); ?>:</b>
	<?php echo CHtml::encode($data->payment_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('join_date')); ?>:</b>
	<?php echo CHtml::encode($data->join_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('join_only_date')); ?>:</b>
	<?php echo CHtml::encode($data->join_only_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('membership_expire_date')); ?>:</b>
	<?php echo CHtml::encode($data->membership_expire_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('membership_subscription_date')); ?>:</b>
	<?php echo CHtml::encode($data->membership_subscription_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('audit_expire_date')); ?>:</b>
	<?php echo CHtml::encode($data->audit_expire_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profile_completion_percentage')); ?>:</b>
	<?php echo CHtml::encode($data->profile_completion_percentage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating_average')); ?>:</b>
	<?php echo CHtml::encode($data->rating_average); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_last_login')); ?>:</b>
	<?php echo CHtml::encode($data->agent_last_login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_comments')); ?>:</b>
	<?php echo CHtml::encode($data->agent_comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profile_notification')); ?>:</b>
	<?php echo CHtml::encode($data->profile_notification); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website_notification')); ?>:</b>
	<?php echo CHtml::encode($data->website_notification); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('listings_notification')); ?>:</b>
	<?php echo CHtml::encode($data->listings_notification); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subscription')); ?>:</b>
	<?php echo CHtml::encode($data->subscription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->timestamp); ?>
	<br />

	*/ ?>

</div>