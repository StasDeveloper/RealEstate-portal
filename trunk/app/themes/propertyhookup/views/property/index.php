<?php
/* @var $this PropertyController */
/* @var $dataProvider CActiveDataProvider */

$cs = Yii::app()->clientScript;
$themePath = Yii::app()->theme->baseUrl;
$this->layout = '//layouts/irradii';
$success_flag = '';
$this->breadcrumbs=array(
	'Property Infos',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create PropertyInfo', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage PropertyInfo', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Property Infos') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>