<?php
/* @var $this PageController */
/* @var $model LandingPage */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'landing-page-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'title',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'slug',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'search_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'post_top_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'post_bottom_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'created_at'); ?>
    <?php echo $form->textFieldControlGroup($model,'updated_at'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
