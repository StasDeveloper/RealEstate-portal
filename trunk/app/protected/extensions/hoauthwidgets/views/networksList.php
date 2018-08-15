<?php
/**
 * @var $sns array of array('provider' => $network->provider, 'profileUrl' => $network->profile->profileURL, 'deleteUrl' => $deleteUrl)
 */

$cs = Yii::app()->clientScript;
$hrefPage = isset(Yii::app()->params['hrefPage'])? Yii::app()->params['hrefPage'] : '';
?>
<div id="fb-root"></div>
<ul class="hoauthSNList list-inline text-center margin-top-10 margin-bottom-10">
<?php
	foreach($sns as $sn)
	{
		list($provider, $profileUrl, $deleteUrl, $setting) = array_values($sn);
                $class = isset($setting['class']) ? $setting['class'] : 'btn btn-primary btn-circle';
                $classIcon = isset($setting['classIcon']) ? $setting['classIcon'] : ''; // 'fa fa-facebook'
                $appId = isset($setting['AppId']) ? $setting['AppId'] : '';
                if($provider == 'Facebook') {
                    $cs->registerScript("FBInitScript","
                    (function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = '//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=$appId';
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                    ", CClientScript::POS_BEGIN);    
                }
?>
                <li> <a  target="_blank" href="<?php echo $profileUrl ?>" class="<?php echo $class ?>"><i class="<?php echo $classIcon ?> "></i></a>
                    <?php    echo CHtml::ajaxLink('<i class="glyphicon glyphicon-remove text-warning"></i>' , $deleteUrl, array(
			'type' => 'post', 
			'context' => 'js:this',
                        'data' => '',
			'beforeSend' => "js:function() { return confirm('" . HOAuthAction::t('If you remove this social network account, you will you will not be able to login with it.\\n\\nDo you realy want to remove this account?') . "');}",
			'success' => 'js:function() {$(this).parent().remove(); location.reload()}',
		), array('class'=>"hoauthSNUnbind btn btn-dafault btn-xs btn-circle  margin-right-5")) ; 
                    if($provider == 'Facebook') : ?>
                    <div class="fb-send" data-layout="button" data-href="<?php echo $hrefPage ?>" data-kid-directed-site="false"></div>
                    <?php endif; ?>
                </li>
<?php /*/ ?>                      
<div class="fb-share-button" data-href="<?php echo $hrefPage ?>"  data-layout="button"></div>
<?php /*/ ?>
	<?php } ?>
</ul>
