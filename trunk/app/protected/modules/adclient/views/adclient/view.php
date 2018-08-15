<?php
/* @var $this AdClientController */
/* @var $model AdClient */
?>

<?php
$this->breadcrumbs=array(
	'Ad Clients'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List AdClient', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create AdClient', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update AdClient', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete AdClient', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage AdClient', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','AdClient '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ad_category_id',
		'company_name',
		'rep_name',
		'company_logo',
		'company_address',
		'company_website',
		'contact_phone_number',
		'alt_contact_phone_number',
		'contact_email',
		'alt_contact_email',
		'ad_tag_line',
		'ad_description',
		'ad_confirmation_message',
		'message_to_advertiser',
		'updated_at',
		'created_at',
	),
)); ?>