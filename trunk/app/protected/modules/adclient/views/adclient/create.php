<?php
/* @var $this AdClientController */
/* @var $model AdClient */
?>

<?php
$this->breadcrumbs=array(
	'Ad Clients'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List AdClient', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage AdClient', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','AdClient') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>