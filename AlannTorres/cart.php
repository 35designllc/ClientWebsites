<?php require("core/init.php") ?>

<?php
//Get Template & Assign Vars

//Create Products Object
$product = new Products();

$template = new Template("templates/cart.php");

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

$template->cart = $_SESSION['cart'];


//Display template
echo $template;
