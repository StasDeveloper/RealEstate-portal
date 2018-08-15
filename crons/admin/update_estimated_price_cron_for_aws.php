<?php
include(__DIR__ . "/../include/config.php"); 
require_once 'update_estimated_price_include.php';

calculate_estimated_price_part($connect_DB_Object);
