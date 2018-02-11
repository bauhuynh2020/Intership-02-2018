<?php
/**
 * Created by PhpStorm.
 * User: bau
 * Date: 2/10/2018
 * Time: 10:37 PM
 */

return array(
    'api' => array(
        'host' => 'http://beta-pirl.pool.sexy/api/',
        'port' => 80
    ),
    'http' => array(
        'host' => '',
        'post' => 80
    ),
    'stratum' => array(
        'host' => '',
        'port' => 80,
        'nice_hash_port' => 4445
    ),
    // Fee and payout details
    'pool_fee' => '0.9%',
    'payout_threhold' => '20 PIRL',

    'block_explorer' => array(
        'df' => 'https://explorer.pirl.io/#/block/',
        'addr' => 'https://explorer.pirl.io/#/address/',
        'tx' => 'https://explorer.pirl.io/#/tx/'
    ),
    // For network hashrate (change for your favourite fork)
    'block_time' => 13
);