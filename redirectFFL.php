<?php require("core/init.php") ?>

<?php
//Create Products Object
$product = new Products();

//Get zipcode from post method
$zipcode = isset($_POST['zipcode']) ? $_POST['zipcode'] : null;

//Get the selected FFL from the post method
$fflId = isset($_POST['fflId']) ? $_POST['fflId'] : null;
$fflName = isset($_POST['fflName']) ? $_POST['fflName'] : null;
$fflStreet = isset($_POST['fflStreet']) ? $_POST['fflStreet'] : null;
$fflCity = isset($_POST['fflCity']) ? $_POST['fflCity'] : null;
$fflState = isset($_POST['fflState']) ? $_POST['fflState'] : null;
$fflZip = isset($_POST['fflZip']) ? $_POST['fflZip'] : null;
$fflCountry = isset($_POST['fflCountry']) ? $_POST['fflCountry'] : null;
$fflPhone = isset($_POST['fflPhone']) ? $_POST['fflPhone'] : null;

//Get locations based on zipcode
if(isset($zipcode)){

    $product->find_ffl($zipcode);

}

//Create the Selected FFL Session Array
if(isset($fflId) &&
   isset($fflName) &&
   isset($fflStreet) && 
   isset($fflCity) && 
   isset($fflState) && 
   isset($fflZip) && 
   isset($fflCountry) && 
   isset($fflPhone)){
   
        $_SESSION['fflSelected'] = array();
        array_push($_SESSION['fflSelected'],
                   $fflId,
                   $fflName,
                   $fflStreet,
                   $fflCity,
                   $fflState,
                   $fflZip,
                   $fflCountry,
                   $fflPhone);

        print_r($_SESSION['fflSelected']);
}else{
    $_SESSION['fflSelected'] = array();
    print_r($_SESSION['fflSelected']);
}

header('Location: '.'http://localhost/AllanTorres/checkout.php');
die();

