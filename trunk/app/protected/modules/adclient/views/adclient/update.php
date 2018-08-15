<?php
/* @var $this AdClientController */
/* @var $model AdClient */
?>

<?php
$this->breadcrumbs=array(
	'Ad Clients'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List AdClient', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create AdClient', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View AdClient', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage AdClient', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','AdClient '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>