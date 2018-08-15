<?php
/* @var $this AdclientactivityController */
/* @var $model AdClientActivity */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'ad-client-activity-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'status'); ?>
    <?php echo $form->textFieldControlGroup($model,'client_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'user_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'user_first_name',array('maxlength'=>128)); ?>
    <?php echo $form->textFieldControlGroup($model,'user_last_name',array('maxlength'=>128)); ?>
    <?php echo $form->textFieldControlGroup($model,'user_phone_number',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'user_email',array('maxlength'=>128)); ?>
    <?php echo $form->textFieldControlGroup($model,'user_address',array('maxlength'=>256)); ?>
    <?php echo $form->textAreaControlGroup($model,'user_comment',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'user_lon'); ?>
    <?php echo $form->textFieldControlGroup($model,'user_lat'); ?>
    <?php echo $form->textFieldControlGroup($model,'created_at'); ?>
    <?php echo $form->textFieldControlGroup($model,'updated_at'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
