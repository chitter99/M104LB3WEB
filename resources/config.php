<?php

$config = array(
    'hostname' => 'localhost',
    'absolute_host' => 'http://localhost:8888/',
    'absolute_path' => '...',
    'db' => array(
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'database' => 'hotel'
    )
);

define('LIBRARY_PATH', realpath(dirname(__FILE__) . '/lib'));
define('RESOURCES_PATH', realpath(dirname(__FILE__)));

function GetDB()
{
    global $config;
    require_once LIBRARY_PATH . '/hoteldb.class.php';
    return new HotelDB($config['db']['host'], $config['db']['user'], $config['db']['passs'], $config['db']['database']);
}

?>