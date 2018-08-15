<?php

$session = Yii::app()->session;
$uri_page = '@'.Yii::app()->request->url; 
$recent_pages = 'Search'.$uri_page;
if(!isset($session['recent_pages']) || count($session['recent_pages'])==0){
    $session['recent_pages'] = array($recent_pages);
} else {
    $sess_arr = $session['recent_pages'];
    $sess_arr[]=$recent_pages;
    $session['recent_pages'] = $sess_arr;
}
$cs = Yii::app()->clientScript;
$themePath = Yii::app()->theme->baseUrl;
$this->title = 'Search'; 
$property_type_array = array('0' => 'Unknown',
    '1' => 'Single Family Home',
    '2' => 'Condo',
    '3' => 'Townhouse',
    '4' => 'Multi Family',
    '5' => 'Land',
    '6' => 'Mobile Home',
    '7' => 'Manufactured Home',
    '8' => 'Time Share',
    '9' => 'Rental',
    '16' => 'High Rise');
if (!Yii::app()->user->isGuest) {
    echo $this->renderPartial('/layouts/aside', array('profile' => $profile));
}
?>
<!-- END NAVIGATION -->
<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">

        <span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all of your personalized widget settings." data-html="true"><i class="fa fa-refresh"></i></span> </span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>
                Real Estate Search
            </li>
            <li>
                Homes for Sale
            </li>
        </ol>
        <!-- end breadcrumb -->

        <!-- You can also add more buttons to the
        ribbon for further usability

        Example below:

        <span class="ribbon-button-alignment pull-right">
        <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
        <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
        <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
        </span> -->

    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">


        <!-- widget grid -->
        <section id="widget-grid" class="">

            <div class="row">

                <!-- NEW WIDGET START -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget" id="wid-id-sfilter" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-collapsed="false" data-widget-fullscreenbutton="false">
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
                            <h2 class="page-title txt-color-blueDark">
                                <i class="fa fa-search"></i> 
                                Search Filters = <span id="filter-search-page"></span>
                                <i class="fa fa-filter"></i>
                            </h2>

                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default" id="search_list" title="List View">
                                    <i class="fa fa-list-ul"></i> List
                                </button>
                                <button type="button" class="btn btn-default" id="search_map" title="Map View">
                                    <i class="fa fa-globe"></i> Map
                                </button>
                                <!--                                <button type="button" class="btn btn-default" title="Photo Gallery">
                                                                    <i class="fa fa-th"></i> Gallery
                                                                </button>-->
                            </div>

                        </header>

                        <!-- widget div-->
                        <div id="s_f_block">

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body">

                                <form class="form-horizontal"
                                      id="main_search_form"
                                      action="<?php echo Yii::app()->createUrl('property/search') ?>"
                                      method="POST"
                                      name="search">

                                <?php

                                $input_values['address'] = array_key_exists('searchfld', $top_search) ? $top_search['searchfld'] : '';
                                if($input_values['address'] == '')
                                    $input_values['address'] = array_key_exists('address', $general_search_fields) ? $general_search_fields['address'] : '';

                                $input_values['street_number'] = array_key_exists('street_number_searchfld', $top_search) ? $top_search['street_number_searchfld'] : '';
                                if($input_values['street_number'] == '')
                                    $input_values['street_number'] = array_key_exists('street_number', $general_search_fields) ? $general_search_fields['street_number'] : '';

                                $input_values['street_address'] = array_key_exists('street_address_searchfld', $top_search) ? $top_search['street_address_searchfld'] : '';
                                if($input_values['street_address'] == '')
                                    $input_values['street_address'] = array_key_exists('street_address', $general_search_fields) ? $general_search_fields['street_address'] : '';

                                $input_values['city'] = array_key_exists('city_searchfld', $top_search) ? $top_search['city_searchfld'] : '';
                                if($input_values['city'] == '')
                                    $input_values['city'] = array_key_exists('city', $general_search_fields) ? $general_search_fields['city'] : '';

                                $input_values['state'] = array_key_exists('state_searchfld', $top_search) ? $top_search['state_searchfld'] : '';
                                if($input_values['state'] == '')
                                    $input_values['state'] = array_key_exists('state', $general_search_fields) ? $general_search_fields['state'] : '';

                                $input_values['zipcode'] = array_key_exists('zipcode_searchfld', $top_search) ? $top_search['zipcode_searchfld'] : '';
                                if($input_values['zipcode'] == '')
                                    $input_values['zipcode'] = array_key_exists('zipcode', $general_search_fields) ? $general_search_fields['zipcode'] : '';

                                $input_values['country'] = array_key_exists('country_searchfld', $top_search) ? $top_search['country_searchfld'] : '';
                                if($input_values['country'] == '')
                                    $input_values['country'] = array_key_exists('country', $general_search_fields) ? $general_search_fields['country'] : '';


                                //var_dump($general_search_fields);exit;
                                ?>


                                    <fieldset>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="input-icon-left">
                                                    <i class="fa fa-globe"></i>
                                                    <input class="form-control"
                                                           id="autocomplete"
                                                           placeholder="Address or City or State or ZIP..."
                                                           onFocus="geolocate()"
                                                           type="text"
                                                           name="address"
                                                           value="<?php echo $input_values['address']; ?>" >
                                                    <input type="hidden"
                                                           id="street_number"
                                                           name="street_number"
                                                           disabled="true"
                                                           value="<?php echo $input_values['street_number']; ?>" >
                                                    <input type="hidden"
                                                           id="route"
                                                           name="street_address"
                                                           disabled="true"
                                                           value="<?php echo $input_values['street_address']; ?>" >
                                                    <input type="hidden"
                                                           id="locality"
                                                           name="city"
                                                           disabled="true"
                                                           value="<?php echo $input_values['city'] ?>" >
                                                    <input type="hidden"
                                                           id="administrative_area_level_1"
                                                           name="state"
                                                           disabled="true"
                                                           value="<?php echo $input_values['state'] ?>" >
                                                    <input type="hidden"
                                                           id="postal_code"
                                                           name="zipcode"
                                                           disabled="true"
                                                           value="<?php echo $input_values['zipcode']; ?>" >
                                                    <input type="hidden"
                                                           id="country"
                                                           name="country"
                                                           disabled="true"
                                                           value="<?php echo $input_values['country'] ?>" >
                                                </div>
                                            </div>
                                            <?php
                                            $membrCheck = SiteHelper::forFullPaidMembersOnly(true);
                                            $wayToPayment = Yii::app()->createAbsoluteUrl('user/profile');
                                            $linkToPayment = " onclick='document.location=\"$wayToPayment\" ' ";
                                            ?>

                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group1">
                                                            <input value="<?php echo (isset($general_search_fields['min_price_sqft']))? $general_search_fields['min_price_sqft'] :''; ?>" class="form-control" id="appendprepend_3" type="text" placeholder="Min Price / Sq Ft" name="min_price_sqft">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group1">
                                                            <input value="<?php echo (isset($general_search_fields['max_price_sqft']))? $general_search_fields['max_price_sqft'] :''; ?>" class="form-control" id="appendprepend_4" type="text" placeholder="Max Price / Sq Ft" name="max_price_sqft">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input value="<?php echo (isset($general_search_fields['min_price']))? $general_search_fields['min_price'] :''; ?>" class="form-control" id="appendprepend" type="text" placeholder="Min Price" name="min_price">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input value="<?php echo (isset($general_search_fields['max_price']))? $general_search_fields['max_price'] :''; ?>" class="form-control" id="appendprepend_2" type="text" placeholder="Max Price" name="max_price">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <!--                                                <div class="row">-->
                                                <select class="form-control" id="select-1" name="sale_type">
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='all sale types')? 'selected ' :''; ?> value="ALL Sale Types">ALL Sale Types</option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='for sale')? 'selected' :''; ?> value="For Sale">For Sale</option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='under value')? 'selected' :''; echo ($membrCheck !== true)? ' non_paid="true" class="non_paid"' : ''; ?> value="Under Value">Under Value 5% - 14% Off<?php echo ($membrCheck !== true)? ' - Full Access Members Only' : ''; ?></option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='equity deals')? 'selected' :''; echo ($membrCheck !== true)? ' non_paid="true" class="non_paid"' : ''; ?> value="Equity Deals">Equity Deals 15% - 50%+ Off<?php echo ($membrCheck !== true)? ' - Full Access Members Only' : ''; ?></option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='foreclosures')? 'selected' :''; echo ($membrCheck !== true)? ' non_paid="true" class="non_paid"' : ''; ?> value="Foreclosures">Foreclosures<?php echo ($membrCheck !== true)? ' - Full Access Members Only' : ''; ?></option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='shortsales')? 'selected' :''; echo ($membrCheck !== true)? ' non_paid="true" class="non_paid"' : ''; ?> value="Shortsales">Shortsales<?php echo ($membrCheck !== true)? ' - Full Access Members Only' : ''; ?></option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='auction')? 'selected' :''; echo ($membrCheck !== true)? ' non_paid="true" class="non_paid"' : ''; ?> value="Auction">Auction<?php echo ($membrCheck !== true)? ' - Full Access Members Only' : ''; ?></option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='all property records')? 'selected' :''; ?> value="All Property Records">All Property Records</option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='for rent')? 'selected' :''; ?> value="For Rent">For Rent</option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='owner will carry')? 'selected' :''; echo ($membrCheck !== true)? ' non_paid="true" class="non_paid"' : ''; ?> value="Owner Will Carry">Owner Will Carry<?php echo ($membrCheck !== true)? ' - Full Access Members Only' : ''; ?></option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='aitd opportunities')? 'selected' :''; echo ($membrCheck !== true)? ' non_paid="true" class="non_paid"' : ''; ?> value="AITD Opportunities">AITD Opportunities<?php echo ($membrCheck !== true)? ' - Full Access Members Only' : ''; ?></option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='mid cap rental potential')? 'selected' :''; echo ($membrCheck !== true)? ' non_paid="true" class="non_paid"' : ''; ?> value="Mid Cap Rental Potential">Mid 8%+ Cap Rental<?php echo ($membrCheck !== true)? ' - Full Access Members Only' : ''; ?></option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='high cap rental potential')? 'selected' :''; echo ($membrCheck !== true)? ' non_paid="true" class="non_paid"' : ''; ?> value="High Cap Rental Potential">High 12%+ Cap Rental<?php echo ($membrCheck !== true)? ' - Full Access Members Only' : ''; ?></option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='rental properties with equity')? 'selected' :''; echo ($membrCheck !== true)? ' non_paid="true" class="non_paid"' : ''; ?> value="Rental Properties With Equity">6%+ Cap And 6%+ Equity Rental<?php echo ($membrCheck !== true)? ' - Full Access Members Only' : ''; ?></option>
                                                    <option <?php echo (isset($general_search_fields['sale_type']) && strtolower($general_search_fields['sale_type'])=='high cap and high equity opportunities')? 'selected' :''; echo ($membrCheck !== true)? ' non_paid="true" class="non_paid"' : ''; ?> value="High Cap And High Equity Opportunities" >High 10%+ Cap And High 10%+ Equity Rental<?php echo ($membrCheck !== true)? ' - Full Access Members Only' : ''; ?></option>
                                                </select>
                                                <!--                                                </div>	-->
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group1">
                                                            <input value="<?php echo (isset($general_search_fields['min_sqft']))? $general_search_fields['min_sqft'] :''; ?>" class="form-control" id="appendprepend_3" type="text" placeholder="Min Sq Ft" name="min_sqft">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group1">
                                                            <input value="<?php echo (isset($general_search_fields['max_sqft']))? $general_search_fields['max_sqft'] :''; ?>" class="form-control" id="appendprepend_4" type="text" placeholder="Max Sq Ft" name="max_sqft">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <select class="form-control" id="select-1" name="bed">
                                                    <option <?php echo (!isset($general_search_fields['bed']) || $general_search_fields['bed']=='0')? 'selected' :''; ?> value="0">ANY Bedrooms</option>
                                                    <option <?php echo (isset($general_search_fields['bed']) && $general_search_fields['bed']=='2')? 'selected' :''; ?> value="2">2+ Beds</option>
                                                    <option <?php echo (isset($general_search_fields['bed']) && $general_search_fields['bed']=='3')? 'selected' :''; ?> value="3">3+ Beds</option>
                                                    <option <?php echo (isset($general_search_fields['bed']) && $general_search_fields['bed']=='4')? 'selected' :''; ?> value="4">4+ Beds</option>
                                                    <option <?php echo (isset($general_search_fields['bed']) && $general_search_fields['bed']=='5')? 'selected' :''; ?> value="5">5+ Beds</option>
                                                    <option <?php echo (isset($general_search_fields['bed']) && $general_search_fields['bed']=='6')? 'selected' :''; ?> value="6">6+ Beds</option>
                                                    <option <?php echo (isset($general_search_fields['bed']) && $general_search_fields['bed']=='7')? 'selected' :''; ?> value="7">7+ Beds</option>
                                                </select>

                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">

                                                <select class="form-control" id="select-2" name="bath">
                                                    <option <?php echo (!isset($general_search_fields['bath']) || $general_search_fields['bath']=='0')? 'selected' :''; ?> value="0">ANY Bathrooms</option>
                                                    <option <?php echo (isset($general_search_fields['bath']) && $general_search_fields['bath']=='2')? 'selected' :''; ?> value="2">2+ Baths</option>
                                                    <option <?php echo (isset($general_search_fields['bath']) && $general_search_fields['bath']=='3')? 'selected' :''; ?> value="3">3+ Baths</option>
                                                    <option <?php echo (isset($general_search_fields['bath']) && $general_search_fields['bath']=='4')? 'selected' :''; ?> value="4">4+ Baths</option>
                                                    <option <?php echo (isset($general_search_fields['bath']) && $general_search_fields['bath']=='5')? 'selected' :''; ?> value="5">5+ Baths</option>
                                                    <option <?php echo (isset($general_search_fields['bath']) && $general_search_fields['bath']=='6')? 'selected' :''; ?> value="6">6+ Baths</option>
                                                    <option <?php echo (isset($general_search_fields['bath']) && $general_search_fields['bath']=='7')? 'selected' :''; ?> value="7">7+ Baths</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                                <select multiple style="width:100%" class="select2" placeholder="Any Property Type" name="property_type[]">
                                                    <optgroup label="Single Family Homes">
                                                        <option <?php echo (isset($general_search_fields['property_type']) && in_array('AK', $general_search_fields['property_type']))? 'selected':'' ?> value="AK">Attached SFH</option>
                                                        <option <?php echo (isset($general_search_fields['property_type']) && in_array('HI', $general_search_fields['property_type']))? 'selected':'' ?> value="HI">Detached SFH</option>
                                                    </optgroup>
                                                    <optgroup label="Condos">
                                                        <!--                                                    <option value="CA">Time Share</option>-->
                                                        <option <?php echo (isset($general_search_fields['property_type']) && in_array('CA1', $general_search_fields['property_type']))? 'selected':'' ?> value="CA1">Low Rise</option>
                                                        <!--                                                    <option value="NV">Mid Rise</option>-->
                                                        <option <?php echo (isset($general_search_fields['property_type']) && in_array('OR', $general_search_fields['property_type']))? 'selected':'' ?> value="OR">High Rise</option>
                                                    </optgroup>
                                                    <optgroup label="Townhouse">
                                                        <option <?php echo (isset($general_search_fields['property_type']) && in_array('TH', $general_search_fields['property_type']))? 'selected':'' ?> value="TH">Townhouse</option>
                                                    </optgroup>
                                                    <optgroup label="Multi-Family">
                                                        <option <?php echo (isset($general_search_fields['property_type']) && in_array('DP', $general_search_fields['property_type']))? 'selected':'' ?> value="DP">Duplex</option>
                                                        <option <?php echo (isset($general_search_fields['property_type']) && in_array('TP', $general_search_fields['property_type']))? 'selected':'' ?> value="TP">Triplex</option>
                                                        <option <?php echo (isset($general_search_fields['property_type']) && in_array('FP', $general_search_fields['property_type']))? 'selected':'' ?> value="FP">Fourplex</option>
                                                    </optgroup>

                                                    <optgroup label="Manufactured">
                                                        <option <?php echo (isset($general_search_fields['property_type']) && in_array('AZ', $general_search_fields['property_type']))? 'selected':'' ?> value="AZ">Mobile Home</option>
                                                        <option <?php echo (isset($general_search_fields['property_type']) && in_array('CO', $general_search_fields['property_type']))? 'selected':'' ?> value="CO">Manufactured Home</option>
                                                    </optgroup>
                                                    <optgroup label="Land">
                                                        <option <?php echo (isset($general_search_fields['property_type']) && in_array('AL', $general_search_fields['property_type']))? 'selected':'' ?> value="AL">Vacant Land</option>
                                                    </optgroup>
                                                </select>

                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group1">
                                                            <input value="<?php echo (isset($general_search_fields['min_year_built']))? $general_search_fields['min_year_built'] :''; ?>" class="form-control" id="appendprepend_5" type="text" placeholder="Min Year Built" data-mask="Yr 9999" name="min_year_built">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group1">
                                                            <input value="<?php echo (isset($general_search_fields['max_year_built']))? $general_search_fields['max_year_built'] :''; ?>" class="form-control" id="appendprepend_6" type="text" placeholder="Max Year Built" data-mask="Yr 9999" name="max_year_built">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group1">
                                                            <input class="form-control" id="appendprepend_7" type="text" placeholder="Min Lot Size" data-mask="9.99 Acre" value="<?php echo (isset($general_search_fields['min_lot_size']))? $general_search_fields['min_lot_size'] :''; ?>" name="min_lot_size">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group1">
                                                            <input class="form-control" id="appendprepend_8" type="text" placeholder="Max Lot Size" data-mask="9.99 Acre" value="<?php echo (isset($general_search_fields['max_lot_size']))? $general_search_fields['max_lot_size'] :''; ?>" name="max_lot_size">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-4" id="keywords_block">
                                                <input class="form-control tagsinput" value="<?php if(isset($general_search_fields['keywords']) && $general_search_fields['keywords']!='') {echo $general_search_fields['keywords'];} ?> " placeholder="Keywords... foreclosure, view, etc" data-role="tagsinput"  name="keywords" >
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="form-actions">
                                        <div class="row">
<?php if(!Yii::app()->user->isGuest) : ?>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="checkbox">
                                                                    <label>
                                                                        <input <?php if(isset($general_search_fields['save_search_title'])){ echo "checked";} ?> autocomplete="off" id="save_search_checkbox" value="1" type="checkbox" class="checkbox style-0" name="save_search_checkbox">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </span>
                                                            <input value="<?php echo (isset($general_search_fields['save_search_title']))? $general_search_fields['save_search_title'] :''; ?>" class="form-control" id="save_search" type="text" placeholder="To save this search, enter a search title" name="save_search_title">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="alert alert-info fade in" id="alert_guest">
                                                    <button class="close"  id="eg1">
                                                        ×
                                                    </button>
                                                    <i class="fa-fw fa fa-check"></i>
                                                    <strong>Set Alerts</strong> - Save filters and recieve property alerts!
                                                </div>
                                            </div>
<?php else : ?>
                                            <div class="col-md-9">
                                            </div>
<?php endif; ?>
                                            <div class="col-md-3">
                                                <button class="btn btn-default" type="submit">
                                                    Cancel
                                                </button>

                                                <button class="btn btn-primary" name="search_button" id="search-button" type="submit">
                                                    <i class="fa fa-search"></i>
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->
                </div>


            </div>


            <!-- row -->
            <div class="row">

                <!-- NEW WIDGET START -->
                <article class="col-sm-12">
                    <!--
            <div class="alert alert-warning fade in">
                    <button class="close" data-dismiss="alert">
                            ×
                    </button>
                    <i class="fa-fw fa fa-warning"></i>
                    <strong>Warning</strong> Your monthly traffic is reaching limit.
            </div>
                    -->
                    <!--
                    <div class="alert alert-info fade in">
                            <button class="close" data-dismiss="alert">
                                    ×
                            </button>
                            <i class="fa-fw fa fa-info"></i>
                            <strong>Info!</strong> You have 198 unread messages.
                    </div>

                    <div class="alert alert-danger fade in">
                            <button class="close" data-dismiss="alert">
                                    ×
                            </button>
                            <i class="fa-fw fa fa-times"></i>
                            <strong>Error!</strong> The daily cronjob has failed.
                    </div>
                    -->
                </article>
                <!-- WIDGET END -->

            </div>

            <!-- end row -->

            <!-- start my searches row -->
            <div class="row" id="search_list_block">

                <!-- NEW WIDGET START -->
                <div class="col-sm-12 col-md-12 col-lg-12">

                    <!-- NEW WIDGET START -->

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-white" id="wid-id-0M" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-sortable="true">
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
                            <h2>Results Map</h2>           

                            <div class="widget-toolbar hidden-mobile">
                                <!-- add: non-hidden - to disable auto hide -->

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
                                        <li class="divider"></li>
                                        <li>
                                            <a href="javascript:void(0);" class="freehand"><i class="icon-delete"></i> Free Hand</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="delete-button"><i class="icon-circle txt-color-red"></i> Delete Selected Shape</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

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
                                <div id="map_canvas" class="google_maps">
                                    &nbsp;
                                </div>

                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-greenDark" id="wid-id-results_table33" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
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
                            <h2><span class="count_search_result"></span> Search Results</h2>

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

                                </div>
                                <table class="table table-striped table-hover datatable_tabletools">
                                    <thead>
                                        <tr>
                                            <th>Weight</th>
                                            <th>Value</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>List Price</th>
                                            <th>Sq. Ft.</th>
                                            <th>Beds/Baths</th>
                                            <th>List Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table
                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </div>
                <!-- end row -->

            </div>
<!--            Layout fix!!!!!   -->
            </div>
            <div class="row" id="search_map_block">

                <!-- NEW WIDGET START -->
                <div class="col-sm-8 col-md-8 col-lg-8">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-white" id="wid-id-0M2" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-sortable="true">
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
                            <h2>Results Map</h2>

                            <div class="widget-toolbar hidden-mobile">
                                <!-- add: non-hidden - to disable auto hide -->

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
                                        <li class="divider"></li>
                                        <li>
                                            <a href="javascript:void(0);" class="freehand"><i class="icon-delete"></i> Free Hand</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="delete-button"><i class="icon-circle txt-color-red"></i> Delete Selected Shape</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </header>

                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body no-padding mobile-wrapper" style="height:750px">
                                <div id="map_canvas2" class="google_maps2">
                                    &nbsp;
                                </div>

                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </div>
                <!-- NEW WIDGET START -->
                <div class="col-sm-4 col-md-4 col-lg-4">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-greenDark" id="wid-id-results12" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false">
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
                            <h2><span class="count_search_result"></span> Search Results</h2>

                        </header>

                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body no-padding mobile-wrapper" style="height:750px; overflow-y: scroll;">
                                <table  class="table table-striped table-hover datatable_tabletools2">
                                    <thead>
                                        <tr>
                                            <th>Weight</th>
                                            <th>Address</th>
                                            <th>Desc.</th>
                                            <th>List Date</th>
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

                </div>
                <!-- end row -->

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
<div id="demo"></div>
<div class="detail-pop-up">
    <button class="close" type="button">×</button>
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
</div>
<script>
    var my_array;
    my_array = $('#select-1 option');
    $("#select-1")
        .change(function () {
            $( "#select-1 option:selected" ).each(function() {
                if(this.getAttribute('non_paid') == 'true'){
                    window.location = '<?php echo Yii::app()->params['linkToBuyingSubscr'];?>';
                }
            });
        })
</script>

<!-- END SHORTCUT AREA -->
<?php if (Yii::app()->user->hasFlash('search')): ?>
    <div class="success1">
        <?php echo Yii::app()->user->getFlash('search'); ?>
    </div>
<?php endif; ?>
<div class="success2"></div>
<?php
if (Yii::app()->user->isGuest) {
    $guest = 0;
} else {
    $guest = 1;
}
?>
<div id="loader_img">
    <img src="<?php echo CPathCDN::baseurl( 'img' ); ?>/img/ajax-loader.gif" alt="">
</div>
<?php

Yii::app()->clientScript->registerScript("MapBoundaryVar", "
var mapBoundaries = [];
        ", CClientScript::POS_END);

if(isset($general_search_fields['map_boundary'])){
    $mapBoundaryObject = $general_search_fields['map_boundary'];
    $mapBoundaryClass = get_class($general_search_fields['map_boundary']);

    switch($mapBoundaryClass){

        case 'MapBoundaryCircle': // https://developers.google.com/maps/documentation/javascript/examples/circle-simple
            Yii::app()->clientScript->registerScript("MapBoundaryCircle", "

            var circle = new google.maps.Circle({
                strokeColor: '#000000',
                strokeOpacity: 0.3,
                strokeWeight: 2,
                fillColor: '#000000',
                fillOpacity: 0.2,
                center: new google.maps.LatLng(".$mapBoundaryObject->getCenter()->getStringPresentation()."),
                radius: ".$mapBoundaryObject->getRadius()."
            })
            mapBoundaries.push(circle);
            coordinates_filter = getCircleCoordinatesFilter(circle);
        ", CClientScript::POS_END);
            break;

        case 'MapBoundaryPolygon': // https://developers.google.com/maps/documentation/javascript/examples/polygon-arrays

            $points = $mapBoundaryObject->getPoints();

            Yii::app()->clientScript->registerScript("MapBoundaryPolygonCoords", "
var polygonCoords = [];
            ", CClientScript::POS_END);

            foreach($points as $key=>$point){
                Yii::app()->clientScript->registerScript("MapBoundaryPolygonCoord".$key, "
polygonCoords.push(new google.maps.LatLng(".$point->getStringPresentation()."));
        ", CClientScript::POS_END);
            }

            foreach($points as $key=>$point){
                Yii::app()->clientScript->registerScript("MapBoundaryPolygon", "

var polygon = new google.maps.Polygon({
    paths: polygonCoords,
    strokeColor: '#000000',
    strokeOpacity: 0.3,
    strokeWeight: 3,
    fillColor: '#000000',
    fillOpacity: 0.2
});

mapBoundaries.push(polygon);
coordinates_filter = getPolygonCoordinatesFilter(polygon);
        ", CClientScript::POS_END);
            }
            break;

        case 'MapBoundaryRectangle':// https://developers.google.com/maps/documentation/javascript/examples/rectangle-simple
            Yii::app()->clientScript->registerScript("MapBoundaryRectangleBounds", "
var rectangleBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(".$mapBoundaryObject->getLeftTopPoint()->getStringPresentation()."),
      new google.maps.LatLng(".$mapBoundaryObject->getRightBottomPoint()->getStringPresentation().")
)
            ", CClientScript::POS_END);

            Yii::app()->clientScript->registerScript("MapBoundaryRectangle", "
var rectangle = new google.maps.Rectangle({
    strokeColor: '#000000',
    strokeOpacity: 0.3,
    strokeWeight: 2,
    fillColor: '#000000',
    fillOpacity: 0.2,
    bounds: rectangleBounds
});
mapBoundaries.push(rectangle);

coordinates_filter = getRectangleCoordinatesFilter(rectangle);
            ", CClientScript::POS_END);
            break;
    }// end switch
}

$searchResultSmallQuery = $search_results ? json_encode($search_results) : '';

Yii::app()->clientScript->registerScript("main", "
            var dataSearchResultSmallQuery = " . $searchResultSmallQuery . ";

            var map;
            var mapReady = false;
            var geolocation;
            var drawingManager;
            var selectedShape;
            var coordinates_filter;
            var bounds = new google.maps.LatLngBounds();
            var marker_on_popup;
            var map2;
            var drawingManager2;
            var selectedShape2;
            var bounds2 = new google.maps.LatLngBounds();
            var isEquityDeal = 0;
            var search_results;
            function setAddressFields(){
                var a = $('#autocomplete').val();
                if(!a){
                    $('#street_number, #route, #locality, #administrative_area_level_1, #postal_code, #country').val('');
                }
            }

            function getCircleCoordinatesFilter(circle){
                var center = circle.getCenter();
                var lat = center.lat();
                var lon = center.lng();
                var radius = circle.getRadius();
                return '&geodistance_circle=' + 1 + '&latitude=' + lat + '&longitude=' + lon + '&radius=' + radius;
            }

            function getRectangleCoordinatesFilter(rectangle){
                var coordinates = rectangle.getBounds();
                var lat2 = coordinates.getNorthEast().lat();
                var lon2 = coordinates.getNorthEast().lng();
                var lat1 = coordinates.getSouthWest().lat();
                var lon1 = coordinates.getSouthWest().lng();

                return '&geodistance_rectangle=' + 1 + '&latitude1=' + lat1 + '&latitude2=' + lat2 + '&longitude1=' + lon1 + '&longitude2=' + lon2;
            }

            function getPolygonCoordinatesFilter(polygon){
                var filter = '';
                filter += '&geodistance_polygon=' + 1;
                polygon.getPaths().forEach(function(e){
                    e.getArray().forEach(function(el){
                        filter += '&latitude%5B%5D=' + el.lat() + '&longitude%5B%5D=' + el.lng();
                    });
                });

                return filter;
            }


            function clickSearchButton(){
                makeSearch();
            }


            function makeSearch(){
                setAddressFields();
                $('#loader_img').show();
                var this_form = '';
                this_form = $('#main_search_form').serialize();
                if(coordinates_filter){
                    this_form += coordinates_filter;
                }
                isEquityDeal = this_form.indexOf('Equity+Deals') + 1;

                setFiltersString();
                $.ajax({
                    url: '/property/search',
                    type: 'POST',
                    data: this_form,
                    dataType: 'json',
                    cache: false,
                    success: function(data){
                        $('#loader_img').hide();
                        dataSearchResultSmallQuery = data;
                        getSearchResult(data);
                        addResponsive();

                    },
                    error:  function(xhr, str){
//                        console.log('error: ' + xhr.responseCode);
                    }
                });
            }


            function setSelection(shape) {

                selectedShape = shape;
                selectedShape2 = shape;
                shape.setEditable(true);
            }

            function deleteSelectedShape() {
                if (selectedShape) { selectedShape.setMap(null);   }
                if (selectedShape2){ selectedShape2.setMap(null);  }
                coordinates_filter = '';
                selectedShape = null;
            }

            function initialize() {
                var mapOptions = {
                    zoom: 12,
                    minZoom: 2
                };
                map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
                var mapOptions2 = {
                    zoom: 12,
                    minZoom: 2
                };
                map2 = new google.maps.Map(document.getElementById('map_canvas2'), mapOptions2);


               for (key in mapBoundaries) {
                    if (mapBoundaries.hasOwnProperty(key)) {

                        // clone objects
                        var shape1 = jQuery.extend(true, {}, mapBoundaries[key]);
                        var shape2 = jQuery.extend(true, {}, mapBoundaries[key]);

                        shape1.setMap(map);
                        shape2.setMap(map2);

                        selectedShape = shape1;
                        selectedShape2 = shape2;


                    }
                }
                $('.detail-pop-up').on('mousewheel', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if(e.originalEvent.wheelDelta / 120 > 0) {
                        $('#detail-pop-up-carousel').carousel('prev');
                    } else {
                        $('#detail-pop-up-carousel').carousel('next');
                    }
                });

                var markersLoadedOnStartup = false;
                google.maps.event.addListener(map, 'idle', function(){

                    mapReady = true;
                    if(!markersLoadedOnStartup){
                        if((dataSearchResultSmallQuery.status == 'nothing') ||
                           (dataSearchResultSmallQuery.status == 'success') ){
                            getSearchResult(dataSearchResultSmallQuery);
                            setFiltersString();
                            addResponsive();
                       }
                       markersLoadedOnStartup = true;
                    }
                });
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        map.setCenter(pos);
                        map2.setCenter(pos);
                    }, function() {
                        handleNoGeolocation(map);
                        handleNoGeolocation(map2);
                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleNoGeolocation(map);
                    handleNoGeolocation(map2);
                }
                drawingManager = new google.maps.drawing.DrawingManager();
                drawingManager2 = new google.maps.drawing.DrawingManager();
                search_fld = new google.maps.places.Autocomplete(document.getElementById('search-fld'),{ types: ['geocode'] });
                google.maps.event.addListener(search_fld, 'place_changed', function() {
                  fillInAddressSearchFld();
                });
                autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'),{ types: ['geocode'] });

                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                  fillInAddress();
                });
                bounds = new google.maps.LatLngBounds();
                bounds2 = new google.maps.LatLngBounds();
            }



            function handleNoGeolocation(map) {
                var options = {
                  map: map,
                  position: new google.maps.LatLng(36.175, -115.1363889),
                };
                map.setCenter(options.position);
            }


            function setAllMap(map) {
                for (var i = 0; i < markers.length; i++) {
                    google.maps.event.addListener(markers[i], 'mouseover', function() {
                        var ttl = this.title;
                        $('.title-wraper-block').each(function() {
                            if ($.trim($(this).find('a').text()) == ttl) {
                                $(this).parent().parent().find('td').each(function() {
                                    $(this).css('border-bottom', '3px solid #60747C');
                                    $(this).css('border-top', '3px solid #60747C');
                                });
                            }
                        });
                    });
                    google.maps.event.addListener(markers[i], 'mouseout', function() {
                        var ttl = this.title;
                        $('.title-wraper-block').each(function() {
                            if ($.trim($(this).find('a').text()) == ttl) {
                                $(this).parent().parent().find('td').each(function() {
                                    $(this).css('border-bottom', '1px solid #dddddd');
                                    $(this).css('border-top', '1px solid #dddddd');
                                });
                            }
                        });
                    });
                    markers[i].setMap(map);
                }

            }



            function setAllMap2(map2) {

                for (var i = 0; i < markers2.length; i++) {
                    google.maps.event.addListener(markers2[i], 'mouseover', function() {
                        var ttl = this.title;
                        $('.title-wraper-block').each(function() {
                            if ($.trim($(this).find('a').text()) == ttl) {
                                $(this).parent().parent().find('td').each(function() {
                                    $(this).css('border-bottom', '3px solid #60747C');
                                    $(this).css('border-top', '3px solid #60747C');
                                });
                            }
                        });
                    });
                    google.maps.event.addListener(markers2[i], 'mouseout', function() {
                        var ttl = this.title;
                        $('.title-wraper-block').each(function() {
                            if ($.trim($(this).find('a').text()) == ttl) {
                                $(this).parent().parent().find('td').each(function() {
                                    $(this).css('border-bottom', '1px solid #dddddd');
                                    $(this).css('border-top', '1px solid #dddddd');
                                });
                            }
                        });
                    });
                    markers2[i].setMap(map2);
                }

            }



            var dTable;
            var dTable2;
            var markers = [];
            var markers2 = [];
            var latLon_arr = [];
            var search_map_results;

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
            function setMarkersArray(latLon_arr){
//                if (!window.location.origin) { // IE
//                    var a_path = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
//                } else {
//                    var a_path = window.location.origin ;
//                }
                var a_path = getPathImages();
                markers = [];
                
                for(var i = 0; i < latLon_arr.length; i++){
                    for(var key in latLon_arr[i]){
                        
                        if( ( ( latLon_arr[i][key].lat == '0.000000' ) || ( latLon_arr[i][key].lat == '' )  ) &&
                            ( ( latLon_arr[i][key].lon == '0.000000' ) || ( latLon_arr[i][key].lon == '' ) ) ){
                            continue;
                        }
                        position = new google.maps.LatLng(latLon_arr[i][key].lat, latLon_arr[i][key].lon);
                        
                        var status = latLon_arr[i][key].status.toLowerCase();
                        
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
                        if(isEquityDeal !== 0 && status == 'active-exclusive right' || isEquityDeal !== 0 && status == 'active'){
                            image = new google.maps.MarkerImage(a_path + '/images/map-icons/green.png', null, null, new google.maps.Point(0, 34),new google.maps.Size(35, 40));
                        }
                        
                        
  
                        var marker = new google.maps.Marker({
                                position: position,
                                map: map,
                                icon: image,
                                property:latLon_arr[i][key].property_id,
                                title: latLon_arr[i][key].address
                        });
                        marker.addListener('click', toggleDetailPopup);        
                        markers.push(marker);
                        bounds.extend(position);
                    }
                }
                setAllMap(null);
                if(latLon_arr[0].length != 0){
                    setAllMap(map);
                } else {
                    setAllMap(map2);
                }
                if(!bounds.isEmpty()) {
                    map.fitBounds(bounds);
                }
            }
/*POPUP WORKER START*/
            $('.detail-pop-up .close').on('click', function() {
                hideDetailPopup();
            });
            
            function toggleDetailPopup() {
                var marker = this;
                if (marker && marker_on_popup && marker === marker_on_popup) {
                    hideDetailPopup();
                    return;
                }
                hideDetailPopup();
                showDetailPopup(marker);
                updatePopupPosition(marker);
            }
            
            function hideDetailPopup() {
                var searchMarkerPopup = $('.detail-pop-up'),
                    searchMarkerCarousel = searchMarkerPopup.find('#detail-pop-up-carousel');
        
                marker_on_popup = null;
        
                searchMarkerCarousel.find('.carousel-inner').text('');
                searchMarkerPopup
                    .find('.img-container')
                    .text('')
                    .append(searchMarkerCarousel);
        
                searchMarkerPopup.find('.price').text('');
                searchMarkerPopup.find('.label-container').text('');
                searchMarkerPopup.find('.street').text('');
                searchMarkerPopup.find('.exclude-btn').text('');
                searchMarkerPopup.find('.city').text('');
                searchMarkerPopup.find('.subdivision').text('');
                searchMarkerPopup.find('.type').text('');
                searchMarkerPopup.find('.metrics').text('');
                searchMarkerPopup.find('.popup-tmv-price').text('');
                searchMarkerPopup.find('.popup-tmv').text('');
        
                $('.detail-pop-up').css('display', 'none');

            }
            
            function showDetailPopup(marker) {
            
                if($('#search_map_block').is(':visible')){
                    var rows$ = $('#search_map_block').find('tbody tr');
                    var map = '#map_canvas2';
                } else {
                    var rows$ = $('#search_list_block').find('tbody tr');
                    var map = '#map_canvas';
                }

                var prop_id = marker.property,
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
                } else {
                    rows$.each(function(index, element) {
                            if ($(element).find('.exclude-reinclude').data('property_id') === prop_id) {
                                row$ = $(element);
                            } 
                    })
                }
                img$ = row$.find('img');
                firstPhoto$ = $('<div>').addClass('item active');
                firstPhoto$.append($('<img>', {
                            src: img$.attr('src'),
                            alt: img$.attr('alt')
                        }));
                        
                if($('#search_map_block').is(':visible')){
                    descArray = row$.find('td').eq(1).html().split('<br>');
              
                    descObject = {};
                    descArray.forEach(function(e){
                        if(e && e != ''){
                           if(e.indexOf('Price') >= 0){
                                e = e.replace('Price','').trim();
                                price = e;
                           } else if(e.indexOf('label') >= 0){
                                label$ = e;
                           } else {
                                street = descObject['description'] + ' ' + e;
                           }
                        }
                    });

                street = row$.find('td').eq(0).find('h6').html();
                } else {
                    label$ = row$.find('td').eq(2).clone();

                    price = row$.find('td').eq(3).html().split('<br>')[0];
                    street = row$.find('td').eq(1).html();
        
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
                }
                
        
                $('.detail-pop-up')
                    .find('.carousel-inner')
                        .append(firstPhoto$)
                    .end()
                    .find('.label-container')
                        .append(label$)
                    .end()
                    .find('.price').html(price)
                    .end()
                    .find('.exclude-btn')
                        .append(exclude_btn)
                    .end()
                    .fadeIn()
                    .appendTo(map);
     
                $.ajax({
                    url: '/property/getcomppropertydetails',
                    data: {property_id: prop_id},
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    success: function(data){
                        $('#detail-pop-up-carousel').carousel('pause');
                        
                        $('.detail-pop-up')
                            .find('.link-container')
                                .attr('href',data['url'])
                            .end()
                            .find('.street')
                                .text(data['property_street'])
                            .end()
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
                            .find('.carousel-inner')
                                .append(data['carousel'])
                            .end();
                            
                         if(data['tmv'].length > 0){
                            $('.detail-pop-up')
                            .find('.popup-tmv')
                                .append('TMV:')
                            .end()
                            .find('.popup-tmv-price')
                                .append(data['tmv'])
                            .end();
                         }    
        
                        updatePopupPosition(marker_on_popup);
                    },
                    error: function(data){
//                            console.log('error: ',data);
                    }
                });
            }
            
            function updatePopupPosition(marker) {
                var map = $('#search_map_block').is(':visible') ? map2 : map;
                
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
     
     
/*POPUP WORKER END*/
            function getDataCurrentPage(data){
                latLon_arr = [];
                latLon_arr[0] = [];
                latLon_arr[1] = [];
                data.find('.property_info_row').each(function(){
                    var arr = {};
                    arr.lat = $(this).data('lat');
                    arr.lon = $(this).data('lon');
                    arr.address = $(this).data('address');
                    arr.status = $(this).data('status');
                    arr.property_id = $(this).data('property_id');
                    latLon_arr[0].push(arr);
                    delete arr;
                });
                data.find('.property_info_row_map').each(function(){
                var arr2 = {};
                    arr2.lat = $(this).data('lat');
                    arr2.lon = $(this).data('lon');
                    arr2.address = $(this).data('address');
                    arr2.status = $(this).data('status');
                    arr2.property_id = $(this).data('property_id');
                    latLon_arr[1].push(arr2);
                    delete arr2;
                });

                setMarkersArray(latLon_arr);
            }

            function resetDataTableList(){
                setAllMap(null);
                dTable = $('.datatable_tabletools').dataTable().fnDestroy();
                dTable = $('.datatable_tabletools').dataTable({
                    'sDom' : '<\'dt-top-row\'Tlf>r<\'dt-wrapper\'t><\'dt-row dt-bottom-row\'<\'row\'<\'col-sm-6\'i><\'col-sm-6 text-right\'p>>',
                    'oTableTools' : {
                            'aButtons' : ['copy', 'print', {
                                    'sExtends' : 'collection',
                                    'sButtonText' : 'Save <span class=\"caret\" />',
                                    'aButtons' : ['csv', 'xls', 'pdf']
                            }],
                            'sSwfPath' : '" . CPathCDN::baseurl( 'js' ) ."/js/plugin/datatables/media/swf/copy_csv_xls_pdf.swf'
                    },
                    'iDisplayLength':100,
                    'aaData': search_results,
                    'bDeferRender': true,
                    'bAutoWidth': false,
                    'fnDrawCallback': function (oSettings) {
                        var current_page = this.fnPagingInfo().iPage+1;
                        setAllMap(null);
                        getDataCurrentPage($(this));

                        if(typeof oSettings.oFeatures.bAutoWidth != undefined && oSettings.oFeatures.bAutoWidth == false)
                        {
                            $(this).attr('style', 'width:100%;');
                        }
                     },
                     'aoColumns': [
                            { 'bVisible': false, 'sType': 'natural' },
                            { 'sType': 'num-html' },
                            { 'sType': 'natural' },
                            null,
                            { 'sType': 'currency' },
                            { 'sType': 'natural' },
                            { 'sType': 'natural' },
                            null
                     ],
                     'aaSorting': [[ 0, 'desc' ]],

                    'fnInitComplete' : function(oSettings, json) {
                            $(this).closest('#dt_table_tools_wrapper').find('.DTTT.btn-group').addClass('table_tools_group').children('a.btn').each(function() {
                                    $(this).addClass('btn-sm btn-default');
                            });
                    }
                });

            }

            function resetDataTableMap(){
                setAllMap2(null);
                dTable2 = $('.datatable_tabletools2').dataTable().fnDestroy();
                    dTable2 = $('.datatable_tabletools2').dataTable({
                        'sDom': '<\'dt-top-row\'Tlf>r<\'dt-wrapper\'t><\'dt-row dt-bottom-row\'<\'row\'<\'col-sm-6\'i><\'col-sm-6 text-right\'p>>',
                        'oTableTools': {
                            'aButtons': ['copy', 'print', {
                                    'sExtends': 'collection',
                                    'sButtonText': 'Save <span class=\'caret\' />',
                                    'aButtons': ['csv', 'xls', 'pdf']
                                }],
                            'sSwfPath': '" . CPathCDN::baseurl( 'js' ) ."/js/plugin/datatables/media/swf/copy_csv_xls_pdf.swf'
                        },
                        'iDisplayLength':100,
                        'aaData': search_map_results,
                        'bDeferRender': true,
                        'bAutoWidth': false,
                        'fnDrawCallback': function (oSettings) {
                                        var current_page = this.fnPagingInfo().iPage+1;
                                        setAllMap2(null);
                                        getDataCurrentPage($(this));
                                    if(typeof oSettings.oFeatures.bAutoWidth != undefined && oSettings.oFeatures.bAutoWidth == false)
                                    {
                                        $(this).attr('style', 'width:100%;');
                                    }
                        },
                      'aoColumns': [
                           { 'bVisible': false, 'sType': 'natural' },
                           { 'sType': 'num-html' },
                           { 'sType': 'currency' },
                           { 'bVisible': false}
                        ],
                        'aaSorting': [[ 0, 'desc' ]],
                        'oLanguage': {
                            'sEmptyTable': 'No data available in table'
                        },
                        'fnInitComplete': function(oSettings, json) {
                            $(this).closest('#dt_table_tools_wrapper').find('.DTTT.btn-group').addClass('table_tools_group').children('a.btn').each(function() {
                                $(this).addClass('btn-sm btn-default');
                            });
                        }
                    });
            }


            function waitMapReady(callbackWhenReady){
                setTimeout(
                    function () {
                        if (mapReady === true) {

                            if(typeof(callbackWhenReady) != 'undefined'){
                                callbackWhenReady();
                            }

                        } else {

                            //console.log('wait');
                            waitMapReady(callbackWhenReady);
                        }
                    }, 10); // wait 10 milisecond
            }

            function getSearchResult(data){

                waitMapReady(function(){
                    if(!bounds.isEmpty()) {
                        bounds = new google.maps.LatLngBounds(null);
                    }
                    if(!bounds2.isEmpty()) {
                        bounds2 = new google.maps.LatLngBounds(null)
                    }
                    search_results = '';
                    search_map_results = '';
                    $('.count_search_result').empty();
                    if(data.status.toLowerCase() == 'success' && data.count_result > 0){
                         var pos = new google.maps.LatLng(data.latlon[0], data.latlon[1]);
                         map.setCenter(pos);
                         map2.setCenter(pos);
                         $('.count_search_result').empty().html(data.count_result);
                         search_results = data.result;
                         search_map_results = data.res_map_layout;
                    } else { /*console.log(data);*/ }
                    if( $('#search_list_block').css('display') === 'block' ){
                        $('#wid-id-results_table33').fadeIn();
                        resetDataTableList();
                    }
                    if( $('#search_map_block').css('display') === 'block' ){
                        resetDataTableMap();
                    }
                });
            }

            function addResponsive(){
                $('.datatable_tabletools_wrapper .dt-wrapper').addClass('table-responsive');
            }


            function setFiltersString(){
                var filters = '';
                var filter_str = '';
                var min_price = '';
                var max_price = '';
                var min_sqft = '';
                var max_sqft ='';
                var min_year_built = '';
                var max_year_built = '';
                var min_lot_size = '';
                var max_lot_size = '';
                var filter_str_pref = '';
                filters = $('#main_search_form').serializeArray();
                $.each(filters, function(i, filter){
                    filter_str_pref = '';
                    filter_str_pref = filter_str.length > 0 ? ' / ' : '';
                    if ( (filter.name == 'address') && (filter.value.length != 0) ){
                        filter_str += filter_str_pref + filter.value;
                    }
                     if ( (filter.name == 'sale_type') && (filter.value.length != 0) && (filter.value != 0) ){
                        filter_str += filter_str_pref + filter.value;
                    }
                    if ( (filter.name == 'min_price') && (filter.value.length != 0) && (filter.value != 0) ){
                        min_price = '$' + filter.value;
                    }
                     if ( (filter.name == 'max_price') && (filter.value.length != 0) && (filter.value != 0) ){
                        max_price = '$' + filter.value;
                    }
                     if ( (filter.name == 'min_sqft') && (filter.value.length != 0) && (filter.value != 0) ){
                        min_sqft = filter.value;
                    }
                     if ( (filter.name == 'max_sqft') && (filter.value.length != 0) && (filter.value != 0) ){
                        max_sqft = filter.value;
                    }
                     if ( (filter.name == 'bed') && (filter.value.length != 0) && (filter.value != 0) ){
                        filter_str += filter_str_pref + filter.value + '+ Bed';
                    }
                     if ( (filter.name == 'bath') && (filter.value.length != 0) && (filter.value != 0) ){
                        filter_str += filter_str_pref + filter.value + '+ Bath' ;
                    }
                    if ( (filter.name == 'min_year_built') && (filter.value.length != 0) && (filter.value != 0) ){
                        var min_year_built_arr = '';
                        min_year_built_arr = filter.value.split(' ');
                        min_year_built = min_year_built_arr[1];
                    }
                    if ( (filter.name == 'max_year_built') && (filter.value.length != 0) && (filter.value != 0) ){
                        var max_year_built_arr = '';
                        max_year_built_arr = filter.value.split(' ')
                        max_year_built = max_year_built_arr[1];
                    }
                    if ( (filter.name == 'min_lot_size') && (filter.value.length != 0) && (filter.value != 0) ){
                        var min_lot_size_arr = '';
                        min_lot_size_arr = filter.value.split(' ');
                        min_lot_size = min_lot_size_arr[0];
                    }
                    if ( (filter.name == 'max_lot_size') && (filter.value.length != 0) && (filter.value != 0) ){
                        var max_lot_size_arr = '';
                        max_lot_size_arr = filter.value.split(' ');
                        max_lot_size = max_lot_size_arr[0];
                    }
                });
                if(min_price.length > 0 || max_price.length > 0){
                    filter_str += filter_str_pref + min_price + ' - ' + max_price;
                }
                if(min_sqft.length > 0 || max_sqft.length > 0){
                    filter_str += filter_str_pref + ' SqFt ' + min_sqft + ' - ' + max_sqft;
                }
                if(min_year_built.length > 0 || max_year_built.length > 0){
                    filter_str += filter_str_pref + ' Year ' + min_year_built + ' - ' + max_year_built;
                }
                if(min_lot_size.length > 0 || max_lot_size.length > 0){
                    filter_str += filter_str_pref +  min_lot_size + ' - ' + max_lot_size + ' Acre';
                }
                $('#filter-search-page').empty().html(filter_str);
            }

            function showAlert(text){
                $('.success2').empty().html(text);
                $('.success2').css('display','block');
                if($('.success2').css('display')=='block'){
                    $('.success2').fadeOut(5000);
                }
            }

            function deleteSearchResults(find_property){
                for(var i = 0; i < search_results.length; i++){
                    if(search_results[i][0].search(find_property) != -1){
                        search_results.splice(i,1);
                    }
                }
            }
            
            $('#search_list').click(function(){
                $('#search_list_block').show();
                $('#search_map_block').hide();
                
                google.maps.event.trigger(map, 'resize');
                if(search_results){
                    resetDataTableList();
                    $('#wid-id-results_table33').show();
                }       
                
            });
            
            $('#search_map').click(function(){
                $('#search_list_block').hide();
                $('#search_map_block').show();
                $('#wid-id-0M2').show();
                $('#wid-id-results12').show();
                google.maps.event.trigger(map2, 'resize');
                if(search_results){
                    resetDataTableMap();
                }
            });

            var myMap = google.maps.event.addDomListener(window, 'load', initialize);
            var searchOnLoad = " . ((isset($general_search_fields['searchOnLoad']) && $general_search_fields['searchOnLoad']=='1')? '1' :'0') . ";


", CClientScript::POS_END);




Yii::app()->clientScript->registerScript("successDestroyer", "if($('.success1').css('display')=='block'){
            $('.success1').fadeOut(5000);
        }", CClientScript::POS_END);


Yii::app()->clientScript->registerScript("searchScript", "   
       
var guest = " . $guest . ";
                   
        if(guest == 0){
            $('#main').css('margin-left', 0 );
            $('body #content').css('padding-top', '50px');
        }
        $('#save_search').on('focus',function(){
            if(guest == 0){
                 $('#alert_guest').fadeIn(200);
                 setTimeout(function(){ $('#save_search').trigger('blur'); },6000);
            }
        });
        $('#save_search_checkbox').on('click', function(){
            if($(this).prop('checked')==true){
                if(guest == 0){
                     $('#alert_guest').fadeIn(200);
                     setTimeout(function(){ $('#save_search_checkbox').prop('checked',false); },6000);
                }
            } 
        });

    ", CClientScript::POS_END);

Yii::app()->clientScript->registerScript(
        "sendAjaxRequest", " 
            var search_result;
            $('.rectangle').click(function() {                                                          //  RECTANGLE
                if($('#search_map_block').css('display') === 'block'){
                    if(selectedShape2){
                        selectedShape2.setMap(null);
                        coordinates_filter = '';
                    }

                    drawingManager2 = new google.maps.drawing.DrawingManager({
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
                    
                    drawingManager2.setMap(map2);
                    
                    google.maps.event.addListener(drawingManager2, 'rectanglecomplete', function(rectangle) {

                        coordinates_filter = getRectangleCoordinatesFilter(rectangle);
                        makeSearch();

                        drawingManager2.setDrawingMode(null);
                        google.maps.event.addListener(rectangle, 'click', function() {
                            setSelection(rectangle);
                        });
                        setSelection(rectangle);
                        google.maps.event.addListener(rectangle, 'bounds_changed', function(){

                            coordinates_filter = getRectangleCoordinatesFilter(rectangle);
                            makeSearch();
                        });
                    });
                }
                
                if($('#search_list_block').css('display') === 'block'){
                    if(selectedShape){
                        selectedShape.setMap(null);
                        coordinates_filter = '';
                    }

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

                        coordinates_filter = getRectangleCoordinatesFilter(rectangle);
                        makeSearch();

                        drawingManager.setDrawingMode(null);
                        google.maps.event.addListener(rectangle, 'click', function() {
                            setSelection(rectangle);
                        });
                        setSelection(rectangle);
                        google.maps.event.addListener(rectangle, 'bounds_changed', function(){

                            coordinates_filter = getRectangleCoordinatesFilter(rectangle);
                            makeSearch();
                        });
                    });
                }
            });
            


            $('.radius').click(function() {                                                             // RADIUS
                if( selectedShape ){
                    selectedShape.setMap(null);
                    coordinates_filter = '';
                }
                if( selectedShape2 ){
                    selectedShape2.setMap(null);
                    coordinates_filter = '';
                }

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
                drawingManager2 = new google.maps.drawing.DrawingManager({
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
                drawingManager2.setMap(map2);
                
                google.maps.event.addListener(drawingManager, 'circlecomplete', function(circle) {

                        coordinates_filter = getCircleCoordinatesFilter(circle);
                        makeSearch();
                        drawingManager.setDrawingMode(null);

                    google.maps.event.addListener(circle, 'click', function() {
                        setSelection(circle);
                    });

                    setSelection(circle);
                    google.maps.event.addListener(circle, 'center_changed', function(){

                        coordinates_filter = getCircleCoordinatesFilter(circle);
                        makeSearch();
                    });
                    google.maps.event.addListener(circle, 'radius_changed', function(){

                        coordinates_filter = getCircleCoordinatesFilter(circle);
                        makeSearch();
                    });
                });
                google.maps.event.addListener(drawingManager2, 'circlecomplete', function(circle) {

                        coordinates_filter = getCircleCoordinatesFilter(circle);
                        makeSearch();
                    drawingManager2.setDrawingMode(null);
                    google.maps.event.addListener(circle, 'click', function() {
                        setSelection(circle);
                    });
                    setSelection(circle);
                    google.maps.event.addListener(circle, 'center_changed', function(){

                        coordinates_filter = getCircleCoordinatesFilter(circle);
                        makeSearch();
                    });
                    google.maps.event.addListener(circle, 'radius_changed', function(){

                        coordinates_filter = getCircleCoordinatesFilter(circle);
                        makeSearch();
                    });
                });
            });


            
            
            $('.freehand').click(function() {                                                           // POLYGON
                if( selectedShape ){
                    selectedShape.setMap(null);
                    coordinates_filter = '';
                }
                if( selectedShape2 ){
                    selectedShape2.setMap(null);
                    coordinates_filter = '';
                }

                drawingManager = new google.maps.drawing.DrawingManager({
                    drawingMode: google.maps.drawing.OverlayType.POLYGON,
                    drawingControl: false,
                    drawingControlOptions: {
                        drawingModes: [
                            google.maps.drawing.OverlayType.POLYGON
                        ]
                    },
                    poligonOptions: {
                        strokeWeight: 0,
                        editable: true
                    }
                });
                drawingManager.setMap(map);
                
                drawingManager2 = new google.maps.drawing.DrawingManager({
                    drawingMode: google.maps.drawing.OverlayType.POLYGON,
                    drawingControl: false,
                    drawingControlOptions: {
                        drawingModes: [
                            google.maps.drawing.OverlayType.POLYGON
                        ]
                    },
                    poligonOptions: {
                        strokeWeight: 0,
                        editable: true
                    }
                });
                drawingManager2.setMap(map2);
                
                google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {

                    coordinates_filter = getPolygonCoordinatesFilter(polygon);
                    drawingManager.setDrawingMode(null);
                    setSelection(polygon);

                    google.maps.event.addListener(polygon, 'click', function() {
                        setSelection(polygon);
                    });

                    google.maps.event.addListener(polygon.getPath(), 'set_at', function() {
                        coordinates_filter = getPolygonCoordinatesFilter(polygon);
                        makeSearch();
                    });
                    google.maps.event.addListener(polygon.getPath(), 'insert_at', function() {
                        coordinates_filter = getPolygonCoordinatesFilter(polygon);
                        makeSearch();
                    });

                    makeSearch();

                });
                google.maps.event.addListener(drawingManager2, 'polygoncomplete', function(polygon) {
                    coordinates_filter = getPolygonCoordinatesFilter(polygon);
                    drawingManager.setDrawingMode(null);
                    google.maps.event.addListener(polygon, 'click', function() {
                        setSelection(polygon);
                    });
                    setSelection(polygon);
                    google.maps.event.addListener(polygon.getPath(), 'set_at', function() {
                        coordinates_filter = getPolygonCoordinatesFilter(polygon);
                    });
                    google.maps.event.addListener(polygon.getPath(), 'insert_at', function() {
                        coordinates_filter = getPolygonCoordinatesFilter(polygon);
                    });
                });
            });
            

            $('.delete-button').click(function() {
                deleteSelectedShape();
                
            });


            
            $('#keywords_block').on('blur', '.bootstrap-tagsinput input', function() {
                $('input.tagsinput').tagsinput('add', $(this).val());
                $(this).val('');
               
            });
            


            $('#search-button').click(function(){
                clickSearchButton();
                return false;
            });




            $('.datatable_tabletools').on('click', 'button.delete-property', function(){
                var property = $(this).data('property_id');
                if(confirm('Are you sure you want to delete the row?')){
                    setAllMap(null);
                    deleteSearchResults(property);
                    
                    $.ajax({
                        url: '/property/deletefavorites',
                        type: 'POST',
                        data: { property: property },
                        dataType: 'json',
                        cache: false,
                        success: function(data){
                            if(data.length > 0){
                                showAlert(data);
                            }
                        },
                        error:  function(xhr, str){
//                            console.log('error: ' + xhr.responseCode);
                        }
                    });
                    $(this).closest('tr').remove();
                    var c_res = parseInt($('.count_search_result').text());
                    $('.count_search_result').empty().html(c_res-1);
                    for(var i = 0; i < latLon_arr.length; i++){
                        if(latLon_arr[i].property_id == property){ 
                            latLon_arr.splice(i,1);
                        };
                    }
                    resetDataTableList();
                }
            });

            $('.datatable_tabletools').on('click', 'button.favorite', function(){
                var property_id = $(this).data('property_id');
                $.ajax({
                    url: '/property/addfavorites',
                    type: 'POST',
                    data: { property: property_id },
                    dataType: 'json',
                    cache: false,
                    success: function(data){
                        showAlert(data);
                    },
                    error:  function(xhr, str){
//                        console.log('error: ' + xhr.responseCode);
                    }
                });
                
            });
            

            
            $(document).keypress(function(eventObject){
                var code = parseInt((eventObject.keyCode ? eventObject.keyCode : eventObject.which));
                if(code === 13){
                    makeSearch();
                    return false;
                }

            });
            



            if(searchOnLoad){
                makeSearch();
            }



// end sendAjaxRequest (POS_READY)


", CClientScript::POS_READY);

//$cs->registerScriptFile(CPathCDN::publish(Yii::app()->theme->basePath . '/js/search.js', CClientScript::POS_END));

Yii::app()->clientScript->registerScript("Script", "
    
        var placeSearch, autocomplete;
        var componentForm = {
          street_number: 'short_name',
          route: 'long_name',
          locality: 'long_name',
          administrative_area_level_1: 'short_name',
          country: 'long_name',
          postal_code: 'short_name'
        };
        
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
//          console.log(place);
          for (var component in componentFormSearchFld) {
//            console.log(component);
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
          }
          for (var i = 0; i < place.address_components.length; i++) {
//            console.log(place.address_components[i].types[0]);
            var addressType = place.address_components[i].types[0];
            if (componentFormSearchFld[addressType+'_searchfld']) {
              var val = place.address_components[i][componentFormSearchFld[addressType+'_searchfld']];
              document.getElementById(addressType+'_searchfld').value = val;
            }
          }
        }
              

        function fillInAddress() {
          var place = autocomplete.getPlace();
          for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
          }
          if ('address_components' in place) {
          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
              var val = place.address_components[i][componentForm[addressType]];
              document.getElementById(addressType).value = val;
            }
          }
          }
        }

        
        function geolocate() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
              var geolocation = new google.maps.LatLng(
                  position.coords.latitude, position.coords.longitude);
                  
              autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
                  geolocation));
            });
          }
        }
        
        
    
    ", CClientScript::POS_END);

