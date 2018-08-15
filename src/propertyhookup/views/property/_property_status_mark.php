<?php
if(isset($property_model->propertyInfoAdditionalBrokerageDetails->status))
{
    $status = $property_model->propertyInfoAdditionalBrokerageDetails->status;
    $percentage = $property_model->getDiscontValue();
    $discount = $percentage >= Yii::app()->params['underValueDeals'];
    $colorScheme = SiteHelper::getColorScheme($status,$discount);
    $statusColor = $colorScheme['label-color'];

    echo '<span class="label '.$statusColor.'">'.$status.'</span>';
}