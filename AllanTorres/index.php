<?php require("core/init.php") ?>

<?php

//Create Products Object
$product = new Products();

//Get Template & Assign Vars
$template = new Template("templates/frontpage.php");

$template->products = $product->getAll_DB_Products();
$template->exclusiveProducts = $product->getAll_DB_Products_Exclusive();

//Display template
echo $template;

