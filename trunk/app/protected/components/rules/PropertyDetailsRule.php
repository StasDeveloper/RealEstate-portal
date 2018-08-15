<?php
class PropertyDetailsRule extends CBaseUrlRule
{
    public $connectionID = 'db';
 
    public $urlSuffix;

    public function createUrl($manager,$route,$params,$ampersand)
    {
        $routeArr = explode('/', $route);
        if ($routeArr[0] ==='property' && $routeArr[1] ==='details' && is_numeric($routeArr[2]))
        {
            $property_models = PropertyInfo::model()->cache(1000, null)->with('city', 'county', 'state', 'zipcode')->findByAttributes(array('property_id' => $routeArr[2]));
            if(!empty($property_models)) {
                $suffix=$this->urlSuffix===null ? $manager->urlSuffix : $this->urlSuffix;

		$url='property/details/' . str_replace(' ', '-', $property_models->getFullAddress());

		if($this->hasHostInfo) {
			$hostInfo=Yii::app()->getRequest()->getHostInfo();
			if(stripos($url,$hostInfo)===0)
				$url=substr($url,strlen($hostInfo));
		}

		if(empty($params)) {
			return $url!=='' ? $url.$suffix : $url;
                }
		if($this->append) {
			$url.='/'.$manager->createPathInfo($params,'/','/').$suffix;
                } else {
			if($url!=='')
				$url.=$suffix;
			$url.='?'.$manager->createPathInfo($params,'=',$ampersand);
		}

		return $url;
            }
        }
        return false;
    }
 
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        $routeArr = explode('/', $pathInfo);
        if ($routeArr[0] ==='property' && $routeArr[1] ==='details' && !empty($routeArr[2]) && !is_numeric($routeArr[2])) {

            return 'property/details/' . $routeArr[2];
        }
        return false;
    }
}