<?php require("core/init.php") ?>

<?php

//Create Products Object
$product = new Products();

//Get Template & Assign Vars
$template = new Template("templates/shop.php");

$template->title = $_SESSION['shopTitle'];
$template->products = $_SESSION['shopProducts'];
$template->type = $_SESSION['shopType'];
$template->search = $_SESSION['search'];

$template->maxItemCount = $_SESSION['shopMaxItemCount'];
$template->currentCount = 0;

$template->manufacturers = $_SESSION['shopManufacturersFilter'];
$template->firearmTypes = $_SESSION['shopFirearmTypeFilter'];
$template->opticTypes = $_SESSION['shopOpticTypeFilter'];
$template->caliberGages = $_SESSION['shopCaliberGagesFilter'];

//Display template
echo $template;