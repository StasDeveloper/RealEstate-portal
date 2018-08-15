<?php
/**
 * @var HOAuthWidget $this
 * @var string $provider name of provider
 */
                                        
$additionalClass = $this->onlyIcons ? 'icon' : '';
$invitation = Yii::app()->user->isGuest ? HOAuthAction::t('Sign in with') : HOAuthAction::t('Connect with');

$class = isset($settings['class']) ? $settings['class'] : 'btn btn-primary btn-circle';
$classIcon = isset($settings['classIcon']) ? $settings['classIcon'] : ''; // 'fa fa-facebook'

?>
<?php /*/ ?>
<p>
    <a href="<?php echo Yii::app()->createUrl($this->route . '/oauth', array('provider' => $provider)); ?>" class="zocial <?php echo $additionalClass . ' ' . strtolower($provider) ?>"><?php echo  "$invitation $provider"; ?></a>
</p>
<?php /*/ ?>
<li>
    <a href="<?php echo Yii::app()->createUrl($this->route . '/oauth', array('provider' => $provider)); ?>" class="<?php echo $class ?>"><i class="<?php echo $classIcon ?>"></i></a>
</li>