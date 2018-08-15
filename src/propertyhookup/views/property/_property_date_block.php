<?php

$content = '';
$content .= str_replace("-", "/", $property_model->property_updated_date);
$content .= '<br>';

$datetime_now = new DateTime();
$datetime_exp = new DateTime($property_model->property_updated_date);
$interval = $datetime_now->diff($datetime_exp);
$quantity = $interval->days;
$discont = $property_model->getDiscontValue();

$prop_stat_caps = '';
if(isset($property_model->propertyInfoAdditionalBrokerageDetails->status))
    $prop_stat_caps = strtoupper($property_model->propertyInfoAdditionalBrokerageDetails->status);

$status_p = $discont >= Yii::app()->params['underValueDeals'] ? 'under value' : $prop_stat_caps ;
$content .= $quantity ? $quantity . ' DOM' : '';
$content .= '<br>';


echo $content;