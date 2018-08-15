<?php
/* @var $this PageController */
/* @var $model LandingPage */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'title',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'slug',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'search_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'post_top_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'post_bottom_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'created_at'); ?>
    <?php echo $form->textFieldControlGroup($model,'updated_at'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
