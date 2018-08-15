<?php

class ActualInfoIsNull
{
    private $valueArray = array();

    public function __set($name, $value)
    {
        $this->valueArray[$name] = $value;
    }

    public function __get($name){
        $name = 0;
        return $this->valueArray[$name] = "<span style='color:#999999'>N/A</span>";
    }

    public function __call($name, $arguments)
    {
        return '';
    }
}