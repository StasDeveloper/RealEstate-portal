<?php

/**
 * Reload slug 
 *  ./yiic CronSitemap    // create if slug is empty
 *  ./yiic CronSitemap all
 */
class CronSitemapCommand extends CConsoleCommand {
    private $reloadAll = false;

    /**
     * Whether or not to use absolute URLs
     * @var bool
     */
    public $absoluteUrls = true;

    /**
     * List of protected controllers, eg:
     * array('admin', 'maintenance')
     * This has no effect if you have 
     * specified $actions array
     * @var array
     */
    public $protectedControllers = array();

    /**
     * List of protected actions, eg:
     * array('user/login', 'post/delete')
     * This has no effect if you have 
     * specified $actions array
     * @var array
     */
    public $protectedActions = array();

    /**
     * List of actions used for generating the sitemap
     * @var array
     */
    public $actions = array();

    /**
     * Default sitemap preferences.
     * @var array
     */
    public $priority, $changefreq, $lastmod;

    /**
     * ID of the caching component
     * (defaults to 'cache')
     * @var string
     */
    public $cacheId = 'cache';

    /**
     * Number of seconds cached data will remain valid.
     * Set to 0 to disable caching
     * @var int
     */
    public $cachingDuration = 600; // 3600;

    /**
     * CCache instance
     * @var CCache
     */
    protected $_cache;

    
    protected $viewPath='application.views.sitemap';

    protected $layoutPath='application.views.sitemap.layouts';

    protected $layout;

    protected $view;

    protected $data;

    protected $limit = 10000;
    protected $sitemapLimit;
    
    protected $fileCount = 0;
    
    protected $urlCount = 0;

    protected $urlIndexFiles = array();

    protected $fileName = 'sitemap';

    private $sitemap_url = 'http://img1.irradii.com/sitemap/';
    private $sitemap_path = 'sitemap/';
    private $bucket = 'props3photos';
    
    private $nameRedisId ;


    public function run($args = array()) {
        ini_set("memory_limit","300M");
        $this->getParams($args);
        $this->actions = isset(Yii::app()->params['sitemap']['actions'])? Yii::app()->params['sitemap']['actions'] : array();
        $this->sitemapLimit = isset(Yii::app()->params['sitemapLimit'])? Yii::app()->params['sitemapLimit'] : 45000;
        $this->nameRedisId = isset(Yii::app()->params['sitemapRedisId'])? Yii::app()->params['sitemapRedisId'] : 'siteMapCron';

        $start = time();
        $this->writeToLog("\r\n Start Sitemap at ". date('Y-m-d H:i:s', $start)); 
        $this->createSitemapFiles();
        $end = time();
        $this->writeToLog('Finished Sitemap at '. date('Y-m-d H:i:s', $end) . ' time=' . SiteHelper::timeElapsed($end-$start) . ' max memory=' . memory_get_peak_usage());
    }
    
    private function writeToLog($content) {
        $filename = Yii::app()->basePath.'/runtime/cronSitemap.log';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }
        
        fclose($fp); 
    }
    
    public function createSitemapFiles(){
//        $this->urlIndexFiles = array('eeeeeeeeee'=>array('lastmod'=>'123456789'));
        $urls = $this->getSpecifiedUrls();
        
        $this->createSitemap($urls);
        $this->fileCount++;

        unset($urls);
        $urls = array();
        $this->urlCount = 0;

        if(Yii::app()->redisCache->executeCommand('SET',array($this->nameRedisId,CJSON::encode($this->urlIndexFiles))))
        {
//            Yii::app()->redisCache->executeCommand('EXPIRE',array($this->nameRedisId,$this->cachingDuration));
        }

        
    }

    public function getParams($args) {
        foreach ($args as $value) {
            switch (strtolower($value)) {
                case 'all':
                    $this->reloadAll = true;
                    break;

                default:
                    break;
            }
        }
    }

	/**
	 * Returns an array of URLs specifed in SitemapModule::$actions, with sitemap preferences.
	 * URLs are returned as keys, preferences as values, eg:
	 * array(
	 * 		'http://example.org/index.html' => array(
	 * 			'lastmod' => '1980-08-31', 
	 * 			'changefreq' => 'daily', 
	 * 			'priority' => '0.8'
	 * 		),
	 * 		'http://example.org/login' => array(
	 * 			'lastmod' => '1985-11-05', 
	 * 			'changefreq' => 'daily', 
	 * 			'priority' => '0.5'
	 * 		),
	 * )
	 * @return array
	 */	
	public function getSpecifiedUrls()
	{
		
		$urls = array();
		
		foreach ($this->actions as $action)
		{
			$config = array();
			
			//action may be given as a string and as an array, in which case it must contain 'route' key
			if (is_array($action))
			{
				if (!isset($action['route']))
					throw new CHttpException(500, 'Action configuration must contain a "route" key');
				$config = $action;
				$action = $action['route'];
			}

			//evaluate condition
			if (isset($config['condition']) and !eval($config['condition']))
				continue;
			
			//apply params (if supplied)
			if (isset($config['params']))
			{
				//model used to generate params
				if (isset($config['params']['model']) and isset($config['params']['model']['class']))
				{
					$class = $config['params']['model']['class'];
			
					if (!class_exists($class))
						throw new CHttpException(500, "Class $class not found");
					$criteria = @$config['params']['model']['criteria'];
//Yii::log('Start ' . memory_get_usage(),'ERROR');
                                        
                                    $lastId = 0;
                                    $cycle = 0;
                                    $count_rows = 0;
                                    do {
                                        $cycle++;
					//fetch all model instances
                                        $models = $class::model()->findAll(array(
                                            'condition'=>(isset($criteria['condition'])?$criteria['condition'] . ' AND ':'') . 'id >' . $lastId ,
                                            'limit'=> $this->limit,
                                        ));
                                        if ( $models !== false ){
                                            $count_rows = count($models);
                                            if($count_rows > 0) {
                                                foreach ($models as $model)
                                                {
                                                    $lastId = $model->id;
                                                    $args = array();
                                                    //build arguments from model attributes
                                                    foreach ($config['params']['model']['map'] as $param => $attribute)
                                                            $args[$param] = $this->getModelAttribute($model, $attribute);

                                                    $this->addUrl($urls, $action, $args, @$config['prefs']);
                                                }
                                            }
                                        }
                                    } while ( $models && $count_rows );
//Yii::log('Stop ' . memory_get_usage(),'ERROR');
				}
				//array used to generate params
				elseif (isset($config['params']['array']))
					foreach ($config['params']['array'] as $args)
						$this->addUrl($urls, $action, $args, @$config['prefs']);
			}
			//no params
			else
				$this->addUrl($urls, $action, array(), @$config['prefs']);
		}

		return $urls;
	}

	/**
	 * Returns the value of the specified attribute
	 * in the provided model
	 * @param CModel $model
	 * @param string $attribute
	 * @throws CHttpException
	 */
	protected function getModelAttribute($model, $attribute)
	{
		$class = get_class($model);
		if (!$model->hasAttribute($attribute) and !$model->hasProperty($attribute))
			throw new CHttpException(500, "Class $class does not have a property named $attribute");
		return $model->$attribute;
	}
	
	/**
	 * Adds an URL to the specified array.
	 * @param array $urls
	 * @param string $action
	 * @param array $args
	 * @param array $prefs
	 */
	protected function addUrl(&$urls, $action, $args = array(), $prefs = null)
	{
		if ($this->absoluteUrls)
			$url = Yii::app()->createAbsoluteUrl($action, $args);
		else
			$url =  Yii::app()->createUrl($action, $args);		
		
		if (!$prefs)
			$prefs = array();
		
		$defPrefs = array(
			'lastmod' => $this->lastmod ? $this->lastmod : date('Y-m-d'),
			'changefreq' => $this->changefreq ? $this->changefreq : 'always',
			'priority' => $this->priority ? $this->priority : 0.5,
		);
		$prefs = array_merge($defPrefs, $prefs);
		
		$urls[$url] = $prefs;
                $this->urlCount++;
                if($this->urlCount >= $this->sitemapLimit) {
                    $this->createSitemap($urls);
                    $this->fileCount++;
            
//                    unset($urls);
                    $urls = array();
                    $this->urlCount = 0;
                }
	}

	protected function createSitemap(&$urls)
	{
            if (!Yii::app()->s3)
                    throw new CException('You need to configure the S3 component or set the variable s3Component properly');

            if(isset(Yii::app()->controller))
                $controller = Yii::app()->controller;
            else
                $controller = new CController('Sitemap');

            $viewPath = Yii::getPathOfAlias($this->viewPath.'.xml').'.php';

            $body = $controller->renderInternal($viewPath, array('urls' => $urls), true);

            $nameFile = "{$this->fileName}-{$this->fileCount}.xml";
            
            $this->urlIndexFiles[$this->sitemap_url.$nameFile] = array(
                'lastmod' => date('Y-m-d'),
            );
            
            Yii::app()->s3->putObjectString(
                    $body, 
                    $this->bucket,  
                    $this->sitemap_path . $nameFile);

        }

}
