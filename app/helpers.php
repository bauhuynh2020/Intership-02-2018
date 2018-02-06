<?php
/**
 * Created by PhpStorm.
 * User: bau
 * Date: 2/6/2018
 * Time: 12:48 PM
 */

if (!function_exists('clientRequest')) {
    function clientRequest($config = array())
    {
        if (!isset($config['base_domain'])) {
            $config['base_domain'] = config('common.base_domain');
        }

        return new ClientRequest($config);
    }
}