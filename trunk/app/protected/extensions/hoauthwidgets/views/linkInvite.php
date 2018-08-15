<?php
/**
 * @var HOAuthWidget $this
 * @var string $provider name of provider
 */
$cs = Yii::app()->clientScript;
                                      
$invitation = Yii::app()->user->isGuest ? HOAuthAction::t('Sign in with') : HOAuthAction::t('Connect with');

$class = isset($settings['class']) ? $settings['class'] : 'btn btn-primary btn-circle';
$classIcon = isset($settings['classIcon']) ? $settings['classIcon'] : ''; // 'fa fa-facebook'
$appId = isset($settings['keys']['id']) ? $settings['keys']['id']:'';
$hrefPage = isset(Yii::app()->params['hrefPage'])? Yii::app()->params['hrefPage'] : '';
?>
<li>
    <div class="row margin-bottom-10">
        <div class="col-xs-6">
            <a href="<?php echo Yii::app()->createUrl($this->route . '/oauth', array('provider' => $provider)); ?>" class="<?php echo $class ?>"><i class="<?php echo $classIcon ?>"></i></a>
        </div>
        <div class="col-xs-6">
<?php            switch ($provider) {
                case 'Facebook':
                        $cs->registerScript("FBInitScript","
                        (function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = '//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=$appId';
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
                        ", CClientScript::POS_BEGIN);    
?>
                    <div class="fb-send" data-layout="button" data-href="<?php echo $hrefPage ?>" data-kid-directed-site="false"></div>
<?php
                    break;

                default: ?>
                    <div class="btn btn-primary">Find contacts</div>
<?php               break;
            }
?>
        </div>
    </div>
</li>