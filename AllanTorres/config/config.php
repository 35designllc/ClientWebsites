<?php
//DB Params
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "1223ABab");
define("DB_NAME", "modernedgearmory");

//Lipseys API Params
define("LAPI_USER_DS", "modernedgearmorydropship@gmail.com");
define("LAPI_PASS_DS", "123456!");

//Lipseys API Params
define("LAPI_USER_NDS", "modernedgearmory1@gmail.com");
define("LAPI_PASS_NDS", "111Cec!!!");

//Authorize.net API Params
define("AUTHNET_USER", "2wj3p6WB7s");
define("AUTHNET_KEY", "775b4hLZ4f7VvyqT");

//Square access token
define("SQUARE_APPLICATION_ID", "sandbox-sq0idb-eEf-Ty6dCivgi--qGiu8Bw");
define("SQUARE_LOCATION_ID", "LJ8MMKPMRTWRB");
define("SQUARE_ACCESS_TOKEN", "EAAAl-wdcNHQbBOkEEezSxXTR8NZpia_J8AX6XOCan9tnFqOXoGh1cE5b8dnXf1h");
define("ENVIRONMENT", "sandbox");
$_ENV["ENVIRONMENT"] = '';

//Paths
define("BASE_URI", "http://".$_SERVER['SERVER_NAME']."/AllanTorres/");
define("LIPSEYS_API_PATH", "http://".$_SERVER['SERVER_NAME']."/AllanTorres/libraries/vendor_lipseys/lipseys/ApiIntegration");
define("SQUARE_API_PATH", "http://".$_SERVER['SERVER_NAME']."/AllanTorres/libraries/squareSDK");

#use LIPSEYS_API_PATH\LipseysClient;
