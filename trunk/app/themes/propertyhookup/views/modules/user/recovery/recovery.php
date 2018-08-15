<?php
/* @var $this RegistrationController */
/* @var $model RegistrationStep1 */
/* @var $form BSActiveForm */
$cs = Yii::app()->clientScript;
$themePath = Yii::app()->theme->baseUrl;
$this->signin = CHtml::link('Create account', array('/user/registration'), array('class' => 'btn btn-danger'));
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

                    <div class="pull-left login-desc-box-ll col-xs-12 col-sm-12 col-md-6 col-lg-5">
                        <h1 class="txt-color-red login-header-big">Irradii Real Estate</h1>
                        <h4 class="paragraph-header">Real estate search just got a whole lot smarter! Irradii is your eye into a market full of valuable real estate opportunities all around you.</h4>
                        <div class="login-app-icons">
                            <a href="javascript:void(0);" class="btn btn-danger btn-sm">Search Now</a>
                            <a href="javascript:void(0);" class="btn btn-danger btn-sm">Learn more</a>
                        </div>
                    </div>
                    <div class="pull-right login-desc-box-ll col-xs-12 col-sm-12 col-md-6 col-lg-7 " style="overflow: hidden;">

                        <img src="<?php echo CPathCDN::baseurl( 'img' ); ?>/img/demo/color_logo.png" class="pull-right display-image" alt="" style="">

                        <img src="<?php echo CPathCDN::baseurl( 'img' ); ?>/img/demo/city_background.png" class="pull-right " alt="" style="">
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
                    <?php if (Yii::app()->user->hasFlash('recoveryMessage')): ?>
                        <div class="success">
                            <?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
                        </div>
                    <?php else: ?>
                        <?php
                        $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                            'id' => 'UserRecoveryForm',
                            //'method'=>'get',
                            // Please note: When you enable ajax validation, make sure the corresponding
                            // controller action is handling ajax validation correctly.
                            // There is a call to performAjaxValidation() commented in generated controller code.
                            // See class documentation of CActiveForm for details on this.
                            'enableAjaxValidation' => false,
                            'htmlOptions' => array('class' => 'smart-form client-form'),
                        ));
                        ?>

                        <header>
                            Forgot Password
                        </header>

                        <fieldset>

                            <section>
                                <label class="label">Enter your email address</label>
                                <label class="input<?php echo $form->error($model, 'login_or_email') ? ' state-error' : ''; ?>"> <i class="icon-append fa fa-envelope"></i>
    <!--                                    <input type="email" name="email">-->
                                    <?php echo $form->textField($model, 'login_or_email'); ?>
                                    <b class="tooltip tooltip-top-right">
                                        <i class="fa fa-envelope txt-color-teal"></i> Please enter email address for password reset</b>
                                    <?php echo $form->error($model, 'login_or_email') ?>
                                </label>
                            </section>

                            <section>

                                <div class="note">
                                    <a href="<?php echo  Yii::app()->createUrl('/user/login'); ?>">I remembered my password!</a>
                                </div>
                            </section>

                        </fieldset>
                        <footer>
                            <?php echo BsHtml::submitButton('Reset Password', array('class' => "btn btn-primary", 'icon' => BsHtml::GLYPHICON_REFRESH)); ?>
                            <!--                            <button type="submit" class="btn btn-primary">
                                                            <i class="fa fa-refresh"></i> Reset Password
                                                        </button>-->
                        </footer>
                        <?php $this->endWidget(); ?>
                    <?php endif; ?>
                </div>

                <!--                <h5 class="text-center"> - Or sign in using -</h5>
                
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
        </div>
    </div>

</div>

