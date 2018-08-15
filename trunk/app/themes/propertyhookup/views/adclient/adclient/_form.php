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
        'htmlOptions'=>array(
            'class'=> 'form-horizontal',
            'enctype' => 'multipart/form-data',
        ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo CHtml::errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'ad_category_id',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo BsHtml::activeDropDownList($model, 'ad_category_id', AdClientCategory::items(),array("empty"=>"Select category", 'class'=>'form-control col-sm-10')); ?>
		<?php echo $form->error($model,'ad_category_id'); ?>
            </div>
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'company_name',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo $form->textField($model,'company_name',array('class'=>'form-control','size'=>80,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company_name'); ?>
            </div>
	</div>
	
	<div class="form-group">
            <?php echo $form->labelEx($model,'rep_name',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo $form->textField($model,'rep_name',array('class'=>'form-control','size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'rep_name'); ?>
            </div>
	</div>
	
	<div class="form-group">
            <?php echo $form->labelEx($model,'company_logo',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-2">
                <?php if(empty($model->company_logo)) : ?>
                <img src="http://img1.irradii.com/image_absent.jpg" alt="company_logo" class="img-thumbnail">
                <?php else: ?> 
                 <img src="<?php echo $model->company_logo; ?>" alt="company_logo" class="img-thumbnail">
                 <?php endif; ?>
            </div>
            <div class="col-sm-8">
		<?php echo $form->fileField($model,'company_logo',array('class'=>'form-control','size'=>80,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company_logo'); ?>
            </div>
	</div>
	
	<div class="form-group">
            <?php echo $form->labelEx($model,'company_address',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo $form->textField($model,'company_address',array('class'=>'form-control','size'=>80,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company_address'); ?>
            </div>
	</div>
	
	<div class="form-group">
            <?php echo $form->labelEx($model,'company_website',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo $form->urlField($model,'company_website',array('class'=>'form-control','size'=>80,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company_website'); ?>
            </div>
	</div>
	
	<div class="form-group">
            <?php echo $form->labelEx($model,'contact_phone_number',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo $form->telField($model,'contact_phone_number',array('class'=>'form-control','size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'contact_phone_number'); ?>
            </div>
	</div>
	
	<div class="form-group">
            <?php echo $form->labelEx($model,'alt_contact_phone_number',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo $form->telField($model,'alt_contact_phone_number',array('class'=>'form-control','size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'alt_contact_phone_number'); ?>
            </div>
	</div>
	
	<div class="form-group">
            <?php echo $form->labelEx($model,'contact_email',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo $form->emailField($model,'contact_email',array('class'=>'form-control','size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'contact_email'); ?>
            </div>
	</div>
	
	<div class="form-group">
            <?php echo $form->labelEx($model,'alt_contact_email',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo $form->emailField($model,'alt_contact_email',array('class'=>'form-control','size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'alt_contact_email'); ?>
            </div>
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'ad_tag_line',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo $form->textField($model,'ad_tag_line',array('class'=>'form-control','size'=>80,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ad_tag_line'); ?>
            </div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'ad_description',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo CHtml::activeTextArea($model,'ad_description',array('class'=>'form-control summernote','rows'=>3, 'cols'=>70)); ?>
		<?php echo $form->error($model,'ad_description'); ?>
            </div>
        </div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'ad_confirmation_message',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo CHtml::activeTextArea($model,'ad_confirmation_message',array('class'=>'form-control summernote','rows'=>3, 'cols'=>70)); ?>
		<?php echo $form->error($model,'ad_confirmation_message'); ?>
            </div>
        </div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'message_to_advertiser',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo CHtml::activeTextArea($model,'message_to_advertiser',array('class'=>'form-control summernote','rows'=>3, 'cols'=>70)); ?>
		<?php echo $form->error($model,'message_to_advertiser'); ?>
            </div>
        </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
		<?php echo BsHtml::activeDropDownList($model, 'status', Lookup::items('AdClientStatus'),array("empty"=>"Select status", 'class'=>'form-control col-sm-10')); ?>
		<?php echo $form->error($model,'status'); ?>
            </div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'for_all',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-1">
		<?php echo BsHtml::activeCheckBox($model, 'for_all', array( 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'for_all'); ?>
            </div>
	</div>

        
	<div class="form-group">
            <label class="control-label col-sm-2" for="ad-states">Ad States</label>
            <div class="col-sm-10">
                <select multiple style="width:100%" class="select2" placeholder="Select State" name="ad_state_id[]">
                    <?php foreach (State::items(1) as $state_id=>$state) : ?>
                    <option <?php echo (isset($adStates) && in_array($state_id, $adStates))? 'selected':'' ?> value="<?php echo $state_id;?>"><?php echo $state;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
	</div>

	<div class="form-group">
            <label class="control-label col-sm-2" for="ad-counties">Ad Counties</label>
            <div class="col-sm-10">
                <select multiple style="width:100%" class="select2" placeholder="Select County" name="ad_county_id[]">
                    <?php foreach (County::items() as $county_id=>$county) : ?>
                    <option <?php echo (isset($adCounties) && in_array($county_id, $adCounties))? 'selected':'' ?> value="<?php echo $county_id;?>"><?php echo $county;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
	</div>

	<div class="form-group">
            <label class="control-label col-sm-2" for="ad-cities">Ad Cities</label>
            <div class="col-sm-10">
                <select multiple style="width:100%" class="select2-ajax" placeholder="Select City" name="ad_city_id[]">
                    <?php foreach ($adCities as $city_id) : ?>
                    <option selected value="<?php echo $city_id;?>"><?php echo City::item($city_id);?></option>
                    <?php endforeach; ?>
                </select>

            </div>
	</div>

	<div class="form-group">
            <label class="control-label col-sm-2" for="ad-zipcodes">Ad Zipcode</label>
            <div class="col-sm-10">
                <select multiple style="width:100%" class="select2-ajax-zip" placeholder="Select Zipcode" name="ad_zipcode_id[]">
                    <?php foreach ($adZipcodes as $zipcode_id) : ?>
                    <option selected value="<?php echo $zipcode_id;?>"><?php echo Zipcode::item($zipcode_id);?></option>
                    <?php endforeach; ?>
                </select>
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

<?php 
Yii::app()->clientScript->registerCssFile(CPathCDN::baseurl( 'js' ) . '/js/plugin/select2/400/select2_custom.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl  . '/js/plugin/select2/400/select2_custom.css');
Yii::app()->clientScript->registerScript(
        "setupSelect2", " 
	if ($.fn.select24) { console.log('Sel2');
		$('.select2').each(function() {
			thiss = $(this);
			var width = thiss.attr('data-select-width') || '100%';
			//, _showSearchInput = thiss.attr('data-select-search') === 'true';
			thiss.select24({
				//showSearchInput : _showSearchInput,
				allowClear : true,
				width : width,
//                                minimumResultsForSearch: -2
			});
		});
        }
        if ($.fn.select24) { console.log('Sel24');
 $('.select2-ajax').select24({
    ajax: {
      url: '". $this->createUrl('/adclient/adclient/suggestcities') . "',
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used
        params.page = params.page || 1;

        return {
          results: data.items,
          pagination: {
            more: (params.page * 30) < data.total_count
          }
        };
      },
      cache: true
    },
    escapeMarkup: function (markup) { return markup; },
    minimumInputLength: 2,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
  });
  
 $('.select2-ajax-zip').select24({
    ajax: {
      url: '". $this->createUrl('/adclient/adclient/suggestzip') . "',
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used
        params.page = params.page || 1;

        return {
          results: data.items,
          pagination: {
            more: (params.page * 30) < data.total_count
          }
        };
      },
      cache: true
    },
    escapeMarkup: function (markup) { return markup; },
    minimumInputLength: 2,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
  });

        }
        
function formatRepo (repo) {
    if (repo.loading) return repo.text;

    var markup = repo.name;

    return markup;
  }

  function formatRepoSelection (repo) {
    return repo.name || repo.text;
  }
", CClientScript::POS_READY);