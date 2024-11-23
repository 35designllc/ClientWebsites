<?php
//Start Session
session_start();

//Include Configuration
require_once('config/config.php');

//Call Lipseys Autoloader
require_once('libraries/vendor_lipseys/autoload.php');

//Square Auto loader
require('libraries/squareSDK/vendor/autoload.php');

//Helper Function Files
require_once('helpers/system_helper.php');
require_once('helpers/format_helper.php');
require_once('helpers/db_helper.php');

//Autoload Classes
function myAutoload($class_name)
{
    
        require_once('libraries/'.$class_name.'.php');
}

spl_autoload_register('myAutoload');



