<?php
	#AUTOGENERATED BY HYBRIDAUTH 2.1.1-dev INSTALLER - Tuesday 16th of June 2015 01:04:37 PM

/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

return 
	array(
		"base_url" => "http://irradii.local/user/login/oauth", 

		"providers" => array ( 
			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "127011947630365", "secret" => "e1344d6cd3b1a9df0566491da7b186c8" ),
                                "scope"   => "email", // you can change the data, that will be asked from user
                                "display" => "popup", // <- this one
                                "class" => "btn btn-primary btn-circle",
                                "classIcon" => "fa fa-facebook",
			),

			"Twitter" => array ( 
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" ) ,
                                "class" => "btn btn-info btn-circle",
                                "classIcon" => "fa fa-twitter",
			),

			"Google" => array ( 
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ),
                                "class" => "btn btn-danger btn-circle",
                                "classIcon" => "fa fa-google-plus",
			),

			"LinkedIn" => array ( 
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" ) ,
                                "class" => "btn btn-warning btn-circle",
                                "classIcon" => "fa fa-linkedin",
			),

			// openid providers
			"OpenID" => array (
				"enabled" => false
			),

			"AOL"  => array ( 
				"enabled" => false 
			),

			"Yahoo" => array ( 
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" )
			),

			// windows live
			"Live" => array ( 
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ) 
			),

			"MySpace" => array ( 
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" ) 
			),

			"Foursquare" => array (
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ) 
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,

		"debug_file" => "/home/developer/Projects/irradii/trunk/app/protected/runtime/hoauth_debug.log"
	);
