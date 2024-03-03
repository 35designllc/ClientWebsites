<?php require("core/init.php") ?>

<?php
//Get Template & Assign Vars

//Create Products Object
$product = new Products();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

//Get Item Number From URL
$productNumber = isset($_POST['productNumber']) ? $_POST['productNumber'] : null;
$price = isset($_POST['price']) ? $_POST['price'] : null;
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
$removeNo = isset($_POST['removeNo']) ? $_POST['removeNo'] : null;

if(isset($productNumber) && isset($price) && isset($quantity)){
    if($quantity > 0){
        $selectedProduct = array("itemNo"=>$productNumber, "price"=>$price, "qty"=>$quantity);
        $product->add_to_cart($selectedProduct);
    }else{
        header('Location: '.'http://localhost/AllanTorres/item.php?itemNo='.$productNumber);
        die();
    }
}elseif(isset($removeNo)){
    $product->remove_from_cart($removeNo);
}

header('Location: '.'http://localhost/AllanTorres/cart.php');
die();
