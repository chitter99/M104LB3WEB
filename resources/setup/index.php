<?php

require_once(realpath(dirname(__FILE__) . "/../config.php"));
require_once(LIBRARY_PATH . '/hoteldb.class.php');

$db = GetDB($config);

$db->build();
$db->seed();

?>

