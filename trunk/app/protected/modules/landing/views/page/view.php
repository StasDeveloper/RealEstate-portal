<?php
/* @var $this PageController */
/* @var $model LandingPage */
?>

<?php
$this->breadcrumbs=array(
	'Landing Pages'=>array('index'),
	$model->title,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List LandingPage', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create LandingPage', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update LandingPage', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete LandingPage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage LandingPage', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','LandingPage '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'slug',
		'search_id',
		'post_top_id',
		'post_bottom_id',
		'created_at',
		'updated_at',
	),
)); ?>