<?php
/* @var $this PropertyController */
/* @var $model PropertyInfo */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'property_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'year_biult_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'pool'); ?>
    <?php echo $form->textFieldControlGroup($model,'garages'); ?>
    <?php echo $form->textFieldControlGroup($model,'mid'); ?>
    <?php echo $form->textFieldControlGroup($model,'property_title',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'house_square_footage'); ?>
    <?php echo $form->textFieldControlGroup($model,'lot_acreage'); ?>
    <?php echo $form->textFieldControlGroup($model,'property_type'); ?>
    <?php echo $form->textFieldControlGroup($model,'property_price'); ?>
    <?php echo $form->textFieldControlGroup($model,'bathrooms'); ?>
    <?php echo $form->textFieldControlGroup($model,'bedrooms'); ?>
    <?php echo $form->textAreaControlGroup($model,'description',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'property_street',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'property_state_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'property_county_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'property_city_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'property_zipcode'); ?>
    <?php echo $form->textFieldControlGroup($model,'property_uploaded_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'property_updated_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'property_expire_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'photo1',array('maxlength'=>250)); ?>
    <?php echo $form->textFieldControlGroup($model,'caption1',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'getlongitude'); ?>
    <?php echo $form->textFieldControlGroup($model,'getlatitude'); ?>
    <?php echo $form->textFieldControlGroup($model,'estimated_price'); ?>
    <?php echo $form->textFieldControlGroup($model,'percentage_depreciation_value'); ?>
    <?php echo $form->textFieldControlGroup($model,'property_status',array('maxlength'=>8)); ?>
    <?php echo $form->textFieldControlGroup($model,'user_session_id',array('maxlength'=>40)); ?>
    <?php echo $form->textFieldControlGroup($model,'visible',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'sub_type',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'area',array('maxlength'=>250)); ?>
    <?php echo $form->textFieldControlGroup($model,'subdivision',array('maxlength'=>250)); ?>
    <?php echo $form->textFieldControlGroup($model,'schools',array('maxlength'=>250)); ?>
    <?php echo $form->textFieldControlGroup($model,'community_name',array('maxlength'=>200)); ?>
    <?php echo $form->textAreaControlGroup($model,'community_features',array('rows'=>6)); ?>
    <?php echo $form->textAreaControlGroup($model,'property_fetatures',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'mls_sysid'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
