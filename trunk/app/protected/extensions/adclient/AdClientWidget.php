<?php

class AdClientWidget extends CWidget
{
    public $property;

//    public function init()
//    {
//
//    }

    /**
     * 
     */	
    public function run()
    {
        if($this->property) {
            $adclients = AdClient::model()->suggestToProperty($this->property);

            foreach ($adclients as $adclient) {
                $this->render('small', array(
                        'adclient' => $adclient,
                    ));
            }
        }
    }

}
