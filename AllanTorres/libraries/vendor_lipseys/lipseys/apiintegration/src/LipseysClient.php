<?php

namespace vendor_lipseys\lipseys\ApiIntegration\src;

use Exception;

class LipseysClient
{
    private $BaseUrl = "https://api.lipseys.com/api/";

    private $Email;
    private $Password;

    private $Account;
    private $Token;

    public function __construct($username, $password)
    {
        $this->Email = $username;
        $this->Password = $password;

        if( !extension_loaded('curl') ){
            throw new Exception("This method requires the php curl extension.");
        }
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if(session_status() == PHP_SESSION_ACTIVE){
            if(array_key_exists("LipseysSessionToken{$this->Email}{$this->Password}", $_SESSION)) {
                $this->Token = $_SESSION["LipseysSessionToken{$this->Email}{$this->Password}"];
                
            }
        }
    }

    private function RequestBuilder($options){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($curl, $options);
        return $curl;
    }

    private function PostRequestBuilder($url, $model){
        $curl = $this->RequestBuilder(array(
            CURLOPT_URL => "{$this->BaseUrl}{$url}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($model),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Token: {$this->Token}",
            ),
        ));
        return $curl;
    }
    private function GetRequestBuilder($url){
        $curl = $this->RequestBuilder(array(
            CURLOPT_URL => "{$this->BaseUrl}{$url}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Token: {$this->Token}",
                "cache-control: no-cache"
            ),
        ));
        return $curl;
    }

    private function InvalidLoginResponse($loginResponse){
        $errorsArray = array(
            "Not Authorized Response",
            "Credentials Provided: {$this->Email}, {$this->Password}",
            date("Y-m-d h:i:s A T"),
            $loginResponse
        );
        if($this->Token){
            array_push($errorsArray, "Token: {$this->Token}");
        }
        return array(
            "authorized" => false,
            "success" => false,
            "errors" => $errorsArray
        );
    }
    private function RequestError($error){
        return array(
            "authorized" => false,
            "success" => false,
            "errors" => array(
                "Error making http request",
                $error
            )
        );
    }

    public function Catalog(){
        if(!$this->Token){
            $loginAttemptResult = $this->login();
            if($loginAttemptResult != 1){
                return $this->InvalidLoginResponse($loginAttemptResult);
            }
        }

        $curl = $this->GetRequestBuilder("integration/items/CatalogFeed");
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError($err);
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                $loginAttemptResult = $this->login();
                if($loginAttemptResult != 1){
                    return $this->InvalidLoginResponse($loginAttemptResult);
                }

                $curl = $this->GetRequestBuilder("integration/items/CatalogFeed");
                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    return $this->RequestError($err);
                } else {
                    $decode2 = json_decode($response, true);
                    if ($decode2["authorized"] == false) {
                        return $this->InvalidLoginResponse($response);
                    }
                    return $decode2;
                }
            }
            return $decode;
        }
    }
    public function CatalogItem($itemNumber){
        if(!$this->Token){
            $loginAttemptResult = $this->login();
            if($loginAttemptResult != 1){
                return $this->InvalidLoginResponse($loginAttemptResult);
            }
        }

        if(!$itemNumber || strlen($itemNumber) < 1){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Item number not provided"
                )
            );
        }

        $curl = $this->PostRequestBuilder("integration/items/CatalogFeed/Item", $itemNumber);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError($err);
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                $loginAttemptResult = $this->login();
                if($loginAttemptResult != 1){
                    return $this->InvalidLoginResponse($loginAttemptResult);
                }

                $curl = $this->PostRequestBuilder("integration/items/CatalogFeed/Item", $itemNumber);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError($err);
                } else {
                    $decode2 = json_decode($response, true);
                    if($decode2["authorized"] == false){
                        return $this->InvalidLoginResponse($response);
                    }
                    return $decode2;
                }
            }
            return $decode;
        }
    }
    public function PricingAndQuantity(){
        if(!$this->Token){
            $loginAttemptResult = $this->login();
            if($loginAttemptResult != 1){
                return $this->InvalidLoginResponse($loginAttemptResult);
            }
        }

        $curl = $this->GetRequestBuilder("integration/items/PricingQuantityFeed");
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError($err);
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                $loginAttemptResult = $this->login();
                if($loginAttemptResult != 1){
                    return $this->InvalidLoginResponse($loginAttemptResult);
                }
                $curl = $this->GetRequestBuilder("integration/items/PricingQuantityFeed");
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError($err);
                } else {
                    $decode2 = json_decode($response, true);
                    if($decode2["authorized"] == false){
                        return $this->InvalidLoginResponse($response);
                    }
                    return $decode2;
                }
            }
            return $decode;
        }
    }
    public function AllocationPricingAndQuantity(){
        if(!$this->Token){
            $loginAttemptResult = $this->login();
            if($loginAttemptResult != 1){
                return $this->InvalidLoginResponse($loginAttemptResult);
            }
        }

        $curl = $this->GetRequestBuilder("integration/items/Allocations");
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError($err);
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                $loginAttemptResult = $this->login();
                if($loginAttemptResult != 1){
                    return $this->InvalidLoginResponse($loginAttemptResult);
                }
                $curl = $this->GetRequestBuilder("integration/items/Allocations");
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError($err);
                } else {
                    $decode2 = json_decode($response, true);
                    if($decode2["authorized"] == false){
                        return $this->InvalidLoginResponse($response);
                    }
                    return $decode2;
                }
            }
            return $decode;
        }
    }
    public function ValidateItem($itemNumber){
        if(!$this->Token){
            $loginAttemptResult = $this->login();
            if($loginAttemptResult != 1){
                return $this->InvalidLoginResponse($loginAttemptResult);
            }
        }

        if(!$itemNumber || strlen($itemNumber) < 1){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Item number not provided"
                )
            );
        }

        $curl = $this->PostRequestBuilder("integration/items/validateitem", $itemNumber);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError($err);
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                $loginAttemptResult = $this->login();
                if($loginAttemptResult != 1){
                    return $this->InvalidLoginResponse($loginAttemptResult);
                }

                $curl = $this->PostRequestBuilder("integration/items/validateitem", $itemNumber);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError($err);
                } else {
                    $decode2 = json_decode($response, true);
                    if($decode2["authorized"] == false){
                        return $this->InvalidLoginResponse($response);
                    }
                    return $decode2;
                }
            }
            return $decode;
        }
    }

    public function Order($order){
        if(!$this->Token){
            $loginAttemptResult = $this->login();
            if($loginAttemptResult != 1){
                return $this->InvalidLoginResponse($loginAttemptResult);
            }
        }

        if(!$order || !array_key_exists("Items", $order) || !isset($order["Items"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"Items\""
                )
            );
        }
        foreach ($order["Items"] as &$value) {
            if(!array_key_exists("ItemNo", $value) || strlen($value["ItemNo"]) < 1 || !$value["Quantity"] || $value["Quantity"] < 1){
                print_r($value["Quantity"]);

                return array(
                    "authorized" => true,
                    "success" => false,
                    "errors" => array(
                        "One or more line item was missing item number or had less than 1 quantity"
                    )
                );
            }
        }

        $curl = $this->PostRequestBuilder("integration/order/apiorder", $order);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        echo "<br><br>";
        echo "HERE2";
        echo "<br><br>";

        if ($err) { 
            echo "<br><br>";
            echo "ERROR ORDERING!";
            echo "<br><br>";
            return $this->RequestError($err);
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                $loginAttemptResult = $this->login();
                if($loginAttemptResult != 1){
                    echo "<br><br>";
                    echo "HERE4";
                    echo "<br><br>";
                    return $this->InvalidLoginResponse($loginAttemptResult);
                }

                $curl = $this->PostRequestBuilder("integration/order/apiorder", $order);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError($err);
                } else {
                    $decode2 = json_decode($response, true);
                    if($decode2["authorized"] == false){
                        return $this->InvalidLoginResponse($response);
                    }
                    echo "<br><br>";
                    echo "HERE5";
                    echo "<br><br>";
                    return $decode2;
                }
            }
            echo "<br><br>";
            echo "HERE3";
            echo "<br><br>";
            print_r($decode);
            print_r($decode2);
            echo "<br><br>";
            return $decode;
        }
    }
    public function AllocationOrder($order){
        if(!$this->Token){
            $loginAttemptResult = $this->login();
            if($loginAttemptResult != 1){
                return $this->InvalidLoginResponse($loginAttemptResult);
            }
        }

        if(!$order || !array_key_exists("Items", $order) || !isset($order["Items"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"Items\""
                )
            );
        }
        foreach ($order["Items"] as &$value) {
            if(!array_key_exists("ItemNo", $value) || strlen($value["ItemNo"]) < 1 || !$value["Quantity"] || $value["Quantity"] < 1){
                print_r($value["Quantity"]);

                return array(
                    "authorized" => true,
                    "success" => false,
                    "errors" => array(
                        "One or more line item was missing item number or had less than 1 quantity"
                    )
                );
            }
        }

        $curl = $this->PostRequestBuilder("integration/order/AllocationOrder", $order);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError($err);
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                $loginAttemptResult = $this->login();
                if($loginAttemptResult != 1){
                    return $this->InvalidLoginResponse($loginAttemptResult);
                }

                $curl = $this->PostRequestBuilder("integration/order/AllocationOrder", $order);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError($err);
                } else {
                    $decode2 = json_decode($response, true);
                    if($decode2["authorized"] == false){
                        return $this->InvalidLoginResponse($response);
                    }
                    return $decode2;
                }
            }
            return $decode;
        }
    }
    public function DropShipAccessories($order){
        if(!$this->Token){
            $loginAttemptResult = $this->login();
            if($loginAttemptResult != 1){
                return $this->InvalidLoginResponse($loginAttemptResult);
            }
        }

        echo "<br><br>";
        print_r($order);
        echo "<br><br>";

        if(!$order || !array_key_exists("BillingName", $order) || !isset($order["BillingName"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"BillingName\""
                )
            );
        }
        if(!$order || !array_key_exists("BillingAddressLine1", $order) || !isset($order["BillingAddressLine1"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"BillingAddressLine1\""
                )
            );
        }
        if(!$order || !array_key_exists("BillingAddressCity", $order) || !isset($order["BillingAddressCity"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"BillingAddressCity\""
                )
            );
        }
        if(!$order || !array_key_exists("BillingAddressState", $order) || !isset($order["BillingAddressState"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"BillingAddressState\""
                )
            );
        }

        if(strlen($order["BillingAddressState"]) != 2){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "BillingAddressState Should be 2 Letters"
                )
            );
        }
        if(!$order || !array_key_exists("BillingAddressZip", $order) || !isset($order["BillingAddressZip"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"BillingAddressZip\""
                )
            );
        }
        if(strlen($order["BillingAddressZip"]) > 5){
            $order["BillingAddressZip"] = trim($order["BillingAddressZip"]);
            if(strlen($order["BillingAddressZip"]) > 5){
                $order["BillingAddressZip"] = substr ( $order["BillingAddressZip"] , 0, 5 );
            }
        }
        if(strlen($order["BillingAddressZip"]) < 5){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "BillingAddressZip Should be 5 Numbers"
                )
            );
        }
        if(!$order || !array_key_exists("ShippingName", $order) || !isset($order["ShippingName"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"ShippingName\""
                )
            );
        }
        if(!$order || !array_key_exists("ShippingAddressLine1", $order) || !isset($order["ShippingAddressLine1"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"ShippingAddressLine1\""
                )
            );
        }
        if(!$order || !array_key_exists("ShippingAddressCity", $order) || !isset($order["ShippingAddressCity"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"ShippingAddressCity\""
                )
            );
        }
        if(!$order || !array_key_exists("ShippingAddressState", $order) || !isset($order["ShippingAddressState"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"ShippingAddressState\""
                )
            );
        }
        if(strlen($order["ShippingAddressState"]) != 2){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "ShippingAddressState Should be 2 Letters"
                )
            );
        }
        if(!$order || !array_key_exists("ShippingAddressZip", $order) || !isset($order["ShippingAddressZip"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"ShippingAddressZip\""
                )
            );
        }

        if(strlen($order["ShippingAddressZip"]) > 5){
            $order["ShippingAddressZip"] = trim($order["ShippingAddressZip"]);
            if(strlen($order["ShippingAddressZip"]) > 5){
                $order["ShippingAddressZip"] = substr ( $order["ShippingAddressZip"] , 0, 5 );
            }
        }
        if(strlen($order["ShippingAddressZip"]) < 5){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "ShippingAddressZip Should be 5 Numbers"
                )
            );
        }

        if(!$order || !array_key_exists("PoNumber", $order) || !isset($order["PoNumber"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"PoNumber\""
                )
            );
        }



        if(!$order || !array_key_exists("Items", $order) || !isset($order["Items"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"Items\""
                )
            );
        }
        foreach ($order["Items"] as &$value) {
            if(!array_key_exists("ItemNo", $value) || strlen($value["ItemNo"]) < 1 || !array_key_exists("Quantity", $value) || $value["Quantity"] < 1){
                return array(
                    "authorized" => true,
                    "success" => false,
                    "errors" => array(
                        "One or more line item was missing item number or had less than 1 quantity"
                    )
                );
            }
        }

        echo "<br><br>";
        echo "HERE3";
        echo "<br><br>";

        $curl = $this->PostRequestBuilder("integration/order/dropship", $order);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError($err);
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                $loginAttemptResult = $this->login();
                if($loginAttemptResult != 1){
                    return $this->InvalidLoginResponse($loginAttemptResult);
                }

                $curl = $this->PostRequestBuilder("integration/order/dropship", $order);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError($err);
                } else {
                    $decode2 = json_decode($response, true);
                    if($decode2["authorized"] == false){
                        return $this->InvalidLoginResponse($response);
                    }
                    return $decode2;
                }
            }
            echo "<br><br>";
            print_r($decode);
            echo "HERE";
            echo "<br><br>";
            return $decode;
        }
    }
    public function DropShipFirearms($order){
        if(!$this->Token){
            $loginAttemptResult = $this->login();
            if($loginAttemptResult != 1){
                return $this->InvalidLoginResponse($loginAttemptResult);
            }
        }

        if(!$order || !array_key_exists("Ffl", $order) || !isset($order["Ffl"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"Ffl\""
                )
            );
        }
        if(!$order || !array_key_exists("Name", $order) || !isset($order["Name"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"Name\""
                )
            );
        }
        if(!$order || !array_key_exists("Phone", $order) || !isset($order["Phone"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"Phone\""
                )
            );
        }

        if(!$order || !array_key_exists("Items", $order) || !isset($order["Items"])){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "Field Missing: \"Items\""
                )
            );
        }
        foreach ($order["Items"] as &$value) {
            if(!array_key_exists("ItemNo", $value) || strlen($value["ItemNo"]) < 1 || !array_key_exists("Quantity", $value) || $value["Quantity"] < 1){
                return array(
                    "authorized" => true,
                    "success" => false,
                    "errors" => array(
                        "One or more line item was missing item number or had less than 1 quantity"
                    )
                );
            }
        }


        $curl = $this->PostRequestBuilder("integration/order/DropShipFirearm", $order);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError($err);
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                $loginAttemptResult = $this->login();
                if($loginAttemptResult != 1){
                    return $this->InvalidLoginResponse($loginAttemptResult);
                }

                $curl = $this->PostRequestBuilder("integration/order/DropShipFirearm", $order);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError($err);
                } else {
                    $decode2 = json_decode($response, true);
                    if($decode2["authorized"] == false){
                        return $this->InvalidLoginResponse($response);
                    }
                    return $decode2;
                }
            }
            return $decode;
        }
    }

    public function OneDaysShipping($date){
        if(!$this->Token){
            $loginAttemptResult = $this->login();
            if($loginAttemptResult != 1){
                return $this->InvalidLoginResponse($loginAttemptResult);
            }
        }

        if(!$date){
            return array(
                "authorized" => true,
                "success" => false,
                "errors" => array(
                    "date not provided"
                )
            );
        }

        $curl = $this->PostRequestBuilder("integration/shipping/oneday", $date);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->RequestError($err);
        } else {
            $decode = json_decode($response, true);
            if($decode["authorized"] == false){
                $loginAttemptResult = $this->login();
                if($loginAttemptResult != 1){
                    return $this->InvalidLoginResponse($loginAttemptResult);
                }

                $curl = $this->PostRequestBuilder("integration/shipping/oneday", $date);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return $this->RequestError($err);
                } else {
                    $decode2 = json_decode($response, true);
                    if($decode2["authorized"] == false){
                        return $this->InvalidLoginResponse($response);
                    }
                    return $decode2;
                }
            }
            return $decode;
        }
    }

    private function login(){
        $model = array(
            "Email" => $this->Email,
            "Password" => $this->Password
        );
        $curl = $this->PostRequestBuilder("integration/authentication/login", $model);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            $decode = json_decode($response, true);
            if(array_key_exists("token", $decode) && array_key_exists("econtact", $decode) && $decode["econtact"]["success"] == 1){
                $this->Account = $decode;
                $this->Token = $decode["token"];
                if(session_status() == PHP_SESSION_ACTIVE){
                    $_SESSION["LipseysSessionToken{$this->Email}{$this->Password}"] = $decode["token"];
                }
                return 1;
            }
        }
        return $response;
    }
}