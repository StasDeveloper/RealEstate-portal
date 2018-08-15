<?php

$content = '';
$content .= $property_model->bedrooms ? $property_model->bedrooms . " Beds/<br>" : '';
$content .= $property_model->bathrooms ? $property_model->bathrooms . ' Baths/<br>' : '';
$content .= $property_model->garages ? $property_model->garages . ' Car Gar' : '';

echo $content;