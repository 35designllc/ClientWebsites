<?php require("core/init.php") ?>

<?php
//Create Products Object
$product = new Products();

//Get Item Number From URL
$productNumber = isset($_GET['itemNo']) ? $_GET['itemNo'] : null;

//Get Template & Assign Vars
$template = new Template("templates/item.php");

//Assign Product Type
if(isset($productNumber)){ 
$validatedItem = $product->validate_Lipseys_Product($productNumber);
if($validatedItem != False){

    $template->qty = $validatedItem['data']['qty'];
    $template->price = $validatedItem['data']['price'];    
}else{
    $template->qty = NULL;
    $template->price = NULL;
}

$template->item = $product->get_DB_Product($productNumber);

$related = $template->item[0]->MANUFACTURER;

//Get Related Items
$template->Related = $product->get_DB_ProductsManufacturer($related);

}
else{
    header('Location: '.'http://localhost/AllanTorres/index.php');
    die();
}

//Display template
echo $template;
