<?php
/* @var $this AdclientactivityController */
/* @var $model AdClientActivity */
?>

<?php
$this->breadcrumbs=array(
	'Ad Client Activities'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List AdClientActivity', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create AdClientActivity', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update AdClientActivity', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete AdClientActivity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage AdClientActivity', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','AdClientActivity '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'status',
		'client_id',
		'user_id',
		'user_first_name',
		'user_last_name',
		'user_phone_number',
		'user_email',
		'user_address',
		'user_comment',
		'user_lon',
		'user_lat',
		'created_at',
		'updated_at',
	),
)); ?>