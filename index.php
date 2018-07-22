<?php
/**
 * The entry point where the routing and and HTTP actions are happening
 */

include_once 'system/config.php';
include_once 'system/request.php';
include_once 'system/database.php';
include_once 'api/api_controller.php';

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', true);


if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

// get the HTTP method, path and body of the request
Request::init();

$paths = explode("/", Request::$requestPath, 2);

if($paths[0] !== 'queue'){
    pageNotfound();
    exit();
}


// instantiate database and product object
$database = new Database($config_database);
$db = $database->getConnection();
$api = New API($db);

switch( Request::$requestMethod ){

    case 'GET':
        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $api->getAllQueue($params);
        break;
    case 'POST':
        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $api->create();
        break;
    default :
        pageNotfound();
}
$database->close();




function pageNotfound(){
    header('HTTP/1.0 404 Not Found');
    echo json_encode(
        array(
            "status" => "error",
            "message" => "page not found."
        )
    );
}
