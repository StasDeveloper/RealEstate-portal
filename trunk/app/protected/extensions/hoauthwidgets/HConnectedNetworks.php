<?php
/**
 * HConnectedNetworks shows the list with networks, that user connected to
 * 
 * @uses CWidget
 * @version 1.2.5
 * @copyright Copyright &copy; 2013 Sviatoslav Danylenko
 * @author Sviatoslav Danylenko <dev@udf.su> 
 * @license MIT ({@link http://opensource.org/licenses/MIT})
 * @link https://github.com/SleepWalker/hoauth
 */

class HConnectedNetworks extends CWidget
{
	public $tag = 'ul';

	public function run()
	{
//		require_once(dirname(__FILE__).'/../models/UserOAuth.php');
//		require_once(dirname(__FILE__).'/../HOAuthAction.php');
                Yii::import('ext.hoauth.*');
		require_once('models/UserOAuth.php');
		require_once('HOAuthAction.php');


    	// provider delete action
		if(Yii::app()->request->isPostRequest && isset($_GET['hoauthDelSN']))
		{
			ob_clean();
			ob_clean();
			$userNetwork = UserOAuth::model()->findUser(Yii::app()->user->id, $_GET['hoauthDelSN']);
			if($userNetwork)
			{
				$userNetwork->delete();
			}
			Yii::app()->end();
		}

		$userNetworks = UserOAuth::model()->findUser(Yii::app()->user->id);
		$sns = array();
                $config = UserOAuth::getConfig();
                $settings = !empty($config['providers'])?$config['providers']:array();
		foreach($userNetworks as $network)
		{
			$deleteUrl = '?hoauthDelSN='.$network->provider;
			try
			{
				array_push($sns, array('provider' => $network->provider, 'profileUrl' => $network->profileCache->profileURL, 'deleteUrl' => $deleteUrl
                                        , 'setting' => array('class' => $settings[$network->provider]['class'], 'classIcon' => $settings[$network->provider]['classIcon'], 'AppId' => $settings[$network->provider]['keys']['id']) ));
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
			}
		}

		$this->render('networksList', array(
			'sns' => $sns,
			));
	}
}
