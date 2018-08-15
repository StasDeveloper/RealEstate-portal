<?php
/* @var $this CollectionController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Tbl Profession Field Collections',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create TblProfessionFieldCollection', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage TblProfessionFieldCollection', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Tbl Profession Field Collections') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>