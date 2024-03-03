<?php require("core/init.php")?>

<?php

//Create Products Object
$product = new Products();

$FSD = isset($_POST['FirearmShippingData']) ? $_POST['FirearmShippingData'] : null;
#if($FSD){
#    $data = json_decode($FSD);
#
#    foreach($data as $key => $value){
#        echo $key.': '.$value. '<br>';
#    }
#
#    echo "<br>";
#}

$ASD = isset($_POST['AccessoryShippingData']) ? $_POST['AccessoryShippingData'] : null;
#if($ASD){
#    $data = json_decode($ASD);
#
#    foreach($data as $key => $value){
#        echo $key.': '.$value. '<br>';
#    }
#
#    echo "<br>";
#}

$NDSD = isset($_POST['NonDropshipShippingData']) ? $_POST['NonDropshipShippingData'] : null;
#if($NDSD){
#    $data = json_decode($NDSD);
#
#    foreach($data as $key => $value){
#        echo $key.': '.$value. '<br>';
#    }
#
#    echo "<br>";
#}

$BD = isset($_POST['BillingData']) ? $_POST['BillingData'] : null;
#if($BD){
#    $data = json_decode($BD);
#
#    foreach($data as $key => $value){
#        echo $key.': '.$value. '<br>';
#    }
#
#    echo "<br>";
#}

$CCD = isset($_POST['CreditCardData']) ? $_POST['CreditCardData'] : null;
#if($CCD){
#    $data = json_decode($CCD);
#
#    foreach($data as $key => $value){
#        echo $key.': '.$value. '<br>';
#    }
#
#    echo "<br>";
#}

$FA_result = NULL;
$ACC_result = NULL;
$ND_result = NULL;

if(isset($BD) && isset($CCD)){

    if(isset($FSD)){
        $firearmShippingData = json_decode($FSD, true);
        $firearmShippingData['Type'] ="FSD";

        $billingData = json_decode($BD, true);
        $creditCardData = json_decode($CCD, true);

        $FA_result = $product->process($billingData, $firearmShippingData, $creditCardData, $_SESSION['cart']);
    
        if($FA_result === true){
            $product->lipseysOrder($firearmShippingData, $billingData, "firearms");
            $product->remove_type_from_cart("firearms");
        }
    }

    if(isset($ASD)){
        $accessoryShippingData = json_decode($ASD, true);
        $accessoryShippingData['Type'] ="ASD";

        $billingData = json_decode($BD, true);
        $creditCardData = json_decode($CCD, true);

        $ACC_result = $product->process($billingData, $accessoryShippingData, $creditCardData, $_SESSION['cart']);
       
        if($ACC_result === true){
            $product->lipseysOrder($accessoryShippingData, $billingData, "accessories");
            $product->remove_type_from_cart("accessories");
        }
    }
    

    if(isset($NDSD)){
        $nonDropshipShippingData = json_decode($NDSD, true);
        $nonDropshipShippingData['Type'] ="NDSD";

        $billingData = json_decode($BD, true);
        $creditCardData = json_decode($CCD, true);

        $ND_result = $product->process($billingData, $nonDropshipShippingData, $creditCardData, $_SESSION['cart']);
        
        if($ND_result === true){
            $product->lipseysOrder($nonDropshipShippingData, $billingData, "nonDropShip");
            $product->remove_type_from_cart("nonDropShip");
        }
    
    }

}


echo "<br><br> Firearm: ".$FA_result."<br><br>";
echo 'Accessory: '.$ACC_result."<br><br>";
echo 'NonDropship: '.$ND_result."<br><br>";


if($FA_result === NULL && $ACC_result === NULL && $ND_result === NULL){
    echo 'here1 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/checkout.php');
    die();
}
elseif($FA_result === true && $ACC_result === NULL && $ND_result === NULL){
    echo 'here2 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=1');
    die();
}
elseif($FA_result === NULL && $ACC_result === true && $ND_result === NULL){
    echo 'here3 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=1');
    die();
}
elseif($FA_result === NULL && $ACC_result === NULL && $ND_result === true){
    echo 'here4 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=1');
    die();
}
elseif($FA_result === true && $ACC_result === true && $ND_result === NULL){
    echo 'here5 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=1');
    die();
}
elseif($FA_result === NULL && $ACC_result === true && $ND_result === true){
    echo 'here6 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=1');
    die();
}
elseif($FA_result === true && $ACC_result === NULL && $ND_result === true){
    echo 'here7 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=1');
    die();
}
elseif($FA_result === true && $ACC_result === true && $ND_result === NULL){
    echo 'here8 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=1');
    die();
}
elseif($FA_result === NULL && $ACC_result === true && $ND_result === true){
    echo 'here9 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=1');
    die();
}
elseif($FA_result === true && $ACC_result === true && $ND_result === true){
    echo 'here10 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=1');
    die();
}
elseif($FA_result === 2 && $ACC_result === NULL && $ND_result === NULL){
    echo 'here11 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=2');
    die();
}
elseif($FA_result === NULL && $ACC_result === 2 && $ND_result === NULL){
    echo 'here12 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=2');
    die();
}
elseif($FA_result === NULL && $ACC_result === NULL && $ND_result === 2){
    echo 'here13 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=2');
    die();
}
elseif($FA_result === 2 && $ACC_result === 2 && $ND_result === NULL){
    echo 'here14 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=2');
    die();
}
elseif($FA_result === NULL && $ACC_result === 2 && $ND_result === 2){
    echo 'here15 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=2');
    die();
}
elseif($FA_result === 2 && $ACC_result === NULL && $ND_result === 2){
    echo 'here16 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=2');
    die();
}
elseif($FA_result === 2 && $ACC_result === 2 && $ND_result === NULL){
    echo 'here17 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=2');
    die();
}
elseif($FA_result === NULL && $ACC_result === 2 && $ND_result === 2){
    echo 'here18 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=2');
    die();
}
elseif($FA_result === 2 && $ACC_result === 2 && $ND_result === 2){
    echo 'here19 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=2');
    die();
}
elseif($FA_result === 3 && $ACC_result === NULL && $ND_result === NULL){
    echo 'here20 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=3');
    die();
}
elseif($FA_result === NULL && $ACC_result === 3 && $ND_result === NULL){
    echo 'here21 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=3');
    die();
}
elseif($FA_result === NULL && $ACC_result === NULL && $ND_result === 3){
    echo 'here22 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=3');
    die();
}
elseif($FA_result === 3 && $ACC_result === 3 && $ND_result === NULL){
    echo 'here23 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=3');
    die();
}
elseif($FA_result === NULL && $ACC_result === 3 && $ND_result === 3){
    echo 'here24 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=3');
    die();
}
elseif($FA_result === 3 && $ACC_result === NULL && $ND_result === 3){
    echo 'here25 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=3');
    die();
}
elseif($FA_result === 3 && $ACC_result === 3 && $ND_result === NULL){
    echo 'here26 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=3');
    die();
}
elseif($FA_result === NULL && $ACC_result === 3 && $ND_result === 3){
    echo 'here27 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=3');
    die();
}
elseif($FA_result === 3 && $ACC_result === 3 && $ND_result === 3){
    echo 'here28 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=3');
    die();
}else{
    echo 'here29 <br><br>';
    header('Location: '.'http://localhost/AllanTorres/result.php?success=0');
    die();
}
