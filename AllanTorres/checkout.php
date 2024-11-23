<?php require("core/init.php") ?>

<?php
use Square\Environment;
use Ramsey\Uuid\Uuid;

include 'libraries/squareSDK/utils/location-info.php';
include 'libraries/squareSDK/vendor/ramsey/uuid/src/Uuid.php';


//Get Template & Assign Vars
$template = new Template("templates/checkout.php");

//Create Products Object
$product = new Products();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
    header('Location: '.'http://localhost/AllanTorres');
    die();
}

if(empty($_SESSION['cart'])){
    header('Location: '.'http://localhost/AllanTorres');
    die();
}

if(!isset($_SESSION['fflCount'])){
    $_SESSION['fflCount'] = -1;
}

if(!isset($_SESSION['ffls'])){
    $_SESSION['ffls'] = array();
}

if(!isset($_SESSION['fflSelected'])){
    $_SESSION['fflSelected'] = array();
}

if(!isset($_SESSION['FirearmAccessory'])){
    $_SESSION['FirearmAccessory'] = array();
}

if(!isset($_SESSION['SubTotals'])){
    $_SESSION['SubTotals'] = array();
}

$product->checkCartContent();

$template->cart = $_SESSION['cart'];
$template->ffls = $_SESSION['ffls'];
$template->fflCount = $_SESSION['fflCount'];
$template->fflSelected = $_SESSION['fflSelected'];
$template->FirearmAccessory = $_SESSION['FirearmAccessory'];
$template->shipping = 30;
$template->tax = 25;

$template->location_info = new LocationInfo();
$template->upper_case_environment = strtoupper(ENVIRONMENT);
//$template->web_payment_sdk_url = $_ENV["ENVIRONMENT"] === Environment::PRODUCTION ? "https://web.squarecdn.com/v1/square.js" : "https://sandbox.web.squarecdn.com/v1/square.js";
$template->uuid = Uuid::uuid4();

//Display template
echo $template;
