<?php
        $cs=Yii::app()->clientScript;
        $baseUrl=Yii::getPathOfAlias('yiiseo.assets');

        $cs->registerScriptFile(CPathCDN::baseurl( 'js' ) . "/js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js", CClientScript::POS_END);
        $cs->registerCssFile(CPathCDN::baseurl( 'js' ) . '/js/plugin/bootstrap-tags/bootstrap-tagsinput.css');

        $cs->registerScriptFile(CPathCDN::publish($baseUrl.'/js/yiiseo.js'));
    ?>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'yiiseo-url-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'class'=> 'form-horizontal',
        ),
)); ?>


	<?php echo $form->errorSummary($model); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">URL</h3>
        </div>
        <div class="panel-body">
            <?php echo $form->labelEx($model,'url',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
            <?php echo $form->textField($model,'url',array('size'=>60,'class'=>'','id'=>'seo-url-id')); ?>
            <?php echo $form->error($model,'url'); ?>
            </div>
        </div>
    </div>

    <?php echo $this->renderPartial('_formMetaName', array('model'=>$modelTitle, 'listParams'=>$listParams)); ?>

    <?php echo $this->renderPartial('_formMetaName', array('model'=>$modelDescription, 'listParams'=>$listParams)); ?>

    <?php echo $this->renderPartial('_formMetaName', array('model'=>$modelKeywords, 'listParams'=>$listParams)); ?>

    <?php if((!$model->isNewRecord)&&($modelOther!==null)) {?>
        <?php foreach($modelOther as $modelOtherItem){?>
            <?php echo $this->renderPartial('_formMetaName', array('model'=>$modelOtherItem, 'listParams'=>$listParams)); ?>
        <?php }?>
    <?php }?>

    <span id="load-meta-name"></span>

    <div class="row buttons">
        <div class="col-sm-9">
    <?php echo BsHtml::dropDownList("name","",array(
            "robots"=>"robots","author"=>"author","copyright"=>"copyright"
            ,'language'=>'language','classification'=>'classification','distribution'=>'distribution','rating'=>'rating'
            ,'google-site-verification'=>'google-site-verification','revisit-after'=>'revisit-after'
            ,'creator'=>'creator','publisher'=>'publisher'
        ),array("empty"=>"Select meta name", 'class'=>'col-sm-10'))?>
        </div>
        <div class="pull-right">
    <?php echo BsHtml::button("add meta name",array('class'=>"meta-name  btn btn-info")); ?>
        </div>
    </div>

    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title">Property</h3>
        </div>
        <div class="panel-body">
            <?php if( (!$model->isNewRecord) && (count($model->yiiseoProperties)) ){?>
                <?php foreach($model->yiiseoProperties as $key=>$property){?>
                    <?php $this->renderPartial("_formMetaProperty",array('model'=>$property,'count'=>$key, 'listParams'=>$listParams));?>
                <?php }?>
            <?php }?>
            <span id="load-meta-property"></span>
        </div>
    </div>
    
    <div class="row buttons">
        <div class="pull-right">
        <?php echo BsHtml::button("add meta property",array('class'=>"meta-property btn btn-warning","data-count"=>count($model->yiiseoProperties))); ?>
        </div>
    </div>

    <div class="row buttons pull-right">
        <?php echo BsHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>"btn btn-primary")); ?>
        <a href="<?php echo Yii::app()->createUrl('yiiseo/seo');?>" title="Cancel" class="btn btn-default"><i class="fa fa-times"></i>Cancel</a>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
