<?php
/* @var $this PageController */
/* @var $model LandingPage */
?>

<?php
$this->breadcrumbs=array(
	'Landing Pages'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List LandingPage', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage LandingPage', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','LandingPage') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>