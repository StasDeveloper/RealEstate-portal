<?php
/* @var $this CollectionController */
/* @var $model TblProfessionFieldCollection */
?>

<?php
$this->breadcrumbs=array(
	'Tbl Profession Field Collections'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List TblProfessionFieldCollection', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage TblProfessionFieldCollection', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','TblProfessionFieldCollection') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>