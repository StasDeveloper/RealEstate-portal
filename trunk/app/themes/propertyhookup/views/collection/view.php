<?php
/* @var $this CollectionController */
/* @var $model TblProfessionFieldCollection */
?>

<?php
$this->breadcrumbs=array(
	'Tbl Profession Field Collections'=>array('index'),
	$model->collection_id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List TblProfessionFieldCollection', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create TblProfessionFieldCollection', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update TblProfessionFieldCollection', 'url'=>array('update', 'id'=>$model->collection_id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete TblProfessionFieldCollection', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->collection_id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage TblProfessionFieldCollection', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','TblProfessionFieldCollection '.$model->collection_id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'collection_id',
		'authitem_name',
		'first_name',
		'middle_name',
		'last_name',
		'office',
		'street_address',
		'address1',
		'address2',
		'state',
		'county',
		'city',
		'zipcode',
		'phone',
		'phone_office',
		'phone_fax',
		'phone_home',
		'phone_mobile',
		'website_url',
		'tagline',
		'years_of_experience',
		'years_of_experience_text',
		'area_expertise',
		'area_expertise_text',
		'about_me',
		'upload_photo',
		'office_logo',
		'upload_logo',
		'listing_type',
		'payment_type',
		'join_date',
		'join_only_date',
		'membership_expire_date',
		'membership_subscription_date',
		'audit_expire_date',
		'profile_completion_percentage',
		'rating_average',
		'agent_last_login',
		'agent_comments',
		'profile_notification',
		'website_notification',
		'listings_notification',
		'subscription',
		'timestamp',
	),
)); ?>