<?php
$this->breadcrumbs=array(
	'Yiiseo Urls'=>array('index'),
	'Create',
);

?>

<?php echo BsHtml::pageHeader('Create Seo Url','') ?>

<div class="pull-right" style="padding-bottom: 10px;">
<?php  echo BsHtml::buttonGroup(array(
	array('type'=>BsHtml::BUTTON_TYPE_LINK,'label'=>'List SeoUrl', 'url'=>array('index'), 'color'=>BsHtml::BUTTON_COLOR_PRIMARY),
    )); ?>
</div>
<div class="clearfix"></div>
<?php echo $this->renderPartial('_form', array( 'model'=>$model,
                                                'modelTitle'=>$modelTitle,
                                                "modelKeywords"=>$modelKeywords,
                                                "modelDescription"=>$modelDescription,
                                                'listParams'=>$listParams,
    )); ?>