<?php
/* @var $this PropertyInfoSlugController */
/* @var $model PropertyInfoSlug */


$this->breadcrumbs=array(
	'Property Info Slugs'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#property-info-slug-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Factors','') ?>
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
			'id'=>'property-info-slug-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		'id',
		'property_id',
		'slug',
//		'created_at',
//		'updated_at',
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
                                        'template'=>'{view}',
                                        'buttons'=>array
                                        (
                                            'view' => array
                                            (
                                                'url'=>'Yii::app()->createUrl("statInfo/factor", array("id"=>$data->property_id))',
                                            ),
                                        )

				),
			),
        )); ?>
    </div>
</div>




