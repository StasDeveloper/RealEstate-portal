<?php
$this->breadcrumbs=array(
	'Yiiseo Urls'=>array('index'),
	'Manage',
);

//$this->menu=array(
//	array('label'=>'List SeoUrl', 'url'=>array('index')),
//	array('label'=>'Create SeoUrl', 'url'=>array('create')),
////	array('label'=>'Logout', 'url'=>Yii::app()->createUrl("yiiseo/default/logout")),
//);

?>

<?php echo BsHtml::pageHeader('Manage Seo Urls','') ?>

<div class="pull-right" style="padding-bottom: 10px;">
<?php  echo BsHtml::buttonGroup(array(
	array('type'=>BsHtml::BUTTON_TYPE_LINK,'label'=>'Create SeoUrl', 'url'=>array('create'), 'color'=>BsHtml::BUTTON_COLOR_PRIMARY),
    )); ?>
</div>
<div class="clearfix"></div>
<?php $this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'yiiseo-url-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'url',
		'language',
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
                        'template'=>'{update} {delete}',
		),
	),
        'type' => BsHtml::GRID_TYPE_BORDERED,
)); ?>
