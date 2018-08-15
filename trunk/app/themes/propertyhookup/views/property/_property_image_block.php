<?php

$content = "<a href=" . Yii::app()->createAbsoluteUrl('property/details', array( 'slug'=>$property_model->slug->slug)) . " >";
$content .= CPathCDN::checkPhoto($property_model, "thumb-img-140", 0 );
$content .= "</a>";
$discont = $property_model->getDiscontValue();

if ($discont >= Yii::app()->params['underValueDeals']) {
    $content .= '<br><span class="label bg-color-greenDark">' . round($discont) . '% Below TMV</span>';
}

echo $content;