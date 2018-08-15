<?php

define('REDIS_EST_PRICE_NAME', 'EstimatedPriceCronIsBusy');

define('REDIS_EST_PRICE_TIMEOUT', 3600); // 3600  sec


function isEstimatedPriceBusy() {
    $redis = New Redis();
    $redis->connect(REDIS_SERVER, REDIS_PORT);
    if($result=$redis->get(REDIS_EST_PRICE_NAME)) {
        return $result;
    }
    $redis->set(REDIS_EST_PRICE_NAME, time(), REDIS_EST_PRICE_TIMEOUT);
    return $result;
}

function setEstimatedPriceFree() {
    $redis = New Redis();
    $redis->connect(REDIS_SERVER, REDIS_PORT);
    $redis->del(REDIS_EST_PRICE_NAME);
}