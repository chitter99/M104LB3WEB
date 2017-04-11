<?php

$config = [
    'hostname' => 'localhost',
    'absolute_host' => 'http://localhost:8888/',
    'absolute_path' => '...',
    'env' => 'dev', // dev, test, live
    'db' => [
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'database' => 'hotel'
    ],
    'setup' => [
        'enabled' => true,
        'passwd' => '123456'
    ]
];

define('LIBRARY_PATH', realpath(dirname(__FILE__) . '/lib'));
define('RESOURCES_PATH', realpath(dirname(__FILE__)));

function GetDB()
{
    global $config;
    require_once LIBRARY_PATH . '/hoteldb.class.php';
    return new HotelDB($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['database']);
}

?>