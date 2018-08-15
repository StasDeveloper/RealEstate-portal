<?php
/* @var $this CollectionController */
/* @var $model TblProfessionFieldCollection */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'collection_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'authitem_name',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'first_name',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'middle_name',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'last_name',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'office',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'street_address',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'address1',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'address2',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'state',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'county',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'city',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'zipcode',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone_office',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone_fax',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone_home',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone_mobile',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'website_url',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'tagline',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'years_of_experience',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'years_of_experience_text',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'area_expertise',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'area_expertise_text',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'about_me',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'upload_photo',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'office_logo',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'upload_logo',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'listing_type',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'payment_type',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'join_date',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'join_only_date',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'membership_expire_date',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'membership_subscription_date',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'audit_expire_date',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'profile_completion_percentage',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'rating_average',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'agent_last_login',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'agent_comments',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'profile_notification',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'website_notification',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'listings_notification',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'subscription',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'timestamp',array('maxlength'=>3)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
