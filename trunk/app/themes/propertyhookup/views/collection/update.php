<?php
/* @var $this CollectionController */
/* @var $model TblProfessionFieldCollection */
?>

<?php
$this->breadcrumbs=array(
	'Tbl Profession Field Collections'=>array('index'),
	$model->collection_id=>array('view','id'=>$model->collection_id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List TblProfessionFieldCollection', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create TblProfessionFieldCollection', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View TblProfessionFieldCollection', 'url'=>array('view', 'id'=>$model->collection_id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage TblProfessionFieldCollection', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','TblProfessionFieldCollection '.$model->collection_id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>