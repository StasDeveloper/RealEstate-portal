<?php
/* @var $this AdclientactivityController */
/* @var $model AdClientActivity */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
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

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
