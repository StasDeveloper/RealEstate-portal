<?php   
$property_model;
$content = '';
$content .= $property_model->property_street.'<br>';
$content .= $property_model->city ? $property_model->city->city_name . ', ' : '';
$content .= $property_model->state ? $property_model->state->state_code . ' ' : '';
$content .= $property_model->zipcode ? $property_model->zipcode->zip_code : '';
$content .= '<br>';
$community = $property_model->community_name || $property_model->community_name != 'None' ? $property_model->community_name : '';
if ($community == '') {
    $community = $property_model->subdivision ? $property_model->subdivision : '';

}
if ($community == '') {
    $community = $property_model->area ? $property_model->area : '';
}
$content .= $community ? ucwords(strtolower($community)) . '<br>' : '';
if ($property_model->brokerage_join) {
    $brokerage_name = $property_model->brokerage_join->brokerage_name ? $property_model->brokerage_join->brokerage_name : '';
    if ($brokerage_name) {
        $content .= ucwords(strtolower($brokerage_name));
    }
}

echo $content;