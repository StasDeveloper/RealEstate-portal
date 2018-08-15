<?php
$cs = Yii::app()->clientScript;
$themePath = Yii::app()->theme->baseUrl;
$this->signin = CHtml::link('Sign In', array('/user/login'), array('class' => 'btn btn-danger'));
$this->layout = '//layouts/irradii';
$this->body_ID = 'id="login"';
$this->body_onload = 'onload="initialize()"';

?>
<?php
/* @var $this RegistrationController */
/* @var $model RegistrationForm */
/* @var $form BSActiveForm */
?>


<div id="main" role="main">
    
    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 hidden-xs hidden-sm">

                <div class="row">
                <div class="hero">

                    <img src="<?php echo CPathCDN::baseurl( 'img' ); ?>/img/demo/color_logo.png" class="display-image eye-logo-login-page" alt="" style="">
                    <div class="pull-left login-desc-box-ll col-xs-12 col-sm-12 col-md-6 col-lg-5">
                        <h1 class="txt-color-red login-header-big">Irradii Real Estate</h1>
                        <h4 class="paragraph-header">Real estate search just got a whole lot smarter! Irradii is your eye into a market full of valuable real estate opportunities all around you.</h4>
                        <div class="login-app-icons">
                            <a href="<?php echo Yii::app()->createUrl('property/search') ?>" class="btn btn-danger btn-sm">Search Now</a>
                            <a href="<?php echo Yii::app()->createUrl('blog') ?>" class="btn btn-danger btn-sm">Learn more</a>
                        </div>
                    </div>
                    <div class="pull-right login-desc-box-ll col-xs-12 col-sm-12 col-md-6 col-lg-7 " style="overflow: hidden;">

<!--                        <img src="--><?php //echo CPathCDN::baseurl( 'img' ); ?><!--/img/demo/color_logo.png" class="pull-right display-image" alt="" style="">-->

<!--                        <img src="--><?php //echo CPathCDN::baseurl( 'img' ); ?><!--/img/demo/city_background.png" class="pull-right " alt="" style="">-->
                        <img src="<?php echo CPathCDN::baseurl( 'img' ); ?>/img/demo/map_results.png" class="pull-right map_results_main_page" alt="" style="">
                    </div>
                </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <h5 class="about-heading">Find real estate opportunities all around you!</h5>
                        <p>
                            Our patent pending search technology crunches data on millions of property records each night to filter and find the best market value opportunities available each morning. Wake up each morning to a list of properties available for sale today that are 20% - 50%+ below market value! 
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <h5 class="about-heading">Our Promise to You -</h5>
                        <p>
                            We are dedicated to providing the most accurate real estate values, with tools to help you make stronger, faster and more educated real estate decisions - an edge that can save or make you tens of thousands of dollars.
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <div class="well no-padding">
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                        'id' => 'registration-form-form',
                        // Please note: When you enable ajax validation, make sure the corresponding
                        // controller action is handling ajax validation correctly.
                        // There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array('class' => 'smart-form client-form'),
                    ));
                    ?>

                    <header>Registration is FREE*</header>
                    <?php // echo $form->errorSummary($model); ?>
                    <fieldset>
                        <section>
                            <label class="input<?php
                                if(! User::model()->find('username=:username AND lastvisit_at=:lastvisit_at',array(':username'=>$model->attributes['username'], ':lastvisit_at'=>'0000-00-00 00:00:00'))) {
                                    echo $form->error($model, 'username') ? ' state-error' : '';
                                }
                            ?>"> <i class="icon-append fa fa-user"></i>
<!--                                    <input type="text" name="username" placeholder="Username">-->
                                <?php echo $form->textField($model, 'username', array('maxlength' => 130)); ?>
                                <?php
                                if(! User::model()->find('username=:username AND lastvisit_at=:lastvisit_at',array(':username'=>$model->attributes['username'], ':lastvisit_at'=>'0000-00-00 00:00:00'))){
                                    echo $form->error($model, 'username');
                                }
                                ?>
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
                                    <input  name="request" class="form-control" id="autocomplete" placeholder="Enter your City" onfocus="geolocate()" type="text" autocomplete="off">
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
                                <i></i>I agree with the <a href="#" data-toggle="modal" data-target="#myModal"> Terms and Conditions </a><br>
                                <?php echo $form->error($model, 'terms'); ?>
                            </label>
                        </section>
                    </fieldset>

                    <footer>

                        <?php echo BsHtml::submitButton('Register', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
                    </footer>

                    <div class="message">
                        <i class="fa fa-check"></i>
                        <p style="padding: 5px 10px;">
                            Thank you for your registration!
                        </p>
                    </div>
<?php $this->endWidget(); ?>


                </div>
                <p class="note text-center">*Registration is always free to access our standard tools, register now and check them out.</p>
                <!--                <h5 class="text-center">- Or sign in using -</h5>
                                <ul class="list-inline text-center">
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                </ul>-->
            </div>

            <h5 class="text-center margin-top-10"> - Or register using -</h5>

            <?php $this->widget('ext.hoauthwidgets.HOAuth'); ?>

        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
            </div>
            <div class="modal-body custom-scroll terms-body">

                <div id="left">

                    <h1>SMARTADMIN TERMS & CONDITIONS TEMPLATE</h1>

                    <h2>Introduction</h2>

                    <p>These terms and conditions govern your use of this website; by using this website, you accept these terms and conditions in full.   If you disagree with these terms and conditions or any part of these terms and conditions, you must not use this website.</p>

                    <p>[You must be at least [18] years of age to use this website.  By using this website [and by agreeing to these terms and conditions] you warrant and represent that you are at least [18] years of age.]</p>


                    <h2>License to use website</h2>
                    <p>Unless otherwise stated, [NAME] and/or its licensors own the intellectual property rights in the website and material on the website.  Subject to the license below, all these intellectual property rights are reserved.</p>

                    <p>You may view, download for caching purposes only, and print pages [or [OTHER CONTENT]] from the website for your own personal use, subject to the restrictions set out below and elsewhere in these terms and conditions.</p>

                    <p>You must not:</p>
                    <ul>
                        <li>republish material from this website (including republication on another website);</li>
                        <li>sell, rent or sub-license material from the website;</li>
                        <li>show any material from the website in public;</li>
                        <li>reproduce, duplicate, copy or otherwise exploit material on this website for a commercial purpose;]</li>
                        <li>[edit or otherwise modify any material on the website; or]</li>
                        <li>[redistribute material from this website [except for content specifically and expressly made available for redistribution].]</li>
                    </ul>
                    <p>[Where content is specifically made available for redistribution, it may only be redistributed [within your organisation].]</p>

                    <h2>Acceptable use</h2>

                    <p>You must not use this website in any way that causes, or may cause, damage to the website or impairment of the availability or accessibility of the website; or in any way which is unlawful, illegal, fraudulent or harmful, or in connection with any unlawful, illegal, fraudulent or harmful purpose or activity.</p>

                    <p>You must not use this website to copy, store, host, transmit, send, use, publish or distribute any material which consists of (or is linked to) any spyware, computer virus, Trojan horse, worm, keystroke logger, rootkit or other malicious computer software.</p>

                    <p>You must not conduct any systematic or automated data collection activities (including without limitation scraping, data mining, data extraction and data harvesting) on or in relation to this website without [NAME'S] express written consent.</p>

                    <p>[You must not use this website to transmit or send unsolicited commercial communications.]</p>

                    <p>[You must not use this website for any purposes related to marketing without [NAME'S] express written consent.]</p>

                    <h2>[Restricted access</h2>

                    <p>[Access to certain areas of this website is restricted.]  [NAME] reserves the right to restrict access to [other] areas of this website, or indeed this entire website, at [NAME'S] discretion.</p>

                    <p>If [NAME] provides you with a user ID and password to enable you to access restricted areas of this website or other content or services, you must ensure that the user ID and password are kept confidential.</p>

                    <p>[[NAME] may disable your user ID and password in [NAME'S] sole discretion without notice or explanation.]</p>

                    <h2>[User content</h2>

                    <p>In these terms and conditions, “your user content” means material (including without limitation text, images, audio material, video material and audio-visual material) that you submit to this website, for whatever purpose.</p>

                    <p>You grant to [NAME] a worldwide, irrevocable, non-exclusive, royalty-free license to use, reproduce, adapt, publish, translate and distribute your user content in any existing or future media.  You also grant to [NAME] the right to sub-license these rights, and the right to bring an action for infringement of these rights.</p>

                    <p>Your user content must not be illegal or unlawful, must not infringe any third party's legal rights, and must not be capable of giving rise to legal action whether against you or [NAME] or a third party (in each case under any applicable law).</p>

                    <p>You must not submit any user content to the website that is or has ever been the subject of any threatened or actual legal proceedings or other similar complaint.</p>

                    <p>[NAME] reserves the right to edit or remove any material submitted to this website, or stored on [NAME'S] servers, or hosted or published upon this website.</p>

                    <p>[Notwithstanding [NAME'S] rights under these terms and conditions in relation to user content, [NAME] does not undertake to monitor the submission of such content to, or the publication of such content on, this website.]</p>

                    <h2>No warranties</h2>

                    <p>This website is provided “as is” without any representations or warranties, express or implied.  [NAME] makes no representations or warranties in relation to this website or the information and materials provided on this website.</p>

                    <p>Without prejudice to the generality of the foregoing paragraph, [NAME] does not warrant that:</p>
                    <ul>
                        <li>this website will be constantly available, or available at all; or</li>
                        <li>the information on this website is complete, true, accurate or non-misleading.</li>
                    </ul>
                    <p>Nothing on this website constitutes, or is meant to constitute, advice of any kind.  [If you require advice in relation to any [legal, financial or medical] matter you should consult an appropriate professional.]</p>

                    <h2>Limitations of liability</h2>

                    <p>[NAME] will not be liable to you (whether under the law of contact, the law of torts or otherwise) in relation to the contents of, or use of, or otherwise in connection with, this website:</p>
                    <ul>
                        <li>[to the extent that the website is provided free-of-charge, for any direct loss;]</li>
                        <li>for any indirect, special or consequential loss; or</li>
                        <li>for any business losses, loss of revenue, income, profits or anticipated savings, loss of contracts or business relationships, loss of reputation or goodwill, or loss or corruption of information or data.</li>
                    </ul>
                    <p>These limitations of liability apply even if [NAME] has been expressly advised of the potential loss.</p>

                    <h2>Exceptions</h2>

                    <p>Nothing in this website disclaimer will exclude or limit any warranty implied by law that it would be unlawful to exclude or limit; and nothing in this website disclaimer will exclude or limit [NAME'S] liability in respect of any:</p>
                    <ul>
                        <li>death or personal injury caused by [NAME'S] negligence;</li>
                        <li>fraud or fraudulent misrepresentation on the part of [NAME]; or</li>
                        <li>matter which it would be illegal or unlawful for [NAME] to exclude or limit, or to attempt or purport to exclude or limit, its liability.</li>
                    </ul>
                    <h2>Reasonableness</h2>

                    <p>By using this website, you agree that the exclusions and limitations of liability set out in this website disclaimer are reasonable.</p>

                    <p>If you do not think they are reasonable, you must not use this website.</p>

                    <h2>Other parties</h2>

                    <p>[You accept that, as a limited liability entity, [NAME] has an interest in limiting the personal liability of its officers and employees.  You agree that you will not bring any claim personally against [NAME'S] officers or employees in respect of any losses you suffer in connection with the website.]</p>

                    <p>[Without prejudice to the foregoing paragraph,] you agree that the limitations of warranties and liability set out in this website disclaimer will protect [NAME'S] officers, employees, agents, subsidiaries, successors, assigns and sub-contractors as well as [NAME].</p>

                    <h2>Unenforceable provisions</h2>

                    <p>If any provision of this website disclaimer is, or is found to be, unenforceable under applicable law, that will not affect the enforceability of the other provisions of this website disclaimer.</p>

                    <h2>Indemnity</h2>

                    <p>You hereby indemnify [NAME] and undertake to keep [NAME] indemnified against any losses, damages, costs, liabilities and expenses (including without limitation legal expenses and any amounts paid by [NAME] to a third party in settlement of a claim or dispute on the advice of [NAME'S] legal advisers) incurred or suffered by [NAME] arising out of any breach by you of any provision of these terms and conditions[, or arising out of any claim that you have breached any provision of these terms and conditions].</p>

                    <h2>Breaches of these terms and conditions</h2>

                    <p>Without prejudice to [NAME'S] other rights under these terms and conditions, if you breach these terms and conditions in any way, [NAME] may take such action as [NAME] deems appropriate to deal with the breach, including suspending your access to the website, prohibiting you from accessing the website, blocking computers using your IP address from accessing the website, contacting your internet service provider to request that they block your access to the website and/or bringing court proceedings against you.</p>

                    <h2>Variation</h2>

                    <p>[NAME] may revise these terms and conditions from time-to-time.  Revised terms and conditions will apply to the use of this website from the date of the publication of the revised terms and conditions on this website.  Please check this page regularly to ensure you are familiar with the current version.</p>

                    <h2>Assignment</h2>

                    <p>[NAME] may transfer, sub-contract or otherwise deal with [NAME'S] rights and/or obligations under these terms and conditions without notifying you or obtaining your consent.</p>

                    <p>You may not transfer, sub-contract or otherwise deal with your rights and/or obligations under these terms and conditions.</p>

                    <h2>Severability</h2>

                    <p>If a provision of these terms and conditions is determined by any court or other competent authority to be unlawful and/or unenforceable, the other provisions will continue in effect.  If any unlawful and/or unenforceable provision would be lawful or enforceable if part of it were deleted, that part will be deemed to be deleted, and the rest of the provision will continue in effect.</p>

                    <h2>Entire agreement</h2>

                    <p>These terms and conditions [, together with [DOCUMENTS],] constitute the entire agreement between you and [NAME] in relation to your use of this website, and supersede all previous agreements in respect of your use of this website.</p>

                    <h2>Law and jurisdiction</h2>

                    <p>These terms and conditions will be governed by and construed in accordance with [GOVERNING LAW], and any disputes relating to these terms and conditions will be subject to the [non-]exclusive jurisdiction of the courts of [JURISDICTION].</p>

                    <h2>About these website terms and conditions</h2><p>We created these website terms and conditions with the help of a free website terms and conditions form developed by Contractology and available at <a href="http://www.SmartAdmin.com">www.SmartAdmin.com</a>.
                        Contractology supply a wide variety of commercial legal documents, such as <a href="#">template data protection statements</a>.
                    </p>
                    <h2>[Registrations and authorisations</h2>

                    <p>[[NAME] is registered with [TRADE REGISTER].  You can find the online version of the register at [URL].  [NAME'S] registration number is [NUMBER].]</p>

                    <p>[[NAME] is subject to [AUTHORISATION SCHEME], which is supervised by [SUPERVISORY AUTHORITY].]</p>

                    <p>[[NAME] is registered with [PROFESSIONAL BODY].  [NAME'S] professional title is [TITLE] and it has been granted in [JURISDICTION].  [NAME] is subject to the [RULES] which can be found at [URL].]</p>

                    <p>[[NAME] subscribes to the following code[s] of conduct: [CODE(S) OF CONDUCT].  [These codes/this code] can be consulted electronically at [URL(S)].</p>

                    <p>[[NAME'S] [TAX] number is [NUMBER].]]</p>

                    <h2>[NAME'S] details</h2>

                    <p>The full name of [NAME] is [FULL NAME].</p>

                    <p>[[NAME] is registered in [JURISDICTION] under registration number [NUMBER].]</p>

                    <p>[NAME'S] [registered] address is [ADDRESS].</p>

                    <p>You can contact [NAME] by email to [EMAIL].</p>



                </div>

                <br><br>

                <p><strong>By using this  WEBSITE TERMS AND CONDITIONS template document, you agree to the 
                        <a href="#">terms and conditions</a> set out on 
                        <a href="#">SmartAdmin.com</a>.  You must retain the credit 
                        set out in the section headed "ABOUT THESE WEBSITE TERMS AND CONDITIONS".  Subject to the licensing restrictions, you should 
                        edit the document, adapting it to the requirements of your jurisdiction, your business and your 
                        website.  If you are not a lawyer, we recommend that you take professional legal advice in relation to the editing and 
                        use of the template.</strong></p>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary" id="i-agree">
                    <i class="fa fa-check"></i> I Agree
                </button>

                <button type="button" class="btn btn-danger pull-left" id="print">
                    <i class="fa fa-print"></i> Print
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<?php
$cs->registerScript("val_reg_form", "runAllForms();

    // Model i agree button
    $('#i-agree').click(function() {
        _this = $('#RegistrationForm_terms');
        if (_this.checked) {
            $('#myModal').modal('toggle');
        } else {
            _this.prop('checked', true);
            $('#myModal').modal('toggle');
        }
    });

    // Validation
    $(function() {
        // Validation
        $('#registration-form-form').validate({
            // Rules for form validation
            rules: {
                username: {
                    required: true,
//                    email: true
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

    });", CClientScript::POS_END);

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
    $('.message').css('display','block');


    var title = 'Thank you for registering with Irradii.com!';
    var mess = 'We\'ve sent an activation link to your email address. Please check your email and click on the link, and don\'t forget to check your junk mail boxes.';
    $.SmartMessageBox({
            title : '<span class=\"txt-color-orangeDark\"><strong>'+title+'</strong></span>',
            content : mess,
            buttons : '[Ok]'

    }, function(ButtonPressed) {
            if (ButtonPressed == 'Ok') {
                    $('#MsgBoxBack').addClass('animated fadeOutUp');
            }

    });

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
                autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'), { types: ['geocode'] });
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

