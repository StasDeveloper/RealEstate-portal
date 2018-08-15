<?php 
        $cs=Yii::app()->clientScript;
//        $cs->registerScriptFile(CPathCDN::baseurl( 'js' ) . "/js/plugin/ckeditor/ckeditor.js", CClientScript::POS_END);
        $cs->registerCssFile(CPathCDN::baseurl( 'js' ) . '/js/plugin/summernote/summernote.css');
        $cs->registerScriptFile(CPathCDN::baseurl( 'js' ) . "/js/plugin/summernote/summernote.min.js", CClientScript::POS_END);
?>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'post-edit-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'class'=> 'form-horizontal',
        ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo CHtml::errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo $form->textField($model,'title',array('class'=>'form-control','size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
            </div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'content',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo CHtml::activeTextArea($model,'content',array('class'=>'form-control summernote','rows'=>10, 'cols'=>70)); ?>
<?php /*/ ?>
		<p class="hint">You may use <a target="_blank" href="http://daringfireball.net/projects/markdown/syntax">Markdown syntax</a>.</p>
<?php /*/ ?>
		<?php echo $form->error($model,'content'); ?>
            </div>
        </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tags',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
<?php /*/ ?>
 		<?php $this->widget('CAutoComplete', array(
 
			'model'=>$model,
			'attribute'=>'tags',
			'url'=>array('suggestTags'),
			'multiple'=>true,
			'htmlOptions'=>array('class'=>'form-control tagsinput', 'size'=>50, 'data-role'=>"tagsinput"),
		)); ?>
		<p class="hint">Please separate different tags with commas.</p>
<?php /*/ ?>
       		<?php echo $form->textField($model,'tags',array('class'=>'form-control tagsinput', 'data-role'=>"tagsinput",'size'=>80)); ?>
		<?php echo $form->error($model,'tags'); ?>
            </div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo BsHtml::activeDropDownList($model, 'status', Lookup::items('PostStatus'),array("empty"=>"Select status", 'class'=>'form-control col-sm-10')); ?>
		<?php echo $form->error($model,'status'); ?>
            </div>
	</div>

<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
		<?php echo BsHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>"btn btn-primary")); ?>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
        $cs->registerScript("ckeditorStart", " 
$('.summernote').summernote({
        height : 380,
        focus : false,
        tabsize : 2,
        'fontNames':[
        'Muli', 'Open Sans', 'Open Sans Condensed',
        'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New',
        'Helvetica Neue', 'Helvetica', 'Impact', 'Lucida Grande',
        'Tahoma', 'Times New Roman', 'Verdana'
      ],
      onImageUpload: function(files) {
                sendFile(files[0]);
      }
});
        function sendFile(file) {
            data = new FormData();
            data.append('file', file);
            $.ajax({
                data: data,
                type: 'POST',
                url: '/blog/upload/summernote',
                cache: false,
                contentType: false,
                processData: false,
                success: function(obj) {
                  if(obj.error == 0) {
                        $('.summernote').summernote('editor.insertImage', obj.url);
                    } else {
//                        console.log(obj.result);
                        $.smallBox({
                                title : 'Insert Image',
                                content : '<i class=\"fa fa-clock-o\"></i> <i>'+obj.result+'</i>',
                                color : '#C46A69',
                                iconSmall : 'fa fa-bell swing animated',
                                timeout : 4000
                        });
                    }
                }
            });
        }
        ", CClientScript::POS_READY);
