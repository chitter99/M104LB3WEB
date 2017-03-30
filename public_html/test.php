<?php

require_once(realpath(dirname(__FILE__) . "/../config.php"));

$db = new HotelDB($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['database']);

$db->insert("test", ["nameField" => "James", "valueFirst" => 4, "last" => 69]);

?>