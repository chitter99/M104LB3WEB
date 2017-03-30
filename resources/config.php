<?php

$config = array(
    'hostname' => 'localhost',
    'absolute_host' => 'http://localhost:8888/',
    'absolute_path' => '...',
    'db' => array(
        'host' => 'localhost',
        'user' => 'root',
        'passwd' => '',
        'database' => 'hotel'
    )
);

define('LIBRARY_PATH', realpath(dirname(__FILE__) . '/lib'));
define('RESOURCES_PATH', realpath(dirname(__FILE__)));

?>
