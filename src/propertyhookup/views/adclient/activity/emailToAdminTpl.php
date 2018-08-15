<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <META http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        @import url(http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700|Open+Sans+Condensed:300|Muli);
        *{margin:0;padding:0}*{font-family:Muli,"Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif}img{max-width:100%}.collapse{margin:0;padding:0}body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width:100% !important;height:100%}a{color:#2ba6cb} .btn{display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: normal;line-height: 1.428571429;text-align: center;white-space: nowrap;vertical-align: middle;cursor: pointer;border: 1px solid transparent;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;-o-user-select: none;user-select: none;color: #333;background-color: white;border-color: #CCC;} p.callout{padding:15px;background-color:#ecf8ff;margin-bottom:15px}.callout a{font-weight:bold;color:#2ba6cb}table.social{background-color:#ebebeb}.social .soc-btn{padding:3px 7px;border-radius:2px; -webkit-border-radius:2px; -moz-border-radius:2px; font-size:12px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:bold;display:block;text-align:center}a.fb{background-color:#3b5998 !important}a.tw{background-color:#1daced !important}a.gp{background-color:#db4a39 !important}a.ms{background-color:#000 !important}.sidebar .soc-btn{display:block;width:100%}table.head-wrap{width:100%}.header.container table td.logo{padding:15px}.header.container table td.label{padding:15px;padding-left:0}table.body-wrap{width:100%}table.footer-wrap{width:100%;clear:both !important}.footer-wrap .container td.content p{border-top:1px solid #d7d7d7;padding-top:15px}.footer-wrap .container td.content p{font-size:10px;font-weight:bold}h1,h2,h3,h4,h5,h6{font-family:Muli,"HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;line-height:1.1;margin-bottom:15px;color:#000}h1 small,h2 small,h3 small,h4 small,h5 small,h6 small{font-size:60%;color:#6f6f6f;line-height:0;text-transform:none}h1{font-weight:200;font-size:44px}h2{font-weight:200;font-size:37px}h3{font-weight:500;font-size:27px}h4{font-weight:500;font-size:23px}h5{font-weight:900;font-size:17px}h6{font-weight:900;font-size:14px;text-transform:uppercase;color:#444}.collapse{margin:0 !important}p,ul{margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6}p.lead{font-size:17px}p.last{margin-bottom:0}ul li{margin-left:5px;list-style-position:inside}ul.sidebar{background:#ebebeb;display:block;list-style-type:none}ul.sidebar li{display:block;margin:0}ul.sidebar li a{text-decoration:none;color:#666;padding:10px 16px;margin-right:10px;cursor:pointer;border-bottom:1px solid #777;border-top:1px solid #fff;display:block;margin:0}ul.sidebar li a.last{border-bottom-width:0}ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p{margin-bottom:0 !important}.container{display:block !important;max-width:600px !important;margin:0 auto !important;clear:both !important}.content{padding:15px;max-width:600px;margin:0 auto;display:block}.content table{width:100%}.column{width:300px;float:left}.column tr td{padding:15px}.column-wrap{padding:0 !important;margin:0 auto;max-width:600px !important}.column table{width:100%}.social .column{width:280px;min-width:279px;float:left}.clear{display:block;clear:both}@media only screen and (max-width:600px){a[class="btn"]{display:block !important;margin-bottom:10px !important;background-image:none !important;margin-right:0 !important}div[class="column"]{width:auto !important;float:none !important}table.social div[class="column"]{width:auto !important}}
    </style>
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">


<table class="body-wrap" bgcolor="">
    <tr><td class="container">
            <table width="100%">
                <tr>
                    <td width="420">
                        <img src="http://css.irradii.com/assets/img/logo/color_logo.png" alt="irradii" class="pull-left "/>
                        <div class="pull-left logo-title" style="display: inline-block;font-size: 48px"><span class="text-success" style="color: rgb(41, 104, 41);">i</span>rrad<span class="text-primary" style="color: rgb(50, 118, 177);">i</span><span class="txt-color-red" style="color: rgb(169, 3, 41);">i</span>
                            <br/>
                            <span class="pull-left text-muted logo-description" style="font-size: 11px">Your eyes into the real estate market around you</span>
                        </div>
                    </td>
                    <td class="header" align="right">


                        <div>
                            <table>
                                <tr>
                                    <td align="right" class="collapse"><h6>Local Services</h6></td>
                                </tr>
                            </table>
                        </div>

                    </td>
                    <td></td>
                </tr>
            </table>

        </td></tr>
    <tr>
        <td class="container" align="" bgcolor="#FFFFFF">



            <div>
                <div style="border: 1px solid;padding:10px">
                    Agents!<br/> Get your profile posted here!
                </div>
                <br/>
                <table>
                    <tr>
                        <td>
                            <h3><?php if(isset($clientCompany->rep_name)){echo 'Dear '.$clientCompany->rep_name.' <small>at</small>';}?> <?php echo isset($clientCompany->company_name)? $clientCompany->company_name: ''?>,</h3>
                            <p>There are new activity for you at <a href="http://irradii.com/">irradii.com</a></p>
                        </td>
                    </tr>
                </table>
            </div>

            <div>
                <table bgcolor="">
                        <tr>
                            <td width="100%" ">


                            <?php echo isset($customerInfo->user_first_name)? $customerInfo->user_first_name : '' ?> <?php echo isset($customerInfo->user_last_name)? $customerInfo->user_last_name : '' ?> has a
                            <?php echo isset($clientCompany->adCategory->ad_category)? $clientCompany->adCategory->ad_category : ''?> request for their property <?php echo isset($customerInfo->user_address)? ' at: '.$customerInfo->user_address : ''?>.
                            <br/>
                            <br/>
                            <p>Here are the details:</p>

                            <ul>
                                <li>User first name: <?php echo isset($customerInfo->user_first_name)? $customerInfo->user_first_name : ''?></li>
                                <li>User last name: <?php echo isset($customerInfo->user_last_name)? $customerInfo->user_last_name : ''?></li>
                                <?php if(isset($customerInfo->user_phone_number) && $customerInfo->user_phone_number != ''){ ?><li>User phone number: <?php echo $customerInfo->user_phone_number ;?></li><?php }?>
                                <li>User email: <?php echo isset($customerInfo->user_email)? $customerInfo->user_email: ''?></li>
                                <?php if(isset($customerInfo->user_address) && $customerInfo->user_address != ''){ ?><li>User address: <?php echo isset($customerInfo->user_address)? $customerInfo->user_address : '';?></li><?php }?>
                                <?php if(isset($customerInfo->user_comment) && $customerInfo->user_comment != ''){ ?><li>User comment/request: <?php echo $customerInfo->user_comment;?></li><?php }?><br/>
                            </ul>

                            <p>Form was filled at <?php $date = date_create("now"); echo date_format($date, 'Y-m-d H:i:s');?></p>

                            </td>
                        </tr>
                </table>

            </div>


            <div class="content">
                <table bgcolor="">
                    <tr>
                        <td>
                            <table bgcolor="" class="social" width="100%">
                                <tr>
                                    <td>


                                        <div class="column">
                                            <table bgcolor="" cellpadding="" align="left">
                                                <tr>
                                                    <td>

                                                        <h5>Connect with Us:</h5>
                                                        <p class=""><a href="https://www.facebook.com/Irradii" class="soc-btn fb">Facebook</a> <a href="https://twitter.com/irradii" class="soc-btn tw">Twitter</a> <a href="#" class="soc-btn gp">Google+</a></p>


                                                    </td>
                                                </tr>
                                            </table>
                                        </div>


                                        <div class="column">
                                            <table bgcolor="" cellpadding="" align="left">
                                                <tr>
                                                    <td>

                                                        <h5>Contact Info:</h5>
                                                        <p>Phone: <strong>800.878.6219</strong><br>
                                                            Email: <strong><a>info@irradii.com</a></strong></p>

                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="clear"></div>

                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
                <div style="border: 1px solid;padding:10px">
                    Agents!<br/> Get your profile posted here!
                </div>

            </div>


        </td>
        <td></td>
    </tr>
</table>

<!-- FOOTER -->
<table class="footer-wrap">
    <tr>
        <td></td>
        <td class="container">

            <!-- content -->
            <div class="content">
                <table>
                    <tr>
                        <td align="center">
                            <p>
                                <a href="#">Terms</a> |
                                <a href="#">Privacy</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </div><!-- /content -->

        </td>
        <td></td>
    </tr>
</table><!-- /FOOTER -->


</div>



</body>
</html>

