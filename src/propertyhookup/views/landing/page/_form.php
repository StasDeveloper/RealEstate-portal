<?php
/* @var $this PageController */
/* @var $model LandingPage */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
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
    <?php echo $form->dropDownListControlGroup($model,'search_id',
            CHtml::listData(SavedSearch::model()->findAll(array(
                'order' => 'name',
//                'condition'=>'user_id='.Yii::app()->user->id
            ))
        ,'id','name')); ?>
    <?php echo $form->dropDownListControlGroup($model,'post_top_id',CHtml::listData(Post::model()->findAll(array('order' => 'title','condition'=>'status='.Post::STATUS_PUBLISHED)),'id','title')); ?>
    <?php echo $form->dropDownListControlGroup($model,'post_bottom_id',CHtml::listData(Post::model()->findAll(array('order' => 'title','condition'=>'status='.Post::STATUS_PUBLISHED)),'id','title')); ?>
    <?php echo $form->dropDownListControlGroup($model,'status',  Lookup::items('LandingPageStatus') ,array("empty"=>"Select status")); ?>
    <?php // echo $form->textFieldControlGroup($model,'created_at'); ?>
    <?php // echo $form->textFieldControlGroup($model,'updated_at'); ?>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'class'=> 'pull-right')); ?>
</div>
</div>
</div>
<?php $this->endWidget(); ?>
