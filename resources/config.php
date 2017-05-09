<?php

error_reporting(E_ALL);

define('LIBRARY_PATH', realpath(dirname(__FILE__) . '/lib'));
define('RESOURCES_PATH', realpath(dirname(__FILE__)));

function GetConfig()
{
    return [
        'hostname' => 'localhost', // Hostname of the Application
        'absolute_host' => 'http://localhost/M104', // Absolute URL to reach the Application. Used for linking.
        'absolute_path' => '...', // Absolute Path in the Filesystem
        'env' => 'dev', // dev, test, live
        'db' => [
            'host' => 'localhost', // Enter your Database Host here
            'user' => 'root', // Enter your Username here
            'pass' => '', // Enter your Password here
            'database' => 'hotel' // Enter your Database here
        ],
        'setup' => [
            'enabled' => true, // Set this to false after building and seeding your database
            'passwd' => '123456' // The Password you need to enter in the Setup
        ]
    ];
}

function GetDB()
{
    global $config;
    require_once LIBRARY_PATH . '/hoteldb.class.php';
    return new HotelDB($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['database']);
}

$config = GetConfig();

?>