<?php

/**
 * request_class
 * This class analysis the Request URL
 *
 *  1- Url Request: http://www.example.com/somthing1/something2/
 *  2- base URL: www.example.com
 *  3- subfolder: somthing1/ or null
 *  4- request query: somthing1/something2/ or something2/
 *  5- headers
 *  6- Request Method
 *
 * @author anan
 */
class Request {
    public static $requestPath;
    public static $requestMethod;
    
    /**
     * init()
     * This function read the $_SERVER values 
     * Analysis the request uri and script name 
     * and then create the local properties
     * 
     */
    public static function init() {
        // get the HTTP method, path and body of the request
        self::$requestMethod = $_SERVER['REQUEST_METHOD'];
        
        //Parsing the request path
        
        $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
        
        $requestPath= trim(str_replace($_SERVER["SCRIPT_NAME"], "", $_SERVER["REQUEST_URI"]), "/")."/";
        

              self::$requestPath = trim($requestPath, "/") . "/";
        
    }
}
