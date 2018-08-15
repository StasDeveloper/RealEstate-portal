<?php

class LandingModule extends CWebModule
{
    /**
     * @var string the ID of the default controller for this module. Defaults to 'default'.
     */
    public $defaultController='page';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'landing.models.*',
			'landing.components.*',
			'blog.models.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
