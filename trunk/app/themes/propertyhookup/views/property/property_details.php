<?php
$cs = Yii::app()->clientScript;
$themePath = Yii::app()->theme->baseUrl;
$session = Yii::app()->session;
$enableAds = Yii::app()->params['googleAdSenseEnable'];

$property_type_array = array('0' => 'Unknown', '1' => 'Single Family Home', '2' => 'Condo', '3' => 'Townhouse', '4' => 'Multi Family', '5' => 'Land', '6' => 'Mobile Home', '7' => 'Manufactured Home', '8' => 'Time Share', '9' => 'Rental', '16' => 'High Rise');
$pool_array = array('0' => 'No', '1' => 'Yes');
$amenities_stove_id_array = array('0' => 'No', '1' => 'Stove/Oven', '2' => 'Stove Top Only');
$amenities_washer_id_array = array('0' => 'No', '1' => 'Washer/Dryer', '2' => 'Dryer Only', '3' => 'Shared Washer/Dryer');
$amenities_fireplace_id_array = array('0' => 'No', '1' => 'Wood Burning', '2' => 'Natural Gas');
$amenities_parking_id_array = array('0' => 'Not Listed', '1' => 'Street Parking', '2' => 'Driveway Parking', '3' => 'Reserved Parking', '4' => 'Carport', '5' => '1 Car Garage', '6' => '2 Car Garage', '7' => '3 Car Garage', '8' => '4 Car Garage', '9' => '5+ Car Garage', '10' => 'Permit Parking Only');
$over_all_property_array = array('1' => 'Is ready to move in', '2' => 'Needs a little TLC', '3' => 'Is a moderate fixer upper', '4' => 'Needs major repair');
$discont = $details->getDiscontValue();
if($details->property_type == 9){
    $postfix_after_rounded ='';
    $round_value = 1;
} else {
    $postfix_after_rounded ='K';
    $round_value = 1000;
}
$p_type = isset($details->property_type) ? " - ".$property_type_array[$details->property_type] : '';

$this->title = $details->fullAddress.$p_type;
$uri_page = '@'.Yii::app()->request->url;
$recent_pages = $details->fullAddress.$p_type.$uri_page;

if(!isset($session['recent_pages']) || count($session['recent_pages'])==0){
    $session['recent_pages'] = array($recent_pages);
} else {
    $sess_arr = $session['recent_pages'];
    $sess_arr[]=$recent_pages;
    $session['recent_pages'] = $sess_arr;
}
$colorScheme = SiteHelper::defineColorScheme($details);
$text_color_if_discont = SiteHelper::getColorIfUnderValueOrEquityDeals($details);

$listOrSold = $details->property_type == 9 ? 'RENT PRICE' : 'LIST PRICE';
$icon = '<i class="fa '.$colorScheme['icon'].' fa-fw '.$colorScheme['color'].'"></i>';
$icon_map_lg = '<i class="fa '.$colorScheme['icon_map_lg'].' fa-fw '.$colorScheme['color'].'"></i>';
$icon_map_sm = '<i class="fa '.$colorScheme['icon_map_sm'].' fa-fw '.$colorScheme['color'].'"></i>';
$status_str = '<span class="'.$text_color_if_discont.'"> $' . number_format($details->property_price) . '</span>'  ;
$status_str2 = 'Last Updated: ' . date('m/d/Y', strtotime($details->property_updated_date));
$sparks_true_marker_value = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 931, 1071, 930, 1031</div>';
$sparks_mo_mo_chg = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 931, 1071, 930, 1031</div>';
$sparks_true_marker = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 931, 1071, 930, 1031</div>';
$sparks_page_views = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 931, 1071, 930, 1031</div>';
$foreclosure = '<span class="'.$text_color_if_discont.'">Foreclosure</span>';
$shortsale = '<span class="'.$text_color_if_discont.'">Short Sale</span>';
$txt_view_color = $text_color_if_discont    ;
if (isset($details->propertyInfoAdditionalBrokerageDetails->status)) {
    $prop_stat_caps = '<h5 class="'.$colorScheme["color"].'">'.strtoupper($details->propertyInfoAdditionalBrokerageDetails->status).'</h5>';
    $property_sale_date = date('m/d/Y', strtotime($details->property_updated_date));
    $property_price = number_format($details->property_price);
    $status_str2 = 'Last Updated: ' . $property_sale_date;

    if (preg_match("/^HISTORY$/", $prop_stat_caps)) {
        $status_str = $prop_stat_caps . '<span class="'.$text_color_if_discont.'"> $' . $property_price .  '</span>'  ;
        $sparks_true_marker_value = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1000, 1000, 1000, 1000, 1000</div>';
        $sparks_mo_mo_chg = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1000, 1000, 1000, 1000, 1000</div>';
        $sparks_true_marker = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1000, 1000, 1000, 1000, 1000</div>';
        $sparks_page_views = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1000, 1000, 1000, 1000, 1000</div>';
    } else if ((preg_match("/^RECENTLY SOLD$/", $prop_stat_caps)) or (preg_match("/^CLOSED$/", $prop_stat_caps)) or (preg_match("/^SOLD$/", $prop_stat_caps)) or (preg_match("/^LEASED$/", $prop_stat_caps)) or (preg_match("/^TEMPOFF$/", $prop_stat_caps)) or (preg_match("/^NOT FOR SALE$/", $prop_stat_caps)) or (preg_match("/^TEMPORARILY OFF THE MARKET$/", $prop_stat_caps))
    ) {
        $listOrSold = $details->property_type == 9 ? 'LEASED PRICE' : 'SOLD PRICE';
        $status_str = $prop_stat_caps . '<span class="'.$text_color_if_discont.'"> $' . $property_price .  '</span>'  ;
        $sparks_true_marker_value = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1010, 1009, 1008, 1007, 1006, 1005</div>';
        $sparks_mo_mo_chg = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1010, 1009, 1008, 1007, 1006, 1005</div>';
        $sparks_true_marker = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1010, 1009, 1008, 1007, 1006, 1005</div>';
        $sparks_page_views = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1010, 1009, 1008, 1007, 1006, 1005</div>';
    } else if ((preg_match("/^FORECLOSURE$/", $prop_stat_caps)) or (preg_match("/^SHORT SALE$/", $prop_stat_caps)) or (preg_match("/^AUCTION$/", $prop_stat_caps)) or (preg_match("/^CONTINGENT OFFER$/", $prop_stat_caps)) or (preg_match("/^PENDING OFFER$/", $prop_stat_caps))
    ) {
        $status_str = $prop_stat_caps . '<span class="'.$text_color_if_discont.'"> $' . $property_price .  '</span>'  ;
        $sparks_true_marker_value = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 831, 1171, 930, 1031</div>';
        $sparks_mo_mo_chg = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 831, 1171, 930, 1031</div>';
        $sparks_true_marker = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 831, 1171, 930, 1031</div>';
        $sparks_page_views = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 831, 1171, 930, 1031</div>';
    } else if ((preg_match("/^FOR SALE$/", $prop_stat_caps)) or (preg_match("/^ACTIVE$/", $prop_stat_caps)) or (preg_match("/^ACTIVE­EXCLUSIVE RIGHT$/", $prop_stat_caps)) or (preg_match("/^EXCLUSIVE AGENCY$/", $prop_stat_caps))
    ) {
        $status_str = $prop_stat_caps . '<span class="'.$text_color_if_discont.'"> $' . $property_price .  '</span>'  ;
        $sparks_true_marker_value = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 931, 1071, 930, 1031</div>';
        $sparks_mo_mo_chg = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 931, 1071, 930, 1031</div>';
        $sparks_true_marker = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 931, 1071, 930, 1031</div>';
        $sparks_page_views = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 931, 1071, 930, 1031</div>';
    } else if (preg_match("/^OPPORTUNITY$/", $prop_stat_caps)) {
        $status_str = $prop_stat_caps . '<span class="'.$text_color_if_discont.'"> $' . $property_price .  '</span>'  ;
        $sparks_true_marker_value = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">2000, 2700, 3231, 3871, 4100, 4631</div>';
        $sparks_mo_mo_chg = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">2000, 2700, 3231, 3871, 4100, 4631</div>';
        $sparks_true_marker = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">2000, 2700, 3231, 3871, 4100, 4631</div>';
        $sparks_page_views = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">2000, 2700, 3231, 3871, 4100, 4631</div>';
    } else {
        $status_str = $prop_stat_caps . '<span class="'.$text_color_if_discont.'"> $' . $property_price .  '</span>'  ;
        $sparks_true_marker_value = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 931, 1071, 930, 1031</div>';
        $sparks_mo_mo_chg = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 931, 1071, 930, 1031</div>';
        $sparks_true_marker = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 931, 1071, 930, 1031</div>';
        $sparks_page_views = '<div class="sparkline '.$text_color_if_discont.' hidden-mobile hidden-md hidden-sm">1000, 1200, 931, 1071, 930, 1031</div>';
    }
}


if ($discont >= Yii::app()->params['underValueDeals']) {
    $estimatedEquity = $details->getEstimatedEquity($details->estimated_price, $details->property_price);
    $estimatedEquity = number_format($estimatedEquity,0,'.',',');
}
$status_str2 .= '<span class="views-for-equity"> Page Views <span><i class="fa fa-eye"></i>&nbsp;<span id="jarviswidget-ctrls">'.$details->views.'</span></span></span>';

$slider_arr = array();
//Yii::log('Step 2: ' . print_r($details->propertyInfoPhoto,1) ,'ERROR');
$photoArr = $this->getPhotoArr($details);
//Yii::log('Step 2-2: ' . print_r($photoArr,1) ,'ERROR');

foreach ($photoArr as $propertyInfoPhoto) {
    $photocaption = $propertyInfoPhoto->caption ? "<p>{$propertyInfoPhoto->caption}</p>" : '';
    $slider_arr[] = '<div class="item">' . CPathCDN::checkPhoto($propertyInfoPhoto, "", 0 ) . $photocaption . '</div>';
    unset($photocaption);
}
?>

<!--aside-->
<?php
if (!Yii::app()->user->isGuest) {
    echo $this->renderPartial('/layouts/aside', array('profile' => $profile));
}
?>
<!-- END NAVIGATION -->
<!-- MAIN PANEL -->
<div id="main" role="main" class="<?php echo Yii::app()->user->isGuest ? 'guest-variant' : ''; ?>">

    <!-- RIBBON -->
    <div id="ribbon" class="<?php echo Yii::app()->user->isGuest ? 'ribbon-guest-variant' : ''; ?>">

        <span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all of your personalized widget settings." data-html="true"><i class="fa fa-refresh"></i></span> </span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>
                Home
            </li>
            <li>
                Real Estate for Sale
            </li>
            <li>
                <?php echo isset($details->state->state_code) ? '<a>' . $details->state->state_code . '</a> ' : ''; ?>
            </li>
            <li>
                <?php echo isset($details->city->city_name) ? '<a>' . $details->city->city_name . '</a> ' : ''; ?>
            </li>
            <li>
                <?php echo (isset($details->property_zipcode) &&
            ($details->property_zipcode != 0) &&
            ($details->property_zipcode != '') &&
            ($details->zipcode) ) ? '<a>' . $details->zipcode->zip_code . '</a>' : ''; ?>
            </li>



        </ol>
<?php /*/ ?>
        <span class="ribbon-button-alignment pull-right">
            <a href="javascript:void(0);" class="btn btn-ribbon" id="save"> 
                <span class="btn-label"><i class="glyphicon glyphicon-check"></i></span>Save </a>
            <a href="javascript:void(0);" class="btn btn-ribbon" id="share"> 
                <span class="btn-label"><i class="glyphicon glyphicon-share"></i></span>Share </a>
            <a href="javascript:void(0);" class="btn btn-ribbon hidden-xs" id="print"> 
                <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Print</a>


            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span>
        <!-- end breadcrumb -->

        <!-- You can also add more buttons to the
        ribbon for further usability

        Example below:

        <span class="ribbon-button-alignment pull-right">
        <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i>TRACK</span>
        <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i>SAVE</span>
        <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">PRINT</span></span>
         
         </span> -->
<?php /*/ ?>
    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                <h1 class="page-title txt-color-blueDark">
<?php echo $icon_map_lg; ?>
<?php echo $details->property_street; ?>
                    <span>
<?php echo isset($details->city->city_name) ? '<a class="search-field-query" data-subdivision="" data-zipcode="" data-city="'.$details->city->city_name.'" data-state="'. $details->state->state_code .'">' . $details->city->city_name . '</a>, ' : ''; ?>
<?php echo isset($details->state->state_code) ? '<a class="search-field-query" data-subdivision="" data-zipcode="" data-city="" data-state="'. $details->state->state_code .'">' . $details->state->state_code . '</a> ' : ''; ?>
<?php

isset($details->city) ? $_city = $details->city->city_name : $_city = '';
isset($details->state) ? $_state = $details->state->state_code : $_state = '';
echo (isset($details->property_zipcode) &&
            ($details->property_zipcode != 0) &&
            ($details->property_zipcode != '') &&
            ($details->zipcode) ) ?
                '<a class="search-field-query" data-subdivision="" data-city="'.$_city
                .'" data-state="'. $_state .'" data-zipcode="'
                . $details->zipcode->zip_code .'">'
                . $details->zipcode->zip_code
                . '</a>' : ''; ?>
                    </span>

                </h1>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                <ul id="sparks" class="header-prices">
                    <li class="sparks-info <?php echo $text_color_if_discont ?>">
                        <h5>
                            <?php echo $status_str; ?>
                        </h5>
                    </li>
                    <li class="sparks-info">
<!-- # stage=<?php if (property_exists($comparebles_properties, 'current_stage')) { echo $comparebles_properties->current_stage; ?> # -->
                        <script>
                            var current_stage = <?php echo $comparebles_properties->current_stage; ?>;
                        </script>
                        <?php } ?>
<!-- # estimated_price=<?php if (property_exists($comparebles_properties, 'estimated_price')) { echo $comparebles_properties->estimated_price;} ?> # -->
<!-- # estimated_value_subject_property_stage=<?php if (property_exists($comparebles_properties, 'estimated_value_subject_property_stage')) { echo $comparebles_properties->estimated_value_subject_property_stage;} ?> # -->
                        <h5> <?php echo $details->property_type == 9 ? 'True Market Rent' : 'True Market Value' ?>
                            <?php
if (property_exists($comparebles_properties, 'estimated_price_dollar')) {

    //redefine $discont if there is $comparebles_properties->estimated_price_dollar
    if($comparebles_properties->estimated_price_dollar != 0){
        $discont = 100 - ($details->property_price * 100 / $comparebles_properties->estimated_price_dollar);
    }

    echo $comparebles_properties->estimated_price_dollar != 0 ? '<span class="">$' . number_format(round($comparebles_properties->estimated_price_dollar)) . '</span>' : '<span title="Not Enough Data" class="">-</span>';
} else {
    echo '<span title="Not Enough Data" class="">-</span>';
}
?>
                            <a id="goToComparables" href="javascript:void(0);">View Comparables</a>
                        </h5>
                        <!--                        <div class="sparkline txt-color-green hidden-mobile hidden-md hidden-sm">
                                                    3000, 2700, 3231, 2871, 3100, 3631
                                                </div>-->
                    <?php // echo $sparks_true_marker_value; ?>
                    </li>

<?php /*/ ?>
                    <li class="sparks-info">
                        <h5> Mo/Mo Chg <span class="txt-color-green"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;5%</span></h5>
                        <!--                        <div class="sparkline txt-color-green hidden-mobile hidden-md hidden-sm">
                                                    110,150,300,130,200,240,220,310
                                                </div>-->
<?php echo $sparks_mo_mo_chg; ?>
                    </li>
<?php /*/ ?>
                    <?php if(property_exists($comparebles_properties, 'low_range') && property_exists($comparebles_properties, 'high_range')) :?>
                    <li class="sparks-info">
                        <h5> Value Range <span class="<?php echo $text_color_if_discont ?>">$<span class="<?php echo $text_color_if_discont ?> low_value_b" id="">
                        <?php echo number_format(round($comparebles_properties->low_range / $round_value ),0,'.',',') . $postfix_after_rounded ; ?>
                                </span>-$<span class="<?php echo $text_color_if_discont ?> high_value_b" id="">
                        <?php echo number_format(round($comparebles_properties->high_range / $round_value),0,'.',',') . $postfix_after_rounded; ?>
                                </span>
                            </span>
                        </h5>
                    </li>
                    <?php endif; ?>

                    <?php
                    if ($discont >= Yii::app()->params['underValueDeals']) {
                        ?>
                        <li class="sparks-info">
                            <h5>
                                <?php echo $details->property_type == 9 ? 'Estimated Spread' : 'Estimated Equity' ?>
                                <span class="<?php echo $text_color_if_discont ?>">$
                                    <?php
                                    if(isset($comparebles_properties->estimated_price_dollar) && $comparebles_properties->estimated_price_dollar != 0 && $discont >= Yii::app()->params['underValueDeals']){
                                        $estimatedEquity = $details->getEstimatedEquity($comparebles_properties->estimated_price_dollar, $details->property_price);
                                        $estimatedEquity = number_format($estimatedEquity,0,'.',',');
                                    }
                                    echo $estimatedEquity;
                                    ?>
                                </span>
                            </h5>
                        </li>
                        <li class="sparks-info">
                            <h5> Below <?php echo $details->property_type == 9 ? 'TMR' : 'TMV' ?> <span class="<?php echo $text_color_if_discont ?>"><?php echo round($discont) ?>%</span></h5>
                        </li>
                    <?php } ?>

                    &nbsp;&nbsp;
                </ul>
            </div>
        </div>

        <!-- widget grid -->
        <section id="widget-grid" class="">

            <!-- row -->

            <div class="row">

                <article class="col-sm-12 col-md-12 col-lg-9">

                    <!-- new widget -->
                    <div class="jarviswidget jarviswidget-sortable" id="wid-id-2dt-c" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">

                        <!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                        data-widget-colorbutton="false"
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true"
                        data-widget-sortable="false"

                        -->

                        <header>
                            <?php if($user_property_info != null) :?>
                                <?php $bgColorOfStatuses = SiteHelper::getColorSchemeOfUserPropertyStatus($user_property_info->user_property_status)?>
                            <div class="user-property-status" style="float:left;display: inline-block">
                                <div class="btn-group hidden-phone pull-left">
                                    <a id="status-button" class="btn dropdown-toggle btn-sm <?php echo $bgColorOfStatuses;?>" data-toggle="dropdown"><span><?php echo $user_property_info->user_property_status; ?></span> <span class="caret"> </span> </a>
                                    <ul class="dropdown-menu pull-left">
                                        <li>
                                            <a href="javascript:void(0);" data-status="Saved">Save</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-status="Dismissed">Dismiss</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-status="Offered">Offer</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-status="Purchased">Purchase</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-status="Rejected">Reject</a>
                                        </li>
                                    </ul>
                                </div>

                                <span><?php echo date('m/d/Y',strtotime($user_property_info->last_viewed_date)) ;?></span>
                            </div>
                            <?php endif;?>
                            <span class="widget-icon"> <?php echo $icon; ?> </span>
<!--                            <h2>-->
                            <h3 class="header-status-and-views" style="">
                                <?php echo $status_str2; ?>
                            </h3>
<!--                            </h2>-->
<?php if (count($slider_arr) > 0): ?>
                                <div class="widget-toolbar hidden-mobile">
                                    <span class="onoffswitch-title">Slideshow</span>
                                    <span class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked="checked" id="myonoffswitch">
                                        <label class="onoffswitch-label" for="myonoffswitch"> <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span> <span class="onoffswitch-switch"></span> </label> </span>
                                </div>
<?php endif; ?>
                        </header>
                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- photo slide fade widget content -->

                            <div class="col-sm-9 col-md-9 col-lg-9" id="parentCarouselBlock">



                            <?php if (count($slider_arr) > 0): ?>
                                    <div id="myCarousel" class="carousel fade">
                                        <ol class="carousel-indicators">
    <?php for ($i = 0; $i <= count($slider_arr); $i++) : ?>
        <?php if ($i == 0): ?>
                                                    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="active"></li>
        <?php else : ?>
                                                    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class=""></li>
        <?php endif; ?>
    <?php endfor; ?>

                                        </ol>
                                        <div class="carousel-inner">

                                            <!-- Slide 1 -->
                                            <div class="item active">
    <?php
//        echo CPathCDN::checkPhoto($details, "", 0 );

    if (strtolower(substr($details->photo1, 0, 4)) === 'http') {
        $file_headers=Yii::app()->cache->get($details->photo1);
        if($file_headers===false)
        {
//            $file_headers = @get_headers($details->photo1);
            $file_headers = CPathCDN::checkS3Photo($details->photo1);
            Yii::app()->cache->set($details->photo1,$file_headers, 1000);
        }
        if($file_headers[0] != 'HTTP/1.1 404 Not Found') {
            echo CPathCDN::checkPhoto($details, "", 0 );
        } else {
            echo $slider_arr[0];
        }
    } else {
        $photo1 = CPathCDN::baseurl( 'images' ) . '/images/property_image/' . $details->photo1;
        $photo1_file = Yii::app()->basePath . "/../images/property_image/" . $details->photo1;
        if (is_readable($photo1_file)) {
            echo '<img src="' . $photo1 . '" alt="' . $details->getFullAddress() . '">';
        } else {
            echo $slider_arr[0];
        }
    }

    ?>
                                                <?php echo $details->caption1 ? "<p>{$details->caption1}</p>" : ''; ?>



                                            </div>

                                            <!-- Slide 2 -->
                                                <?php
                                                foreach ($slider_arr as $slider_arr_value) {
                                                    echo $slider_arr_value;
                                                }
                                                ?>



                                        </div>
                                        <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
                                        <a class="right carousel-control" href="#myCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
                                    </div>
                                            <?php else : ?>
                                                <?php
                                                if (strtolower(substr($details->photo1, 0, 4)) === 'http') {

                                                    $photo1 = $details->photo1;
                                                    $file_headers=Yii::app()->cache->get($details->photo1);
                                                    if($file_headers===false)
                                                    {
//                                                        $file_headers = @get_headers($details->photo1);
                                                        $file_headers = CPathCDN::checkS3Photo($details->photo1);
                                                        Yii::app()->cache->set($details->photo1,$file_headers, 1000);
                                                    }
                                        if($file_headers[0] != 'HTTP/1.1 404 Not Found') {
                                            $photo1 = $details->photo1;
                                            echo CPathCDN::checkPhoto($details, "", 0 );
                                        } else {
//                                            echo '<img src="'.CPathCDN::baseurl( 'img' ).'/img/image_absent.jpg" alt="">';?>
                                                <div id="map-canvas45" class="col-md-12 map45" style="height: 370px;"></div>
                                                    <script type="text/javascript">
                                                        var map45;
                                                        var lat = "<?php echo $details->getlatitude; ?>";
                                                        var lng = "<?php echo $details->getlongitude; ?>";
                                                        function initialize45() {
                                                            var pos = new google.maps.LatLng(lat, lng);
                                                            var mapOptions = {
                                                                center: pos,
                                                                zoom: 19,
                                                                mapTypeId: google.maps.MapTypeId.SATELLITE
                                                            };
                                                            map45 = new google.maps.Map(document.getElementById('map-canvas45'), mapOptions);
                                                                    var a_path = getPathImages();
                                                                     var status = '<?php if(!empty($details->propertyInfoAdditionalBrokerageDetails->status)) echo strtolower($details->propertyInfoAdditionalBrokerageDetails->status); ?>';
                                                                     if(status === ''){
                                                                         status = 'for sale';
                                                                     }
                                                            switch (status){
                                                                default:
                                                                case 'active':
                                                                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/blue.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                                                                    break;

                                                                case 'archive':
                                                                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/gray.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                                                                    break;

                                                                case 'action':
                                                                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/green.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                                                                    break;

                                                                case 'alert':
                                                                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/red.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                                                                    break;

                                                                case 'warning':
                                                                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/yellow.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                                                                    break;

                                                                case 'closed':
                                                                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/black.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                                                                    break;
                                                            }
                                                                    var marker = new google.maps.Marker({
                                                                                    position: pos,
                                                                                    map: map45,
                                                                                    icon: image,
                                                                                    title: '123124'
                                                                                });


                                                            map45.setTilt(45);
                                                        }
                                                        google.maps.event.addDomListener(window, 'load', initialize45);
                                                    </script>
                                            <?php
                                        }
                                                } else {

                                                    $photo1 = CPathCDN::baseurl( 'images' ) . '/images/property_image/' . $details->photo1;
                                                    $photo1_file = Yii::app()->basePath . "/../images/property_image/" . $details->photo1;
                                                    if (is_readable($photo1_file)) {
                                                        echo '<img src="' . $photo1 . '" alt="">';
                                                        echo $details->caption1 ? "<p>{$details->caption1}</p>" : '';
                                                    } else {
                                                        echo '<img src="' . CPathCDN::baseurl( 'images' ) . '/image_absent.jpg" alt="">';?>
                                                    <div id="map-canvas45" class="col-md-12 map45" style="height: 370px;"></div>
                                                 <!--   <script type="text/javascript">

                                                        var map45;
                                                        var lat = "<?php //echo $details->getlatitude; ?>";
                                                        var lng = "<?php //echo $details->getlongitude; ?>";
                                                        function initialize45() {
                                                            var pos = new google.maps.LatLng(lat, lng);
                                                            var mapOptions = {
                                                                center: pos,
                                                                zoom: 19,
                                                                mapTypeId: google.maps.MapTypeId.SATELLITE
                                                            };
                                                            map45 = new google.maps.Map(document.getElementById('map-canvas45'), mapOptions);

                                                            var a_path = getPathImages();
                                                            var status = '<?php //echo strtolower($details->propertyInfoAdditionalBrokerageDetails->status); ?>';
                                                            if(status === ''){
                                                                status = 'for sale';
                                                            }
                                                            switch (status){
                                                                default:
                                                                case 'active':
                                                                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/blue.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                                                                    break;

                                                                case 'archive':
                                                                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/gray.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                                                                    break;

                                                                case 'action':
                                                                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/green.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                                                                    break;

                                                                case 'alert':
                                                                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/red.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                                                                    break;

                                                                case 'warning':
                                                                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/yellow.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                                                                    break;

                                                                case 'closed':
                                                                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/black.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                                                                    break;
                                                            }

                                                                    var marker = new google.maps.Marker({
                                                                                    position: pos,
                                                                                    map: map45,
                                                                                    icon: image,
                                                                                    title: '123124'
                                                                                });

                                                            map45.setTilt(45);
                                                        }
                                                        google.maps.event.addDomListener(window, 'load', initialize45);
                                                    </script>-->
                                                    <?php
                                                    }
                                                }
                                                ?>

                                <?php endif; ?>
                                <?php if(strtolower($details->public_remarks) !== 'null') :?>
                                    <div id="public-remarks">
                                        <p>
                                            <?php echo $details->public_remarks; ?>
                                        </p>
                                    </div>
                                <?php endif ;?>
                            </div>
                            <!-- tabl -->
<div class="col-sm-3">

						<table class="table table-bordered table-striped table-condensed">

							<tbody>
								<tr>
									<th colspan="2"><?php echo $details->house_square_footage; ?> Square Feet</th>
								</tr>
								<tr>
                                                                    <?php $in_str = $details->subdivision ? 'in' : ''; ?>
									<td colspan="2"><?php echo array_key_exists($details->property_type, $property_type_array) ?
                                        $property_type_array[$details->property_type] : '';
                                ?>&nbsp;<?php echo $in_str; ?><a rel="popover-hover"  class="search-field-query" data-city="<?php echo $details->city_name ?>" data-state="<?php echo  $details->state_code ?>" data-zipcode="<?php echo  $details->zip_code ?>" data-subdivision="<?php echo $details->subdivision; ?>"
                                                                              >
                                <?php echo $details->subdivision; ?>
                                                </a></td>
								</tr>
								<tr>
									<th>Bedrooms:</th>
									<td><?php echo $details->bedrooms; ?></td>
								</tr>
								<tr>
									<th>Bathrooms:</th>
									<td><?php echo $details->bathrooms; ?></td>
								</tr>
								<tr>
									<th>Year Built:</th>
									<td><?php echo $details->year_biult_id; ?></td>
								</tr>
								<tr>
									<th>Garage:</th>
									<?php echo!empty($details->garages) ? '<td>' . $details->garages . '</td>' : '<td class="text-muted">N/A</td>'; ?>
								</tr>
								<tr>
									<th>Lot Acreage:</th>
									<?php echo $details->lot_acreage != 0 ? '<td>' . $details->lot_acreage . '</td>' : '<td class="text-muted">N/A</td>'; ?>
								</tr>
								<tr>
									<th>Pool:</th>
									<?php echo $details->pool != 0 ? '<td>' . $details->pool . '</td>' : '<td class="text-muted">N/A</td>'; ?>
								</tr>
								<tr>
									<th>Spa:</th>
									<?php echo !empty($details->propertyInfoDetails->spa)? '<td>' . $details->propertyInfoDetails->spa . '</td>' : '<td class="text-muted">N/A</td>'; ?>
								</tr>
								<tr>
									<th>Gated:</th>
									<?php echo !empty($details->propertyInfoDetails->amenities_gated_community) ? '<td>' . $details->propertyInfoDetails->amenities_gated_community . '</td>' : '<td class="text-muted">N/A</td>'; ?>
								</tr>
							</tbody>
						</table>
                        <?php if($user_property_info != null) :?>
                        <form id="user_property_note">
                            <textarea name="" id="" cols="30" rows="10" placeholder="My Notes..."><?php echo $user_property_info->user_property_note; ?></textarea>
                        </form>
                        <?php endif;?>
					</div>
                            <!-- tabl -->

<?php $this->renderPartial('//property/_property_description', array('details' => $details)) ?>

                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->
                    </div>
                    <!-- end widget -->
                </article>

                <article class="col-sm-12 col-md-6 col-lg-3">

<?php
$this->widget('application.extensions.chat.chat', array(
    'options' => array(
        'property_id' => $details->property_id,
        'owner_mid' => $details->mid,
        'property_zipcode' => $details->property_zipcode,
        'property_status' => !empty($details->propertyInfoAdditionalBrokerageDetails->status)?strtoupper($details->propertyInfoAdditionalBrokerageDetails->status):'',
        'property_street' => $details->property_street,
        'property_type' => $details->property_type
    )
        )
);
?>
                </article>

                    <div class="clearfix"></div>
                    <!-- ad area widget content -->
<?php // if(AdClient::model()->countSuggestToProperty($details)) : ?>
                    <article class="col-sm-12 col-md-6 col-lg-3">

                        <div class="jarviswidget jarviswidget-color-blue jarviswidget-sortable" id="local-vendors-1" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-editbutton="false" role="widget">
                            <header role="heading">
                                <h2>Local Vendors <i></i></h2>
                            </header>

                            <!-- widget div-->
                            <div role="content">
                                <!-- widget content -->
<?php
$this->widget('application.extensions.adclient.AdClientWidget', array(
        'property'=>$details,
    ));
?>
                                <!-- end widget content -->
                            </div>

                            <!-- end widget div -->
                        </div>
                    </article>
<?php // endif;?>
                    <!-- end ad area widget content -->
<?php // if($enableAds) : ?>
                <article class="col-sm-12 col-md-6 col-lg-3">

                    <div class="jarviswidget jarviswidget-color-blue jarviswidget-sortable" id="google-ads1" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-editbutton="false" role="widget">
                                <!-- widget options:
                                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                                        data-widget-colorbutton="false"
                                        data-widget-editbutton="false"
                                        data-widget-togglebutton="false"
                                        data-widget-deletebutton="false"
                                        data-widget-fullscreenbutton="false"
                                        data-widget-custombutton="false"
                                        data-widget-collapsed="true"
                                        data-widget-sortable="false"

                                -->
                                <header role="heading">
                                    <h2>Our Sponsors <i></i></h2>
                                </header>

                                <!-- widget div-->
                                <div role="content">
                                        <!-- widget content -->
<?php
$this->widget('application.extensions.googleadsense.GoogleAdSense', array(
        'slot' => '9155258396',
        'format' => 'rectangle',
        'responsive' => true,
    )
);

?>
                                        <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                        </div>
                </article>
                <article class="col-sm-12 col-md-6 col-lg-3">

                    <div class="jarviswidget jarviswidget-color-blue jarviswidget-sortable" id="google-ads3" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-editbutton="false" role="widget">
                                <!-- widget options:
                                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                                        data-widget-colorbutton="false"
                                        data-widget-editbutton="false"
                                        data-widget-togglebutton="false"
                                        data-widget-deletebutton="false"
                                        data-widget-fullscreenbutton="false"
                                        data-widget-custombutton="false"
                                        data-widget-collapsed="true"
                                        data-widget-sortable="false"

                                -->
                                <header role="heading">
                                    <h2>&nbsp; <i></i></h2>
                                </header>

                                <!-- widget div-->
                                <div role="content">
                                        <!-- widget content -->
<?php
$this->widget('application.extensions.googleadsense.GoogleAdSense', array(
        'slot' => '3549250794',
//        'style' => '',
        'format' => 'rectangle',
        'responsive' => true,
    )
);

?>
                                        <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                        </div>
                </article>
            <?php // endif; ?>

            </div>

            <!-- end row -->

            <!-- row -->

            <div class="row">

                <article class="col-sm-12 col-md-12
                <?php
                if(property_exists($comparebles_properties, 'estimated_value_subject_property') && property_exists($comparebles_properties, 'result_query'))
                    echo 'col-lg-6'
                ?>
                ">

                    <!-- new widget -->
                    <div class="jarviswidget" id="wid-id-2map" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">

                        <!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                        data-widget-colorbutton="false"
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true"
                        data-widget-sortable="false"

                        -->

                        <header>
                            <span class="widget-icon"> <i class="fa fa-map-marker"></i> </span>
                            <h2>Map</h2>

                            <div class="widget-toolbar">
                                <span class="onoffswitch-title"><i class="fa fa-location-arrow"></i> Show Comps</span>
                                <span class="onoffswitch">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked="checked" id="myonoffswitch2">
                                    <label class="onoffswitch-label" for="myonoffswitch2"> <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span> <span class="onoffswitch-switch"></span> </label> </span>
                            </div>

                            <div class="widget-toolbar hidden-mobile">
                                <div class="btn-group">
                                    <button class="btn dropdown-toggle btn-xs btn-primary" data-toggle="dropdown">
                                        Draw Boundaries <i class="icon-caret-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:void(0);" class="rectangle"><i class="icon-circle txt-color-green"></i> Rectangle</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="radius"><i class="icon-circle txt-color-red"></i> Radius</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="freehand"><i class="icon-delete"></i> Free Hand</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="javascript:void(0);" class="delete-button"><i class="icon-circle txt-color-red"></i> Delete Shape</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </header>

                        <!-- widget div-->
                        <div>
                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <div>
                                    <label>Title:</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <!-- end widget edit box -->

                            <div class="widget-body no-padding mobile-wrapper">
                                <!-- content goes here -->
                                <div id="map-wrap">
                                    <div id="map-canvas"></div>
                                    <!--                                    <div id="vector-map" class="vector-map"></div>-->
                                    <!--                                    <div id="heat-fill">
                                                                            <span class="fill-a">0</span>

                                                                            <span class="fill-b">2 Miles</span>
                                                                        </div>-->
                                </div>


                                <!-- end content -->

                            </div>

                        </div>
                        <!-- end widget div -->
                    </div>
                    <!-- end widget -->
                </article>
<!--<div>-->

        <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable
        <?php echo property_exists($comparebles_properties, 'estimated_value_subject_property') ? '' : 'hidden'?>

">

							<!-- new widget -->
							<div class="jarviswidget jarviswidget-sortable" id="wid-id-00" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" role="widget">
								<!-- widget options:
								usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

								data-widget-colorbutton="false"
								data-widget-editbutton="false"
								data-widget-togglebutton="false"
								data-widget-deletebutton="false"
								data-widget-fullscreenbutton="false"
								data-widget-custombutton="false"
								data-widget-collapsed="true"
								data-widget-sortable="false"

								-->
								<header role="heading"><div class="jarviswidget-ctrls" role="menu">   <a href="#" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-resize-full "></i></a> </div>
									<span class="widget-icon"> <i class="fa fa-tachometer"></i> </span>
									<h2><span><?php echo $details->property_street; ?></span> - Property Comparison</h2>
<?php /*/ ?>
									<ul class="nav nav-tabs pull-right in" id="myTab">
										<li class="active">
											<a data-toggle="tab" href="#s1"><i class="fa fa-info"></i> <span class="hidden-mobile hidden-tablet">Property Details</span></a>
										</li>

										<li>
											<a data-toggle="tab" href="#s2"><i class="fa fa-bar-chart-o"></i> <span class="hidden-mobile hidden-tablet">List/ Sale Activity</span></a>
										</li>

										<li>
											<a data-toggle="tab" href="#s3"><i class="fa fa-dollar"></i> <span class="hidden-mobile hidden-tablet">Pricing Analysis</span></a>
										</li>
									</ul>
<?php /*/ ?>
								<span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>

								<!-- widget div-->
								<div class="no-padding" role="content">
									<!-- widget edit box -->
									<div class="jarviswidget-editbox">

										test
									</div>
									<!-- end widget edit box -->

									<div class="widget-body">
										<!-- content -->

                                <div id="myTabContent" class="tab-content">

                                    <div class="tab-pane fade active in padding-10 no-padding-bottom" id="s1">
                                        <div class="row no-space">
<?php /*/ ?>
                                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
                                                <span class="demo-liveupdate-1"> <span class="onoffswitch-title">Live</span> <span class="onoffswitch">
                                                        <input type="checkbox" name="start_interval" class="onoffswitch-checkbox" id="start_interval">
                                                        <label class="onoffswitch-label" for="start_interval"> 
                                                            <span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span> 
                                                            <span class="onoffswitch-switch"></span> </label> </span> </span>
                                                <div id="updating-chart" class="chart-large txt-color-blue"></div>

                                            </div>
<?php /*/ ?>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 show-stats">

                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                                                        <span class="text"> 
                                                            <?php echo number_format($details->house_square_footage); ?> SQ FT 
                                                            <span class="pull-right">
                                                                <span id="min_sqft"><?php if (property_exists($comparebles_properties, 'result_query')) {
                                                                    echo number_format($comparebles_properties->result_query->min_sqft);
                                                                    } ?>
                                                                </span> - 
                                                                <span id="max_sqft"><?php if (property_exists($comparebles_properties, 'result_query')) {
                                                                        echo number_format($comparebles_properties->result_query->max_sqft);
                                                                    } ?>
                                                                </span> 
                                                            </span> 
                                                        </span>
                                                        <div class="progress">
                                                            <?php
                                                                $progress_bar_class = 'bg-color-green';
                                                                if (property_exists($comparebles_properties, 'result_query') ) {
                                                                        $delta_min_max_sqft = $comparebles_properties->result_query->max_sqft - $comparebles_properties->result_query->min_sqft;
                                                                        $delta_house_square_footage = $details->house_square_footage - $comparebles_properties->result_query->min_sqft;
                                                                        $delta_min_max_sqft_value = $delta_min_max_sqft != 0 ?
                                                                                round($delta_house_square_footage * 100 / $delta_min_max_sqft) : 0;

                                                                    if($delta_min_max_sqft_value !=0 && round($delta_house_square_footage * 100 / $delta_min_max_sqft) < 50){
                                                                        $progress_bar_class = 'bg-color-blue';
                                                                    }
                                                                }
                                                            ?>
                                                            <div class="progress-bar <?php echo $progress_bar_class ?>" id="min_sqft_max_sqft_progress" style="width:
                                                                <?php if (property_exists($comparebles_properties, 'result_query') ) {

                                                                        echo $delta_min_max_sqft_value;
                                                                    } ?>%;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                                                        <span class="text"> 
                                                            <span id="price_per_sq">
                                                                    <?php if (($details->property_price != 0) && ($details->house_square_footage != 0)) {
                                                                        echo '$'.round($details->property_price / $details->house_square_footage, 2);
                                                                    } ?></span> per SQ FT 
                                                            <span class="pull-right">
                                                                <span id="lowppsqft_1">
                                                                    <?php echo property_exists($comparebles_properties, "result_query") ?
                                                                            '$'.number_format($comparebles_properties->result_query->min_ppsqft,2,'.',',') : ''; ?>
                                                                </span> - 
                                                                <span id="highppsqft_1">
                                                                    <?php echo property_exists($comparebles_properties, "result_query") ?
                                                                            '$'.number_format($comparebles_properties->result_query->max_ppsqft,2,'.',',') : ''; ?>
                                                                </span> 
                                                            </span> 
                                                        </span>
                                                        <div class="progress">
                                                                <?php if (property_exists($comparebles_properties, 'result_query')) {
                                                                    $delta_min_max_ppsqft = round($comparebles_properties->result_query->max_ppsqft,2) - round($comparebles_properties->result_query->min_ppsqft, 2);
                                                                    $delta_property_price = ($details->house_square_footage!=0)?round($details->property_price / $details->house_square_footage, 2) - round($comparebles_properties->result_query->min_ppsqft, 2):0;
                                                                    $delta_property_pric_value = $delta_property_price > 0 && $delta_min_max_ppsqft != 0 ? $delta_property_price * 100 / $delta_min_max_ppsqft : 0;
                                                                }?>
                                                            <div class="progress-bar <?php echo (isset($delta_property_pric_value) && $delta_property_pric_value < 50)? 'bg-color-green' : 'bg-color-blue';?>" id="price_per_sq_progress" style="width:
                                                                <?php if (property_exists($comparebles_properties, 'result_query')) {
                                                                    echo  $delta_property_pric_value ;
                                                                } ?>%;"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                                                        <span class="text"> 
                                                            <span id="lot_size">
                                                                    <?php if ($details->lot_acreage) {
                                                                    echo number_format(round($details->lot_acreage, 3),3,'.',',');
                                                                } ?></span> ACRE LOT
                                                            <span class="pull-right">
                                                                <span id="lowlot_1">
                                                                    <?php echo property_exists($comparebles_properties, "result_query") ?
                                                                            number_format($comparebles_properties->result_query->min_lot,3,'.',',') : ''; ?>
                                                                </span> - 
                                                                <span id="highlot_1">
                                                                    <?php echo property_exists($comparebles_properties, "result_query") ?
                                                                            number_format($comparebles_properties->result_query->max_lot,3,'.',',') : ''; ?>
                                                                </span>
                                                            </span> 
                                                        </span>
                                                        <div class="progress">
                                                                <?php if (property_exists($comparebles_properties, 'result_query')) {
                                                                    $delta_min_max_lot = round($comparebles_properties->result_query->max_lot - $comparebles_properties->result_query->min_lot, 3);
                                                                    $delta_lot = round($details->lot_acreage - $comparebles_properties->result_query->min_lot, 3);
                                                                    $delta_lot_value = $delta_lot > 0 && $delta_min_max_lot != 0 ?
                                                                            round($delta_lot * 100 / $delta_min_max_lot) : 0;
                                                                } ?>
                                                            <div class="progress-bar <?php echo (isset($delta_lot_value) &&  $delta_lot_value < 50)? 'bg-color-blue' : 'bg-color-green';?>" id="lot_size_progress" style="width:
                                                                <?php if (property_exists($comparebles_properties, 'result_query')) {
                                                                    echo $delta_lot_value;
                                                                } ?>%;"></div>
                                                        </div>

                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                                                        <span class="text"> 
                                                            <span id="listprice">
                                                                <?php echo '$'.number_format($details->property_price, 0, '.', ',') ?>
                                                            </span>
                                                            <?php echo $listOrSold; ?>
                                                            <span class="pull-right">COMPS:
                                                                <span id="min_price">
                                                                <?php if (property_exists($comparebles_properties, 'result_query')) {
                                                                    echo '$'.number_format(round($comparebles_properties->result_query->min_price / $round_value ), 0, '.', ','). $postfix_after_rounded;
                                                                } ?>
                                                            </span> - 
                                                                <span id="max_price">
                                                                    <?php if (property_exists($comparebles_properties, 'result_query')) {
                                                                    echo '$'.number_format(round($comparebles_properties->result_query->max_price / $round_value ), 0, '.',','). $postfix_after_rounded;
                                                                } ?>
                                                                </span>
                                                            </span> 
                                                        </span>
                                                        <div class="progress">
                                                                <?php if (property_exists($comparebles_properties, 'result_query')) {
                                                                    $delta_min_max_comp = round($comparebles_properties->result_query->max_price - $comparebles_properties->result_query->min_price);
                                                                    $delta_comp = round($details->property_price - $comparebles_properties->result_query->min_price);
                                                                    $delta_comp_value = $delta_comp > 0 &&  $delta_min_max_comp != 0 ?
                                                                            round($delta_comp * 100 / $delta_min_max_comp) : 0;
                                                                } ?>
                                                            <div class="progress-bar <?php echo (isset($delta_comp_value) && $delta_comp_value < 50)? 'bg-color-green' : 'bg-color-blue';?>" id="min_price_max_price_progress" style="width:
                                                                <?php if (property_exists($comparebles_properties, 'result_query')) {
                                                                    echo $delta_comp_value;
                                                                } ?>%;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                                                        <span class="text">
                                                            <span id="tmvalue">
                                                                    <?php echo property_exists($comparebles_properties, 'estimated_value_subject_property') ?
                                                                            '$'.number_format($comparebles_properties->estimated_value_subject_property,0,'.',',') : ''; ?>
                                                            </span> <?php echo $details->property_type == 9 ? 'TMR' : 'TMV' ?>

                                                            <span class="pull-right">RANGE: 
                                                                <span id="low_value">
                                                                    <?php if (property_exists($comparebles_properties, 'low_range')) {
                                                                        echo '$'.number_format(round($comparebles_properties->low_range / $round_value ),0,'.',',') . $postfix_after_rounded ;
                                                                    } ?>
                                                                </span> - 
                                                                <span id="high_value">
                                                                    <?php if (property_exists($comparebles_properties, 'high_range')) {
                                                                    echo '$'.number_format(round($comparebles_properties->high_range / $round_value),0,'.',',') . $postfix_after_rounded ;

                                                                } ?>
                                                                </span>
                                                            </span> 
                                                        </span>
                                                        <div class="progress">
                                                                <?php if (property_exists($comparebles_properties, 'high_range') && property_exists($comparebles_properties, 'low_range')) {
                                                                    $delta_max_min_value = round($comparebles_properties->high_range - $comparebles_properties->low_range);
                                                                    $dleta_value = round($comparebles_properties->estimated_value_subject_property - $comparebles_properties->low_range);
                                                                    $dleta_value_value = $dleta_value > 0 &&  $delta_max_min_value != 0 ? $dleta_value * 100 / $delta_max_min_value : 0;
                                                                } ?>
                                                            <div class="progress-bar <?php echo (isset($dleta_value_value) &&  $dleta_value_value < 50)? 'bg-color-blue' : 'bg-color-green';?>" id="low_value_high_value_progress" style="width:
                                                                <?php if (property_exists($comparebles_properties, 'high_range') && property_exists($comparebles_properties, 'low_range')) {
                                                                    echo $dleta_value_value;
                                                                } ?>%;"></div>
                                                        </div>
                                                    </div>

                                                    <?php if(SiteHelper::forFullPaidMembersOnly(1) !== 1){ ?>
                                                    <span class="show-stat-buttons">
                                                        <span class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                            <a id="details_full_access" href="<?php echo Yii::app()->params['linkToBuyingSubscr']?>" class="btn btn-default btn-block hidden-xs">Full Access</a>
                                                        </span>
                                                        <span class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                            <a id="details_analyze" href="<?php echo Yii::app()->params['linkToBuyingSubscr']?>" class="btn btn-default btn-block hidden-xs">Analyze this Property</a>
                                                        </span>
                                                    </span>
                                                    <?php } ?>

                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                    <!-- end s1 tab pane -->

                                    <div class="tab-pane fade" id="s2">
                                        <div class="widget-body-toolbar bg-color-white">

                                            <form class="form-inline" role="form">

                                                <div class="form-group">
                                                    <label class="sr-only" for="s123">Show From</label>
                                                    <input type="email" class="form-control input-sm" id="s123" placeholder="Show From">
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control input-sm" id="s124" placeholder="To">
                                                </div>

                                                <div class="btn-group hidden-phone pull-right">
                                                    <a class="btn dropdown-toggle btn-xs btn-default" data-toggle="dropdown"><i class="fa fa-cog"></i> More <span class="caret"> </span> </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:void(0);"><i class="fa fa-file-text-alt"></i> Export full PDF report</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);"><i class="fa fa-file-text-alt"></i> Compare Markets</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);"><i class="fa fa-question-sign"></i> Help</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </form>

                                        </div>
                                        <div class="padding-10">
                                            <div id="statsChart" class="chart-large has-legend-unique"></div>
                                        </div>

                                    </div>
                                    <!-- end s2 tab pane -->

                                    <div class="tab-pane fade" id="s3">

                                        <div class="widget-body-toolbar bg-color-white smart-form" id="rev-toggles">

                                            <div class="inline-group">

                                                <label for="gra-0" class="checkbox">
                                                    <input type="checkbox" name="gra-0" id="gra-0" checked="checked">
                                                    <i></i> Sales </label>
                                                <label for="gra-1" class="checkbox">
                                                    <input type="checkbox" name="gra-1" id="gra-1" checked="checked">
                                                    <i></i> Asking Price </label>
                                                <label for="gra-2" class="checkbox">
                                                    <input type="checkbox" name="gra-2" id="gra-2" checked="checked">
                                                    <i></i> Sold Price </label>
                                            </div>

                                            <div class="btn-group hidden-phone pull-right">
                                                <a class="btn dropdown-toggle btn-xs btn-default" data-toggle="dropdown"><i class="fa fa-cog"></i> More <span class="caret"> </span> </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-file-text-alt"></i> Export full PDF report</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-file-text-alt"></i> Compare Markets</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-question-sign"></i> Help</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="padding-10">
                                            <div id="flotcontainer" class="chart-large has-legend-unique"></div>
                                        </div>
                                    </div>
                                    <!-- end s3 tab pane -->
                                </div>

										<!-- end content -->
                                    </div>
                                </div>
								<!-- end widget div -->
        </article>

							<!-- end widget -->


<!--<div>-->

                <article class="col-sm-12 col-md-12 col-lg-6
                <?php echo property_exists($comparebles_properties, 'result_query') ? '' : 'hidden'?>
                ">
                    <!-- new widget -->
                    <div class="jarviswidget jarviswidget-sortable" id="wid-id-0" data-widget-editbutton="false data-widget-colorbutton="false" data-widget-deletebutton="false">
                        <!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                        data-widget-colorbutton="false"
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true"
                        data-widget-sortable="false"

                        -->
                        <header>
                            <span class="widget-icon"> <i class="glyphicon glyphicon-usd <?php echo $text_color_if_discont?>"></i> </span>
<!-- # estimated_value_subject_property=<?php if (property_exists($comparebles_properties, 'estimated_value_subject_property')) { echo ($comparebles_properties->estimated_value_subject_property) ;} ?> # -->
                            <h2><?php echo $details->property_type == 9 ? 'True Market Rent' : 'True Market Value' ?>
<?php /*/ ?>
                                = <span id="tmvh2"><?php
                                if (property_exists($comparebles_properties, 'estimated_value_subject_property')) {
                                    echo $comparebles_properties->estimated_value_subject_property != 0 ? 
                                            '<span class="txt-color-green">$' . number_format(round($comparebles_properties->estimated_value_subject_property)) . '</span>' : 
                                        '<span title="Not Enough Data" class="txt-color-green">-</span>';
                                } else {
                                    echo '<span title="Not Enough Data" class="txt-color-green">-</span>';
                                }
                                ?></span>
<?php /*/ ?>
 - <?php echo $details->property_street; ?>.</h2>

                            <ul class="nav nav-tabs pull-right in" id="myTab">

<?php
if (property_exists($comparebles_properties, 'result_query')) {
    $active_case = $comparebles_properties->result_query->count_property > 0 ? 'active' : '';
} else {
    $active_case = '';
}
?>

<?php /*/ ?>
                                <li class="<?php $active_case; ?>">
                                    <a data-toggle="tab" href="#s1"><i class="fa fa-info"></i> <span class="hidden-mobile hidden-tablet">Property Details</span></a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#s2"><i class="fa fa-bar-chart-o"></i> <span class="hidden-mobile hidden-tablet">List/ Sale Activity</span></a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#s3"><i class="fa fa-dollar"></i> <span class="hidden-mobile hidden-tablet">Pricing Analysis</span></a>
                                </li>
 <?php /*/ ?>
                            </ul>

                        </header>

                        <!-- widget div-->
                        <div class="no-padding">
                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">


                            </div>
                            <!-- end widget edit box -->

                            <div class="widget-body">
                                <!-- content## -->
                                <div id="myTabContent" class="tab-content">
                			<div class="tab-pane fade padding-10 no-padding-bottom active in" id="spd1">

                                        <div class="show-stat-microcharts">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<!-- # stage=<?php if (property_exists($comparebles_properties, 'current_stage')) { echo $comparebles_properties->current_stage;} ?> # -->
                                                <ul id="sparks" class="pull-left">
                                                    <li class="sparks-info">
                                                        <h5> <?php echo $details->property_type == 9 ? 'True Market Rent' : 'True Market Value' ?> <span id="tmv"><?php
                                                if (property_exists($comparebles_properties, 'estimated_value_subject_property')) {
                                                    echo $comparebles_properties->estimated_value_subject_property != 0 ? '<span class="'.$text_color_if_discont.'">$' . number_format(round($comparebles_properties->estimated_value_subject_property)) . '</span>' : '<span title="Not Enough Data" class="'.$text_color_if_discont.'">-</span>';
                                                } else {
                                                    echo '<span title="Not Enough Data" class="'.$text_color_if_discont.'">-</span>';
                                                }
                                                ?></span></h5>
                                                    </li>
                                                    <?php
                                                if ($discont >= Yii::app()->params['underValueDeals']) {?>
                                                    <li class="sparks-info">
                                                        <h5> <?php echo $details->property_type == 9 ? 'Estimated Spread' : 'Estimated Equity' ?> <span class="<?php echo $text_color_if_discont ?>" id="dynamicEstimatedEquity"><?php echo $comparebles_properties->estimated_value_subject_property != 0 ? '$'.$estimatedEquity : '-'; ?></span></h5>
                                                    </li>
                                                <?php } ?>
                                                </ul>
                                                <ul class="smaller-stat pull-right">
                                                    <li>
                                                        <span class="label bg-color-green" title="Asking Price"><?php echo $details->property_price ? '$'.round($details->property_price / $round_value).$postfix_after_rounded : ''; ?></span>
                                                    </li>
                                                    <li>
                                                     <?php     if (property_exists($comparebles_properties, 'estimated_price_dollar') && $comparebles_properties->estimated_price_dollar > 0) :?>
                                                     <?php $percentage = (($details->property_price - $comparebles_properties->estimated_price_dollar) / $comparebles_properties->estimated_price_dollar) * 100 ;?>
                                                        <span class="label bg-color-green" title="Asking Price <?php echo round($percentage).'%'; ?> Below TMV"><i class="fa fa-caret-down"></i><?php echo round($percentage).'%'; ?></span>
                                                    <?php endif; ?>

                                                    </li>
                                                </ul>
<?php /*/ ?>
                                                <div class="sparkline txt-color-green">3000, 2700, 3231, 2871, 3100, 3631</div>
<?php /*/ ?>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                                <ul id="sparks" class="pull-left">

                                                    <li class="sparks-info">
                                                        <h5> Value Range <span class="<?php echo $text_color_if_discont ?>">$<span class="<?php echo $text_color_if_discont ?> low_value_b" id="">
<?php
if (property_exists($comparebles_properties, 'low_range')) {
     echo number_format(round($comparebles_properties->low_range / $round_value ),0,'.',',') . $postfix_after_rounded ;
}
?></span>-$<span class="<?php echo $text_color_if_discont ?> high_value_b" id="">
<?php
if (property_exists($comparebles_properties, 'high_range')) {
    echo number_format(round($comparebles_properties->high_range / $round_value),0,'.',',') . $postfix_after_rounded;
}
?></span></span></h5>
                                                    </li>
                                                </ul>

                                                <span id="comparable_price_sparkline" class="sparkline display-inline" data-sparkline-type="box" data-sparkline-height="14px"></span>
                                            </div>



                                            <div class="overflow-visible col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-8">
                                                    <div id="confidence_chart" class="easy-pie-chart txt-color-green" data-pie-percent="90" data-percent="90" data-pie-size="50" data-size="50">
                                                        <span id="confidence_chart_text" class="percent percent-sign">90</span>
                                                   </div>

                                                    <span class="easy-pie-title"> Confidence </span>
                                                </div>
<?php /*/ ?>
                                                <ul class="smaller-stat hidden-sm pull-right">
                                                    <li>
                                                        <span class="label bg-color-green" title="Higher Confidence broadens the High and Low Range Limits"><i class="fa fa-caret-up"></i> 98%</span>
                                                    </li>
                                                    <li>
                                                        <span class="label bg-color-orange" title="Lower Confidence tightens the High and Low Range Limits"><i class="fa fa-caret-down"></i> 50%</span>
                                                    </li>
                                                </ul>
<?php /*/ ?>
                                                <div class="margin-top-10 col-xs-4 col-sm-5 col-md-5 col-lg-4">
                                                <div id="confidence_slider">
                                                    <input type="text" class="slider slider-primary" id="g1" value=""
                                                           data-slider-max="98"
                                                           data-slider-min="50"
                                                           data-slider-value="90"
                                                           data-slider-selection = "before"
                                                           data-slider-handle="round">
                                                </div>
                                                </div>

                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<?php
$dtz  = new DateTimeZone(isset(Yii::app()->timeZone)?Yii::app()->timeZone:"UTC");
$datetime_now = new DateTime();
$datetime_now->setTimezone($dtz);
$propertyDate = !empty($details->propertyInfoAdditionalBrokerageDetails->entry_date)
        ?$details->propertyInfoAdditionalBrokerageDetails->entry_date:$details->property_uploaded_date ;
$datetime_exp = new DateTime($propertyDate, $dtz);
$interval = $datetime_now->diff($datetime_exp);
$quantity = $interval->days;
if($quantity<0) {
    $quantity = 0;
}
if ($quantity <= 30) {
    $chart_class = 'txt-color-green';
}
if (($quantity >= 31) && ($quantity <= 90)) {
    $chart_class = 'txt-color-orange';
}
if ($quantity >= 91) {
    $chart_class = 'txt-color-red';
}
?>
                                                <div id="daysonmarket_chart" class="easy-pie-chart <?php echo $chart_class; ?>" data-percent="<?php echo $quantity; ?>" data-pie-size="50">
                                                    <span id="daysonmarket_chart_text" class=""><?php echo $quantity; ?> <i class="fa fa-caret-up"></i></span>
                                                </div>
                                                <span class="easy-pie-title"> DaysonMarket </span>
<?php
if (property_exists($comparebles_properties, 'result_query')) {
    $datetime_exp_min = new DateTime($comparebles_properties->result_query->min_uploaded_date, $dtz);
    $interval_min = $datetime_now->diff($datetime_exp_min);
    $quantity_min = $interval_min->days;

    $datetime_exp_max = new DateTime($comparebles_properties->result_query->max_uploaded_date, $dtz);
    $interval_max = $datetime_now->diff($datetime_exp_max);
    $quantity_max = $interval_max->days;
} else {
    $quantity_max = '';
    $quantity_min = '';
}
?>
                                                <ul class="smaller-stat hidden-sm pull-right">
                                                    <li>
                                                        <span class="label bg-color-red"><i class="fa fa-caret-up"></i> <?php echo $quantity_min; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="label bg-color-green"><i class="fa fa-caret-down"></i> <?php echo $quantity_max; ?></span>
                                                    </li>
                                                </ul>
<?php /*/ ?>
                                                <div class="sparkline display-inline" text-align-centerdata-sparkline-type="bullet" data-sparkline-height="14px" data-sparkline-bulletrange-color='["#CCD7DB", "#92A2A8", "#57889C"]' data-sparkline-performance-color="#A4CBDB" data-sparkline-bullet-color="#143644">10,12,12,9,7
<?php /*/ ?>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- end content## -->
                            </div>
                </article>
                        </div>
                        <!-- end widget div -->


            <!-- end row -->

            <!-- row -->

<?php if (property_exists($comparebles_properties, 'result_query')): ?>

    <?php if ($comparebles_properties->result_query->count_property > 0): ?>
                    <div class="row">
                        <article class="col-sm-12">

                            <!-- Comparable Property Table Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-sortable jarviswidget-color-blue" id="wid-id-2proptbl" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false">
                                <!-- widget options:
                                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                                data-widget-colorbutton="false"
                                data-widget-editbutton="false"
                                data-widget-togglebutton="false"
                                data-widget-deletebutton="false"
                                data-widget-fullscreenbutton="false"
                                data-widget-custombutton="false"
                                data-widget-collapsed="true"
                                data-widget-sortable="false"

                                -->
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                    <?php
                                    $curr_stage = 1;
                                    if (property_exists($comparebles_properties, 'current_stage')) {
                                        $curr_stage = $comparebles_properties->current_stage;
                                    }?>

                                    <h2 id="total_comp_prop" title="<?php echo $curr_stage; ?>"><?php if (property_exists($comparebles_properties, 'result_query')) {
            echo $comparebles_properties->result_query->count_property - $countExcludeProperties;
        } ?> Comparable Properties</h2>

                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->

                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body no-padding mobile-wrapper">
                                        <div class="widget-body-toolbar">

                                            <form action="#" class="status_filter">
                                                <select multiple class="select2" name="status_type">
                                                <?php
                                                $excluded_statuses = array();
                                                $excluded_statuses_for_prop = $this->default_excluded_status_types;

                                                if (isset($session['excluded_statuses'])) {
                                                    $excluded_statuses = $session['excluded_statuses'];

                                                    if (array_key_exists($details->property_id, $excluded_statuses)) {
                                                        $excluded_statuses_for_prop = $excluded_statuses[$details->property_id];
                                                    }
                                                }

                                                foreach ($this->status_types as $key => $name) {
                                                    if($details->property_type == 9 && ($key == 'For Sale' || $key == 'Sold')){
                                                        continue;
                                                    }
                                                    if($details->property_type != 9 && ($key == 'For Rent' || $key == 'Leased')){
                                                        continue;
                                                    }
                                                    if (in_array($key, $excluded_statuses_for_prop)) {
                                                        echo '<option value="' . $key . '">' . $key . '</option>';
                                                    } else {
                                                        echo '<option value="' . $key . '" selected>' . $key . '</option>';
                                                    }
                                                }
                                                ?>
                                                </select>
                                            </form>

                                            <div id="stage-slider">
                                                    <input type="text" class="slider slider-primary" value=""
                                                           data-slider-max="100"
                                                           data-slider-min="1"
                                                           data-slider-value="<?php if (property_exists($comparebles_properties, 'current_stage')) { echo $comparebles_properties->current_stage;} ?>"
                                                           data-slider-selection="before"
                                                           data-slider-handle="round">
                                                </div>

                                            <div style="clear:both"></div>
                                        </div>
                                        <table class="table table-striped table-hover datatable_col_reorder">
                                            <thead>
                                                <tr>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th><?php echo $details->property_type == 9 ? 'Rent Price' : 'List Price' ?></th>
                                                    <th><?php echo $details->property_type == 9 ? 'Leased Price' : 'Sale Price' ?></th>
                                                    <th><?php echo $details->property_type == 9 ? 'TMR' : 'TMV' ?></th>

                                                    <th>Date</th>
                                                    <th>$/SqFt</th>
                                                    <th>Sq Ft</th>
                                                    <th>Bed</th>
                                                    <th>Bath</th>
                                                    <th>Garage</th>
                                                    <th>Lot</th>
                                                    <th>Yr Blt</th>
                                                    <th>Dist.</th>

                                                    <th>Stories</th>
                                                    <th>Pool</th>
                                                    <th>Spa</th>
                                                    <th>Condition</th>

                                                    <th>House Faces</th>
                                                    <th>House Views</th>
                                                    <th>Flooring</th>
                                                    <th>Furnishings</th>
                                                    <th>Financing</th>

                                                    <th>Foreclosure</th>
                                                    <th>Short Sale</th>
                                                    <th>Bank Owned</th>
                                                    <th>Original Price</th>
                                                    <th>Days on Market</th>

                                                    <th>Tool Options</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>

                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </div>
                            <!-- end widget -->
                        </article>

                    </div>
    <?php endif; ?>
<?php endif; ?>
            <!-- end row -->


            <!-- row -->
            <div class="row">

                <article class="col-sm-12 col-md-12 col-lg-6">


<?php // if($enableAds) : ?>
                        <div class="jarviswidget jarviswidget-color-blue jarviswidget-sortable" id="google-ads2" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-editbutton="false" role="widget">
                                <!-- widget options:
                                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                                        data-widget-colorbutton="false"
                                        data-widget-editbutton="false"
                                        data-widget-togglebutton="false"
                                        data-widget-deletebutton="false"
                                        data-widget-fullscreenbutton="false"
                                        data-widget-custombutton="false"
                                        data-widget-collapsed="true"
                                        data-widget-sortable="false"

                                -->
                                <header role="heading">
                                    <h2> Our Sponsors <i></i></h2>
                                </header>

                                <!-- widget div-->
                                <div role="content">
                                        <!-- widget content -->
<?php
$this->widget('application.extensions.googleadsense.GoogleAdSense', array(
        'slot' => '8817181195',
//        'style' => '',
        'format' => 'rectangle',
        'responsive' => true,
    )
);

?>
                                        <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                        </div>
<?php // endif; ?>

                </article>
                    <?php if (count($similar_homes) > 0): ?>
                    <article class="col-sm-12 col-md-12 col-lg-6">

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-sortable jarviswidget-color-green" id="wid-id-shfs" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                            <!-- widget options:
                            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                            data-widget-colorbutton="false"
                            data-widget-editbutton="false"
                            data-widget-togglebutton="false"
                            data-widget-deletebutton="false"
                            data-widget-fullscreenbutton="false"
                            data-widget-custombutton="false"
                            data-widget-collapsed="true"
                            data-widget-sortable="false"

                            -->
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>

                                <h2><?php echo count($similar_homes); ?> Similar Homes for <?php echo $details->property_type == 9 ? 'Rent' : 'Sale' ?></h2>

                            </header>

                            <!-- widget div-->
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body no-padding mobile-wrapper" style="height:440px; overflow-y: scroll; overflow-x: hidden;">
                                    <div class="widget-body-toolbar">

                                    </div>
                                    <table class="table table-striped table-bordered table-hover dt_basic">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Price</th>
                                                <th>Address</th>
                                                <th>Desc.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->

                    </article>
<?php endif; ?>
            </div>

            <!-- end row -->

        </section>
        <!-- end widget grid -->

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
Note: These tiles are completely responsive,
you can add as many as you like
-->
<div id="shortcut">
    <ul>
        <li>
            <a href="/user/profile" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
        </li>
        <li>
            <a id="alerts_menu" href="#ajax/inbox.html" class="jarvismetro-tile big-cubes bg-color-red"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Alerts<span class="label pull-right bg-color-darken">14</span></span> </span> </a>
        </li>
        <li>
            <a id="calendar_menu" href="#ajax/calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
        </li>
        <li>
            <a id="search_nearby_menu" href="#ajax/gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Search Nearby</span> </span> </a>
        </li>
        <li>
            <a id="invoice_menu" href="#ajax/invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
        </li>
        <li>
            <a id="gallery_menu" href="#ajax/gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
        </li>
    </ul>
</div>

<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
Note: These tiles are completely responsive,
you can add as many as you like
-->
<div id="shortcut">
    <ul>
        <li>
            <a href="javascript:void(0);" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
        </li>
        <li>
            <a href="#ajax/inbox.html" class="jarvismetro-tile big-cubes bg-color-red"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Alerts<span class="label pull-right bg-color-darken">14</span></span> </span> </a>
        </li>
        <li>
            <a href="#ajax/calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
        </li>
        <li>
            <a href="#ajax/gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Search Nearby</span> </span> </a>
        </li>
        <li>
            <a href="#ajax/invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
        </li>
        <li>
            <a href="#ajax/gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
        </li>
    </ul>
</div>
<!-- END SHORTCUT AREA -->

<a href="#" class="close"></a><h4 class="alert-heading">Warning!</h4><p>The property lies outside the drawn area.</p><p>Please remove or expand the area</p></div>

<div class="comparables-properties-response"></div>

<div class="alert alert-block alert-warning alert-remove-exclude">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">Warning!</h4>
    <div class="msg"></div>
</div>

<div class="detail-pop-up">
    <button class="close" type="button">×</button>
    <a class="show-in-table" href="#">Show in table</a>
    <div class="row">
        <div class="col-sm-6">
                <a class="img-container">
                    <div id="detail-pop-up-carousel" class="carousel fade">
                        <div class="carousel-inner" role="listbox">
                        </div>
                    </div>
                </a>
        </div>
        <div class="col-sm-6">
            <a class="link-container">
                <div class="street"></div>
                <div class="city"></div>
                <div class="subdivision"></div>
                <div class="type"></div>
                <div class="metrics"></div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 bottom-line-popup">
            <div class="row">
                <div class="col-xs-5 col-sm-4 label-container"></div>
                <div class="col-xs-7 col-sm-8 price"></div>
            </div>
            <div class="row">
                <div class="col-xs-5 col-sm-4 popup-tmv"></div>
                <div class="col-xs-7 col-sm-8 popup-tmv-price"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="exclude-btn"></div>

        </div>
    </div>
</div>

<?php

$property_exists_flag = is_object($comparebles_properties) && property_exists($comparebles_properties, 'result_queryAllRows') ? 1 : 0;
$estimated_value_subject_property = is_object($comparebles_properties) && property_exists($comparebles_properties, 'estimated_value_subject_property') ? $comparebles_properties->estimated_value_subject_property  : 0 ;

//Yii::app()->clientScript->registerScriptFile(CPathCDN::publish(Yii::app()->theme->basePath . "/js/accounting.js", CClientScript::POS_END));
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/userPropertyStatusOpt.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScript(
        "propDetScript", "var s1 = '" . $active_case . "';
            if(s1 != 'active'){
               setTimeout(function(){
                   $('#myTab a[href=\"#s1\"]').parent().css('display','none');
               },200);
               $('#myTab a[href=\"#s2\"]').trigger('click');
            }
            $('.datatable_col_reorder_wrapper .dt-wrapper').addClass('table-responsive');
            var property_exists_flag = " . $property_exists_flag . ";
            if(property_exists_flag == 1){
                var comparable_price_sparkline = ". json_encode(property_exists($comparebles_properties, 'comparable_price_sparkline') ? $comparebles_properties->comparable_price_sparkline : '') .";

            }
            if(typeof comparable_price_sparkline !== 'undefined'){
                var comp_pr_sp = [];
                for(var key in comparable_price_sparkline){
                    comp_pr_sp.push(parseInt(comparable_price_sparkline[key]));
                }
            }
           
            var mob_screen_height,
                mob_screen_width;
            if(screen.width <= 425){
               mob_screen_height = '30px';
               mob_screen_width = '90px';
            }
            $('#goToComparables').click(function() {
                $('html, body').animate({
                    scrollTop: $('#total_comp_prop').offset().top
                }, 2000);
            });
            var cps = $('#comparable_price_sparkline');
            $('#comparable_price_sparkline').sparkline(comp_pr_sp,{
					type : 'box',
					width : mob_screen_width || cps.data('sparkline-width') || 'auto',
					height : mob_screen_height || cps.data('sparkline-height') || 'auto',
					raw : cps.data('sparkline-boxraw') || false,
					target : cps.data('sparkline-targetval') || 'undefined',
					minValue : cps.data('sparkline-min') || 'undefined',
					maxValue : cps.data('sparkline-max') || 'undefined',
					showOutliers : cps.data('sparkline-showoutlier') || true,
					outlierIQR : cps.data('sparkline-outlier-iqr') || 1.5,
					spotRadius : cps.data('sparkline-spotradius') || 0.1,
					boxLineColor : cps.css('color') || '#000000',
					boxFillColor : cps.data('fill-color') || '#c0d0f0',
					whiskerColor : cps.data('sparkline-whis-color') || '#000000',
					outlierLineColor : cps.data('sparkline-outline-color') || '#303030',
					outlierFillColor : cps.data('sparkline-outlinefill-color') || '#f0f0f0',
					medianColor : cps.data('sparkline-outlinemedian-color') || '#f00000',
					targetColor : cps.data('sparkline-outlinetarget-color') || '#40a020'
				});
            ", CClientScript::POS_READY);



Yii::app()->clientScript->registerScript(
        "parentCarouselBlockSetting", "function setImgageToParent(){
                var widthParent = $('#parentCarouselBlock').width();
                $('#parentCarouselBlock img').css('width', widthParent + 'px');
                $('#parentCarouselBlock').css('overflow','hidden');
             }
             setImgageToParent();
             $(document).resize(function(){setImgageToParent();});
            
             $('.carousel').carousel({interval: 5000});
             
            
            ", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript(
        "propertyDetailsScript", "
function getPathImages(){
    var a_path_cdn = '" . CPathCDN::baseurl( 'images' ) ."';
        if(a_path_cdn === '') {
            if (!window.location.origin) { // IE
                return window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
            } else {
                return window.location.origin ;
            }
        } else {
            return a_path_cdn;
        }
}

$(function(){         
    c_properties = " . json_encode($c_properties) . ";
    details_property = " . json_encode($details) . ";
//console.log('c_properties',c_properties);

    details_latitude = {$details->getlatitude}  ? {$details->getlatitude}  : 0;
    details_longitude = {$details->getlongitude} ? {$details->getlongitude} : 0;
    title = '{$details->property_street}';
    map = '';
    markers = [];
    position = '';
    property_exists_flag = {$property_exists_flag} ;
    estimated_value_subject_property = {$estimated_value_subject_property};
//console.log('estimated_value_subject_property',estimated_value_subject_property);
    if(property_exists_flag == 1){
        arrRows = " . json_encode(property_exists($comparebles_properties, 'result_queryAllRows') ? $comparebles_properties->result_queryAllRows : 0 ) . ";    
    }
    comparables_properties = " . json_encode(property_exists($comparebles_properties, 'result_queryAllRows') ? $comparebles_properties->result_queryAllRows : 0 ) . ";
//console.log('comparables_properties',comparables_properties);
    comparables_properties_full = " . json_encode($comparebles_properties) . ";
    details_property_id = {$details->property_id};
    house_sq_footage = {$details->house_square_footage};
    lot_sq_footage = {$details->lot_acreage}; 
    bathrooms = {$details->bathrooms}; 
    garages = {$details->garages};
    pool = {$details->pool};
    house_square_footage = {$details->house_square_footage};
    var propertyPrice = property_price = {$details->property_price};
    lot_acreage = {$details->lot_acreage};
    s_homes = ". json_encode($s_homes) .";
    source_shape = {$shape};
    excluded_by_shape = {$excluded_by_shape};
    marker_on_popup = null;
    comp_min = ". json_encode(property_exists($comparebles_properties, 'comp_min') ? $comparebles_properties->comp_min : 0 ) . ";
    comp_min = parseInt(comp_min);
    var property_type = {$details->property_type};
    if(property_type == 9){
            var roundValue = 1;
            var postfixAfterRounding = '';
            var true_market = 'TMR';
        } else {
            var roundValue = 1000;
            var postfixAfterRounding = 'K';
            var true_market = 'TMV';
        }

    var DTComparablesPropertie;
    var low_sd, high_sd, table2Tail_arr;
    confidence_value = 'tail_90';

    var dTable = $('.dt_basic').dataTable({
             'iDisplayLength':100,
             'sPaginationType' : 'bootstrap_full',
             'aaData': s_homes,
             'bDeferRender': true,
             'aoColumns': [
                            null,
                            { 'sType': 'currency' },
                            null,
                            { 'sType': 'natural' }
             ]
     });

    $('.status_filter .select2').on('change', function() {
        var optionNotSelected = $(this).find('option').not(':selected'),
            excludedStatuses = [],
            data;

        optionNotSelected.each(function(index, element) {
            excludedStatuses.push($(element).val());
        });

        data = {
            property_id: details_property_id,
            excluded_statuses: excludedStatuses
        };

        $.ajax({
            url: '/property/updateexcludedstatuses',
            data: data,
            type: 'POST',
            dataType: 'json',
            cache: false,
            success: function(){
                getNewComparaplesProperties();
            },
            error: function(data){
//                console.log('error ');
            }
        });
    });

    $('#stage-slider input.slider').on('slideStop', function(slideEvt) {
        var sliderValue = slideEvt.value,
            data;

        //stage can't be less then 1
        if (sliderValue <= 0) {
            sliderValue = 1;
        }

        setStageSliderValue(sliderValue);

        data = {
            property_id: details_property_id,
            min_stage: sliderValue
        };

        $.ajax({
            url: '/property/updateminstage',
            data: data,
            type: 'POST',
            dataType: 'json',
            cache: false,
            success: function(){
                getNewComparaplesProperties();
            },
            error: function(data){
//                console.log('error ');
            }
        });
    });

    function setStageSliderValue(value) {
        var slider = $('#stage-slider input.slider');

        slider.attr('data-slider-value', value);
        slider.slider('setValue', value);
        $('#stage-slider .tooltip-inner').text(value);
    }

     function setAllMap(map) {
         for (var i = 0; i < markers.length; i++) {
             /*
             google.maps.event.addListener(markers[i], 'mouseover', function() {
                 var ttl = this.title;
                 $('.title-wraper-block').each(function(){
                     if($.trim($(this).find('a').text()) === ttl){
                         $(this).parent().parent().find('td').each(function(){
                             $(this).css('border-bottom','3px solid #60747C');
                             $(this).css('border-top','3px solid #60747C');
                         });
                     }
                 });
             });

             // assuming you also want to hide the infowindow when user mouses-out
             google.maps.event.addListener(markers[i], 'mouseout', function() {
                 var ttl = this.title;
                 $('.title-wraper-block').each(function(){
                     if($.trim($(this).find('a').text()) === ttl){;
                         $(this).parent().parent().find('td').each(function(){
                             $(this).css('border-bottom','1px solid #dddddd');
                             $(this).css('border-top','1px solid #dddddd');
                         });
                     }
                 });
             });
             */

             typeof map !== 'undefined' ? markers[i].setMap(map) : console.log('map is undefined');

             window.markers = markers;
         }

     }
     function setMarkersArray(latLon_arr){
        var a_path = getPathImages(),
            marker;
        if(typeof markers !== 'undefined'){ markers = []; }

         for(var key = 0; key < latLon_arr.length; key++){
             position = '';
             if( ( ( latLon_arr[key].lat === '0.000000' ) || ( latLon_arr[key].lat === '' )  ) &&
                 ( ( latLon_arr[key].lon === '0.000000' ) || ( latLon_arr[key].lon === '' ) ) ){
                 continue;
             }
             position = new google.maps.LatLng(latLon_arr[key].lat, latLon_arr[key].lon);


            var status = latLon_arr[key].status.toLowerCase();
            switch (status){
                default:
                case 'active':
                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/blue.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                break;

                case 'archive':
                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/gray.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                break;

                case 'action':
                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/green.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                break;

                case 'alert':
                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/red.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                break;

                case 'warning':
                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/yellow.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                break;
                
                case 'closed':
                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/black.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                break;
            }
             marker = new google.maps.Marker({
                     position: position,
                     icon:image,
                     animation: google.maps.Animation.DROP,
                     title: latLon_arr[key].address,
                     property_id: latLon_arr[key].property_id,
                     prop_id: latLon_arr[key].prop_id
                     });

             marker.addListener('click', toggleDetailPopup);

             markers.push(marker);

             bounds.extend(position);
         }
         if(!bounds.isEmpty()) {
            map.fitBounds(bounds);
         }
         setAllMap(map);

     }

     $('.detail-pop-up .close').on('click', function() {
        hideDetailPopup();
     });

     function toggleDetailPopup() {
        var marker = this;

        if (marker === marker_on_popup) {
            hideDetailPopup();
            return;
        }

        hideDetailPopup();
        showDetailPopup(marker);
        updatePopupPosition(marker);
     }

     function updatePopupPosition(marker) {
        var minTop = 0,
            minLeft = 0,
            markerHeight = 40,
            popup$ = $('.detail-pop-up'),
            popupHeight = popup$.height(),
            popupWidth = popup$.width(),
            topRight = map.getProjection().fromLatLngToPoint(map.getBounds().getNorthEast()),
            bottomLeft = map.getProjection().fromLatLngToPoint(map.getBounds().getSouthWest()),
            scale = Math.pow(2, map.getZoom()),
            worldPoint = map.getProjection().fromLatLngToPoint(marker.getPosition()),
            markerCoords = new google.maps.Point((worldPoint.x - bottomLeft.x) * scale, (worldPoint.y - topRight.y) * scale),
            top = (markerCoords['y'] < popupHeight + markerHeight) ? 0 : (markerCoords['y'] - popupHeight - markerHeight),
            left = (markerCoords['x'] < popupWidth) ? 0 : (markerCoords['x'] - popupWidth);

        popup$.css({
            top: top,
            left: left
        });
     }

     function showDetailPopup(marker) {
        var prop_id = marker.prop_id,
            rows$ = $('#DataTables_Table_1').find('tbody tr'),
            is_main_prop = false,
            row$,
            firstPhoto$,
            img$,
            label$,
            price,
            street,
            sqFoots,
            acre,
            beds,
            baths,
            exclude_btn = '';

        marker_on_popup = marker;

        if (typeof prop_id === 'undefined') {
            is_main_prop = true;
            rows$.each(function(index, element) {
                if ($(element).find('.exclude_reinclude').length === 0) {
                    row$ = $(element);
                }
            });

            prop_id = details_property_id;
        } else {
            rows$.each(function(index, element) {
                if ($(element).find('.exclude_reinclude').data('property_id') === prop_id) {
                    row$ = $(element);
                }
            })
        }

        img$ = row$.find('.property_info_row img');
        firstPhoto$ = $('<div>').addClass('item active');
        firstPhoto$.append($('<img>', {
                    src: img$.attr('src'),
                    alt: img$.attr('alt')
                }));
        label$ = row$.find('.label').clone();
        price = row$.find('td').eq(2).text();
        street = row$.find('.property_info_row').text();

        if (is_main_prop !== true) {
            exclude_btn = row$.find('.exclude_reinclude').clone();
            exclude_btn.on('click', function() {
                hideDetailPopup();
                row$.find('.exclude_reinclude').trigger('click');
            });

            $('.detail-pop-up')
                .find('.exclude-btn')
                .append('<span>Exclude from Comps&nbsp</span>');
        }

        $('.detail-pop-up')
            .find('.carousel-inner')
                .append(firstPhoto$)
            .end()
            .find('.label-container')
                .append(label$)
            .end()
            .find('.price').text(price)
            .end()
            .find('.street').text(street)
            .end()
            .find('.exclude-btn')
                .append(exclude_btn)
            .end()
            .fadeIn()
            .appendTo('#map-canvas');

        $.ajax({
            url: '/property/getcomppropertydetails',
            data: {property_id: prop_id},
            type: 'POST',
            dataType: 'json',
            cache: false,
            success: function(data){
                $('#detail-pop-up-carousel').carousel('pause');

                $('.detail-pop-up')
                    .find('.city')
                        .text(data['city'])
                    .end()
                    .find('.subdivision')
                        .text(data['subdivision'])
                    .end()
                    .find('.type')
                        .text(data['type'])
                    .end()
                    .find('.metrics')
                        .html(data['metrics'])
                    .end()
                    .find('.img-container')
                        .append(data['discont'])
                    .end()
                    .find('.img-container')
                        .attr('href',data['url'])
                    .end()
                    .find('.link-container')
                        .attr('href',data['url'])
                    .end()
                    .find('.carousel-inner')
                        .append(data['carousel'])
                    .end()
                    
                if(data['tmv'].length > 0){
                    $('.detail-pop-up')
                    .find('.popup-tmv')
                        .append(true_market + ':')
                    .end()
                    .find('.popup-tmv-price')
                        .append(data['tmv'])
                    .end();
                }    
                $('.detail-pop-up .show-in-table').attr('property_id', data['property_id']);
                updatePopupPosition(marker_on_popup);
            },
            error: function(data){
//                console.log('error: ',data);
            }
        });
     }

     function hideDetailPopup() {
        var popup$ = $('.detail-pop-up'),
            carousel$ = popup$.find('#detail-pop-up-carousel');

        marker_on_popup = null;

        carousel$.find('.carousel-inner').text('');
        popup$
            .find('.img-container')
            .text('')
            .append(carousel$);

        popup$.find('.price').text('');
        popup$.find('.label-container').text('');
        popup$.find('.street').text('');
        popup$.find('.exclude-btn').text('');
        popup$.find('.city').text('');
        popup$.find('.subdivision').text('');
        popup$.find('.type').text('');
        popup$.find('.popup-tmv-price').text('');
        popup$.find('.popup-tmv').text('');
        popup$.find('.metrics').text('');

        $('.detail-pop-up').css('display', 'none');

     }

     function getDataCurrentPage(dataTableObj){
         pseudoMarkers = {};

         latLon_arr = [];
         dataTableObj.find('.property_info_row').each(function(){

            // dont show markers for excluded properties
            if(parseInt($(this).data('excluded')) == 1)
                return true; // Returning non-false is the same as a continue statement in a for loop; it will skip immediately to the next iteration.
            if($(this).data('self')){
                $(this).parent().parent().css('font-weight','bold');
            }
            var arr = {};
            arr.lat = $(this).data('lat');
            arr.lon = $(this).data('lon');
            arr.status = $(this).data('status');
            arr.address = $(this).data('address');
            arr.property_id = $(this).data('property_id');
            arr.prop_id = $(this).closest('tr').find('.exclude_reinclude').data('property_id')

            if (arr.prop_id !== undefined) {
                latLon_arr.push(arr);
                pseudoMarkers[arr.prop_id] = {
                        lat: parseFloat(arr.lat),
                        lng: parseFloat(arr.lon)
                }
            }

            delete arr;
         });

         setMarkersArray(latLon_arr);
         dataTableObj.find('.fa-reply').each(function(){
            var row = $(this).closest('tr');
            $(row).find('td').each(function(){
                $(this).addClass('row-disable');
            });
         });
     }

     function highlightDetailInComparableTable(dataTableObj){
        dataTableObj.find('a[data-property_id='+this.details_property_id+']').each(function(){
            var row = $(this).closest('tr');
            $(row).addClass('success');
        });

     }


     function setDataTableComparablesPropertie(){
        if(DTComparablesPropertie){ DTComparablesPropertie =  $('.datatable_col_reorder').dataTable().fnDestroy();}
        DTComparablesPropertie = $('.datatable_col_reorder').dataTable({
            'sPaginationType' : 'bootstrap',
            'sDom': '<\'dt-top-row\'Clf>r<\'dt-wrapper\'t><\'dt-row dt-bottom-row\'<\'row\'<\'col-sm-6\'i><\'col-sm-6 text-right\'p>>',
            'aaData': c_properties,
            'bDeferRender': true,
            'iDisplayLength' : 25,
            'bAutoWidth': false,
            'stateSave': true,
            'oColVis' : {
//                'aiExclude' : [ 20 ],
//                'abOriginal': [ true,true,true,true,true,true,true,true,true,true,true,false,false,false,false,false,false,false,false,false ],
            },
            'aoColumns': [
                            { 'sType': 'num-html' },
                            null,
                            { 'sType': 'currency' },
                            { 'sType': 'currency' },
                            null,
                            null,
                            { 'sType': 'currency' },
                            { 'sType': 'natural' },
                            null,
                            null,
                            { 'bVisible' : false }, // garage
                            null,
                            null,
                            null,

                            { 'bVisible' : false },
                            { 'bVisible' : false },
                            { 'bVisible' : false },
                            { 'bVisible' : false },
                            { 'bVisible' : false },
                            { 'bVisible' : false },
                            { 'bVisible' : false },
                            { 'bVisible' : false },
                            { 'bVisible' : false },
                            { 'bVisible' : false },
                            { 'bVisible' : false },
                            { 'bVisible' : false },
                            { 'bVisible' : false, 'sType': 'currency' },
                            { 'bVisible' : false },

                            { 'sType': 'num-html' },
                     ],
            'bScrollCollapse': false,
            'fnDrawCallback': function () {
                setAllMap(null);
                highlightDetailInComparableTable($(this));
                var current_page = this.fnPagingInfo().iPage+1;

                getDataCurrentPage($(this));
             },
             bStateSave: true,
            fnStateSave: function(oSettings, oData) {
              localStorage.setItem('DataTables_' + this.fnSettings().sTableId, JSON.stringify(oData));
            },
            fnStateLoad: function (oSettings) {
              return JSON.parse(localStorage.getItem('DataTables_' + this.fnSettings().sTableId));
            },
            'fnInitComplete' : function(oSettings, json) {
                    $('.ColVis_Button').addClass('btn btn-default btn-sm').html('Columns <i class=\"icon-arrow-down\"></i>');
            }
        });
        countActiveCompProperties();

    }

    function initialize() {
         var pos = new google.maps.LatLng(details_latitude, details_longitude);
         var mapOptions = {
           zoom: 12,
           minZoom : 2,
           center: pos

         };
         map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        var a_path = getPathImages();
        colorScheme = ".json_encode(SiteHelper::defineColorScheme($details)).";
        status = colorScheme.status.toLowerCase(); 
         switch (status){
                default:
                case 'active':
                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/blue.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                break;

                case 'archive':
                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/gray.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                break;

                case 'action':
                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/green.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                break;

                case 'alert':
                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/red.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                break;

                case 'warning':
                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/yellow.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                break;
                
                case 'closed':
                    var image = new google.maps.MarkerImage(a_path + '/images/map-icons/black.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                break;
            }
        bounds = new google.maps.LatLngBounds();
        bounds.extend(pos);
        var marker = new google.maps.Marker({
                        position: pos,
                        animation: google.maps.Animation.DROP,
                        map: map,
                        icon: image,
                        title: title
                    });

        marker.addListener('click', toggleDetailPopup);

        $('.detail-pop-up').on('mousewheel', function(e) {
            e.preventDefault();
            e.stopPropagation();

            //$('#detail-pop-up-carousel').carousel('pause');
            if(e.originalEvent.wheelDelta / 120 > 0) {
                $('#detail-pop-up-carousel').carousel('prev');
            } else {
                $('#detail-pop-up-carousel').carousel('next');
            }
         });
         
         /*
         google.maps.event.addListener(marker, 'mouseover', function() {
             var ttl = this.title;
                 $('.title-wraper-block').each(function(){

                     if($.trim($(this).find('a').text()) === ttl){
                         $(this).parent().parent().find('td').each(function(){
                             $(this).css('border-bottom','3px solid #60747C');
                             $(this).css('border-top','3px solid #60747C');
                         });
                     }
                 });
         });

         
         google.maps.event.addListener(marker, 'mouseout', function() {
             var ttl = this.title;
                 $('.title-wraper-block').each(function(){

                     if($.trim($(this).find('a').text()) === ttl){;
                         $(this).parent().parent().find('td').each(function(){
                             $(this).css('border-bottom','1px solid #dddddd');
                             $(this).css('border-top','1px solid #dddddd');
                         });
                     }
                 });
         });
         */

         if(c_properties){
            setDataTableComparablesPropertie();
         }
         search_fld = new google.maps.places.Autocomplete(document.getElementById('search-fld'),{ types: ['geocode'] });
         google.maps.event.addListener(search_fld, 'place_changed', function() { fillInAddressSearchFld(); });

         setupShape();
         
     }
     var myMap = google.maps.event.addDomListener(window, 'load', initialize);
     
     var componentFormSearchFld = {
          street_number_searchfld: 'short_name',
          route_searchfld: 'long_name',
          locality_searchfld: 'long_name',
          administrative_area_level_1_searchfld: 'short_name',
          country_searchfld: 'long_name',
          postal_code_searchfld: 'short_name'
        };
        
    function fillInAddressSearchFld() {
      var place = search_fld.getPlace();

      for (var component in componentFormSearchFld) {

        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
      }
      for (var i = 0; i < place.address_components.length; i++) {

        var addressType = place.address_components[i].types[0];
        if (componentFormSearchFld[addressType+'_searchfld']) {
          var val = place.address_components[i][componentFormSearchFld[addressType+'_searchfld']];
          document.getElementById(addressType+'_searchfld').value = val;
        }
      }
    }
     
     $('#wid-id-2map .onoffswitch-label').click(function(){
        if($('#myonoffswitch2').prop('checked') === true ){
               setAllMap(null); 
        } else {
            setAllMap(map);
        }  
     });
     
     $('.datatable_col_reorder').on('click', 'button.save_property', function(){
        var property_id = $(this).data('property_id');
        $.ajax({
            url: '/property/favorites',
            data: {propery_id: property_id},
            type: 'POST',
            dataType: 'json',
            cache: false,
            success: function(data){
                $('.comparables-properties-response').empty().html(data);
                $('.comparables-properties-response').css('display','block');
                $('.comparables-properties-response').animate({opacity:1},1000);
                $('.comparables-properties-response').animate({opacity:'hide'},2000);
            },
            error: function(data){
//                console.log('error: ',data);
            }
        });
    });
    
    $('#wid-id-2dt-c .onoffswitch-label').click(function(){
        if($('#myonoffswitch').prop('checked') === true ){
                $('.carousel').carousel('pause');
        } else {
            $('.carousel').carousel({interval: 5000}); 
        }  
     });
     
     $('#confidence_slider .slider').on('slide', function(slideEvt) {
            var slider_value = slideEvt.value;
            $('#confidence_chart').data('easyPieChart').update(parseInt(slider_value));
            $('#confidence_chart_text').html(slider_value);
            $('#confidence_slider .tooltip-inner').text(parseInt(slider_value));
       });

        $('#confidence_slider .slider').on('slideStop', function(slideEvt){
            var slider_value = slideEvt.value;

            $('#confidence_chart').data('easyPieChart').update(parseInt(slider_value));
            $('#confidence_chart_text').html(slider_value);
            $('#confidence_slider .tooltip-inner').text(parseInt(slider_value));

            if (slider_value){
                if(slider_value === 50){
                    confidence_value = 'tail_50';
                } 
                if ( (slider_value > 50) && (slider_value <= 60) ) {
                    confidence_value = 'tail_60';
                } 
                if ( (slider_value > 60) && (slider_value <= 70) ) {
                    confidence_value = 'tail_70';
                } 
                if ( (slider_value > 70) && (slider_value <= 80) ) {
                    confidence_value = 'tail_80';
                } 
                if ( (slider_value > 80) && (slider_value <= 90) ) {
                    confidence_value = 'tail_90';
                } 
                if ( (slider_value > 90) && (slider_value <= 95) ) {
                    confidence_value = 'tail_95';
                } 
                if ( slider_value === 96 ) {
                    confidence_value = 'tail_96';
                } 
                if ( (slider_value > 96) && (slider_value <= 98) ) {
                    confidence_value = 'tail_98';
                } 
                if ( slider_value === 99 ) {
                    confidence_value = 'tail_99';
                }
                
                getNewComparaplesProperties();
            }
        });

    // Drawing boundaries
    var pseudoMarkers = {},
        excludedProps = {}, // get from data
        drawingManager,
        selectedShape;

    //draw rectangle
    $('.rectangle').click(function() {                                                          //  RECTANGLE
        deleteSelectedShape();

        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.RECTANGLE,
            drawingControl: false,
            drawingControlOptions: {
                drawingModes: [
                    google.maps.drawing.OverlayType.RECTANGLE
                ]
            },
            rectangleOptions: {
                editable: true,
                strokeWeight: 0
            }
        });

        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, 'rectanglecomplete', function(rectangle) {
            drawingManager.setDrawingMode(null);
            setSelection(rectangle);

            updateComparableProperties();

            google.maps.event.addListener(rectangle, 'bounds_changed', function() {
                updateComparableProperties();
            });
        });
    });

    //draw circle
    $('.radius').click(function() {
        deleteSelectedShape();

        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.CIRCLE,
            drawingControl: false,
            drawingControlOptions: {
                drawingModes: [
                    google.maps.drawing.OverlayType.CIRCLE
                ]
            },
            circleOptions: {
                strokeWeight: 0,
                editable: true
            }
        });

        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, 'circlecomplete', function(circle) {
            drawingManager.setDrawingMode(null);
            setSelection(circle);

            updateComparableProperties();

            google.maps.event.addListener(circle, 'center_changed', function(){
                updateComparableProperties();
            });

            google.maps.event.addListener(circle, 'radius_changed', function(){
                updateComparableProperties();
            });
        });
    });

    //draw polygon
    $('.freehand').click(function() {
        deleteSelectedShape();

        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: false,
            drawingControlOptions: {
                drawingModes: [
                    google.maps.drawing.OverlayType.POLYGON
                ]
            },
            polygonOptions: {
                strokeWeight: 0,
                editable: true
            }
        });

        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
            drawingManager.setDrawingMode(null);
            setSelection(polygon);

            updateComparableProperties();

            google.maps.event.addListener(polygon.getPath(), 'set_at', function() {
                updateComparableProperties();
            });

            google.maps.event.addListener(polygon.getPath(), 'insert_at', function() {
                updateComparableProperties();
            });
        });
    });

    // remove selected shape
    $('.delete-button').click(function() {
        deleteSelectedShape();
    });

    function setupShape() {
        //draw shape
        drawShapeFromJSON(source_shape);

        // setup excluded by shape
        if (!$.isArray(excluded_by_shape)) {
            excludedProps = excluded_by_shape;
        }
    }

    function drawShapeFromJSON(source_json) {
        var json = source_json,
            bounds,
            center,
            radius,
            path;

        // if empty
        if (Object.keys(json).length === 0) {
            return;
        }

        if (json.type === 'rectangle') {
            bounds = json.bounds;

            selectedShape = new google.maps.Rectangle({
                editable: true,
                strokeWeight: 0,
                map: map,
                bounds: bounds
            });

            // events
            google.maps.event.addListener(selectedShape, 'bounds_changed', function() {
                updateComparableProperties();
            });

        } else if (json.type === 'circle') {
            center = json.center;
            radius = json.radius;

            selectedShape = new google.maps.Circle({
                strokeWeight: 0,
                editable: true,
                map: map,
                center: center,
                radius: radius
            });

            // events
            google.maps.event.addListener(selectedShape, 'center_changed', function() {
                updateComparableProperties();
            });

            google.maps.event.addListener(selectedShape, 'radius_changed', function() {
                updateComparableProperties();
            });
        } else if (json.type === 'polygon') {
            path = json.path;

            selectedShape = new google.maps.Polygon({
                strokeWeight: 0,
                editable: true,
                map: map,
                paths: path
            });

            // events
            google.maps.event.addListener(selectedShape.getPath(), 'set_at', function() {
                updateComparableProperties();
            });

            google.maps.event.addListener(selectedShape.getPath(), 'insert_at', function() {
                updateComparableProperties();
            });
        }
    }

    function deleteSelectedShape() {
        if (selectedShape) {
            selectedShape.setMap(null);
        }

        selectedShape = null;

        updateComparableProperties();
    }

    function setSelection(shape) {
        selectedShape = shape;
        shape.setEditable(true);
    }

    function getJsonShape() {
        var json = {},
            path;

        if (!selectedShape) {
            return json;
        }

        if (selectedShape.constructor === google.maps.Rectangle) {
            json.type = 'rectangle';
            json.bounds = selectedShape.getBounds().toJSON();

        } else if (selectedShape.constructor === google.maps.Circle) {
            json.type = 'circle';
            json.center = selectedShape.getCenter().toJSON();
            json.radius = selectedShape.radius;
        } else if (selectedShape.constructor === google.maps.Polygon) {
            json.type = 'polygon';
            json.path = [];
            path = selectedShape.getPath().getArray();

            for (var i = 0, l = path.length; i < l; i++) {
                json.path.push(path[i].toJSON());
            }
        }

        return json;
    }

    function updateComparableProperties(propsForExcluding){
        var propertiesForExcluding = propsForExcluding || getPropsForExcluding(), // object id:position
            propertiesForIncluding = getPropsForIncluding(), // object id:position
            propsForExcludingNum = Object.keys(propertiesForExcluding).length,
            shape = getJsonShape(),
            data;

        if (propsForExcludingNum > 0 && !canExclude(propsForExcludingNum)) {
            showMinComparableMessage();
            return;
        }

        data = {
            property_id: details_property_id,
            shape: JSON.stringify(shape),
            propertiesForExcluding: JSON.stringify(propertiesForExcluding),
            propertiesForIncluding: JSON.stringify(propertiesForIncluding)
        };

        $.when(
            $('#wid-id-2map').find('.jarviswidget-loader').eq(0).css('display', 'block'),

            $.ajax({
                url: '/property/updatepropsbyshape',
                data: data,
                type: 'POST',
                dataType: 'json',
                cache: false,
                success: function(data) {
                    //console.log('success:', data);
                    excludedProps = data;
                },
                error: function(data) {
                    console.log('error:', data);
                }
            })
        ).then(getNewPropsSet);
    }

    function getNewPropsSet() {
        $.ajax({
            url: '/property/getmoreconfidenceinfo',
            data: {
                property_id: details_property_id,
                tail: confidence_value
            },
            type: 'POST',
            dataType: 'json',
            cache: false,
            success: function(data){
                var propsForExcluding,
                    propsForExcludingNum;

                if (data.status.toLowerCase() === 'success') {
                    current_stage = data.comparebles['current_stage'];
                    setStageSliderValue(current_stage);
                    comp_min = parseInt(data.comparebles['comp_min']);

                    c_properties = [];
                    c_properties = data.c_properties;

                    setDataTableComparablesPropertie();
                    countActiveCompProperties(current_stage);

                    propsForExcluding = getPropsForExcluding();
                    propsForExcludingNum = Object.keys(propsForExcluding).length;

                    if (propsForExcludingNum > 0 && canExclude(propsForExcludingNum)) {
                        //continue excluding
                        updateComparableProperties();
                    } else {
                        //prevent excluding
                        resetTMV(data.comparebles);
                        resetComparablePriceSparkline(data.comparebles.comparable_price_sparkline);
                        $('#wid-id-2map').find('.jarviswidget-loader').eq(0).css('display', 'none');

                        if (isNotEnoughData()) {
                            showNotEnoughDataMessage();
                        } else if (isMinComparable()) {
                            showMinComparableMessage();
                        }
                    }
                }
            },
            error: function(data){ console.log('error: ',data);}
        });
    }

    function getPropsForIncluding() {
        var coordinates,
            propertiesForIncluding = {},
            position = {};

        if (!selectedShape) {
            return excludedProps;
        }

        if (selectedShape.constructor === google.maps.Polygon) {
            for(var prop in excludedProps){
                position = new google.maps.LatLng(excludedProps[prop]);

                if (google.maps.geometry.poly.containsLocation(position, selectedShape)) {
                    propertiesForIncluding[prop] = excludedProps[prop];
                }
            }

            return propertiesForIncluding;
        }

        // for rectangle and circle
        coordinates = selectedShape.getBounds();
        for(var prop in excludedProps){
            position = new google.maps.LatLng(excludedProps[prop]);

            if (coordinates.contains(position)) {
                propertiesForIncluding[prop] = excludedProps[prop];
            }
        }

        return propertiesForIncluding;
    }

    function getPropsForExcluding() {
        var coordinates,
            propertiesForExcluding = {},
            position = {};

        if (!selectedShape) {
            return propertiesForExcluding;
        }

        if (selectedShape.constructor === google.maps.Polygon) {
            for(var prop in pseudoMarkers){
                position = new google.maps.LatLng(pseudoMarkers[prop]);

                if (!google.maps.geometry.poly.containsLocation(position, selectedShape)) {
                    propertiesForExcluding[prop] = pseudoMarkers[prop];
                }
            }

            return propertiesForExcluding;
        }

        // for rectangle and circle
        coordinates = selectedShape.getBounds();
        for(var prop in pseudoMarkers) {
            position = new google.maps.LatLng(pseudoMarkers[prop]);

            if (!coordinates.contains(position)) {
                propertiesForExcluding[prop] = pseudoMarkers[prop];
            }
        }

        return propertiesForExcluding;
    }

    function getNewComparaplesProperties() {
        $.ajax({
            url: '/property/getmoreconfidenceinfo',
            data: {
                property_id: details_property_id,
                tail: confidence_value
            },
            type: 'POST',
            dataType: 'json',
            cache: false,
            success: function(data){

                if(data.status.toLowerCase() === 'success'){
                    current_stage = data.comparebles['current_stage'];
                    setStageSliderValue(current_stage);

                    comp_min = parseInt(data.comparebles['comp_min']);

                    c_properties = [];
                    c_properties = data.c_properties;

                    setDataTableComparablesPropertie();
                    countActiveCompProperties(current_stage);

                    resetTMV(data.comparebles);
                    resetComparablePriceSparkline(data.comparebles.comparable_price_sparkline);

                    if (isNotEnoughData()) {
                        showNotEnoughDataMessage();
                    } else if (isMinComparable()) {
                        showMinComparableMessage();
                    }
                }
            },
            error: function(data){ /*console.log('error: ',data);*/}
       });
    }
    
    function resetComparablePriceSparkline(arr){
        var sparkline_new = [];
        for(var k in arr){
            sparkline_new.push(arr[k]);
        }
        var sparkline_new_sort = sparkline_new.sort(function(a,b){return a - b;});
        var  cps = $('#comparable_price_sparkline');
        $('#comparable_price_sparkline').sparkline(sparkline_new_sort,{
            type : 'box',
            width : cps.data('sparkline-width') || 'auto', 
            height : cps.data('sparkline-height') || 'auto',
            raw : cps.data('sparkline-boxraw') || false, 
            target : cps.data('sparkline-targetval') || 'undefined', 
            minValue : cps.data('sparkline-min') || 'undefined', 
            maxValue : cps.data('sparkline-max') || 'undefined', 
            showOutliers : cps.data('sparkline-showoutlier') || true, 
            outlierIQR : cps.data('sparkline-outlier-iqr') || 1.5, 
            spotRadius : cps.data('sparkline-spotradius') || 0.1, 
            boxLineColor : cps.css('color') || '#000000', 
            boxFillColor : cps.data('fill-color') || '#c0d0f0', 
            whiskerColor : cps.data('sparkline-whis-color') || '#000000', 
            outlierLineColor : cps.data('sparkline-outline-color') || '#303030', 
            outlierFillColor : cps.data('sparkline-outlinefill-color') || '#f0f0f0', 
            medianColor : cps.data('sparkline-outlinemedian-color') || '#f00000', 
            targetColor : cps.data('sparkline-outlinetarget-color') || '#40a020'
    });
    }
    
    function resetTMV(obj){
        data = obj.result_query;
        $('#min_sqft').empty().html(accounting.formatNumber(data.min_sqft));
        $('#max_sqft').empty().html(accounting.formatNumber(data.max_sqft));
        var d_sqft = parseFloat(data.max_sqft) - parseFloat(data.min_sqft);
        var d_detail_sqft = parseFloat(house_square_footage) - parseFloat(data.min_sqft);
        var min_sqft_max_sqft_progress = d_detail_sqft > 0 && d_sqft != 0 ? d_detail_sqft * 100 / d_sqft : 0;
        $('#min_sqft_max_sqft_progress').css('width', accounting.toFixed(min_sqft_max_sqft_progress)+'%');

        $('#lowppsqft_1').empty().html('$'+accounting.toFixed(data.min_ppsqft, 2));
        $('#highppsqft_1').empty().html('$'+accounting.toFixed(data.max_ppsqft, 2));
        var d_ppsqft = parseFloat(data.max_ppsqft) - parseFloat(data.min_ppsqft);
        var d_price_per_sq = parseFloat(property_price / house_square_footage) - parseFloat(data.min_ppsqft);
        var price_per_sq_progress = d_price_per_sq > 0 && d_ppsqft != 0 ? d_price_per_sq * 100 / d_ppsqft : 0;
        $('#price_per_sq_progress').css('width', accounting.toFixed(price_per_sq_progress)+'%');

        $('#lowlot_1').empty().html(accounting.toFixed(data.min_lot, 2));
        $('#highlot_1').empty().html(accounting.toFixed(data.max_lot, 2));
        var d_lot = parseFloat(data.max_lot) - parseFloat(data.min_lot);
        var d_lot_size = parseFloat(lot_acreage) - parseFloat(data.min_lot);
        var lot_size_progress = d_lot_size > 0 && d_lot != 0 ? d_lot_size * 100 / d_lot : 0;
        $('#lot_size_progress').css('width', accounting.toFixed(lot_size_progress)+'%');
        
        $('#min_price').empty().html('$'+accounting.toFixed(data.min_price/ roundValue)+ postfixAfterRounding);
        $('#max_price').empty().html('$'+accounting.toFixed(data.max_price/ roundValue)+ postfixAfterRounding);
        var d_range_price = parseInt(data.max_price) - parseInt(data.min_price);
        var d_price = parseInt(property_price) - parseInt(data.min_price);
        var min_price_max_price_progress = d_price > 0 && d_range_price != 0 ? d_price * 100 / d_range_price : 0;
        $('#min_price_max_price_progress').css('width', accounting.toFixed(min_price_max_price_progress)+'%');
        

        $('#low_value').empty().html('$'+accounting.toFixed(obj.low_range / roundValue)+ postfixAfterRounding);
        $('#high_value').empty().html('$'+accounting.toFixed(obj.high_range / roundValue)+ postfixAfterRounding);
        var d_estimated = parseFloat(obj.high_range) - parseFloat(obj.low_range) ;
        var estimated_value_subject_property = parseFloat(obj.estimated_value_subject_property) - parseFloat(obj.low_range) ;
        var low_value_high_value_progress = estimated_value_subject_property > 0 && d_estimated != 0 ? estimated_value_subject_property * 100 / d_estimated : 0;
        resetEstimatedEquity(obj.estimated_value_subject_property);
        var estimated_value_subject_property_str = obj.estimated_value_subject_property ?
            '<span class=\"txt-color-green\">$' + accounting.formatNumber(obj.estimated_value_subject_property) + '</span>' : 
            '<span title=\"Not Enough Data\" class=\"txt-color-green\">-</span>';
        $('#tmv').empty().html(estimated_value_subject_property_str);
//        $('#tmvh2').empty().html(estimated_value_subject_property_str);
        var tmvalue = obj.estimated_value_subject_property ? '$' + accounting.formatNumber(obj.estimated_value_subject_property) : '';
        $('#tmvalue').empty().html(tmvalue);
        $('#low_value_high_value_progress').css('width', accounting.toFixed(low_value_high_value_progress)+'%');
        if (obj.low_range) {
            $('.low_value_b').html(accounting.toFixed(obj.low_range / roundValue)+ postfixAfterRounding);
        } else {
            $('.low_value_b').empty();
        }

        if (obj.high_range) {
            $('#high_value_b').html(accounting.toFixed(obj.high_range / roundValue)+ postfixAfterRounding);
        } else {
            $('#high_value_b').empty();
        }

        $('#high_value_b2').html(accounting.toFixed(obj.high_range / roundValue));
        $('#low_value_b2').html(accounting.toFixed(obj.low_range / roundValue)+'K');
        $('#high_value_b2_label').attr('title', 'High Estimated Range of '+accounting.formatMoney(obj.high_range, '$', 0));
        $('#low_value_b2_label').attr('title', 'Low Estimated Range of '+accounting.formatMoney(obj.low_range, '$', 0));
    }

    function resetEstimatedEquity(tmv){
        
        var estimatedEquity;

        if (tmv == 0) {
            estimatedEquity = '<span title=\"Not Enough Data\" class=\"txt-color-green\">-</span>';
        } else {
            estimatedEquity = '$' + accounting.formatNumber(tmv - propertyPrice);
        }

        $('#dynamicEstimatedEquity').html(estimatedEquity);
    }
    
    function sendRequest(property_id, url){
        $.ajax({
            url: url,
            data: {property_id: property_id},
            type: 'POST',
            dataType: 'json',
            cache: false,
            success: function(data){

            },
            error: function(data){/*console.log('error: ',data);*/}
        });
    }               

    function showAlert(text){
        $('.comparables-properties-response').empty().html(text);
        $('.comparables-properties-response').css('display','block');
        $('.comparables-properties-response').animate({opacity:1},1000);
        $('.comparables-properties-response').animate({opacity:'hide'},4000);
    }
    
    $('.datatable_col_reorder').on('click', 'button.exclude_reinclude', clickExcludeIncludeBtn);

     function clickExcludeIncludeBtn(){
     console.log(13);
        var infoElement,
            point,
            lat,
            lng;

        property_id = $(this).data('property_id');

        //check if the prop is inside the shape
        if($(this).hasClass('fa-reply')) {
            if (selectedShape) {
                infoElement = $(this).closest('tr').find('.property_info_row');
                lat = parseFloat(infoElement.data('lat'));
                lng = parseFloat(infoElement.data('lon'));
                point = new google.maps.LatLng(lat, lng);

                if (selectedShape.constructor === google.maps.Polygon) {
                    if (!google.maps.geometry.poly.containsLocation(point, selectedShape)) {
                        showMessage('<p>The property lies outside the drawn area.</p><p>Please remove or expand the area</p>');
                        return false;
                    }
                } else {
                    if (!selectedShape.getBounds().contains(point)) {
                        showMessage('<p>The property lies outside the drawn area.</p><p>Please remove or expand the area</p>');
                        return false;
                    }
                }
            }
        }

        if (canExclude(1)) {
        console.log(this);
            $(this).toggleClass('fa-times');
            $(this).toggleClass('fa-reply');
            if($(this).hasClass('fa-reply')){
                for(var k in markers){
                    if(markers[k].property_id === property_id){
                        markers[k].visible = false;
                    }
                }
                if($('#myonoffswitch2').prop('checked') === true ){
                    setAllMap(map);
                }

                var row = $(this).closest('tr');
                $(row).find('td').each(function(){
                    $(this).addClass('row-disable');
                });
                sendRequest(property_id, '/property/addexcludeproperty');
                getNewComparaplesProperties();
                
                return false;
            }
            if($(this).hasClass('fa-times')){
                for(var k in markers){
                    if(markers[k].property_id === property_id){
                        markers[k].visible = true;
                    }
                }
                
                if($('#myonoffswitch2').prop('checked') === true ){

                    setAllMap(map);
                }

                var row = $(this).closest('tr');
                $(row).find('td').each(function(){
                    $(this).removeClass('row-disable');
                });                                   
                sendRequest(property_id, '/property/deleteexcludeproperty');
                getNewComparaplesProperties();
                return false;
              } 
        } else {

            if($(this).hasClass('fa-reply')){
                $(this).toggleClass('fa-times');
                $(this).toggleClass('fa-reply');

                var row = $(this).closest('tr');
                $(row).find('td').each(function(){
                    $(this).removeClass('row-disable');
                });
                sendRequest(property_id, '/property/deleteexcludeproperty');
                getNewComparaplesProperties();
                return false;
              }
            else{
                showMinComparableMessage();
            }
        }

    };

    function showMessage(text){
        var alert = $('.alert-remove-exclude').clone(true);

        alert
            .find('.msg')
            .empty()
            .html(text);

        alert
            .appendTo($('body'))
            .fadeIn(300);
    }

    function showMinComparableMessage(){
        if($('.datatable_col_reorder').find('i').hasClass('fa-times')){
                $('.comparables-properties-response').empty().html('You’ve reached the minimum number of comparable records allowed');
                $('.comparables-properties-response').css('display','block');
                $('.comparables-properties-response').animate({opacity:1},500);
                var comparablesPropertiesResponse = $('.comparables-properties-response');
                setTimeout(function(){comparablesPropertiesResponse.animate({opacity:'hide'},500);}, 2000);
                return false;
            }
    }

    function showNotEnoughDataMessage(){
        var comparablesPropertiesResponse$ = $('.comparables-properties-response');

        comparablesPropertiesResponse$
            .empty()
            .html('Not enough comparable market data')
            .css('display','block')
            .animate({opacity:1},500);

        setTimeout(function(){comparablesPropertiesResponse$.animate({opacity:'hide'},500);}, 2000);
    }

    function countActiveCompProperties(current_stage){
        if(typeof current_stage !== 'undefined'){
            current_stage = current_stage;
            $('#total_comp_prop').attr('title', 'Comp Stage = '+current_stage)
        }

        var total_comp_prop_str = $('#total_comp_prop').text();
        var total_comp_prop_num = $('.datatable_col_reorder i.fa-times').length;
        var total_comp_prop_substr = total_comp_prop_str.substr(-22);
        var recalc_stage_substr;

        var new_total_comp_prop_str = total_comp_prop_num + total_comp_prop_substr;

        $('#total_comp_prop').empty().text(new_total_comp_prop_str);
    }

    function canExclude(count_for_excluding) {
        var total_comp_prop_num = $('.datatable_col_reorder .fa-times').length;

        count_for_excluding = count_for_excluding || 0;
        total_comp_prop_num -= count_for_excluding;

        if (current_stage == 100 && total_comp_prop_num < comp_min) {
            return false;
        } else {
            return true;
        }
    }

    function isMinComparable(count_for_excluding) {
        var total_comp_prop_num = $('.datatable_col_reorder i.fa-times').length;

        count_for_excluding = count_for_excluding || 0;
        total_comp_prop_num -= count_for_excluding;

        if (current_stage == 100 && total_comp_prop_num <= comp_min) {
            return true;
        } else {
            return false;
        }
    }

    function isNotEnoughData() {
        var total_comp_prop_num = $('.datatable_col_reorder i.fa-times').length;

        if (current_stage == 100 && total_comp_prop_num < comp_min) {
            return true;
        } else {
            return false;
        }
    }

    $('#confidence_chart').data('easyPieChart').update(90);
    $('#confidence_chart_text').html(90);

    if(typeof c_properties !== 'undefined'){
        confidence_value = 'tail_90';
    }
    
    

}); ", CClientScript::POS_READY );

Yii::app()->clientScript->registerScript(
        "propDetScriptDayson", "
$(document).ready(function(){
    $('#daysonmarket_chart').data('easyPieChart').update($quantity);
});

           ", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript(
        "propDetSearchPost", "

$('.search-field-query').click(function(){
var city = $(this).data('city');
var state = $(this).data('state');
var zipcode = $(this).data('zipcode');
var subdivision = $(this).data('subdivision');
var searchfld = city+' '+state+' '+zipcode;
$.form('/property/search', { city_searchfld : city, state_searchfld : state, zipcode_searchfld : zipcode, subdivision_searchfld : subdivision, sale_type_searchfld:'For Sale', searchfld: searchfld, 'top-search-submit' : 1  }, 'POST').submit();
});
           ", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript("TableMapBinding","
            $('.show-in-table').on('click',function(e){
                e.preventDefault();
                var id = $(this).attr('property_id');
        
                showPropertyInTable(id);
            });
            function showPopover(item){ 
                if($(item).hasClass('fa-reply')){
                    $(item).popover({
                        content : 'Reinclude this property in the comparables and the TMV calculation'
                    })
                } else {
                    $(item).popover({
                        content : 'Exclude this property from the comparables'
                    })
                }
                $(item).popover('show');
            }
            
            function hidePopover(item){
                $(item).popover('hide');
            }
           function showinmap(el){
                var id = $(el).attr('property_id');
                $.each(markers, function() {
                   if (this.property_id == id) {
                      this.setAnimation(google.maps.Animation.BOUNCE);
                   } else {
                      this.setAnimation(null);
                   }
                });
                scroll = $('#wid-id-2map').offset().top;
                $('html, body').animate(
                    {scrollTop: scroll},
                    1000,
                    'easeOutQuart'
                );
                return false;
            };
              function showPropertyInTable(id){
                $('#wid-id-2proptbl').find('.table').addClass('blur');
                    var targetRow = $('#wid-id-2proptbl')
                    .find('[data-property_id=\"'+id + '\"]')
                    .closest('tr'),
                    targetBody = $('html, body'),
                    scroll = targetRow.offset().top - $( window ).height()/2;
                    targetRow.addClass('show-row');
                    console.log(targetRow);
                    setTimeout(function(){
                        $('#wid-id-2proptbl').find('.table').removeClass('blur');
                        targetRow.removeClass('show-row');
                    },3000);
                    
                targetBody.animate(
                    {scrollTop: scroll},
                    1000,
                    'easeOutQuart'
                );
            }

",CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/details.js', CClientScript::POS_END);


