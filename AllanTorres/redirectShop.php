<?php require("core/init.php") ?>

<?php

//Create Products Object
$product = new Products();

//Get ProductType From URL
$productType = isset($_GET['type']) ? $_GET['type'] : null;

//Get Search String from URL
$searchString = isset($_POST['search']) ? $_POST['search'] : null;

//Get max Item Count From URL
$maxItemCount = isset($_GET['count']) ? $_GET['count'] : 99;

//Get max Sale boolean From URL
$sale = isset($_GET['sale']) ? $_GET['sale'] : null;


if(!isset($_SESSION['search'])){
    $_SESSION['search'] = ""; 
}

$_SESSION['search'] = $searchString; 

if(!isset($_SESSION['shopTitle'])){
    $_SESSION['shopTitle'] = "Shop All";
}

if(!isset($_SESSION['shopProducts'])){
    $_SESSION['shopProducts'] = array();
}

if(!isset($_SESSION['shopType'])){
    $_SESSION['shopType'] = "All";
}

if(!isset($_SESSION['shopMaxItemCount'])){
    $_SESSION['shopMaxItemCount'] = $maxItemCount;
}

if(isset($maxItemCount)){
    $_SESSION['shopMaxItemCount'] = $maxItemCount;
}

echo $searchString;
echo "<br><br>";
echo $_SESSION['search'];
echo "<br><br>";
//Assign Product Type
if(isset($productType) and ($productType != "None")){
    if($productType != "Accessory-%" and $productType != "All" and $productType != "sale" and $productType != "Exclusive"){
    $_SESSION['shopTitle'] = 'Shop "'.$productType.'"';
    $_SESSION['shopProducts'] = $product->get_DB_Products($productType);
    $_SESSION['shopType'] = $productType;
    }elseif($productType == "Accessory-%"){
        $_SESSION['shopTitle'] = 'Shop Accessories"';
        $_SESSION['shopProducts'] = $product->get_DB_Products($productType);
        $_SESSION['shopType'] = $productType;
       // echo " Accessories TYPE";
    }elseif($productType == "All"){
        $_SESSION['shopTitle'] = 'Shop All';
        $_SESSION['shopProducts'] = $product->getAll_DB_Products();
        $_SESSION['shopType'] = $productType;
        //echo " ALL TYPE ";
    }
    elseif($productType == "sale"){
        $_SESSION['shopTitle'] = 'Shop Clearance';
        $_SESSION['shopProducts'] = $product->getAll_DB_Products_On_Sale();
        $_SESSION['shopType'] = 'None';
    }
    elseif($productType == "Exclusive"){
        $_SESSION['shopTitle'] = 'Shop Exclusive';
        $_SESSION['shopProducts'] = $product->getAll_DB_Products_Exclusive();
        $_SESSION['shopType'] = 'None';
    }
}
elseif(isset($searchString)){
    //echo "something searched   ";
    $_SESSION['shopProducts'] = $product->get_DB_ProductSearch($searchString);
    $_SESSION['shopTitle'] = 'Shop "'.$searchString.'"';
    $_SESSION['shopType'] = 'None';
}

elseif(!isset($searchString) && !isset($productType) and ($productType != "None")){
//echo " ALL TYPE2";
$_SESSION['shopTitle'] = 'Shop';
$_SESSION['shopProducts'] = $product->getAll_DB_Products();
$_SESSION['shopType'] = 'All';
}

if(isset($maxItemCount) and isset($productType) and ($productType != "None")){
    if($productType != "Accessory-%" and $productType != "All" and $productType != "sale" and $productType != "Exclusive"){
        $_SESSION['shopTitle'] = 'Shop "'.$productType.'"';
        $_SESSION['shopProducts'] = $product->get_DB_Products($productType);
        $_SESSION['shopType'] = $productType;
        }elseif($productType == "Accessory-%"){
            $_SESSION['shopTitle'] = 'Shop Accessories"';
            $_SESSION['shopProducts'] = $product->get_DB_Products($productType);
            $_SESSION['shopType'] = $productType;
            //echo " Accessories TYPE2";
        }elseif($productType == "All"){
            $_SESSION['shopTitle'] = 'Shop All';
            $_SESSION['shopProducts'] = $product->getAll_DB_Products();
            $_SESSION['shopType'] = $productType;
            //echo " ALL TYPE3 ";
        }
        elseif($productType == "sale"){
            $_SESSION['shopTitle'] = 'Shop Clearance';
            $_SESSION['shopProducts'] = $product->getAll_DB_Products_On_Sale();
            $_SESSION['shopType'] = 'None';
        }
        elseif($productType == "Exclusive"){
            $_SESSION['shopTitle'] = 'Shop Exclusive';
            $_SESSION['shopProducts'] = $product->getAll_DB_Products_Exclusive();
            $_SESSION['shopType'] = 'None';
        }
}elseif(isset($maxItemCount) and !isset($productType) and ($productType != "None")){
    //echo " using session var after search reload ";
    $_SESSION['shopProducts'] = $product->get_DB_ProductSearch($_SESSION['search']);
    $_SESSION['shopTitle'] = 'Shop "'.$_SESSION['search'].'"';
    $_SESSION['shopType'] = 'None';
    //echo " Accessories TYPE2";
}else{}

if(!isset($_SESSION['shopManufacturersFilter'])){
    $_SESSION['shopManufacturersFilter'] = array("American Classic", 
                                                "American Tactical Inc", 
                                                "ATN", 
                                                "Chiappa Firearms", 
                                                "Kriss USA", 
                                                "Auto-Ordnance - Thompson", 
                                                "B&T", 
                                                "Beretta", 
                                                "Bersa", 
                                                "Browning",
                                                "Buffalo Cartridge Company", 
                                                "Buffalo Cartridge Company", 
                                                "Burris Optics", 
                                                "Bushmaster",
                                                "Bushnell", 
                                                "Century Arms", 
                                                "Charles Daly", 
                                                "Christensen Arms", 
                                                "Crimson Trace", 
                                                "CVA", 
                                                "CZ-USA", 
                                                "Del-Ton", 
                                                "Diamondback Firearms", 
                                                "EAA Corp", 
                                                "Federal Ammunition", 
                                                "FN", 
                                                "Four Peaks", 
                                                "GLOCK", 
                                                "Heckler and Koch (HK USA)", 
                                                "Heritage Manufacturing", 
                                                "Hi-Point", 
                                                "HOWA",
                                                "Kahr Arms", 
                                                "Keystone Sporting Arms", 
                                                "Legacy Sports International", 
                                                "Leupold", 
                                                "LWRC", 
                                                "Magnum Research", 
                                                "Mossberg", 
                                                "North American Arms", 
                                                "POF USA", 
                                                "Remington", 
                                                "Riton Optics", 
                                                "Rock Island Armory", 
                                                "Rossi", 
                                                "Ruger", 
                                                "Savage Arms", 
                                                "SCCY Industries", 
                                                "Shadow Systems", 
                                                "Shadow Systems Defense", 
                                                "SIG SAUER", 
                                                "Smith and Wesson", 
                                                "Springfield Armory", 
                                                "SureFire",
                                                "Taurus",
                                                "Traditions",
                                                "Trijicon",
                                                "TriStar Sporting Arms",
                                                "UTAS",
                                                "Walther Arms",
                                                "Warne",
                                                "Weatherby",
                                                "Weaver",
                                                "Winchester");
}

if(!isset($_SESSION['shopFirearmTypeFilter'])){
    $_SESSION['shopFirearmTypeFilter'] = array("Revolver",
                                                "Rifle",
                                                "Semi-Auto Pistol",
                                                "Shotgun",
                                                "Accessory-Ammunition",
                                                "Accessory-Magazines",
                                                "Accessory-Scopes");
}

if(!isset($_SESSION['shopOpticTypeFilter'])){
    $_SESSION['shopOpticTypeFilter'] = array("Binoculars",
                                            "Lasers and Sights",
                                            "Range Finders",
                                            "Range Finding Bino",
                                            "Scopes",
                                            "Spotting Scopes");
}

if(!isset($_SESSION['shopCaliberGagesFilter'])){
    $_SESSION['shopCaliberGagesFilter'] = array(".45 Caliber",
                                                "9mm",
                                                "10mm",
                                                "12 Gauge",
                                                "17 HM2", 
                                                "17 HMR", 
                                                "20 Gauge", 
                                                "22 LR", 
                                                "22 LR | 22 Magnum", 
                                                "22 Magnum", 
                                                "22 TCM", 
                                                "223 Rem", 
                                                "223 Rem | 5.56 NATO", 
                                                "223 Wylde", 
                                                "243 Win", 
                                                "25-06", 
                                                "28 Gauge", 
                                                "28 Nosler", 
                                                "280 ACKLY", 
                                                "30 Super Carry", 
                                                "300 AAC Blackout", 
                                                "300 Norma Magnum", 
                                                "300 PRC", 
                                                "300 Rem Ultra Mag", 
                                                "300 Win Mag", 
                                                "300 WSM", 
                                                "30-06", 
                                                "308 Win", 
                                                "338 Lapua", 
                                                "350 Legend",
                                                "357 Magnum | 38 Special", 
                                                "38 Special", 
                                                "380 ACP", 
                                                "40 S&W", 
                                                "410 Bore", 
                                                "45 ACP", 
                                                "5.7 x 28mm", 
                                                "6.5 Creedmoor", 
                                                "6.5 Grendel", 
                                                "6.5 PRC", 
                                                "6.5 WBY RPM", 
                                                "6.5 x 284 Norma", 
                                                "6.8 Western", 
                                                "6mm ARC", 
                                                "6mm Creedmoor", 
                                                "7.62 x 39mm", 
                                                "7mm Rem Mag", 
                                                "7mm-08", 
                                                "9mm", 
                                                "9mm | 22 TCM9R");
}


header('Location: '.'http://localhost/AllanTorres/shop.php');
die();
