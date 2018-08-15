<?php
/* @var $this PropertyController */
/* @var $model PropertyInfo */
?>

<?php
$this->breadcrumbs=array(
	'Property Infos'=>array('index'),
	$model->property_id=>array('view','id'=>$model->property_id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List PropertyInfo', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create PropertyInfo', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View PropertyInfo', 'url'=>array('view', 'id'=>$model->property_id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage PropertyInfo', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','PropertyInfo '.$model->property_id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>