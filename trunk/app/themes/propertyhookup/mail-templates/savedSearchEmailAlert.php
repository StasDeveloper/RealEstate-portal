<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <META http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <META name="format-detection" content="telephone=no,address=no"/>

    <style>
        @import url(http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700|Open+Sans+Condensed:300|Muli);
        *{
            margin:0;
            padding:0;
        }
        *{
            font-family:Muli,"Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif;
        }
        a>img{
            width:100% !important;
            max-width: 100% !important;
        }
        body>table{
            margin-top:0;
            margin-right:auto;
            margin-bottom:0;
            margin-left:auto;
        }
        body{
            -webkit-font-smoothing:antialiased;
            -webkit-text-size-adjust:none;
            width:100% !important;
            height:100%;
        }
        a{
            color:#2ba6cb
        }
        h1,h2,h3,h4,h5,h6{
            font-family:Muli,"HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;
            line-height:1.1;
            margin-bottom:15px;
            color:#000;
        }
        h1 small,h2 small,h3 small,h4 small,h5 small,h6 small{
            font-size:60%;
            color:#6f6f6f;
            line-height:0;
            text-transform:none;
        }
        h1{
            font-weight:200;
            font-size:44px;
        }
        h2{
            font-weight:200;
            font-size:37px;
        }
        h3{
            font-weight:500;
            font-size:27px;
        }
        h4{
            font-weight:500;
            font-size:23px;
        }
        h5{
            font-weight:900;
            font-size:17px;
        }
        h6{
            font-weight:900;
            font-size:14px;
            text-transform:uppercase;
            color:#444;
        }
        p,ul{
            margin-bottom:10px;
            font-weight:normal;
            font-size:14px;
            line-height:1.6;
        }

        ul li{
            margin-left:5px;
            list-style-position:inside;
        }
        body,
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: Helvetica, Arial, sans-serif;
        }
    </style>
    <?php
    //styles for number of photo
        $labelPhoto = "background-color: #3276b1 !important; display: inline; min-width: 10px;padding: 3px 7px;font-size: 12px;font-weight: bold;color: #ffffff;vertical-align: center;white-space: nowrap;text-align: center;background-color: #999999;border-radius: 10px;";
    //styles for label status
        $labelStyle = "display: inline; padding: .2em .6em .3em; font-size: 100%; font-weight: bold;color: #ffffff; text-align: center; white-space: nowrap; vertical-align: center; border-radius: .25em;";
    //styles for link label
        $labelLink = "background-color: #3276b1 !important; display: inline; min-width: 10px;padding: 5px 10px;font-size: 12px;font-weight: bold;color: #ffffff;vertical-align: center;white-space: nowrap;text-align: center;background-color: #999999;border-radius: 5px; text-decoration:none;";
    ?>
</head>

<body style="font-family: Helvetica, Arial, sans-serif" bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">


<table width="100%">
    <tr>
        <td>
            <table width="auto">
                <tr>
                    <td width="420">
                        <img src="http://css.irradii.com/assets/img/logo/color_logo.png" alt="irradii" />
                        <span style="color: rgb(41, 104, 41);">i</span>rrad<span style="color: rgb(50, 118, 177);">i</span><span style="color: rgb(169, 3, 41);">i</span>
                        <br/>
                        <span style="font-size: 11px">Your eyes into the real estate market around you</span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <table>
            <?php echo ($dailyMessages !== null) ? $dailyMessages->message_1 : ''; ?>
            <br/>
            <table width="100%">
                <tr>
                    <td>
                        <h2>&quot;<?php echo $savedSearchModel->name; ?>&quot; Results</h2>
                        <p>There are new properties that match your saved search!</p>
                        <p>Crunching a million property records a night isn&#39;t easy, but hey, the early bird get the worm right? Here are your new and updated results based on your saved search settings. </p>
                    </td>
                </tr>
            </table>
            <?php foreach ($propertyModels as $propertyModel): ?>
            <!--[if mso]>
                <table align="left"><tr><td width="640">
            <![endif]-->
                    <table width="100%" style="max-width:640px">
                        <tr>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td style="vertical-align:top;padding-right:10px;" >
                                            <?php
                                            $percentage = $this->showBellowPercentage($propertyModel);
                                            $img_link   = "<a style='text-align: center; display:block; width:100%' href=" . Yii::app()->createAbsoluteUrl('property/details', array(
                                                    'slug' => $propertyModel->slug->slug
                                                )) . " >";
                                            $img_link .= CPathCDN::checkPhoto($propertyModel, "thumb-img-140", 0, '640');
                                            $img_link .= "</a>";
                                            $photo_txt = ($propertyModel->countPhoto() > 1) ? ' photos ' : ' photo ';
                                            ?>
                                            <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('property/details/'.$propertyModel->slug->slug); ?>">
                                                <h4 style="margin-top: 1em; margin-bottom:1em;color: #15c;">
                                                    <?php
                                                    echo '<span>' . $propertyModel->property_street . '</span>';
                                                    echo '<span style="white-space: nowrap">';
                                                    echo isset($propertyModel->city) ? ' ' . $propertyModel->city->city_name . ', ' : '';
                                                    echo isset($propertyModel->state) ? ' ' . $propertyModel->state->state_code : '';
                                                    echo (isset($propertyModel->property_zipcode) && ($propertyModel->property_zipcode != 0) && ($propertyModel->property_zipcode != '') && ($propertyModel->zipcode)) ? ' ' . $propertyModel->zipcode->zip_code : '';
                                                    echo '</span>';
                                                    ?>
                                                </h4>
                                            </a>
                                        </td>
                                        <td style="text-align: right">
                                            <?php
                                            $this->drawStatusLabel($propertyModel, $labelStyle);
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <?php echo $percentage; ?>
                                        </td>
                                        <td style="text-align: right">
                                            <a target="_blank" style="<?php echo $labelLink;?>" href="<?php echo Yii::app()->createAbsoluteUrl('property/details/'.$propertyModel->slug->slug); ?>">View Full Listing</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center">
                                <table width="100%">
                                    <tr>
                                        <td style="text-align: center">
                                            <?php echo $img_link; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="auto">
                                    <tr>
                                        <td>
                                            <?php echo "<span style='{$labelPhoto}'> &nbsp;" . $propertyModel->countPhoto() . $photo_txt . " &nbsp;</span>"; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" align="center">
                                    <tr>
                                        <td width="30%" style="vertical-align: bottom">
                                            <h6 style="font-weight: bold;font-size: 14px; margin-top: 5px;margin-bottom: 0">
                                                List Price:
                                            </h6>
                                            <p style="font-weight: bold;font-size: 14px; margin-top: 0;margin-bottom: 5px">
                                                <?php
                                                echo $propertyModel->property_price ? '$ ' . number_format($propertyModel->property_price, 0, '.', ',') : '';
                                                ?>
                                            </p>
                                        </td>
                                        <?php if ($propertyModel->estimated_price > 0):?>
                                            <td width="30%" style="vertical-align: bottom">
                                                <h6 style="font-weight: bold;font-size: 14px; margin-top: 5px;margin-bottom: 0">
                                                    True Market Value:
                                                </h6>
                                                <p style="font-weight: bold;font-size: 14px; margin-top: 0;margin-bottom: 5px">
                                                    <?php
                                                    echo '$ ' . number_format($propertyModel->estimated_price, 0, '.', ',');
                                                    ?>
                                                </p>
                                            </td>
                                        <?php endif; ?>
                                        <?php if ($propertyModel->estimated_price > $propertyModel->property_price):?>
                                            <?php
                                            $estimated_equity = $this->showEstimatedEquity($propertyModel->estimated_price, $propertyModel->property_price);
                                            $estimated_equity = number_format($estimated_equity, 0, '.', ',');
                                            ?>
                                            <td width="30%" style="vertical-align: bottom">
                                                <h6 style="font-weight: bold;font-size: 14px; margin-top: 5px;margin-bottom: 0">
                                                    Estimated Equity:
                                                </h6>
                                                <p style="font-weight: bold;font-size: 14px; margin-top: 0;margin-bottom: 5px"><?php
                                                    echo '$ ' . $estimated_equity;
                                                    ?>
                                                </p>
                                            </td>
                                            <?php
                                        endif;
                                        ?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="auto">
                                    <tr>
                                        <td>
                                            <p style="margin-top: 1em; margin-bottom:1em"><?php
                                                echo $propertyModel->house_square_footage;
                                                ?> Square Foot <?php
                                                echo $propertyModel->getPropertyType();
                                                ?> in <?php
                                                echo (!empty($propertyModel->subdivision)) ? $propertyModel->subdivision : '';
                                                ?>. <?php
                                                echo $propertyModel->bedrooms;
                                                ?> Beds, <?php
                                                echo $propertyModel->bathrooms;
                                                ?> Baths, <?php
                                                echo $propertyModel->garages;
                                                ?> Car Garage built in <?php
                                                echo $propertyModel->year_biult_id;
                                                ?>. </p>
                                        </td>
                                    </tr>
                                    <?php if($propertyModel->public_remarks != null):?>
                                        <tr>
                                            <td>
                                                <?php echo $propertyModel->public_remarks; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                    </table>
                    <table width="100%" style="background-color:#EBEBEB">
                        <tr>
                            <td style="height: 2px">
                            </td>
                        </tr>
                    </table>
        <!--[if mso]>
        </td></tr></table>
        <![endif]-->
            <?php endforeach;?>
        </td>
    </tr>
    <tr>
        <td>
            <table  width="auto">
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td>
            <?php echo ($dailyMessages !== null) ? $dailyMessages->message_2 : ''; ?>
        </td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td>
            <table width="auto">
                <tr>
                    <td>
                        <table  width="auto">
                            <tr>
                                <td>
                                    <h5>Connect with Us:</h5>
                                    <p>
                                        <a href="https://www.facebook.com/Irradii" class="soc-btn fb">Facebook</a>
                                        <a href="https://twitter.com/irradii" class="soc-btn tw">Twitter</a>
                                        <a href="#" class="soc-btn gp">Google+</a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                        <table  width="auto">
                            <tr>
                                <td>
                                    <h5>Contact Info:</h5>
                                    <p>
                                        Phone: <strong>800.878.6219</strong><br>
                                        Email: <strong><a>info@irradii.com</a></strong>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td>
            <?php echo ($dailyMessages !== null) ? $dailyMessages->message_3 : ''; ?>
        </td>
    </tr>
</table>

<!-- FOOTER -->
<table width="100%">
    <tr>
        <td></td>
        <td>
            <!-- content -->
            <table width="auto">
                <tr>
                    <td align="center">
                        <p>
                            <a href="#">Terms</a> |
                            <a href="#">Privacy</a> |
                            <a href="<?php
                            echo Yii::app()->createAbsoluteUrl('/searches/unsubscribe/', array(
                                'email' => $email
                            ));
                            ?>"><unsubscribe>Unsubscribe</unsubscribe></a>
                        </p>
                    </td>
                </tr>
            </table>
            <!-- /content -->
        </td>
        <td></td>
    </tr>
</table><!-- /FOOTER -->
</body>
</html>

