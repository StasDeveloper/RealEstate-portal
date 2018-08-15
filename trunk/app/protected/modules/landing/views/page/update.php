<?php
/* @var $this PageController */
/* @var $model LandingPage */
?>

<?php
$this->breadcrumbs=array(
	'Landing Pages'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List LandingPage', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create LandingPage', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View LandingPage', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage LandingPage', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','LandingPage '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>