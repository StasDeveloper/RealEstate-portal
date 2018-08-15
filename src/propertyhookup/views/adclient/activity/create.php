<?php
/* @var $this AdclientactivityController */
/* @var $model AdClientActivity */
?>

<?php
$this->breadcrumbs=array(
	'Ad Client Activities'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List AdClientActivity', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage AdClientActivity', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','AdClientActivity') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>