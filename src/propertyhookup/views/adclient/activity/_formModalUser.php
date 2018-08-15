<?php
/* @var $this AdClientController */
/* @var $model AdClientActivity */
/* @var $form BSActiveForm */
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title"> <?php echo $client->company_name ;?> </h4>

        </div>
        <div class="modal-body adCompanyInfo">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="well no-padding">
                    <section class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'ad-client-form-modal-' . $client->id ,
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'class'=> 'smart-form',
//            'enctype' => 'multipart/form-data',
        ),
)); ?>

<!--	<p class="note" style="padding-left: 15px; margin-bottom: 6px">Fields with <span class="required">*</span> are required.</p>-->
<!-- New form view. To return to old one, comment this block -->
	<p class="note" style="padding-left: 15px; margin-bottom: 15px"></p>
        <div id="error-submit-summary-<?php echo $client->id ?>" class="help-inline">
	<?php echo CHtml::errorSummary($model); ?>
        </div>

    <section class="col col-12" style="float: none">
        <label class="input">
            <i class="icon-prepend fa fa-user"></i>
            <?php echo $form->textField($model,'user_first_name',array('class'=>'form-control','size'=>80,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'user_first_name'); ?>
        </label>
    </section>

    <?php echo CHtml::activeHiddenField($model,'client_id',array()); ?>

    <section class="col col-12" style="float: none">
        <label class="input">
            <i class="icon-prepend fa fa-user"></i>
            <?php echo $form->textField($model,'user_last_name',array('class'=>'form-control','size'=>80,'maxlength'=>128)); ?>
            <?php echo $form->error($model,'user_last_name'); ?>
        </label>
    </section>

    <section class="col col-12" style="float: none">
        <label class="input">
            <i class="icon-prepend fa fa-phone"></i>
            <?php echo $form->telField($model,'user_phone_number',array('class'=>'form-control','size'=>12,'maxlength'=>15, 'data-mask' => '(999) 999-9999')); ?>
            <?php echo $form->error($model,'user_phone_number'); ?>
        </label>
    </section>

    <section class="col col-12" style="float: none">
        <label class="input">
            <i class="icon-prepend fa fa-envelope-o"></i>
            <?php echo $form->emailField($model,'user_email',array('class'=>'form-control','size'=>80,'maxlength'=>128)); ?>
            <?php echo $form->error($model,'user_email'); ?>
        </label>
    </section>

    <section class="col col-12" style="float: none">
        <label class="input">
            <i class="icon-prepend fa fa-globe"></i>
            <?php echo $form->textField($model,'user_address',array('class'=>'form-control','size'=>80,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'user_address'); ?>
        </label>
    </section>

    <section class="col col-12" style="float: none">
        <label class="textarea">
            <?php echo CHtml::activeTextArea($model,'user_comment',array('class'=>'form-control','rows'=>3, 'cols'=>70, 'placeholder' => 'Additional Info / Request')); ?>
            <?php echo $form->error($model,'user_comment'); ?>
        </label>
    </section>

    <?php if(Yii::app()->user->isGuest && CCaptcha::checkRequirements()): ?>
    <p class="note" style="padding-left: 15px">Please enter the letters as they are shown in the image below.
                            <br/>Letters are not case-sensitive.</p>
    <div style="overflow: hidden">
        <section class="col col-4">
                <?php $this->widget('CCaptcha', array(
                    'imageOptions'=>array(
                        'id'=> 'image-captcha-'. $client->id,
                    ),
                    'buttonLabel'   => '<span class="glyphicon glyphicon-refresh"></span>',
                    'buttonOptions' => array(
                        'id' => 'btn-refresh-captcha-'. $client->id,
                        'class' => 'btn-refresh-captcha-'. $client->id,
                        'style' => 'text-decoration: none; text-weight: bold;',
                    )
                )); ?>
        </section>
        <section class="col col-8">
        <label class="input">
                <?php echo $form->textField($model,'verifyCode', array('placeholder' => 'Captcha')); ?>
                </label>
        </section>
                <div class="hint"></div>
                <?php echo $form->error($model,'verifyCode'); ?>
    </div>

    <?php endif; ?>

<!-- END New form view. To return to old one, comment this block and uncomment next one -->


<!--    uncomment for show Old BLock   -->
<!--	<div class="form-group">-->
<!--            --><?php //echo $form->labelEx($model,'user_first_name',array('class'=>'control-label col-sm-3')); ?>
<!--            <div class="col-sm-8">-->
<!--		--><?php //echo $form->textField($model,'user_first_name',array('class'=>'form-control','size'=>80,'maxlength'=>255)); ?>
<!--		--><?php //echo $form->error($model,'user_first_name'); ?>
<!--            </div>-->
<!--	</div>-->
<!--	--><?php //echo CHtml::activeHiddenField($model,'client_id',array()); ?>
<!--	<div class="form-group">-->
<!--            --><?php //echo $form->labelEx($model,'user_last_name',array('class'=>'control-label col-sm-3')); ?>
<!--            <div class="col-sm-8">-->
<!--		--><?php //echo $form->textField($model,'user_last_name',array('class'=>'form-control','size'=>80,'maxlength'=>128)); ?>
<!--		--><?php //echo $form->error($model,'user_last_name'); ?>
<!--            </div>-->
<!--	</div>-->
<!---->
<!--	<div class="form-group">-->
<!--            --><?php //echo $form->labelEx($model,'user_phone_number',array('class'=>'control-label col-sm-3')); ?>
<!--            <div class="col-sm-8">-->
<!--		--><?php //echo $form->telField($model,'user_phone_number',array('class'=>'form-control','size'=>12,'maxlength'=>15, 'data-mask' => '(999) 999-9999')); ?>
<!--		--><?php //echo $form->error($model,'user_phone_number'); ?>
<!--            </div>-->
<!--	</div>-->
<!--	-->
<!--	<div class="form-group">-->
<!--            --><?php //echo $form->labelEx($model,'user_email',array('class'=>'control-label col-sm-3')); ?>
<!--            <div class="col-sm-8">-->
<!--		--><?php //echo $form->emailField($model,'user_email',array('class'=>'form-control','size'=>80,'maxlength'=>128)); ?>
<!--		--><?php //echo $form->error($model,'user_email'); ?>
<!--            </div>-->
<!--	</div>-->
<!--	-->
<!--	<div class="form-group">-->
<!--            --><?php //echo $form->labelEx($model,'user_address',array('class'=>'control-label col-sm-3')); ?>
<!--            <div class="col-sm-8">-->
<!--		--><?php //echo $form->textField($model,'user_address',array('class'=>'form-control','size'=>80,'maxlength'=>255)); ?>
<!--		--><?php //echo $form->error($model,'user_address'); ?>
<!--            </div>-->
<!--	</div>-->
<!--	-->
<!--	<div class="form-group">-->
<!--		--><?php //echo $form->labelEx($model,'user_comment',array('class'=>'control-label col-sm-3')); ?>
<!--            <div class="col-sm-8">-->
<!--		--><?php //echo CHtml::activeTextArea($model,'user_comment',array('class'=>'form-control','rows'=>3, 'cols'=>70)); ?>
<!--		--><?php //echo $form->error($model,'user_comment'); ?>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--	--><?php //if(Yii::app()->user->isGuest && CCaptcha::checkRequirements()): ?>
<!--	<div class="form-group">-->
<!--		--><?php //echo $form->labelEx($model,'verifyCode',array('class'=>'control-label col-sm-3')); ?>
<!--		<div class="col-sm-8">-->
<!--		--><?php //$this->widget('CCaptcha', array(
//                    'imageOptions'=>array(
//                        'id'=> 'image-captcha-'. $client->id,
//                    ),
//                    'buttonLabel'   => '<span class="glyphicon glyphicon-refresh"></span>',
//                    'buttonOptions' => array(
//                            'id' => 'btn-refresh-captcha-'. $client->id,
//                            'class' => 'btn-refresh-captcha-'. $client->id,
//                            'style' => 'text-decoration: none; text-weight: bold;',
//                    )
//                )); ?>
<!--		--><?php //echo $form->textField($model,'verifyCode'); ?>
<!--		<div class="hint">Please enter the letters as they are shown in the image above.-->
<!--		<br/>Letters are not case-sensitive.</div>-->
<!--		--><?php //echo $form->error($model,'verifyCode'); ?>
<!--		</div>-->
<!--	</div>-->
<!--	--><?php //endif; ?>
<!--    END OLD VIEW    -->

<div class="form-actions" style="margin-top: 0">
    <script>
        function showAdCompanyInfo(data){
            var data = data;
            function adConfMessage(){
                if(data.adCompany.ad_confirmation_message !== ""){
                    val = data.adCompany.ad_confirmation_message;
                }else{
                    val = " Please also feel free to contact them directly: ";
                }
                return val;
            }
            function repName(){
                if(data.adCompany.rep_name !== ""){
                    rep_name = "<strong>" + data.adCompany.rep_name + "</strong> at " + data.adCompany.company_name;
                }else{
                    rep_name = "<strong>"+data.adCompany.company_name+"</strong>";
                }
                return "<p style='margin-top: 10px'>" + rep_name + "</p>";
            }
            function phoneNum(){
                if(data.adCompany.contact_phone_number !== ""){
                    phone_num = "<li>Contact phone number: " + data.adCompany.contact_phone_number + "</li>";
                }else{
                    phone_num = "";
                }
                return phone_num;
            }
            function altPhoneNum(){
                if(data.adCompany.alt_contact_phone_number !== ""){
                    atl_phone_num = "<li>Alternative contact phone number: " + data.adCompany.alt_contact_phone_number + "</li>";
                }else{
                    atl_phone_num = "";
                }
                return atl_phone_num;
            }
            function contEmail(){
                if(data.adCompany.contact_email !== ""){
                    val = "<li>Contact email: " + data.adCompany.contact_email + "</li>";
                }else{
                    val = "";
                }
                return val;
            }
            function altContEmail(){
                if(data.adCompany.alt_contact_email !== ""){
                    val = "<li>Alternative email address: " + data.adCompany.alt_contact_email + "</li>";
                }else{
                    val = "";
                }
                return val;
            }
            function companyAddress(){
                if(data.adCompany.company_address !== ""){
                    val = "<li>Company address: " + data.adCompany.company_address + "</li>";
                }else{
                    val = "";
                }
                return val;
            }
            function companyWebsite(){
                if(data.adCompany.company_website !== ""){
                    val = "<li>Website address: " + data.adCompany.company_website + "</li>";
                }else{
                    val = "";
                }
                return val;
            }

            $("#modal-user-activity-<?php echo intval($client->id)?> .adCompanyInfo")
                .html("<p class='alert alert-success'> <strong> Your request has been successfully sent.</strong> "
                + adConfMessage() + "</p>"
                +"<h4 class='pull-right'><span class='label label-default'> "+data.adCategory.ad_category+"</span></h4>"
                + repName()
                + "<ul>"
                + phoneNum()
                + altPhoneNum()
                + contEmail()
                + altContEmail()
                + companyAddress()
                + companyWebsite()
                + "</ul>"
            )
        }
    </script>
    <div class="row" style="padding-right: 15px;">
        <div class="col-md-12">
                        <?php
                            echo BsHtml::ajaxSubmitButton(
                                    'Send', $this->createUrl('/adclient/activity/submit',array('id'=> $client->id)), array(
                                'beforeSend' => 'function(){
                                            $("#error-submit-summary-' . $client->id .'").hide();
                                             $("#submit-activity-button-' . $client->id .'").attr("disabled",true);
                                        }',
                                'complete' => 'function(){ 
                                             $("#submit-activity-button-' . $client->id .'").attr("disabled",false);
                                        }',
                                'success' => 'function(data){  
//                                             var obj = jQuery.parseJSON(data); 
                                             var obj = data; 
                                             if(obj.success == true){
                                                (function($){
                                                    $.smallBox({
                                                            title : "Email alerts",
                                                            content : "<i class=\"fa fa-clock-o\"></i> <i>Email sent</i>",
                                                            color : "#659265",
                                                            iconSmall : "fa fa-check fa-2x fadeInRight animated",
                                                            timeout : 4000
                                                    });
                                                })(jqueryOne);
                                                $("#ad-client-form-modal-' . $client->id .'").each(function(){ this.reset();});
                                                //jqueryOne("#modal-user-activity-'. $client->id .'").modal("hide");
                                                showAdCompanyInfo(data);
                                                jqueryOne("#modal-user-activity-'. $client->id .'").modal("show");
                                             } else {
                                                $("#error-submit-summary-' . $client->id .'").show();
                                                $("#error-submit-summary-' . $client->id .'").html(obj.errors); // $("#login-error-div").append("");
                                                jqueryOne("#btn-refresh-captcha-' . $client->id . '").click();
                                             }
 
                                        }'
                                    ), array("id" => "submit-activity-button-". $client->id , "class" => "btn btn-primary", "style" => "padding: 6px 12px;")
                            );
                        ?>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

                    </div>
                </div>
            </div>
        </div>
<?php /*/ ?>        
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
<?php /*/ ?>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

    <script type="text/javascript">

        // DO NOT REMOVE : GLOBAL FUNCTIONS!

$(document).ready(function() {
    if (jqueryOne.fn.mask) {
		jqueryOne('[data-mask]').each(function() {

			this_1 = jqueryOne(this);
			var mask = this_1.attr('data-mask') || 'error...', mask_placeholder = this_1.attr('data-mask-placeholder') || 'X';

			this_1.mask(mask, {
				placeholder : mask_placeholder
			});
		});
	}
    var $checkoutForm = jqueryOne('#ad-client-form-modal-<?php echo $client->id?>').validate({
        // Rules for form validation
        rules : {
            'AdClientActivity[user_first_name]' : {
                required : true
            },
            'AdClientActivity[user_last_name]' : {
                required : true
            },
            'AdClientActivity[user_phone_number]' : {
                required : true
            },
            'AdClientActivity[user_email]' : {
                required : true,
                email : true
            },
            'AdClientActivity[user_address]' : {
                required : true
            }
        },

        // Messages for form validation
        messages : {
            'AdClientActivity[user_first_name]' : {
                required : 'Please enter your first name'
            },
            'AdClientActivity[user_last_name]' : {
                required : 'Please enter your last name'
            },
            'AdClientActivity[user_phone_number]' : {
                required : 'Please enter your phone number'
            },
            'AdClientActivity[user_email]' : {
                required : 'Please enter your email address',
                email : 'Please enter a VALID email address'
            },
            'AdClientActivity[user_address]' : {
                required : 'Please enter your address'
            }
    },

    // Do not change code below
    errorPlacement : function(error, element) {
        error.insertAfter(element.parent());
    }
    })
});
    </script>

<?php
//Yii::app()->clientScript->registerScript(
//        "setupModal", "
//
//", CClientScript::POS_READY);
