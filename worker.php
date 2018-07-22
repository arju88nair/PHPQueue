<?php
/**
 * Daemon script for running the SMS api
 */

include_once 'system/config.php';
include_once 'system/database.php';
include_once 'api/api_controller.php';

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', true);


if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

// instantiate database and product object
$database = new Database($config_database);
$db = $database->getConnection();
$api = New API($db);

$api->queueCheck();
