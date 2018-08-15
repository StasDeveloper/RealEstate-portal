<?php
/* @var $this PropertyController */
/* @var $model PropertyInfo */
?>

<?php
$this->breadcrumbs=array(
	'Property Infos'=>array('index'),
	$model->property_id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List PropertyInfo', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create PropertyInfo', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update PropertyInfo', 'url'=>array('update', 'id'=>$model->property_id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete PropertyInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->property_id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage PropertyInfo', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','PropertyInfo '.$model->property_id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'property_id',
		'year_biult_id',
		'pool',
		'garages',
		'mid',
		'property_title',
		'house_square_footage',
		'lot_acreage',
		'property_type',
		'property_price',
		'bathrooms',
		'bedrooms',
		'description',
		'property_street',
		'property_state_id',
		'property_county_id',
		'property_city_id',
		'property_zipcode',
		'property_uploaded_date',
		'property_updated_date',
		'property_expire_date',
		'photo1',
		'caption1',
		'getlongitude',
		'getlatitude',
		'estimated_price',
		'percentage_depreciation_value',
		'property_status',
		'user_session_id',
		'visible',
		'sub_type',
		'area',
		'subdivision',
		'schools',
		'community_name',
		'community_features',
		'property_fetatures',
		'mls_sysid',
	),
)); ?>