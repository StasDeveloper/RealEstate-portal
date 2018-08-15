<?php
/* @var $this AdClientController */
/* @var $model AdClient */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'ad-client-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'ad_category_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'company_name',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'rep_name',array('maxlength'=>128)); ?>
    <?php echo $form->textFieldControlGroup($model,'company_logo',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'company_address',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'company_website',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'contact_phone_number',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'alt_contact_phone_number',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'contact_email',array('maxlength'=>128)); ?>
    <?php echo $form->textFieldControlGroup($model,'alt_contact_email',array('maxlength'=>128)); ?>
    <?php echo $form->textFieldControlGroup($model,'ad_tag_line',array('maxlength'=>255)); ?>
    <?php echo $form->textAreaControlGroup($model,'ad_description',array('rows'=>6)); ?>
    <?php echo $form->textAreaControlGroup($model,'ad_confirmation_message',array('rows'=>6)); ?>
    <?php echo $form->textAreaControlGroup($model,'message_to_advertiser',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'updated_at'); ?>
    <?php echo $form->textFieldControlGroup($model,'created_at'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
