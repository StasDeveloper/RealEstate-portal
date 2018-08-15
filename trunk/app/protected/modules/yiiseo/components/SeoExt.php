<?php

class SeoExt extends CApplicationComponent
{
    /* массив, который будет наполнятся тэгами, что бы исключать уже найденые теги в ссылках выше по иерархии */
    public $exist = array();

    public function run($language = null){

        /*
         * получаем все возможные сслыки по Иерархии
         * Пример: исходная ссылка "site/product/type/34"
         * Результат:   - site/product/type/34/*
                        - site/product/type/34
                        - site/product/type/*
                        - site/product/type
                        - site/product/*
                        - site/product
                        - site/*
                        - site
                        - /*
                        - /
         */
        $urls = $this->getUrls();

        foreach($urls as $url)
        {
            $crt = new CDbCriteria();
            $crt->condition = "url = :param";
            $crt->params = array(":param"=>$url);
            if($language != null) {
                $crt->addCondition("language = '".$language."'",'AND');
            }
            $dependency = new CDbCacheDependency('SELECT max(updated_at) FROM yiiseo_url' );
            $urlF = YiiseoUrl::model()->cache(1000,$dependency)->find($crt);
            if($urlF !== null){
                $this->seoName($urlF->id);
            }
        }

        $boolean = false;
        foreach($urls as $url)
        {
            $crt = new CDbCriteria();
            $crt->condition = "url = :param";
            $crt->params = array(":param"=>$url);
            if($language != null) {
                $crt->addCondition("language = '".$language."'",'AND');
            }
            $dependency = new CDbCacheDependency('SELECT max(updated_at) FROM yiiseo_url' );
            $urlF = YiiseoUrl::model()->cache(1000,$dependency)->find($crt);
            if($urlF !== null)
                $boolean = $this->seoProperty($urlF->id);

            if($boolean) break;

        }

    }

    private function seoName($url)
    {
        $content = null;
        $crt = new CDbCriteria();
        $crt->condition = "url = :param AND active = '1'";
        $crt->params = array(":param"=>$url);

        $dependency = new CDbCacheDependency('SELECT max(updated_at) FROM yiiseo_main' );
        $seoRes = YiiseoMain::model()->cache(1000,$dependency)->findAll($crt);

        if(!empty($seoRes)){
            foreach($seoRes as $res)
            {
                if(!in_array($res->name,$this->exist))
                {
                    $this->exist[]=$res->name;
                    $content = $res->content;
                    if($content != "_null"){
                        $matches = array();
                        preg_match_all('#{(.+?)}#ims', $content, $matches);
                        
                        if(!empty($matches[0])) {
                            foreach ($matches[0] as $key => $value) {
                                $param = $this->getSeoparam($value);
                                $content = str_replace ($value, $param, $content);
                            }
                        }
                        $this->printMeta($res->name,$content);
                    }
                }
            }
        }

    }

    /*
    Данная функция находит все MetaProperty, по ссылке
    $url - ссылка по которой будут искаться property
    работает до первого нахождения свойств
    */
    private function seoProperty($url)
    {
        $content = null;
        $crt = new CDbCriteria();
        $crt->condition = "url = :param";
        $crt->params = array(":param"=>$url);

        $dependency = new CDbCacheDependency('SELECT max(updated_at) FROM yiiseo_property' );
        $seoRes = YiiseoProperty::model()->cache(1000,$dependency)->findAll($crt);

        if(!empty($seoRes)){
            foreach($seoRes as $res)
            {
                $content = $res->content;
                if($content != "_null"){
                    $matches = array();
                    preg_match_all('#{(.+?)}#ims', $content, $matches);

                    if(!empty($matches[0])) {
                        foreach ($matches[0] as $key => $value) {
                            $param = $this->getSeoparam($value);
                            $content = str_replace ($value, $param, $content);
                        }
                    }
                    $this->printProperty($res->name,$content);
                }
            }
            return true;
        }
        else
            return false;

    }

    /*
     * функция вывода Мета Тега на страницу
     * @name - название мета-тега
     * @content - значение
     */
    private function printMeta($name,$content)
    {
        $content = strip_tags($content);
        if($name == "keywords")
            $content = str_replace (',', ", ", $content);
        if($name == "title")
            echo "<title>$content</title>\n";
        else{
            echo "<meta name='$name' content='$content' />\n";
        }
    }

    /*
    * функция вывода Мета Property на страницу
    * @name - название мета-property
    * @content - значение
    */
    private function printProperty($name,$content)
    {
        $content = strip_tags($content);
        echo "<meta property='$name' content='$content' />\n";
    }

    /*
    * функция , которая находит все ссылки по иерархии, начиная с той на которой находится пользователь
    */
    private function getUrls()
    {
        $result = null;
        $urls = Yii::app()->request->url;
        $data = explode("/",$urls);
        unset($data[0]);

        while(!empty($data))
        {
            $_url = "";
            $i = 0;
            foreach($data as $key=>$d)
            {
                $_url .= $i++ ? "/".$d : $d ;
            }

            $result[] = $_url."/*";
            $result[] = $_url;
            unset($data[$key]);

        }
        $result[] = "/*";
        $result[] = "/";

        return $result;
    }

    /*
    * функция возвращающая значение параметра если он указан
    * Существуют два типа параметров прямой (ModelName/attribyte) или по связи (ModelName/relation>>attribyte)
    */
    private function getSeoparam($param)
    {
        $param = trim($param, '{}');
        if(!empty(Yii::app()->controller->yiiseo_model)) {
            if(strstr($param, ">>")){
                $data = explode(">>",$param);
                $param = explode("/",$data[0]);
                if(!empty(Yii::app()->controller->yiiseo_model[$param[0]])){
                    $item = Yii::app()->controller->yiiseo_model[$param[0]];
                    if(!empty($item)){
                        if(!empty($item[$param[1]]) && isset($item[$param[1]][$data[1]])) {
                            return $item[$param[1]][$data[1]];
                        } else {
                            Yii::log('Undefined SEO Url params :' . print_r($param,1),'trace');
                        }
                    }
                }
                return "";
            }
            else{
                $param = explode("/",$param);
                if(!empty(Yii::app()->controller->yiiseo_model[$param[0]])){
                    $item = Yii::app()->controller->yiiseo_model[$param[0]];
                    if(!empty($item)){
                        if(isset($item[$param[1]])) {
                            return $item[$param[1]];
                        } else {
                            Yii::log('Undefined SEO Url params :' . print_r($param,1),'trace');
                        }
                    }
                }
                return "";
            }
        } else {
            return "";
        }
    }

}
