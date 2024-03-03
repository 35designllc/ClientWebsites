<?php
//DB Params
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "1223ABab");
define("DB_NAME", "modernedgearmory");

//Lipseys API Params
define("LAPI_USER", "modernedgearmorydropship@gmail.com");
define("LAPI_PASS", "123456!");

//Authorize.net API Params
define("AUTHNET_USER", "2wj3p6WB7s");
define("AUTHNET_KEY", "775b4hLZ4f7VvyqT");

//Paths
define("BASE_URI", "http://".$_SERVER['SERVER_NAME']."/AllanTorres/");
define("API_PATH", "http://".$_SERVER['SERVER_NAME']."/AllanTorres/libraries/vendor/lipseys/ApiIntegration");


use API_PATH\LipseysClient;
