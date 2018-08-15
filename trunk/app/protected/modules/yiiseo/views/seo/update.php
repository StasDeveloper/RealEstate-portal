<?php
$this->breadcrumbs=array(
	'Yiiseo Urls'=>array('index'),
	'Update ' . $model->id ,
);

?>

<?php echo BsHtml::pageHeader('Update Seo Url ' . $model->id,'') ?>

<div class="pull-right" style="padding-bottom: 10px;">
<?php  echo BsHtml::buttonGroup(array(
	array('type'=>BsHtml::BUTTON_TYPE_LINK,'label'=>'List SeoUrl', 'url'=>array('index'), 'color'=>BsHtml::BUTTON_COLOR_PRIMARY),
	array('type'=>BsHtml::BUTTON_TYPE_LINK,'label'=>'Create SeoUrl', 'url'=>array('create'), 'color'=>BsHtml::BUTTON_COLOR_PRIMARY),
    )); ?>
</div>
<div class="clearfix"></div>

<?php echo $this->renderPartial('_form', array( 'model'=>$model,
                                                'modelTitle'=>$modelTitle,
                                                "modelKeywords"=>$modelKeywords,
                                                "modelDescription"=>$modelDescription,
                                                "modelOther"=>$modelOther,
                                                'listParams'=>$listParams
    )); ?>