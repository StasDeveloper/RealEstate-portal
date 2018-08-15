<?php
/**
 * View to display `yii-user` authentication errors
 * 
 * @var $errorCode error code from `yii-user` module UserIdentity class
 * @var $user current user model
 */

$error = HOAuthAction::t('Sorry, but your account') . ' ';
switch($errorCode)
{
	case UserIdentity::ERROR_STATUS_NOTACTIV:
	$error .= HOAuthAction::t('must be activated! Check your email for details!');
	break;
	case UserIdentity::ERROR_STATUS_BAN:
	$error .= HOAuthAction::t('is banned!');
	break;
}
$title = '';

Yii::app()->clientScript->registerScript(
    "activation_script",
    " 
    var title = '".$title."';
    var mess = '".$error."';
    $.SmartMessageBox({
            title : '<span class=\"txt-color-orangeDark\"><strong>'+title+'</strong></span>',
            content : mess,
            buttons : '[Close]'

    }, function(ButtonPressed) {
            if (ButtonPressed == 'Close') {
                    $('#MsgBoxBack').addClass('animated fadeOutUp');
                    window.close();
            }

    }); 
    
    ",  CClientScript::POS_END);