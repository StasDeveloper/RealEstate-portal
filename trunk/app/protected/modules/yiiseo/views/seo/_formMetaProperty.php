<div class="property">
    <div class="col-sm-2">
    <?php echo BsHtml::activeTextField($model,"[$count]name",array("class"=>"",'placeholder'=>"property name"));?>
    </div>
    <div class="col-sm-7">
    <?php echo BsHtml::activeTextField($model,"[$count]content",array('class'=>"property-content",'placeholder'=>"property content"));?>
    </div>
    <div class="col-sm-2">
    <?php echo BsHtml::dropDownList("params", "", BsHtml::listData($listParams, "value", "name","group"), array("empty"=>"Select parameter",'class'=>"select-params-property",'id'=>'id-property-' . $count));?>
    </div>

    <?php if(!$model->isNewRecord){?>
        <?php echo CHtml::activeHiddenField($model,"[$count]id");?>
        <a  title="Delete property" class="close deleteproperty" data-id="<?php echo $model->id;?>">×</a>
    <?php } else {?>
        <a title="Delete property" class="close deleteproperty">×</a>
    <?php } ?>


</div>