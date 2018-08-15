<?php
/* @var $this CollectionController */
/* @var $model TblProfessionFieldCollection */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'tbl-profession-field-collection-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->textFieldControlGroup($model,'authitem_name',array('maxlength'=>100)); ?>
    <?php echo $form->checkBoxControlGroup($model,'first_name'); ?>
    <?php echo $form->checkBoxControlGroup($model,'middle_name'); ?>
    <?php echo $form->checkBoxControlGroup($model,'last_name'); ?>
    <?php echo $form->checkBoxControlGroup($model,'office'); ?>
    <?php echo $form->checkBoxControlGroup($model,'street_address'); ?>
    <?php echo $form->checkBoxControlGroup($model,'address1'); ?>
    <?php echo $form->checkBoxControlGroup($model,'address2'); ?>
    <?php echo $form->checkBoxControlGroup($model,'state'); ?>
    <?php echo $form->checkBoxControlGroup($model,'county'); ?>
    <?php echo $form->checkBoxControlGroup($model,'city'); ?>
    <?php echo $form->checkBoxControlGroup($model,'zipcode'); ?>
    <?php echo $form->checkBoxControlGroup($model,'phone'); ?>
    <?php echo $form->checkBoxControlGroup($model,'phone_office'); ?>
    <?php echo $form->checkBoxControlGroup($model,'phone_fax'); ?>
    <?php echo $form->checkBoxControlGroup($model,'phone_home'); ?>
    <?php echo $form->checkBoxControlGroup($model,'phone_mobile'); ?>
    <?php echo $form->checkBoxControlGroup($model,'website_url'); ?>
    <?php echo $form->checkBoxControlGroup($model,'tagline'); ?>
    <?php echo $form->checkBoxControlGroup($model,'years_of_experience'); ?>
    <?php echo $form->checkBoxControlGroup($model,'years_of_experience_text'); ?>
    <?php echo $form->checkBoxControlGroup($model,'area_expertise'); ?>
    <?php echo $form->checkBoxControlGroup($model,'area_expertise_text'); ?>
    <?php echo $form->checkBoxControlGroup($model,'about_me'); ?>
    <?php echo $form->checkBoxControlGroup($model,'upload_photo'); ?>
    <?php echo $form->checkBoxControlGroup($model,'office_logo'); ?>
    <?php echo $form->checkBoxControlGroup($model,'upload_logo'); ?>
    <?php echo $form->checkBoxControlGroup($model,'listing_type'); ?>
    <?php echo $form->checkBoxControlGroup($model,'payment_type'); ?>
    <?php echo $form->checkBoxControlGroup($model,'join_date'); ?>
    <?php echo $form->checkBoxControlGroup($model,'join_only_date'); ?>
    <?php echo $form->checkBoxControlGroup($model,'membership_expire_date'); ?>
    <?php echo $form->checkBoxControlGroup($model,'membership_subscription_date'); ?>
    <?php echo $form->checkBoxControlGroup($model,'audit_expire_date'); ?>
    <?php echo $form->checkBoxControlGroup($model,'profile_completion_percentage'); ?>
    <?php echo $form->checkBoxControlGroup($model,'rating_average'); ?>
    <?php echo $form->checkBoxControlGroup($model,'agent_last_login'); ?>
    <?php echo $form->checkBoxControlGroup($model,'agent_comments'); ?>
    <?php echo $form->checkBoxControlGroup($model,'profile_notification'); ?>
    <?php echo $form->checkBoxControlGroup($model,'website_notification'); ?>
    <?php echo $form->checkBoxControlGroup($model,'listings_notification'); ?>
    <?php echo $form->checkBoxControlGroup($model,'subscription'); ?>
    <?php echo $form->checkBoxControlGroup($model,'timestamp'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
