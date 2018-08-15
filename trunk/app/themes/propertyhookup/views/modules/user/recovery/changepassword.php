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
				<section class="well no-padding form">
					<div class="smart-form client-form">

						<header>
							<?php echo UserModule::t("Change password"); ?>
						</header>



						<?php echo CHtml::beginForm(); ?>

						<p class="note" style="padding: 0 14px"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
						<?php echo CHtml::errorSummary($form); ?>

						<fieldset>
							<section>
								<label class="label">Password*</label>
								<?php/* echo CHtml::activeLabelEx($form,'password'); */?>
								<?php echo CHtml::activePasswordField($form,'password', array ('class' => 'form-control')); ?>
								<p class="hint">
									<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
								</p>
							</section>

							<section>
								<label class="label">Retype Password*</label>
								<?php /*echo CHtml::activeLabelEx($form,'verifyPassword'); */?>
								<?php echo CHtml::activePasswordField($form,'verifyPassword', array ('class' => 'form-control')); ?>
							</section>
						</fieldset>


						<footer>
							<?php echo CHtml::submitButton(UserModule::t("Save"), array('class' => 'btn btn-primary btn-default')); ?>
						</footer>



						<?php echo CHtml::endForm(); ?>
					</div>
				</section>
			</div>
		</div>

	</div>
</div>