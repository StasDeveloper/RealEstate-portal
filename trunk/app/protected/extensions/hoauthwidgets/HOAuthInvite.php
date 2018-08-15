<?php
/**
 * HOAuth provides widget with buttons for login with social networs 
 * that enabled in HybridAuth config
 * 
 * @uses CWidget
 * @version 1.2.5
 * @copyright Copyright &copy; 2013 Sviatoslav Danylenko
 * @author Sviatoslav Danylenko <dev@udf.su> 
 * @license MIT ({@link http://opensource.org/licenses/MIT})
 * @link https://github.com/SleepWalker/hoauth
 */

/**
 * NOTE: If you want to change the order of button it is better to change this order in HybridAuth config.php file
 */
class HOAuthInvite extends CWidget
{
	/**
	 * @var string $route id of module and controller (eg. module/controller) for wich to generate oauth urls
	 */
	public $route = '/user/login';

        public function init()
	{
		if(!$this->route)
			$this->route = $this->controller->module ? $this->controller->module->id . '/' . $this->controller->id : $this->controller->id;

                Yii::import('ext.hoauth.*');
		require_once('models/UserOAuth.php');
		require_once('HOAuthAction.php');
	}

	public function run()
	{
		$config = UserOAuth::getConfig();

		echo CHtml::openTag('div', array(
			'id' => 'fb-root',
			));
		echo CHtml::closeTag('div');
		echo CHtml::openTag('ul', array(
			'id' => 'hoauthWidget' . $this->id,
			'class' => 'hoauthWidget list-unstyled text-center margin-top-5 margin-bottom-10',
			));

		foreach($config['providers'] as $provider => $settings) {
			if($settings['enabled']) {
				$this->render('linkInvite', array(
					'provider' => $provider,
                                        'settings' => $settings,
                                        
				));
                        }
                }
		echo CHtml::closeTag('ul');
	}

}
