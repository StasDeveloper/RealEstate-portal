<?php
date_default_timezone_set('America/Los_Angeles');
//ob_start();

define('DATABASE_SERVER', 'live.cypu3wsnk6wt.us-west-2.rds.amazonaws.com');  ////////Database server name

define('DATABASE_NAME', 'bucontra_propertyhookup'); ////////Database  name

define('DATABASE_USERNAME', 'irradii'); ////////Database user name

define('DATABASE_PASSWORD', 'msXOms32oS12KDIodm');   ////////Database Password

// define('TESTING', true);


define("HTTP_BASE","http://www.propertyhookup.com/");

define("HTTPS_BASE","http://www.propertyhookup.com/");

define("HTTPS_DIRECTORY",HTTPS_BASE."members/");

define("BASE","http://www.propertyhookup.com/");

define("ROOT_BASE","/var/www/html/irradii.com/crons/");

define('REDIS_SERVER', 'redis-server');  ////////redis server name redis-server

define('REDIS_PORT', 6379); ////////redis  port
