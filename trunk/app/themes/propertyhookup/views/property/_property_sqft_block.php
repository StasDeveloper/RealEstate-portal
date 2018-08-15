<?php

$content = '';
$content .= $property_model->house_square_footage ? $property_model->house_square_footage . ' Sq Ft<br>' : '';
$content .= $property_model->lot_acreage ? $property_model->lot_acreage . ' Acre Lot<br>' : '';
$content .= $property_model->getPropertyType();


echo $content;