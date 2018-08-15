<?php
/* @var $this PropertyController */
/* @var $model PropertyInfo */
?>

<?php
$this->breadcrumbs=array(
	'Property Infos'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List PropertyInfo', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage PropertyInfo', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','PropertyInfo') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>