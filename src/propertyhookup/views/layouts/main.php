<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php
		$cs        = Yii::app()->clientScript;
		$themePath = Yii::app()->theme->baseUrl;

		/**
		 * StyleSHeets
		 */
		$cs->registerCssFile(CPathCDN::baseurl( 'css' ) . '/css/bootstrap.css');
		$cs->registerCssFile(CPathCDN::baseurl( 'css' ) . '/css/bootstrap-theme.css');
                $cs->registerCssFile(CPathCDN::baseurl( 'css' ) . '/css/normalize.css');
//                $cs->registerCssFile(CPathCDN::baseurl( 'css' ) . '/css/styles-bootstrap.css');
                $cs->registerCssFile('//maxcdn.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css');

		/**
		 * JavaScripts
		 */
		$cs->registerCoreScript('jquery', CClientScript::POS_END);
		$cs->registerCoreScript('jquery.ui', CClientScript::POS_END);
//		$cs->registerScriptFile(CPathCDN::baseurl( 'js' ) . '/js/bootstrap/bootstrap.min.js', CClientScript::POS_END);
//		$cs->registerScript('tooltip', "$('[data-toggle=\"tooltip\"]').tooltip();$('[data-toggle=\"popover\"]').tooltip()", CClientScript::POS_READY);
//		$cs->registerScriptFile('//code.jquery.com/jquery-2.0.3.min.js', CClientScript::POS_END);
		$cs->registerScriptFile('//maxcdn.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', CClientScript::POS_END);
		$cs->registerScriptFile(CPathCDN::baseurl( 'js' ) . '/js/plugin/x-editable/x-editable.min.js', CClientScript::POS_END);
//		$cs->registerScriptFile(CPathCDN::baseurl( 'js' ) . '/js/plugin/select2/select2.min.js', CClientScript::POS_END);
	?>

        <!-- FAVICONS -->
        <link rel="shortcut icon" href="<?php echo CPathCDN::baseurl( 'img' ); ?>/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo CPathCDN::baseurl( 'img' ); ?>/img/favicon/favicon.ico" type="image/x-icon">

</head>

<body>

<div class="container-fluid" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
