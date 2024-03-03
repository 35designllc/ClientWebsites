<?php require("core/init.php") ?>

<?php
//Get Template & Assign Vars

$template = new Template("templates/checkout.php");

//Create Products Object
$product = new Products();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
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

//Display template
echo $template;
