<?php
$cs = Yii::app()->clientScript;             //connection themes
$themePath = Yii::app()->theme->baseUrl;    //connection themes
$this->layout = '//layouts/irradii';        //connection themes

$property_type_array = array('0' => 'Unknown', '1' => 'Single Family Home', '2' => 'Condo', '3' => 'Townhouse', '4' => 'Multi Family', '5' => 'Land', '6' => 'Mobile Home', '7' => 'Manufactured Home', '8' => 'Time Share', '9' => 'Rental', '16' => 'High Rise');

//  DATA FOR PHOTO
if($actualInfo instanceof ActualInfoIsNull) {
    $slider_arr = array();
}
else{   //$actualInfo is instance of PropertyInfo and we have all information
    $slider_arr = array();
    list($controller) = Yii::app()->createController('Property');
    $photoArr=$controller->getPhotoArr($actualInfo);

    foreach ($photoArr as $propertyInfoPhoto) {
        $photocaption = $propertyInfoPhoto->caption ? "<p>{$propertyInfoPhoto->caption}</p>" : '';
        $slider_arr[] = '<div class="item">' . CPathCDN::checkPhoto($propertyInfoPhoto, "", 0 ) . $photocaption . '</div>';
        unset($photocaption);
    }

}
// END DATA FOR PHOTO


?>

<!--aside-->
<?php
if (!Yii::app()->user->isGuest) {
    echo $this->renderPartial('/layouts/aside', array('profile' => $profile));
}
?>
<!--  MAIN  -->
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon" class="<?php echo Yii::app()->user->isGuest ? 'ribbon-guest-variant' : ''; ?>">

        <span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all of your personalized widget settings." data-html="true"><i class="fa fa-refresh"></i></span> </span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo $this->createUrl('user/profile');?>">Home</a>
            </li>
            <li>
                <a href="<?php echo $this->createUrl('index');?>">Statistics</a>
            </li>
            <li>
                <a href="<?php echo $this->createUrl('statInfo/history');?>">History Search</a>
            </li>
            <li>
                <?php echo isset($property->city->city_name) ? '<a href="" >' . $property->city->city_name . '</a> ' : ''; ?>
            </li>
            <li>
                <?php echo (isset($property->property_zipcode) &&
                    ($property->property_zipcode != 0) &&
                    ($property->property_zipcode != '') &&
                    ($property->zipcode) ) ? '<a>' . $property->zipcode->zip_code . '</a>' : ''; ?>
            </li>
        </ol>

    </div>
    <!-- END RIBBON -->
    <!--  CONTENT  -->
    <div id="content">
        <!--    ROW for TITLE and PRICE    -->
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-8">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-home fa-fw text-primary"></i>
                    <?php echo $property->property_street; ?>
                    <span>
                        <?php echo isset($property->city->city_name) ? '<a class="search-field-query" data-subdivision="" data-zipcode="" data-city="'.$property->city->city_name.'" data-state="'. $property->state->state_code .'">' . $property->city->city_name . '</a>, ' : ''; ?>
                        <?php echo isset($property->state->state_code) ? '<a class="search-field-query" data-subdivision="" data-zipcode="" data-city="" data-state="'. $property->state->state_code .'">' . $property->state->state_code . '</a> ' : ''; ?>
                        <?php
                        isset($property->city) ? $_city = $property->city->city_name : $_city = '';
                        isset($property->state) ? $_state = $property->state->state_code : $_state = '';
                        echo (isset($property->property_zipcode) &&
                            ($property->property_zipcode != 0) &&
                            ($property->property_zipcode != '') &&
                            ($property->zipcode) ) ?
                            '<a class="search-field-query" data-subdivision="" data-city="'.$_city
                            .'" data-state="'. $_state .'" data-zipcode="'
                            . $property->zipcode->zip_code .'">'
                            . $property->zipcode->zip_code
                            . '</a>' : ''; ?>
                    </span>
                </h1>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4">
                <ul id="sparks" class="">
                    <li class="sparks-info">
                        <h5>Current Price<?php
                            if ($actualInfo->property_price != 0) {
                                echo '<span class="txt-color-primary">$' . number_format($actualInfo->property_price) . '</span>';
                            } else {
                                echo '<span title="Not Enough Data" class=""><span style="color:#999999">N/A</span></span>';
                            }
                            ?>
                        </h5>
                    </li>
                    <li class="sparks-info">
                        <h5>Current TMV<?php
                            if ($actualInfo->estimated_price != 0) {
                                echo '<span class="txt-color-primary">$' . number_format($actualInfo->estimated_price) . '</span>';
                            } else {
                                echo '<span title="Not Enough Data" class=""><span style="color:#999999">N/A</span></span>';
                            }
                            ?>
                        </h5>
                    </li>
                    <li class="sparks-info">
                        <h5>History TMV<?php
                            if ($property->estimated_price != 0) {
                                echo '<span class="">$' . number_format($property->estimated_price) . '</span>';
                            } else {
                                echo '<span title="Not Enough Data" class="">-</span>';
                            }
                            ?>
                        </h5>
                    </li>
                    <li class="sparks-info">
                        <h5>History Price
                            <span class="">$ <?php echo number_format($property->property_price)   ?></span>
                        </h5>
                    </li>
                    &nbsp;&nbsp;
                </ul>
            </div>
        </div>
        <!--    END ROW for TITLE and PRICE    -->

        <!-- widget grid -->
        <section id="widget-grid" class="">
            <!-- row -->
            <div class="row">
                <article class="col-sm-12 col-md-12 col-lg-9 sortable-grid ui-sortable">

                    <div class="jarviswidget jarviswidget-sortable" id="wid-id-2dt-c" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-archive fa-fw text-muted font-lg"></i></span>
                            <h2>
                                <?php echo "Uploaded ".date('m/d/Y', strtotime($property->property_updated_date)); ?>
                            </h2>
                            <?php if (count($slider_arr) > 0){ ?>
                                <div class="widget-toolbar hidden-mobile">
                                    <span class="onoffswitch-title">Slideshow</span>
                                    <span class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked="checked" id="myonoffswitch">
                                        <label class="onoffswitch-label" for="myonoffswitch"> <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span> <span class="onoffswitch-switch"></span> </label> </span>
                                </div>
                            <?php } ?>
                        </header>

                        <!-- Widget div -->
                        <div>

<!--            HERE                -->

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

                                                if (strtolower(substr($actualInfo->photo1, 0, 4)) === 'http') {
                                                    $file_headers=Yii::app()->cache->get($actualInfo->photo1);
                                                    if($file_headers===false)
                                                    {
                                                        $file_headers = CPathCDN::checkS3Photo($actualInfo->photo1);
                                                        Yii::app()->cache->set($actualInfo->photo1,$file_headers, 1000);
                                                    }
                                                    if($file_headers[0] != 'HTTP/1.1 404 Not Found') {
                                                        echo CPathCDN::checkPhoto($actualInfo, "", 0 );
                                                    } else {
                                                        echo $slider_arr[0];
                                                    }
                                                } else {
                                                    $photo1 = CPathCDN::baseurl( 'images' ) . '/images/property_image/' . $actualInfo->photo1;
                                                    $photo1_file = Yii::app()->basePath . "/../images/property_image/" . $actualInfo->photo1;
                                                    if (is_readable($photo1_file)) {
                                                        echo '<img src="' . $photo1 . '" alt="' . $actualInfo->getFullAddress() . '">';
                                                    } else {
                                                        echo $slider_arr[0];
                                                    }
                                                }

                                                ?>
                                                <?php echo $actualInfo->caption1 ? "<p>{$actualInfo->caption1}</p>" : ''; ?>



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
                                if (strtolower(substr($actualInfo->photo1, 0, 4)) === 'http') {

                                $photo1 = $actualInfo->photo1;
                                $file_headers=Yii::app()->cache->get($actualInfo->photo1);
                                if($file_headers===false)
                                {
                                    $file_headers = CPathCDN::checkS3Photo($actualInfo->photo1);
                                    Yii::app()->cache->set($actualInfo->photo1,$file_headers, 1000);
                                }
                                if($file_headers[0] != 'HTTP/1.1 404 Not Found') {
                                    $photo1 = $actualInfo->photo1;
                                    echo CPathCDN::checkPhoto($actualInfo, "", 0 );
                                } else {
                                //                                            echo '<img src="'.CPathCDN::baseurl( 'img' ).'/img/image_absent.jpg" alt="">';?>
                                    <div id="map-canvas45" class="col-md-12 map45" style="height: 370px;"></div>
                                    <script type="text/javascript">
                                        var map45;
                                        var lat = "<?php echo $actualInfo->getlatitude; ?>";
                                        var lng = "<?php echo $actualInfo->getlongitude; ?>";
                                        function getPathImages(){
                                            var a_path_cdn = '<?php echo  CPathCDN::baseurl( 'images' );?>';
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

                                        function initialize45() {
                                            var pos = new google.maps.LatLng(lat, lng);
                                            var mapOptions = {
                                                center: pos,
                                                zoom: 19,
                                                mapTypeId: google.maps.MapTypeId.SATELLITE
                                            };
                                            var map45 = new google.maps.Map(document.getElementById('map-canvas45'), mapOptions);
                                            var colorScheme = <?php echo json_encode(SiteHelper::defineColorScheme($property)); ?>;
                                            var status = colorScheme.status.toLowerCase();

                                            var a_path = getPathImages();
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
                                                icon: image
//                                                                                    title: title
                                            });


                                            map45.setTilt(45);
                                        }
                                        google.maps.event.addDomListener(window, 'load', initialize45);
                                    </script>
                                <?php
                                }
                                } else {

                                $photo1 = CPathCDN::baseurl( 'images' ) . '/images/property_image/' . $actualInfo->photo1;
                                $photo1_file = Yii::app()->basePath . "/../images/property_image/" . $actualInfo->photo1;
                                if (is_readable($photo1_file)) {
                                    echo '<img src="' . $photo1 . '" alt="">';
                                    echo $actualInfo->caption1 ? "<p>{$actualInfo->caption1}</p>" : '';
                                } else {
                                echo '<img src="' . CPathCDN::baseurl( 'images' ) . '/image_absent.jpg" alt="">';?>
                                    <div id="map-canvas45" class="col-md-12 map45" style="height: 370px;"></div>
                                    <script type="text/javascript">
                                        var map45;
                                        var lat = "<?php echo $actualInfo->getlatitude; ?>";
                                        var lng = "<?php echo $actualInfo->getlongitude; ?>";

                                        function getPathImages(){
                                            var a_path_cdn = '<?php echo  CPathCDN::baseurl( 'images' );?>';
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

                                        function initialize45() {
                                            var pos = new google.maps.LatLng(lat, lng);
                                            var mapOptions = {
                                                center: pos,
                                                zoom: 19,
                                                mapTypeId: google.maps.MapTypeId.SATELLITE
                                            };
                                            map45 = new google.maps.Map(document.getElementById('map-canvas45'), mapOptions);

                                            var a_path = getPathImages();

                                            var colorScheme = <?php echo json_encode(SiteHelper::defineColorScheme($property)); ?>;
                                            var status = colorScheme.status.toLowerCase();

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
                                                icon: image
//                                                                                    title: title
                                            });

                                            map45.setTilt(45);
                                        }
                                        google.maps.event.addDomListener(window, 'load', initialize45);
                                    </script>
                                    <?php
                                }
                                }
                                    ?>

                                <?php endif; ?>

                            </div>



<!--            END HERE                -->



                            <!--    TABLE on right from SLIDER    -->
                            <div class="col-sm-3">

                                <table class="table table-bordered table-striped table-condensed">

                                    <tbody>
                                    <tr>
                                        <th colspan="3"><?php echo $property->house_square_footage; ?> Square Feet</th>
                                    </tr>
                                    <tr>
                                        <?php $in_str = $property->subdivision ? 'in' : ''; ?>
                                        <td colspan="3"><?php echo array_key_exists($property->property_type, $property_type_array) ?
                                                $property_type_array[$property->property_type] : '';
                                            ?>&nbsp;<?php echo $in_str; ?><a rel="popover-hover"  class="search-field-query" data-city="<?php echo $actualInfo->city_name ?>" data-state="<?php echo  $actualInfo->state_code ?>" data-zipcode="<?php echo  $actualInfo->zip_code ?>" data-subdivision="<?php echo $property->subdivision; ?>"
                                                                             data-placement="top"
                                                                             data-original-title="<?php echo $property->subdivision; ?>"
                                                                             data-content="Search posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.">
                                                <?php echo $property->subdivision; ?>
                                            </a></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><strong>History</strong></td>
                                        <td><strong>Actual</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Bedrooms:</th>
                                        <td><?php echo $property->bedrooms; ?></td>
                                        <td><?php echo $actualInfo->bedrooms; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Bathrooms:</th>
                                        <td><?php echo $property->bathrooms; ?></td>
                                        <td><?php echo $actualInfo->bathrooms; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Year Built:</th>
                                        <td><?php echo $property->year_biult_id; ?></td>
                                        <td><?php echo $actualInfo->year_biult_id; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Garage:</th>
                                        <?php echo!empty($property->garages) ? '<td>' . $property->garages . '</td>' : '<td class="text-muted">N/A</td>'; ?>
                                        <?php echo!empty($actualInfo->garages) ? '<td>' . $actualInfo->garages . '</td>' : '<td class="text-muted">N/A</td>'; ?>
                                    </tr>
                                    <tr>
                                        <th>Lot Acreage:</th>
                                        <?php echo $property->lot_acreage != 0 ? '<td>' . $property->lot_acreage . '</td>' : '<td class="text-muted">N/A</td>'; ?>
                                        <?php echo $actualInfo->lot_acreage != 0 ? '<td>' . $actualInfo->lot_acreage . '</td>' : '<td class="text-muted">N/A</td>'; ?>
                                    </tr>
                                    <tr>
                                        <th>Pool:</th>
                                        <?php echo $property->pool != 0 ? '<td>' . $property->pool . '</td>' : '<td class="text-muted">N/A</td>'; ?>
                                        <?php echo $actualInfo->pool != 0 ? '<td>' . $actualInfo->pool . '</td>' : '<td class="text-muted">N/A</td>'; ?>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--    END TABLE on right from SLIDER    -->

                            <?php $this->renderPartial('//property/_property_description_history', array('details' => $property, 'actual' => $actualInfo)) ?>

                        </div>
                        <!-- END Widget div -->

                    </div>
                </article>

                <!-- Local Vendors -->
                <?php if(! $actualInfo instanceof ActualInfoIsNull){ ?>
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
                                'property'=>$actualInfo,
                            ));
                            ?>
                            <!-- end widget content -->
                        </div>

                        <!-- end widget div -->
                    </div>
                </article>
                <?php } ?>
                <!-- END Local Vendors -->

                <!-- AD WIDGET -->
                <article class="col-sm-12 col-md-6 col-lg-3">
                    <!-- market data widget content -->

                    <!-- end market data widget content -->

                    <?php // if($enableAds) : ?>
                    <div class="jarviswidget jarviswidget-color-blue jarviswidget-sortable" id="google-ads2" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-editbutton="false" role="widget">

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
                <!-- END AD WIDGET -->

                <!-- AD WIDGET -->
                <article class="col-sm-12 col-md-6 col-lg-3">
                    <!-- market data widget content -->

                    <!-- end market data widget content -->

                    <?php // if($enableAds) : ?>
                    <div class="jarviswidget jarviswidget-color-blue jarviswidget-sortable" id="google-ads2" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-editbutton="false" role="widget">

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
                <!-- END AD WIDGET -->

                <!-- AD WIDGET -->
                <article class="col-sm-12 col-md-6 col-lg-3">
                    <!-- market data widget content -->

                    <!-- end market data widget content -->

                    <?php // if($enableAds) : ?>
                    <div class="jarviswidget jarviswidget-color-blue jarviswidget-sortable" id="google-ads2" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-editbutton="false" role="widget">

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
                <!-- END AD WIDGET -->

            </div>
            <!--  END row  -->
        </section>
        <!-- END widget grid -->

    </div>
    <!-- END CONTENT  -->
</div>
<!--  END MAIN  -->

<?php
Yii::app()->clientScript->registerScript(
    "makeBlockPositionChangeable", "

        if (jqueryOne.device === 'desktop') {
        setup_widgets_desktop();
        }
        else {
            setup_widgets_mobile();
        }

           ", CClientScript::POS_READY);
?>



















