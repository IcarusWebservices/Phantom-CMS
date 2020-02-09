<?php
session_start();

define("PH_ROOT", dirname(dirname(__FILE__)) . '/');

require_once PH_ROOT . 'ph-setup.php';

$request = new PH_Request();

?>