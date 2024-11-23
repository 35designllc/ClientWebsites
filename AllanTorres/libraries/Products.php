<?php 

//Includes
use vendor_lipseys\lipseys\apiintegration\src\LipseysClient;

require('AuthnetAIM.class.php');

class Products{

    //Initialize DB variable
    private $db;

    //Initialize lipseysApi_DS varible
    private $lipseysApi_DS;

    //Initialize lipseysApi_NDS varible
    private $lipseysApi_NDS;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->db = new Database;
        $this->lipseysApi_DS = new LipseysClient(LAPI_USER_DS, LAPI_PASS_DS);
        $this->lipseysApi_NDS = new LipseysClient(LAPI_USER_NDS, LAPI_PASS_NDS);
        $this->payment = new AuthnetAIM(true);


        
    }

    /**
     * Get all Products From DB
    */
    public function getAll_DB_Products(){
        $this->db->query("SELECT * FROM lipseycatalog");

        //Assign Result Set
        $results = $this->db->resultset();

        return $results;
    }

    /**
     * Get all Products From DB
    */
    public function getAll_DB_Products_On_Sale(){
        $this->db->query("SELECT * FROM lipseycatalog WHERE ONSALE = :onsale");
        $this->db->bind(':onsale', "TRUE");
        //Assign Result Set
        $results = $this->db->resultset();

        return $results;
    }


    /**
     * Get all Products From DB
    */
    public function getAll_DB_Products_Exclusive(){
        $this->db->query("SELECT * FROM lipseycatalog WHERE EXCLUSIVE = :exclusive");
        $this->db->bind(':exclusive', "TRUE");
        //Assign Result Set
        $results = $this->db->resultset();

        return $results;
    }

    /**
     * Get all Products From lipseysApi_DS
    */
    public function getAll_API_Products(){
        $catalog = $this->lipseysApi_DS->Catalog();
        return $catalog;
    }

    /**
     * Get all Products From DB Based on Type
    */
    public function get_DB_Products($productType){
        
        $this->db->query("SELECT * FROM lipseycatalog WHERE TYPE LIKE :productType");
        $this->db->bind(':productType', $productType);

        //Assign Result Set
        $results = $this->db->resultset();

        return $results;
    }

    /**
     * Get all Products From DB Based on MANUFACTURER
    */
    public function get_DB_ProductsManufacturer($productM){
        
        $this->db->query("SELECT * FROM lipseycatalog WHERE MANUFACTURER LIKE :productM AND TYPE Like 'Accessory-%'");
        $this->db->bind(':productM', $productM);

        //Assign Result Set
        $results = $this->db->resultset();

        return $results;
    }

    /**
     * Get all Products From DB ralated to the selected item
    */
    public function get_DB_ProductsRelated($product){

        $this->db->query("SELECT * FROM lipseycatalog WHERE 
                          MATCH(`ITEMNO`,`DESCRIPTION1`,`DESCRIPTION2`,`MODEL`,`CALIBERGAUGE`,`MANUFACTURER`,`TYPE`,
                         `ACTION`,`FINISH`,`SIGHTS`,`STOCKFRAMEGRIPS`,`MAGAZINE`,`ITEMTYPE`,`ADDITIONALFEATURE1`,
                         `ADDITIONALFEATURE2`,`ADDITIONALFEATURE3`,`FAMILY`,`ITEMGROUP`) AGAINST(:product1)
                         AND
                         MATCH(`ITEMNO`,`DESCRIPTION1`,`DESCRIPTION2`,`MODEL`,`CALIBERGAUGE`,`MANUFACTURER`,`TYPE`,
                         `ACTION`,`FINISH`,`SIGHTS`,`STOCKFRAMEGRIPS`,`MAGAZINE`,`ITEMTYPE`,`ADDITIONALFEATURE1`,
                         `ADDITIONALFEATURE2`,`ADDITIONALFEATURE3`,`FAMILY`,`ITEMGROUP`) AGAINST(:product2)
                         ");
        
        $manfacturer = str_replace('&', "and", $product->MANUFACTURER);

        $this->db->bind(':product1', $manfacturer);

        //print_r($product);

        if($product->CALIBERGAUGE != ""){
            $this->db->bind(':product2', $product->CALIBERGAUGE);
        }else{
            $this->db->bind(':product2', $product->DESCRIPTION1);
        }

        
        

        //Assign Result Set
        $results = $this->db->resultset();

        return $results;
    }


    /**
     * Get all Products From DB Based on Search
    */
    public function get_DB_ProductSearch($searchString){
       $searchPattern = "";
       $searchString = str_replace('"', "''", $searchString);
       $searchString = str_replace('^', "\\^", $searchString);
       $searchString = str_replace('$', "\\$", $searchString);
       $searchString = str_replace('.', "\\.", $searchString);
       $searchString = str_replace('[', "\\[", $searchString);
       $searchString = str_replace(']', "\\]", $searchString);
       $searchString = str_replace('|', "\\|", $searchString);
       $searchString = str_replace('*', "\\*", $searchString);
       $searchString = str_replace('+', "\\+", $searchString);
       $searchString = str_replace('{', "\\{", $searchString);
       $searchString = str_replace('}', "\\}", $searchString);
       $searchString = str_replace('&', "and", $searchString);

       $this->db->query("SELECT * FROM lipseycatalog WHERE ITEMNO LIKE :searchString");

       $this->db->bind(':searchString', $searchString);

       //Assign Result Set
       $ItemNoResults = $this->db->resultset();

       $this->db->query("SELECT * FROM lipseycatalog WHERE MANUFACTURER LIKE :searchString");

       $this->db->bind(':searchString', $searchString);

       //Assign Result Set
       $ManufResults = $this->db->resultset();

       $this->db->query("SELECT * FROM lipseycatalog WHERE TYPE LIKE :searchString");

       $this->db->bind(':searchString', $searchString);

       //Assign Result Set
       $TypeResults = $this->db->resultset();

       if (count($ItemNoResults) > 0)
       {
        return $ItemNoResults;
       }
       elseif (count($ManufResults) > 0)
       {
        return $ManufResults;
       }
       elseif (count($TypeResults) > 0)
       {
        return $TypeResults;
       }
       else{

       $searchString = explode(" ", $searchString);

       $searchQuery = "SELECT * FROM lipseycatalog WHERE ";

       for ($i = 0; $i < count($searchString); $i++) {

            if ($i > 0 && $i < count($searchString) ) {
              $searchQuery .= " AND ";
            }

            $searchQuery.=
            "MATCH(`ITEMNO`,`DESCRIPTION1`,`DESCRIPTION2`,`MODEL`,`CALIBERGAUGE`,`MANUFACTURER`,`TYPE`,
                    `ACTION`,`FINISH`,`SIGHTS`,`STOCKFRAMEGRIPS`,`MAGAZINE`,`ITEMTYPE`,`ADDITIONALFEATURE1`,
                    `ADDITIONALFEATURE2`,`ADDITIONALFEATURE3`,`FAMILY`,`ITEMGROUP`) AGAINST(".":SEARCH_WORD_".$i.")";

        
       }

       print_r(strval($searchQuery));

       $this->db->query($searchQuery);

       for ($i = 0; $i < count($searchString); $i++) {

        $this->db->bind(':SEARCH_WORD_'.$i, $searchString[$i]);

       }

       $results = $this->db->resultset();

       return $results;

       

       #$searchString = explode(" ", $searchString);      
       #for ($i = 0; $i < count($searchString); $i++) {
       #    if ($i > 0 && $i < count($searchString) ) {
       #       $searchPattern .= "|";
       #    }
       #    $searchPattern .= $searchString[$i];  
       # }    

       #$this->db->query("SELECT * FROM lipseycatalog WHERE 
       #CONCAT(
       # ITEMNO, '',
       # DESCRIPTION1, '',
       # DESCRIPTION2, '',
       # UPC, '',
       # MANUFACTURERMODELNO, '',
       # MSRP, '',
       # MODEL, '',
       # CALIBERGAUGE, '',
       # MANUFACTURER, '',
       # TYPE, '',
       # ACTION, '',
       # SAFETY, '',
       # SIGHTS, '',
       # MAGAZINE, '',
       # CHAMBER, '',
       # ITEMTYPE, '',
       # ONSALE, '',
       # FAMILY, '',
       # COUNTRYOFORIGIN, '',
       # ITEMGROUP, '') 
       # REGEXP :searchPattern");

       #$this->db->bind(':searchPattern', $searchPattern);

       #//Assign Result Set
       #$results = $this->db->resultset();

       #return $results;
       }       
    }
    
    /**
     * Get One Product From DB Based on Item Numbers
    */
    public function get_DB_Product($productNumber){
        
        $this->db->query("SELECT * FROM lipseycatalog WHERE ITEMNO = :productNumber");
        $this->db->bind(':productNumber', $productNumber);

        //Assign Result Set
        $results = $this->db->resultset();

        return $results;
    }


    /**
     * Check If Product is available on Lipseys
     */
    public function validate_Lipseys_Product($productNumber){

        $result = $this->lipseysApi_DS->ValidateItem($productNumber);

        if ($result['data'] != NULL){
            if ($result['data']['qty'] > 0){
                return $result;
            }
            else {
                return False;
            }
        }
        else {
            return False;
        }

    }


    /**
     * Add product to cart
     */

     public function add_to_cart(&$productArray){
        $productNumber = $productArray['itemNo'];
        $price = intval($productArray['price']);
        $quantity = intval($productArray['qty']);

        $product = $this->get_DB_Product($productNumber);

        $imgName = substr($product[0]->IMAGENAME, 0, strpos($product[0]->IMAGENAME, '.')) . ".webp"; 
        $itemName = $product[0]->DESCRIPTION1;
        $itemType = $product[0]->TYPE;
        $manfacturer = $product[0]->MANUFACTURER;
        $subTotal = $price * $quantity;

        $cartItem = array('itemNo'=>$productNumber, 'itemType'=>$itemType, 'manfacturer'=>$manfacturer, 'price'=>$price, 'qty'=>$quantity, 'imgName'=>$imgName, 'itemName'=>$itemName, 'subTotal'=>$subTotal);

        array_push($_SESSION['cart'], $cartItem);

        #print_r($_SESSION['cart']);
     }  


    /**
     * Remove product from cart
    */

    public function remove_from_cart($productNo){
    $key = 0;
    foreach($_SESSION['cart'] as $product){
        if ($productNo == $product['itemNo']){
            unset($_SESSION['cart'][$key]);
        }
        $key+=1;
    }
    #reindex array
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    /**
     * Clear types of products from cart
    */

    public function remove_type_from_cart($productType){

        $key = 0;
        foreach($_SESSION['cart'] as $product){

            #echo $productType."<br>";
            #echo $product['itemType']."<br>";
            #echo $product['manfacturer']."<br>";

            if(($productType == "nonDropShip") && 
               (("Revolver" == $product['itemType']) || 
                ("Rifle" == $product['itemType']) || 
                ("Semi-Auto Pistol" == $product['itemType']) ||
                ("Shotgun" == $product['itemType'])) &&
                (($product['manfacturer'] == "FN") || 
                ($product['manfacturer'] == "Franklin Armory") ||
                ($product['manfacturer'] == "Gemtech") ||
                ($product['manfacturer'] == "GLOCK") ||
                ($product['manfacturer'] == "Heckler and Koch (HK USA)") ||
                ($product['manfacturer'] == "IWI - Israel Weapon Industries") ||
                ($product['manfacturer'] == "Marlin") ||
                ($product['manfacturer'] == "Q") ||
                ($product['manfacturer'] == "Ruger") ||
                ($product['manfacturer'] == "Smith and Wesson") ||
                ($product['manfacturer'] == "Springfield Armory") ||
                ($product['manfacturer'] == "Walther Arms") ||
                ($product['manfacturer'] == "Winchester"))){
                    unset($_SESSION['cart'][$key]);

            }elseif(($productType == "firearms") &&
                ($product['itemType'] == 'Revolver' ||
                $product['itemType']  == 'Rifle' ||
                $product['itemType']  == 'Semi-Auto Pistol' || 
                $product['itemType']  == 'Shotgun')){
                    unset($_SESSION['cart'][$key]);

            }elseif(($productType == "nonDropShip") &&
                (preg_match("/Accessory-.*/", $product['itemType'])) && 
                ($product['manfacturer'] == "AAC (Advanced Armament)") || 
                ($product['manfacturer'] == "Gemtech") ||
                ($product['manfacturer'] == "GLOCK") ||
                ($product['manfacturer'] == "IWI - Israel Weapon Industries") ||
                ($product['manfacturer'] == "Q") ||
                ($product['manfacturer'] == "Trijicon") ||
                ($product['manfacturer'] == "SIG SAUER") ||
                ($product['manfacturer'] == "Winchester")){
                unset($_SESSION['cart'][$key]);
                
            }elseif(($productType == "accessories") &&
                preg_match("/Accessory-.*/", $product['itemType'])){
                unset($_SESSION['cart'][$key]);
            }else{
                continue;
            }
            $key+=1;
        }

        #reindex array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }


    /**
     * Add product Type to product Type Array
     */

     public function add_product_to_productArray($productType){

        $key = 0;

        $firearmArray = array();
        $accessoryArray = array();
        $nonDropshipArray = array();
        
        foreach($_SESSION['cart'] as $product){

            #echo $productType."<br>";
            #echo $product['itemType']."<br>";
            #echo $product['manfacturer']."<br>";

            if(($productType == "nonDropShip") && 
               (("Revolver" == $product['itemType']) || 
                ("Rifle" == $product['itemType']) || 
                ("Semi-Auto Pistol" == $product['itemType']) ||
                ("Shotgun" == $product['itemType'])) &&
                (($product['manfacturer'] == "FN") || 
                ($product['manfacturer'] == "Franklin Armory") ||
                ($product['manfacturer'] == "Gemtech") ||
                ($product['manfacturer'] == "GLOCK") ||
                ($product['manfacturer'] == "Heckler and Koch (HK USA)") ||
                ($product['manfacturer'] == "IWI - Israel Weapon Industries") ||
                ($product['manfacturer'] == "Marlin") ||
                ($product['manfacturer'] == "Q") ||
                ($product['manfacturer'] == "Ruger") ||
                ($product['manfacturer'] == "Smith and Wesson") ||
                ($product['manfacturer'] == "Springfield Armory") ||
                ($product['manfacturer'] == "Walther Arms") ||
                ($product['manfacturer'] == "Winchester"))){
                    $productArray = array();
                    $productArray['ItemNo'] = $product['itemNo'];
                    $productArray['Quantity'] = $product['qty'];
                    $productArray['Note'] = "N/A";
                    array_push($nonDropshipArray, $productArray);

            }elseif(($productType == "firearms") &&
                ($product['itemType'] == 'Revolver' ||
                $product['itemType']  == 'Rifle' ||
                $product['itemType']  == 'Semi-Auto Pistol' || 
                $product['itemType']  == 'Shotgun')){
                    $productArray = array();
                    $productArray['ItemNo'] = $product['itemNo'];
                    $productArray['Quantity'] = $product['qty'];
                    $productArray['Note'] = "N/A";
                    array_push($firearmArray, $productArray);

            }elseif(($productType == "nonDropShip") &&
                (preg_match("/Accessory-.*/", $product['itemType'])) && 
                ($product['manfacturer'] == "AAC (Advanced Armament)") || 
                ($product['manfacturer'] == "Gemtech") ||
                ($product['manfacturer'] == "GLOCK") ||
                ($product['manfacturer'] == "IWI - Israel Weapon Industries") ||
                ($product['manfacturer'] == "Q") ||
                ($product['manfacturer'] == "Trijicon") ||
                ($product['manfacturer'] == "SIG SAUER") ||
                ($product['manfacturer'] == "Winchester")){
                    $productArray = array();
                    $productArray['ItemNo'] = $product['itemNo'];
                    $productArray['Quantity'] = $product['qty'];
                    $productArray['Note'] = "N/A";
                    array_push($nonDropshipArray, $productArray);
                
            }elseif(($productType == "accessories") &&
                preg_match("/Accessory-.*/", $product['itemType'])){
                    $productArray = array();
                    $productArray['ItemNo'] = $product['itemNo'];
                    $productArray['Quantity'] = $product['qty'];
                    $productArray['Note'] = "N/A";
                    array_push($accessoryArray, $productArray);
            }else{
                continue;
            }
            $key+=1;
        }

        if($productType == "firearms"){
            return $firearmArray;
        }
        elseif($productType == "accessories"){
            return $accessoryArray;
        }
        elseif($productType == "nonDropShip"){
            return $nonDropshipArray;
        }

    }

     
    /**
     * Clear data from cart
    */
    public function clear_cart(){
        $_SESSION['cart'] = array();
    }


    /**
     * Check cart content
     */
    public function checkCartContent(){
        $result = array();
        $firearm = False;
        $accessory = False;
        $accesssoryNDS = False;
        $firearmNDS = False;

        $subtotals = array();
        $firearmSubTotal = 0;
        $accessorySubTotal = 0;
        $NDSSubTotal = 0;

        if(!isset($_SESSION['SubTotals'])){
            $_SESSION['SubTotals'] = array();

        }

        if(!isset($_SESSION['FirearmAccessory'])){
            $_SESSION['FirearmAccessory'] = array();

        }

        foreach($_SESSION['cart'] as $product){
            #echo ($product['itemType']."<br><br>");
            if((("Revolver" == $product['itemType']) || 
                ("Rifle" == $product['itemType']) || 
                ("Semi-Auto Pistol" == $product['itemType']) ||
                ("Shotgun" == $product['itemType'])) &&
                (($product['manfacturer'] == "FN") || 
                ($product['manfacturer'] == "Franklin Armory") ||
                ($product['manfacturer'] == "Gemtech") ||
                ($product['manfacturer'] == "GLOCK") ||
                ($product['manfacturer'] == "Heckler and Koch (HK USA)") ||
                ($product['manfacturer'] == "IWI - Israel Weapon Industries") ||
                ($product['manfacturer'] == "Marlin") ||
                ($product['manfacturer'] == "Q") ||
                ($product['manfacturer'] == "Ruger") ||
                ($product['manfacturer'] == "Smith and Wesson") ||
                ($product['manfacturer'] == "Springfield Armory") ||
                ($product['manfacturer'] == "Walther Arms") ||
                ($product['manfacturer'] == "Winchester"))){
                $firearmNDS = True;
                $NDSSubTotal += $product['price'];

            }elseif(($product['itemType'] == 'Revolver' ||
                $product['itemType']  == 'Rifle' ||
                $product['itemType']  == 'Semi-Auto Pistol' || 
                $product['itemType']  == 'Shotgun')){
                    $firearm = True;
                    $firearmSubTotal += $product['price'];

            }elseif((preg_match("/Accessory-.*/", $product['itemType'])) && 
            ($product['manfacturer'] == "AAC (Advanced Armament)") || 
            ($product['manfacturer'] == "Gemtech") ||
            ($product['manfacturer'] == "GLOCK") ||
            ($product['manfacturer'] == "IWI - Israel Weapon Industries") ||
            ($product['manfacturer'] == "Q") ||
            ($product['manfacturer'] == "Trijicon") ||
            ($product['manfacturer'] == "SIG SAUER") ||
            ($product['manfacturer'] == "Winchester")){
                $accesssoryNDS = True;
                $NDSSubTotal += $product['price'];
                
            }elseif(preg_match("/Accessory-.*/", $product['itemType'])){
                $accessory = True;
                $accessorySubTotal += $product['price'];
            }else{
                continue;
            }
        }

        array_push($result, $firearm);
        array_push($result, $accessory);
        array_push($result, $accesssoryNDS);
        array_push($result, $firearmNDS);

        array_push($subtotals, $firearmSubTotal);
        array_push($subtotals, $accessorySubTotal);
        array_push($subtotals, $NDSSubTotal);

        $_SESSION['SubTotals'] = $subtotals;

        $_SESSION['FirearmAccessory'] = $result;

    }


    /**
     * Search FFL loaction based on zipcode
     */
    public function find_ffl($zipcode){
        $this->db->query("SELECT * FROM ffls WHERE PREMISE_ZIP_CODE = :zipcode");
        $this->db->bind(':zipcode', $zipcode);

        //Assign Result Set
        $results = $this->db->resultset();

        if(count($results) === 0){
            $_SESSION['fflCount'] = 0;
        }else{
            $_SESSION['fflCount'] = count($results);
            $_SESSION['ffls'] = array();
            $_SESSION['ffls'] = $results;
        }

        #print_r( $_SESSION['ffls']);

    }


    /**
     * Authorize.net Payment Processing function
     * Connects to Authorize.net using the AuthnetAIM.class.php.
     */
    public function process(&$billingDetails, &$shippingDetails, &$paymentDetails){
        print_r($billingDetails);
        echo "<br><br>";
        print_r($shippingDetails);
        echo "<br><br>";
        print_r($paymentDetails);
        echo "<br><br>";
        $user_id = 1;
        $email   = $billingDetails['B_Email'];
        $product_description = 'A test transaction';
        $billing_firstname = $billingDetails['B_FName'];
        $billing_lastname  = $billingDetails['B_LName'];
        #$billing_company = '';
        $billing_address   = $billingDetails['B_Street'].", ".$billingDetails['B_Apt'];
        $billing_city      = $billingDetails['B_City'];
        $billing_state     = $billingDetails['B_State'];
        $billing_zipcode   = $billingDetails['B_Zip'];
        $billing_country   = $billingDetails['B_Country'];
        $billing_telephone = $billingDetails['B_Phone'];

        $total = 0;

        if($shippingDetails['Type'] == "FSD"){
            #$shipping_firstname = '';
            #$shipping_lastname  = '';
            $shipping_company  = $shippingDetails['FAS_name'];
            $shipping_address   = $shippingDetails['FAS_address2'];
            $shipping_city      = $shippingDetails['FAS_city'];
            $shipping_state     = $shippingDetails['FAS_state'];
            $shipping_zipcode   = $shippingDetails['FAS_zip'];
            $shipping_country   = $shippingDetails['FAS_country'];
            echo $_SESSION['SubTotals'][0]."<br><br>";
            $total = $_SESSION['SubTotals'][0];
        }

        if($shippingDetails['Type'] == "ASD"){
            $shipping_firstname = $shippingDetails['AS_FName'];
            $shipping_lastname  = $shippingDetails['AS_LName'];;
            #$shipping_company  = $shippingDetails['FAS_name'];
            $shipping_address   = $shippingDetails['AS_Street'].", ".$shippingDetails['AS_Apt'];
            $shipping_city      = $shippingDetails['AS_City'];
            $shipping_state     = $shippingDetails['AS_State'];
            $shipping_zipcode   = $shippingDetails['AS_Zip'];
            $shipping_country   = $shippingDetails['AS_Country'];
            echo $_SESSION['SubTotals'][1]."<br><br>";
            $total = $_SESSION['SubTotals'][1];
        }

        if($shippingDetails['Type'] == "NDSD"){
            #$shipping_firstname = '';
            #$shipping_lastname  = '';
            $shipping_company  = $shippingDetails['OWNER_Name'];
            $shipping_address   = $shippingDetails['OWNER_Address1'];
            $shipping_city      = $shippingDetails['OWNER_City'];
            $shipping_state     = $shippingDetails['OWNER_State'];
            $shipping_zipcode   = $shippingDetails['OWNER_Zip'];
            $shipping_country   = $shippingDetails['OWNER_Country'];
            echo $_SESSION['SubTotals'][2]."<br><br>";
            $total = $_SESSION['SubTotals'][2];
        }

        $creditcard = $paymentDetails['CC_Number'];
        $expiration = $paymentDetails['CC_Eexpiration'];
        $cvv        = $paymentDetails['CC_CVV'];

        $invoice    = substr(time(), 0, 6);
        $tax        = 0.00;

        $this->payment->setTransaction($creditcard, $expiration, $total, $cvv, $invoice, $tax);
        $this->payment->setParameter("x_duplicate_window", 180);
        $this->payment->setParameter("x_cust_id", $user_id);
        $this->payment->setParameter("x_customer_ip", $_SERVER['REMOTE_ADDR']);
        $this->payment->setParameter("x_email", $email);
        $this->payment->setParameter("x_email_customer", FALSE);
        $this->payment->setParameter("x_first_name", $billing_firstname);
        $this->payment->setParameter("x_last_name", $billing_lastname);
        
        #$this->payment->setParameter("x_company", $billing_company);

        $this->payment->setParameter("x_address", $billing_address);
        $this->payment->setParameter("x_city", $billing_city);
        $this->payment->setParameter("x_state", $billing_state);
        $this->payment->setParameter("x_zip", $billing_zipcode);
        $this->payment->setParameter("x_country", $billing_country);
        $this->payment->setParameter("x_phone", $billing_telephone);
        if($shippingDetails['Type'] == "FSD" || $shippingDetails['Type'] == "NDSD"){
            $this->payment->setParameter("x_ship_to_company", $shipping_company);
        }else{
            $this->payment->setParameter("x_ship_to_first_name", $shipping_firstname);
            $this->payment->setParameter("x_ship_to_last_name", $shipping_lastname);
        }
        $this->payment->setParameter("x_ship_to_address", $shipping_address);
        $this->payment->setParameter("x_ship_to_city", $shipping_city);
        $this->payment->setParameter("x_ship_to_state", $shipping_state);
        $this->payment->setParameter("x_ship_to_zip", $shipping_zipcode);
        $this->payment->setParameter("x_ship_to_country", $shipping_country);
        $this->payment->setParameter("x_description", $product_description);
        $this->payment->process();


        if ($this->payment->isApproved())
        {
            // Get info from Authnet to store in the database
            $approval_code  = $this->payment->getAuthCode();
            $avs_result     = $this->payment->getAVSResponse();
            $cvv_result     = $this->payment->getCVVResponse();
            $transaction_id = $this->payment->getTransactionID();
        
            // Do stuff with this. Most likely store it in a database.
            // Direct the user to a receipt or something similiar.
            print_r($approval_code);
            echo "<br><br>";
            print_r($avs_result);
            echo "<br><br>";
            print_r($cvv_result);
            echo "<br><br>";
            print_r($transaction_id);
            echo "<br><br>";
            echo "here2";
            echo "<br><br>";
            print_r($this->payment->getResultResponse());

            return true;
        }
        else if ($this->payment->isDeclined())
        {
            // Get reason for the decline from the bank. This always says,
            // "This credit card has been declined". Not very useful.
            $reason = $this->payment->getResponseText();
            print_r($reason);
        
            // Politely tell the customer their card was declined
            // and to try a different form of payment.
            echo "here3 \n";

            return 2;
        }
        else if ($this->payment->isError())
        {
            // Get the error number so we can reference the Authnet
            // documentation and get an error description.
            $error_number  = $this->payment->getResponseSubcode();
            $error_message = $this->payment->getResponseText();
            print_r($error_number);
            print_r($error_message);
            echo "here4 \n";
        
            // OR
        
            // Capture a detailed error message. No need to refer to the manual
            // with this one as it tells you everything the manual does.
            $full_error_message =  $this->payment->getResponseMessage();
        
            // We can tell what kind of error it is and handle it appropriately.
            if ($this->payment->isConfigError())
            {
                // We misconfigured something on our end.
                echo "here5 \n";

                return 3;
            }
            else if ($this->payment->isTempError())
            {
                // Some kind of temporary error on Authorize.Net's end. 
                // It should work properly "soon".
                echo "here6 \n";
                return 4;
            }
            else
            {
                // All other errors.
                echo "here7 \n";

                return 5;
            }
        }
    }

    public function lipseysOrder(&$shippingInformation, &$billingData, $ordertype){
        
        #Check orderType
        if($ordertype == "firearms"){
            $firearmOder = array();
            $itemArray = array();
            $firearmOder['Ffl'] = $shippingInformation['FAS_FFL'];
            $firearmOder['Name'] = $shippingInformation['FAS_name'];
            $firearmOder['PoNumber'] = mt_rand(1000000,9999999);
            $firearmOder['Phone'] = $shippingInformation['FAS_phone'];
            $firearmOder['DelayShipping'] = false;
            $firearmOder['DisableEmail'] = true;
            $firearmOder['Items'] = $this->add_product_to_productArray("firearms");

            print_r($firearmOder['Items']);
            echo "<BR><BR>";

            $result =  $this->lipseysApi_DS->DropShipFirearms($firearmOder);

        }elseif($ordertype == "accessories"){

            $accessoryOder = array();
            $itemArray = array();
            $accessoryOder['PoNumber'] = mt_rand(1000000,9999999);
            $accessoryOder['BillingName'] = $billingData['B_FName']." ".$billingData['B_LName'];
            $accessoryOder['BillingAddressLine1'] = $billingData['B_Street'];
            $accessoryOder['BillingAddressLine2'] = $billingData['B_Apt'];
            $accessoryOder['BillingAddressCity'] = $billingData['B_City'];
            $accessoryOder['BillingAddressState'] = $billingData['B_State'];
            $accessoryOder['BillingAddressZip'] = $billingData['B_Zip'];
            $accessoryOder['ShippingName'] = $shippingInformation['AS_FName']." ".$shippingInformation['AS_LName'];
            $accessoryOder['ShippingAddressLine1'] = $shippingInformation['AS_Street'];
            $accessoryOder['ShippingAddressLine2'] = $shippingInformation['AS_Apt'];
            $accessoryOder['ShippingAddressCity'] = $shippingInformation['AS_City'];
            $accessoryOder['ShippingAddressState'] = $shippingInformation['AS_State'];
            $accessoryOder['ShippingAddressZip'] = $shippingInformation['AS_Zip'];
            $accessoryOder['MessageForSalesExec'] = "TEST ORDER! PLEASE CANCEL";
            $accessoryOder['DisableEmail'] = true;
            $accessoryOder['Overnight'] = false;
            $accessoryOder['Items'] = $this->add_product_to_productArray("accessories");

            $result = $this->lipseysApi_DS->DropShipAccessories($accessoryOder);

        }elseif($ordertype == "nonDropShip"){

            $nonDropshipOder = array();
            $itemArray = array();
            $nonDropshipOder['PoNumber'] = mt_rand(1000000,9999999);
            $nonDropshipOder['EmailConfirmation'] = true;
            $nonDropshipOder['DisableEmail'] = true;
            $nonDropshipOder['Items'] = $this->add_product_to_productArray("nonDropShip");

            $result = $this->lipseysApi_NDS->Order($nonDropshipOder);

        }else{
            
        }

        return $result;
        
    }
}