<?php
/* @var $this PropertyController */
/* @var $model PropertyInfo */


$this->breadcrumbs=array(
	'Property Infos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'List PropertyInfo', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create PropertyInfo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#property-info-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Manage','Property Infos') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo BsHtml::button('Advanced search',array('class' =>'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3>
    </div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
                &lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div>
        <!-- search-form -->

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'property-info-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		'property_id',
		'year_biult_id',
		'pool',
		'garages',
		'mid',
		'property_title',
		/*
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
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>




