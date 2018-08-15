<?php
/* @var $this PropertyInfoSlugController */
/* @var $model PropertyInfoSlug */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'post',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'property_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'mls_sysid'); ?>


    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
