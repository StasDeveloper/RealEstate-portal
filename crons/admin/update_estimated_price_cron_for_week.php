<?php
include(__DIR__ . "/../include/config.php"); 
require_once 'update_estimated_price_include.php';

calculate_estimated_price_all($connect_DB_Object);
