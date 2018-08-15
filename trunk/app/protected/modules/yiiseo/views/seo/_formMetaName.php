

<div class="panel panel-info">
        <div class="panel-heading">
    <?php if(!$model->isNewRecord){?>
        <?php echo BsHtml::activeHiddenField($model,"[$model->name]id");?>
        <a title="Delete" class="close deleteblock" data-id="<?php echo $model->id;?>">×</a>
    <?php } else {?>
        <a title="Delete" class="close deleteblock">×</a>
    <?php } ?>
            <h3 class="panel-title"><?php echo ucwords($model->name);?></h3>

        </div>
        <div class="panel-body">

    <div class="row">
        <?php echo BsHtml::activeLabelEx($model,"[$model->name]content",array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
        <?php if($model->name == "keywords"){?>
            <?php echo BsHtml::activeTextField($model,"[$model->name]content",array("size"=>60,"id"=>"tags", 'data-role'=>"tagsinput", 'class'=>"tagsinput")); ?>
        <?php } else {?>
            <?php echo BsHtml::activeTextArea($model,"[$model->name]content",array("rows"=>3)); ?>
        <?php }?>
        <?php echo BsHtml::error($model,"[$model->name]content"); ?>
            </div>
    </div>

    <div class="row">
        <div class="control-label col-sm-2">Params</div>
        <?php // echo BsHtml::labelBs("Params",array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
        <?php echo BsHtml::dropDownList("params", "", BsHtml::listData($listParams, "value", "name","group"), array("empty"=>"Select parameter",'class'=>($model->name == "keywords")?'select-params-keywords':'select-params','id'=>'id-' . $model->name));?>
            </div>
    </div>

    <div class="row">
        <?php echo BsHtml::activeLabelEx($model,"[$model->name]active",array('class'=>'control-label col-sm-2')); ?>
        <div class="col-sm-10">
            <?php echo BsHtml::activeCheckBox($model,"[$model->name]active"); ?>
            <?php echo BsHtml::error($model,"[$model->name]active"); ?>
        </div>
    </div>

        </div>
    </div>
    
