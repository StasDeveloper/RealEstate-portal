<?php
/* @var $this AdclientactivityController */
/* @var $model AdClientActivity */
?>

<?php
$this->breadcrumbs=array(
	'Ad Client Activities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List AdClientActivity', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create AdClientActivity', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View AdClientActivity', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage AdClientActivity', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','AdClientActivity '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>