<?php
$cs = Yii::app()->clientScript;
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title">Irradii</h4>

        </div>
        <div class="modal-body">
            <div class="row padding-10">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <span class="modal-title pull-right">
                        <span class="">Need an account?</span>
                            <button type="button" class="btn btn-danger" id="modal-sign-up-button" data-dismiss="modal"
                                     data-toggle="modal" href="/user/login" data-target="#modal_login" >
                                Sign in
                            </button>
                    </span>
                </div>
            </div>
            <div class="clearfix"></div>
            
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="well no-padding">
                    <div class="form">

                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                        'id' => 'registration-form-form',
                        // Please note: When you enable ajax validation, make sure the corresponding
                        // controller action is handling ajax validation correctly.
                        // There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                            'validateOnChange' => false,
                        ),
                        'htmlOptions' => array('class' => 'smart-form client-form'),
                    ));
                    ?>

                    <header>Registration is FREE*</header>
                    <?php // echo $form->errorSummary($model); ?>
                    <fieldset>
                        <section>
                            <label class="input<?php echo $form->error($model, 'username') ? ' state-error' : ''; ?>"> <i class="icon-append fa fa-user"></i>
<!--                                    <input type="text" name="username" placeholder="Username">-->
                                <?php echo $form->textField($model, 'username', array('maxlength' => 130)); ?>
                                <?php echo $form->error($model, 'username'); ?>
                                <b class="tooltip tooltip-bottom-right">Needed to enter your email address</b> </label>

                        </section>

                       

                        <section>
                            <label class="input<?php echo $form->error($model, 'password') ? ' state-error' : ''; ?>"> <i class="icon-append fa fa-lock"></i>
<!--                                    <input type="password" name="password" placeholder="Password" id="password">-->
                                <?php echo $form->passwordField($model, 'password', array('maxlength' => 128)); ?>
                                <?php echo $form->error($model, 'password'); ?>
                                <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>

                        </section>

                        <section>
                            <label class="input<?php echo $form->error($model, 'verifyPassword') ? ' state-error' : ''; ?>"> <i class="icon-append fa fa-lock"></i>
<!--                                    <input type="password" name="passwordConfirm" placeholder="Confirm password">-->
                                <?php echo $form->passwordField($model, 'verifyPassword', array('maxlength' => 128)); ?>
                                <?php echo $form->error($model, 'verifyPassword'); ?>
                                <div id="login-error-div" class="errorMessage help-inline" style="display: none;"></div>
                                <b class="tooltip tooltip-bottom-right">Re-enter to confirm your password</b> </label>

                        </section>
                    </fieldset>


                    <fieldset>
                        <div class="row">
                            <section class="col col-6">
                                <label class="input<?php echo $form->error($profile, 'first_name') ? ' state-error' : ''; ?>">
<!--                                        <input type="text" name="firstname" placeholder="First name">-->
                                    <?php echo $form->textField($profile, 'first_name', array('maxlength' => 128)); ?>
                                    <?php echo $form->error($model, 'first_name'); ?>
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="input<?php echo $form->error($profile, 'last_name') ? ' state-error' : ''; ?>">
<!--                                        <input type="text" name="lastname" placeholder="Last name">-->
                                    <?php echo $form->textField($profile, 'last_name', array('maxlength' => 128)); ?>
                                    <?php echo $form->error($model, 'last_name'); ?>
                                </label>
                            </section>
                        </div>

                        <div class="row">
                            <section class="col col-6">
                                <label class="select<?php echo $form->error($model, 'professionRole') ? ' state-error' : ''; ?>">
                                    <?php
//                                                        
                                    echo $form->dropDownList(
                                            $model, 
                                            'professionRole', 
                                            CHtml::listData($profession, 'name','name'),
                                            array('empty'=>'Profession') 
                                    );
                                    ?>
                                    <i></i> 
                                    <?php echo $form->error($model, 'professionRole'); ?>
                                </label>
                            </section>

                            <section class="col col-6">
                                <label class="input"> <i class="icon-append fa fa-globe"></i>
<?php /*/ ?>
                                    <input type="text" name="request" placeholder="City" > 
<?php /*/ ?>
                                    <input  name="request" class="form-control" id="autocompleteSignUp" placeholder="Enter your City" onfocus="geolocate()" type="text" autocomplete="off">
                                </label>
                                
                                        <?php echo $form->hiddenField($profile, 'street_number', array('id'=>"street_number", 'value'=>$profile->street_number));?>
                                        <?php echo $form->hiddenField($profile, 'street_address', array('id'=>"route", 'value'=>$profile->street_address)); ?>
                                        <?php echo $form->hiddenField($profile, 'city', array('id'=>"locality", 'value'=>$profile->city)) ?>
                                        <?php echo $form->hiddenField($profile, 'state', array('id'=>"administrative_area_level_1", 'value'=>$profile->state)); ?>
                                        <?php // echo $form->hiddenField($profile, 'zipcode', array('id'=>"postal_code", 'value'=>$zip_db)); ?>
                                        <?php echo $form->hiddenField($profile, 'country', array('id'=>"country", 'value'=>$profile->country)); ?>
                                
                            </section>
                        </div>

                        <section>
                            <input id="ytTblUsersProfiles_subscription" type="hidden" value="No" name="TblUsersProfiles[subscription]">
                            <input id="ytRegistrationForm_terms" type="hidden" value="" name="RegistrationForm[terms]">
 
                            <label class="checkbox">
                                <input value="Yes" name="TblUsersProfiles[subscription]" id="TblUsersProfiles_subscription" type="checkbox" 
                                    <?php if($profile->subscription=='Yes') echo 'checked="checked"'?>   > 

                                <?php // echo $form->checkBox($profile, 'subscription', array('value' => 'Yes', 'uncheckValue' => 'No')); // IE9 problem  ?>
                                <i></i>I want to receive news and special offers

                            </label>
                            <label class="checkbox<?php echo $form->error($model, 'terms') ? ' state-error' : ''; ?>">
                                <input value="1" name="RegistrationForm[terms]" id="RegistrationForm_terms" type="checkbox" 
                                    <?php if($model->terms=='1') echo 'checked="checked"'?> >  
 
                                <?php // echo $form->checkBox($model, 'terms', array('value' => true, 'uncheckValue' => false)); // IE9 problem ?>
                                <i></i>I agree with the <a href="/site/terms" data-toggle="modal" data-target="#myModalTerms"  data-dismiss="modal"> Terms and Conditions </a><br>
                                <?php echo $form->error($model, 'terms'); ?>
                            </label>
                        </section>
                    </fieldset>

                    <footer>

                        <?php // echo BsHtml::submitButton('Register', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
                            <?php
                            echo BsHtml::ajaxSubmitButton(
                                    'Register', array('/user/registration'), array(
                                'beforeSend' => 'function(){ 
                                             $("#registration-button").attr("disabled",true);
                                        }',
                                'complete' => 'function(){ 
                                             $("#registration-button").attr("disabled",false);
                                        }',
                                'success' => 'function(data){
                                             var obj = data; 
                                             if(obj.login == "success"){
                                                clickAddSearchButton();
                                             }
                                             if(obj.login == "registered"){
                                                    (function($){
                                                    $.smallBox({
                                                            title : "Email alerts",
                                                            content : "<i class=\"fa fa-clock-o\"></i> <i>"+obj.message+"</i>",
                                                            color : "#659265",
                                                            iconSmall : "fa fa-check fa-2x fadeInRight animated",
                                                            timeout : 4000
                                                    });
                                                    })(jqueryOne);
                                                setTimeout(function(){  jqueryOne("#modal_signup").modal("hide") ;}, 4000);
                                             }
                                             if(obj.login == "error"){
                                                $("#modal_signup").html(obj.message);
                                             }
 
                                        }'
                                    ), array("id" => "registration-button", "class" => "btn btn-primary")
                            );
                            ?>

                        
                    </footer>

                    <div class="message">
                        <i class="fa fa-check"></i>
                        <p>
                            Thank you for your registration!
                        </p>
                    </div>
<?php $this->endWidget(); ?>


                </div>
                <p class="note text-center">*Registration is always free to access our standard tools, register now and check them out.</p>

            </div>

            <h5 class="text-center margin-top-10"> - Or register using -</h5>

            <?php $this->widget('ext.hoauthwidgets.HOAuth'); ?>
            </div>
        </div>
            
        </div>
        <!-- /.modal-body -->
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<?php
$cs->registerScript("addInitFunction", "
initialize();
        ", CClientScript::POS_READY);

$cs->registerScript("val_reg_form", " // runAllForms();

    // Model i agree button
    $(document).on('click', '#i-agree',function() {
        _this = $('#RegistrationForm_terms');
        if (_this.checked) {
            jqueryOne('#modal_signup').modal('show');
        } else {
            _this.prop('checked', true);
            jqueryOne('#modal_signup').modal('show');
        }
    });

    // Validation
    jqueryOne(function() {
        // Validation
        jqueryOne('#registration-form-form').validate({
            // Rules for form validation
            rules: {
                username: {
                    required: true,
                    email: true
                },
//                email: {
//                    required: true,
//                    email: true
//                },
                password: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                passwordConfirm: {
                    required: true,
                    minlength: 3,
                    maxlength: 20,
                    equalTo: '#password'
                },
                firstname: {
                    required: true
                },
                lastname: {
                    required: true
                },
//                gender: {
//                    required: true
//                },
                terms: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                username: {
                    required: 'Please enter your email address'
//                    email: 'Please enter a VALID email address'
                },
//                email: {
//                    required: 'Please enter your email address',
//                    email: 'Please enter a VALID email address'
//                },
                password: {
                    required: 'Please enter your password'
                },
                passwordConfirm: {
                    required: 'Please enter your password one more time',
                    equalTo: 'Please enter the same password as above'
                },
                firstname: {
                    required: 'Please select your first name'
                },
                lastname: {
                    required: 'Please select your last name'
                },
//                gender: {
//                    required: 'Please select your gender'
//                },
                terms: {
                    required: 'You must agree with Terms and Conditions'
                }
            },
            // Ajax form submition
//            submitHandler: function(form) {
//                $(form).ajaxSubmit({
//                    success: function() {
//                        $('#registration-form-form').addClass('submited');
//                    }
//                });
//            },
            // Do not change code below
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
            }
        });

    });
    ", CClientScript::POS_READY);

if (Yii::app()->user->hasFlash('registration')){
    $mess = Yii::app()->user->getFlash('registration');
    
    Yii::app()->clientScript->registerScript(
    "registeration_script",
    " 
    var mess = '".$mess."';
//    $.SmartMessageBox({
//            title : '<span class=\"txt-color-orangeDark\"><strong>irradii.com</strong></span>',
//            content : mess,
//            buttons : '[Ok]'
//
//    }, function(ButtonPressed) {
//            if (ButtonPressed == 'Ok') {
//                    $('#MsgBoxBack').addClass('animated fadeOutUp');
//            }
//
//    }); 
    $('.message').find('p').empty().html(mess);
    $('.message').css('display','block')
    ",  CClientScript::POS_END);
    }

$cs->registerScript("zipCodeInputFieldGoogleApi"," 
            
            var placeSearch, autocomplete;
            var componentForm = {
              street_number: 'short_name',
              route: 'long_name',
              locality: 'long_name',
              administrative_area_level_1: 'short_name',
              country: 'long_name',
//              postal_code: 'short_name'
            };

            function initialize() {
//                document.getElementById('autocomplete').value = (document.getElementById('street_number').value!='')?document.getElementById('street_number').value:''
//                +(document.getElementById('route').value!='')?', '+document.getElementById('route').value:''
//                +(document.getElementById('locality').value!='')?', '+document.getElementById('locality').value:''
//                +(document.getElementById('administrative_area_level_1').value!='')?', '+document.getElementById('administrative_area_level_1').value:''
//                +(document.getElementById('country').value!='')?' '+document.getElementById('country').value:'';
                autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocompleteSignUp'), { types: ['geocode'] });
                google.maps.event.addListener(autocomplete, 'place_changed', function() { fillInAddress(); });
            }

            // [START region_fillform]
            
            function fillInAddress() {
              // Get the place details from the autocomplete object.
              var place = autocomplete.getPlace();

              for (var component in componentForm) {
                document.getElementById(component).value = '';
//                document.getElementById(component).disabled = false;
              }

              // Get each component of the address from the place details
              // and fill the corresponding field on the form.
              
              for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                  var val = place.address_components[i][componentForm[addressType]];
                  document.getElementById(addressType).value = val;
                }
              }
            }
            // [END region_fillform]

            // [START region_geolocation]
            // Bias the autocomplete object to the user's geographical location,
            // as supplied by the browser's 'navigator.geolocation' object.
            
            function geolocate() {
              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                  var geolocation = new google.maps.LatLng(
                      position.coords.latitude, position.coords.longitude);
                  autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
                      geolocation));
                });
              }
            }
            // [END region_geolocation]
            ",  CClientScript::POS_END);

