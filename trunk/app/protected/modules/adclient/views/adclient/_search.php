<?php
/* @var $this AdClientController */
/* @var $model AdClient */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
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

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
