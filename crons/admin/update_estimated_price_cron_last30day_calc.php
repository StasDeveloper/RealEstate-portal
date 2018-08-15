<?php
include(__DIR__ . "/../include/config.php"); 
require_once 'update_estimated_price_include_calc.php';

calculate_estimated_price_30($connect_DB_Object);
