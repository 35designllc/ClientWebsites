<?php require("core/init.php") ?>

<?php
//Create Products Object
$product = new Products();

//Get ProductType From URL
$productType = isset($_GET['type']) ? $_GET['type'] : null;

//Get Search String from URL
$searchString = isset($_POST['search']) ? $_POST['search'] : null;

//Get max Item Count From URL
$maxItemCount = isset($_GET['count']) ? $_GET['count'] : null;

//Get Template & Assign Vars
$template = new Template("templates/shop.php");

if(isset($searchString)){
    $_SESSION['search'] = $searchString; 
}

if(isset($maxItemCount)){
    $template->maxItemCount = $maxItemCount;
}else{
    $template->maxItemCount = 99;
}

$template->currentCount = 0;

//Assign Product Type
if(isset($productType)){
    if($productType != "Accessory-%" and $productType != "All"){
    $template->title = 'Shop "'.$productType.'"';
    $template->products = $product->get_DB_Products($productType);
    $template->type = $productType;
    }elseif($productType == "Accessory-%"){
        $template->title = 'Shop Accessories"';
        $template->products = $product->get_DB_Products($productType);
        $template->type = $productType;
       // echo " Accessories TYPE";
    }elseif($productType == "All"){
        $template->title = 'Shop All';
        $template->products = $product->getAll_DB_Products();
        $template->type = $productType;
        //echo " ALL TYPE ";
    }
}

elseif(isset($searchString)){
    //echo "something searched   ";
    $template->products = $product->get_DB_ProductSearch($searchString);
    $template->title = 'Shop "'.$searchString.'"';
    $template->type = 'None';
}

elseif(!isset($searchString) && !isset($productType)){
//echo " ALL TYPE2";
$template->title = 'Shop';
$template->products = $product->getAll_DB_Products();
$template->type = 'All';
}

if(isset($maxItemCount) and isset($productType)){
    if($productType != "Accessory-%" and $productType != "All"){
        $template->title = 'Shop "'.$productType.'"';
        $template->products = $product->get_DB_Products($productType);
        $template->type = $productType;
        }elseif($productType == "Accessory-%"){
            $template->title = 'Shop Accessories"';
            $template->products = $product->get_DB_Products($productType);
            $template->type = $productType;
            //echo " Accessories TYPE2";
        }elseif($productType == "All"){
            $template->title = 'Shop All';
            $template->products = $product->getAll_DB_Products();
            $template->type = $productType;
            //echo " ALL TYPE3 ";
        }
}elseif(isset($maxItemCount) and !isset($productType)){
    //echo " using session var after search reload ";
    $template->products = $product->get_DB_ProductSearch($_SESSION['search']);
    $template->title = 'Shop "'.$_SESSION['search'].'"';
    $template->type = 'None';
    //echo " Accessories TYPE2";
}else{}

$template->manufacturers = array("American Classic", 
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
                                
$template->firearmTypes = array("Revolver",
                                "Rifle",
                                "Semi-Auto Pistol",
                                "Shotgun",
                                "Accessory-Ammunition",
                                "Accessory-Magazines",
                                "Accessory-Scopes");

$template->opticTypes = array("Binoculars",
                              "Lasers and Sights",
                              "Range Finders",
                              "Range Finding Bino",
                              "Scopes",
                              "Spotting Scopes");

$template->caliberGages = array(".45 Caliber",
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

//Display template
echo $template;
