<?php
/* @var $this RegistrationController */
                        /* @var $model RegistrationStep1 */
                        /* @var $form BSActiveForm */
$cs = Yii::app()->clientScript;
$themePath = Yii::app()->theme->baseUrl;
$this->signin = CHtml::link('Create account', array('/user/registration'), array('class'=>'btn btn-danger'));
$this->layout = '//layouts/irradii';
$this->body_ID = 'id="login"';
?>



<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">

                <div class="row">
                <div class="hero">

                    <img src="<?php echo CPathCDN::baseurl( 'img' ); ?>/img/demo/color_logo.png" class="display-image eye-logo-login-page" alt="" style="">
                    <div class="pull-left login-desc-box-ll col-xs-12 col-sm-12 col-md-6 col-lg-5">
                        <h1 class="txt-color-red login-header-big">Irradii Real Estate</h1>
                        <h4 class="paragraph-header">Real estate search just got a whole lot smarter! Irradii is your eye into a market full of valuable real estate opportunities all around you.</h4>
                        <div class="login-app-icons">
                            <a href="<?php echo Yii::app()->createUrl('property/search') ?>" class="btn btn-danger btn-sm">Search Now</a>
                            <a href="<?php echo Yii::app()->createUrl('blog') ?>" class="btn btn-danger btn-sm">Visit our Blog</a>
                        </div>
                    </div>
                    <div class="pull-right login-desc-box-ll col-xs-12 col-sm-12 col-md-6 col-lg-7 " style="overflow: hidden;">

<!--                        <img src="--><?php //echo CPathCDN::baseurl( 'img' ); ?><!--/img/demo/color_logo.png" class="pull-right display-image" alt="" style="">-->

                        <?php /*<img src="<?php echo CPathCDN::baseurl( 'img' ); ?>/img/demo/city_background.png" class="pull-right " alt="" style=""> */ ?>
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
                        <h5 class="about-heading">Our Promise to You - </h5>
                        <p>
                            We are dedicated to providing the most accurate real estate values, with tools to help you make stronger, faster and more educated real estate decisions - an edge that can save or make you tens of thousands of dollars.
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                <div class="well no-padding">
                    <div class="form">

                        
                        <?php
                        $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                            'id' => 'login-form',
                            // Please note: When you enable ajax validation, make sure the corresponding
                            // controller action is handling ajax validation correctly.
                            // There is a call to performAjaxValidation() commented in generated controller code.
                            // See class documentation of CActiveForm for details on this.
                            'enableAjaxValidation' => false,
                            'htmlOptions' => array('class' => 'smart-form client-form'),
                        ));
                        ?>
                        <header>
                            Sign In
                        </header>
                        <?php // echo $form->errorSummary($model); ?>
                         <fieldset>

                            <section>
                                <label class="label">E-mail</label>
                                <label class="input<?php echo $form->error($model,'username') ? ' state-error' : '';?>"> <i class="icon-append fa fa-user"></i>
<!--                                    <input type="email" name="email">-->
                                    <?php echo $form->textField($model, 'username', array('maxlength' => 130)); ?>
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b>
                                <?php echo $form->error($model,'username'); ?>
                                </label>
                               
                            </section>

                            <section>
                                <label class="label">Password</label>
                                <label class="input<?php echo $form->error($model,'password') ? ' state-error' : '';?>"> <i class="icon-append fa fa-lock"></i>
<!--                                    <input type="password" name="password">-->
                                    <?php echo $form->passwordField($model, 'password', array('maxlength' => 32)); ?>
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> 
                                <?php echo $form->error($model,'password'); ?>
                                </label>
                                <div class="note">
                                    <?php echo BsHtml::link('Forgot password?', Yii::app()->createUrl('/user/recovery'))?>
<!--                                    <a href="javascript:void(0)">Forgot password?</a>-->
                                </div>
                            </section>

                            <section>
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" checked="">
                                    <i></i>Stay signed in</label>
                            </section>
                        </fieldset>
                        <footer>
                            <?php echo BsHtml::submitButton('Free 30 day trial', array('class'=>"btn btn-warning pull-left"/*'color' => BsHtml::BUTTON_COLOR_PRIMARY*/)); ?>
                            <?php echo BsHtml::submitButton('Sign in', array('class'=>"btn btn-primary"/*'color' => BsHtml::BUTTON_COLOR_PRIMARY*/)); ?>
                        </footer>

                        <?php $this->endWidget(); ?>
                        


                    </div>
<?php /*/ ?>
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
                    </ul>
<?php /*/ ?>
                </div>

                <h5 class="text-center"> - Or sign in using -</h5>

                <?php $this->widget('ext.hoauthwidgets.HOAuth'); ?>
                    
            </div>
        </div>

    </div>
    <?php 
    $title = isset($_GET['title']) ? $_GET['title'] : '';
    $act_content = isset($_GET['content']) ? $_GET['content'] : '';
    if ($title && $act_content){
    
    
    Yii::app()->clientScript->registerScript(
    "activation_script",
    " 
    var title = '".$title."';
    var mess = '".$act_content."';
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
