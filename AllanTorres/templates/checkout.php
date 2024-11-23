    <?php include("includes/header.php"); ?>

  

    <script type="text/javascript">
        window.paymentcard = null;
        window.form = null;
        <?php $totalPrice = 0;?>
        <?php foreach($cart as $product): ?> 
            <?php $totalPrice+= $product['subTotal'];?>
        <?php endforeach?>  
        window.totalItemPrice = "<?php echo $totalPrice+$shipping+$tax?>";
        window.applicationId = 
        "<?php
            echo SQUARE_APPLICATION_ID;
            ?>";
        window.locationId =
        "<?php
            echo SQUARE_LOCATION_ID;
            ?>";
        window.currency =
        "<?php
            echo $location_info->getCurrency();
            ?>";
        window.country =
        "<?php
            echo $location_info->getCountry();
            ?>";
        window.idempotencyKey =
        "<?php
            echo $uuid;
            ?>";
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Select the div element you want to observe
        const divElement = document.getElementById('payment-flow-message');

        // Check if the element exists
        if (divElement) {
            // Watch for class change
            watchClassChange(divElement);
        } else {
            console.error('Element with class "myDiv" not found!');
        }
    });

    // Function to send alert when class of a div changes
    function watchClassChange(element) {
    // Store the previous class list
    let lastClass = element.className;

    // Create a MutationObserver to listen for changes
    const observer = new MutationObserver((mutationsList) => {
        for (let mutation of mutationsList) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                // Get the current class list
                const newClass = element.className;

                // Check if the class has changed (and not the same as before)
                if (newClass !== lastClass && newClass == "success") {
                    // Log the change (optional)
                    console.log('Payment Successful:', newClass);

                    // Alert the user
                    alert(`Payment Processed: ${newClass}`);

                    // Update the last class to the current one
                    lastClass = newClass;

                    window.form.submit()

                    //window.location.href = "http://localhost/AllanTorres/result.php?success=1";
                }
            }
        }
    });

    // Configure the observer to watch for attribute changes (specifically the class)
    observer.observe(element, {
        attributes: true // Only watch for changes to attributes
    });
    }
    </script>

    <div class="section">
        <div class="contentContainer smallContainer checkoutContainer">  
            <div class="orderBox">
                <div class="checkoutTableWrapper">
                    <h3 class="bdTitle OrdTitle">Your Order</h3>
                    <table class="checkoutTable">
                        <tr class="ckTableRow">
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>SubTotal</th>
                        </tr>
                        <!--PHP-->
                        <?php $total = 0;?>
                        <?php foreach($cart as $product): ?>
                            <tr class="ckTableRow">
                                <td>
                                    <a class="link" href="item.php?itemNo=<?php echo $product['itemNo']?>"><?php echo $product['itemName']; ?></a>
                                </td>
                                <td><?php echo $product['qty']; ?></td>
                                <td>$<?php echo $product['price']; ?></td>
                                <td>$<?php echo $product['subTotal']; ?></td>
                            </tr>  
                        <?php $total+= $product['subTotal'];?>
                        <?php endforeach?>   
                        <!--PHP-->
                        <tr class="ckTableRow">
                            <th>Shipping</th>
                            <td></td>
                            <td></td>
                            <!--PHP-->
                            <td>$<?php echo $shipping?></td>
                            <!--PHP-->
                        </tr>
                        <tr class="ckTableRow">
                            <th>Tax</th>
                            <td></td>
                            <td></td>
                            <!--PHP-->
                            <td>$<?php echo $tax?></td>
                            <!--PHP-->
                        </tr>
                        <tr class="ckTableRow bdNobr">
                            <th>Total</th>
                            <td></td>
                            <td></td>
                            <!--PHP-->
                            <td>$<?php echo $total+$shipping+$tax?></td>
                            <!--PHP-->
                        </tr>
                    </table>
                </div>
            </div>
            <div class="smallContainerHalf">
                <?php if((!empty($cart)) && ($FirearmAccessory[0] == True) && ($FirearmAccessory[1] == True)): ?>
                    <?php if(count($fflSelected) === 0 ):?>
                        <form id="firearmShippingDetailsForm" class="bdForm bdhalf" method="post" action="redirectFFL.php">
                            <h3 class="bdTitle">Firearm Shipping Details</h3>
                            <input class="bdInput" type="number" name="zipcode" pattern="^(?(^00000(|-0000))|(\d{5}(|-\d{4})))$" placeholder="Enter ZIP Code" required/>
                            <br> 
                            <button class="SIB sibCheckout">FIND FFL</button>
                        </form> 
                        <?php if($fflCount > 0):?>
                                <div class="fflBoxWrapper">
                                    <h4 class="bdTitle bdsmaller">Select FFL</h4>
                                    <?php foreach($ffls as $ffl): ?>
                                        <form method="post" action="redirectFFL.php">
                                            <?php $fflId = $ffl->LIC_REGN.$ffl->LIC_DIST.$ffl->LIC_CNTY.$ffl->LIC_TYPE.$ffl->LIC_XPRDTE.$ffl->LIC_SEQN ?>
                                            <input type="hidden" name="fflId" value="<?php echo $fflId ?>"/>
                                            <input type="hidden" name="fflName" value="<?php echo $ffl->LICENSE_NAME ?>"/>
                                            <input type="hidden" name="fflStreet" value="<?php echo $ffl->MAIL_STREET ?>"/>
                                            <input type="hidden" name="fflCity" value="<?php echo $ffl->MAIL_CITY ?>"/>
                                            <input type="hidden" name="fflState" value="<?php echo $ffl->MAIL_STATE ?>"/>
                                            <input type="hidden" name="fflZip" value="<?php echo $ffl->MAIL_ZIP_CODE ?>"/>
                                            <input type="hidden" name="fflCountry" value="United States"/>
                                            <input type="hidden" name="fflPhone" value="<?php echo $ffl->VOICE_PHONE ?>"/>
                                            <button class="fflBox">
                                                    <p class="fflInfo"><b>Zip Code:</b> <?php echo $ffl->PREMISE_ZIP_CODE ?></p>
                                                    <p class="fflInfo"><b>FFL Name:</b> <?php echo $ffl->LICENSE_NAME ?></p>
                                                    <p class="fflInfo"><b>FFL Address:</b> <?php echo $ffl->PREMISE_STREET ?>, <?php echo $ffl->PREMISE_CITY ?>, <?php echo $ffl->PREMISE_STATE ?></p>
                                                    <p class="fflInfo"><b>FFL Address:</b> <?php echo $ffl->PREMISE_STREET ?>, <?php echo $ffl->PREMISE_CITY ?>, <?php echo $ffl->PREMISE_STATE ?></p>
                                            </button>
                                        </form>
                                    <?php endforeach; ?>
                                </div>
                            <?php elseif($fflCount == 0): ?>
                                <p class="fflWarningText">No FFLs Found In This Area!</p>
                            <?php endif; ?>
                            <?php $_SESSION['fflCount'] = -1;?>
                    <?php elseif(count($fflSelected) > 0):?>
                        <form class="bdForm" id="firearmShippingDetails1" method="POST">
                            <h3 class="bdTitle">Firearm Shipping Details</h3>
                            <input class="bdInput" name="FAS_FFL" type="text"readonly hidden value="<?php echo $fflSelected[0] ?>"/> 
                            <input class="bdInput" name="FAS_name" type="text" readonly value="<?php echo $fflSelected[1] ?>"/> 
                            <input class="bdInput" name="FAS_address2" type="text" readonly value="<?php echo $fflSelected[2] ?>"/> 
                            <input class="bdInput" name="FAS_city" type="text" readonly value="<?php echo $fflSelected[3] ?>"/> 
                            <input class="bdInput" name="FAS_state" type="text" readonly value="<?php echo $fflSelected[4] ?>"/> 
                            <input class="bdInput" name="FAS_zip" type="text" readonly value="<?php echo $fflSelected[5] ?>"/> 
                            <input class="bdInput" name="FAS_country" type="text" readonly value="<?php echo $fflSelected[6] ?>"/> 
                            <input class="bdInput" name="FAS_phone" type="text" readonly value="<?php echo $fflSelected[7] ?>"/> 
                        </form>
                    <?php endif; ?>
                    <?php $_SESSION['fflSelected'] = array();?>
                        <form class="bdForm MarginTopAC" id="accessoryShippingDetails" method="POST">
                            <h3 class="bdTitle">Accessory Shipping Details</h3>
                            <div class="bdIBox">
                                <input name="AS_FName" class="bdInput bdIHalf" type="text" placeholder="First Name"/> 
                                <input name="AS_LName" class="bdInput bdIHalf" type="text" placeholder="Last Name"/> 
                            </div>
                            <input class="bdInput" name="AS_Country" type="text" placeholder="Country / Region"/> 
                            <input class="bdInput" name="AS_Street" type="text" placeholder="Street Name"/> 
                            <input class="bdInput" name="AS_Apt" type="text" placeholder="Apartment, suite, unit, etc. (optional)"/> 
                            <input class="bdInput" name="AS_City" type="text" placeholder="Town / City"/> 
                            <input class="bdInput" name="AS_State" type="text" placeholder="State"/> 
                            <input class="bdInput" maxlength="5" name="AS_Zip" type="text" placeholder="ZIP Code"/> 
                        </form>
                <?php elseif((!empty($cart)) && ($FirearmAccessory[0] == True)): ?>
                    <?php if(count($fflSelected) === 0 ):?>
                        <form id="firearmShippingDetailsForm" class="bdForm bdhalf" method="post" action="redirectFFL.php">
                            <h3 class="bdTitle">Shipping Details</h3>
                            <input class="bdInput" type="number" name="zipcode" pattern="^(?(^00000(|-0000))|(\d{5}(|-\d{4})))$" placeholder="Enter ZIP Code" required/>
                            <br> 
                            <button class="SIB sibCheckout">FIND FFL</button>
                        </form> 
                        <?php if($fflCount > 0):?>
                                <div class="fflBoxWrapper">
                                <h4 class="bdTitle bdsmaller">Select FFL</h4>
                                <?php foreach($ffls as $ffl): ?>
                                    <form method="post" action="redirectFFL.php">
                                            <?php $fflId = $ffl->LIC_REGN.$ffl->LIC_DIST.$ffl->LIC_CNTY.$ffl->LIC_TYPE.$ffl->LIC_XPRDTE.$ffl->LIC_SEQN ?>
                                            <input type="hidden" name="fflId" value="<?php echo $fflId ?>"/>
                                            <input type="hidden" name="fflName" value="<?php echo $ffl->LICENSE_NAME ?>"/>
                                            <input type="hidden" name="fflStreet" value="<?php echo $ffl->MAIL_STREET ?>"/>
                                            <input type="hidden" name="fflCity" value="<?php echo $ffl->MAIL_CITY ?>"/>
                                            <input type="hidden" name="fflState" value="<?php echo $ffl->MAIL_STATE ?>"/>
                                            <input type="hidden" name="fflZip" value="<?php echo $ffl->MAIL_ZIP_CODE ?>"/>
                                            <input type="hidden" name="fflCountry" value="United States"/>
                                            <input type="hidden" name="fflPhone" value="<?php echo $ffl->VOICE_PHONE ?>"/>
                                            <button class="fflBox">
                                                    <p class="fflInfo"><b>Zip Code:</b> <?php echo $ffl->PREMISE_ZIP_CODE ?></p>
                                                    <p class="fflInfo"><b>FFL Name:</b> <?php echo $ffl->LICENSE_NAME ?></p>
                                                    <p class="fflInfo"><b>FFL Address:</b> <?php echo $ffl->PREMISE_STREET ?>, <?php echo $ffl->PREMISE_CITY ?>, <?php echo $ffl->PREMISE_STATE ?></p>
                                                    <p class="fflInfo"><b>FFL Address:</b> <?php echo $ffl->PREMISE_STREET ?>, <?php echo $ffl->PREMISE_CITY ?>, <?php echo $ffl->PREMISE_STATE ?></p>
                                            </button>
                                    </form>
                                <?php endforeach; ?>
                                </div>
                            <?php elseif($fflCount == 0): ?>
                                <p class="fflWarningText">No FFLs Found In This Area!</p>
                            <?php endif; ?>
                            <?php $_SESSION['fflCount'] = -1;?>
                    <?php elseif(count($fflSelected) > 0): ?>
                        <form class="bdForm" id="firearmShippingDetails2" method="POST">
                            <h3 class="bdTitle">Shipping Details</h3>
                            <input class="bdInput" name="FAS_FFL" type="text"readonly hidden value="<?php echo $fflSelected[0] ?>"/> 
                            <input class="bdInput" name="FAS_name" type="text" readonly value="<?php echo $fflSelected[1] ?>"/> 
                            <input class="bdInput" name="FAS_address2" type="text" readonly value="<?php echo $fflSelected[2] ?>"/> 
                            <input class="bdInput" name="FAS_city" type="text" readonly value="<?php echo $fflSelected[3] ?>"/> 
                            <input class="bdInput" name="FAS_state" type="text" readonly value="<?php echo $fflSelected[4] ?>"/> 
                            <input class="bdInput" name="FAS_zip" type="text" readonly value="<?php echo $fflSelected[5] ?>"/> 
                            <input class="bdInput" name="FAS_country" type="text" readonly value="<?php echo $fflSelected[6] ?>"/> 
                            <input class="bdInput" name="FAS_phone" type="text" readonly value="<?php echo $fflSelected[7] ?>"/> 
                        </form>
                    <?php endif; ?>
                    <?php $_SESSION['fflSelected'] = array();?>
                <?php elseif((!empty($cart)) && ($FirearmAccessory[1] == True)): ?>
                    <form class="bdForm" method="POST" id="accessoryShippingDetails">
                        <h3 class="bdTitle">Shipping Details</h3>
                        <div class="bdIBox">
                            <input name="AS_FName" class="bdInput bdIHalf" type="text" placeholder="First Name"/> 
                            <input name="AS_LName" class="bdInput bdIHalf" type="text" placeholder="Last Name"/> 
                        </div>
                        <input class="bdInput" name="AS_Country" type="text" placeholder="Country / Region"/> 
                        <input class="bdInput" name="AS_Street" type="text" placeholder="Street Name"/> 
                        <input class="bdInput" name="AS_Apt" type="text" placeholder="Apartment, suite, unit, etc. (optional)"/> 
                        <input class="bdInput" name="AS_City" type="text" placeholder="Town / City"/> 
                        <input class="bdInput" name="AS_State" type="text" placeholder="State"/> 
                        <input class="bdInput" maxlength="5" name="AS_Zip" type="text" placeholder="ZIP Code"/> 
                    </form>
                <?php endif; ?>
                <?php if ($FirearmAccessory[2] == True || $FirearmAccessory[3] == True):?>
                    <form class="bdForm MarginTopAC" method="POST" id="NonDropshipShippingDetails">
                        <h3 class="bdTitle" style="color:#FAA916;">Non-Drophip 
                        <?php if(($FirearmAccessory[2] == True) && ($FirearmAccessory[3] == False)): ?>
                            Accessory
                        <?php elseif(($FirearmAccessory[2] == False) && ($FirearmAccessory[3] == True)):?>
                            Firearm
                        <?php elseif(($FirearmAccessory[2] == True) && ($FirearmAccessory[3] == True)) :?>
                            Accessory & Firearm
                        <?php endif; ?>
                         Shipping Details</h3>
                        <input class="bdInput" name="OWNER_Name" type="text" readonly value="MODERN EDGE ARMORY LLC"/> 
                        <input class="bdInput" name="OWNER_Address1" type="text" readonly value="16102 UNIVERSITY OAK DR."/> 
                        <input class="bdInput" name="OWNER_City" type="text" readonly value="SAN ANTONIO"/> 
                        <input class="bdInput" name="OWNER_State" type="text" readonly value="TX"/> 
                        <input class="bdInput" name="OWNER_Zip" type="text" readonly value="78249"/> 
                        <input class="bdInput" name="OWNER_Country" type="text" readonly value="United States"/> 
                        <input class="bdInput" name="OWNER_FFL" type="text" hidden readonly value="2108420702"/> 
                        </form>
                <?php endif; ?>
            </div>
            <div class="smallContainerHalf">
                <?php if ($FirearmAccessory[2] == True || $FirearmAccessory[3] == True):?>
                    <form class="bdForm" method="POST" id="billingDetails">
                <?php else: ?>
                    <form class="bdForm MarginTopAC" method="POST" id="billingDetails">
                <?php endif; ?>
                    <h3 class="bdTitle">Billing Details</h3>
                    <div class="bdIBox">
                      <input class="bdInput bdIHalf" name="B_FName" type="text" placeholder="First Name"/> 
                        <input class="bdInput bdIHalf" name="B_LName" type="text" placeholder="Last Name"/> 
                    </div>
                    <input class="bdInput" type="text" name="B_Email"  placeholder="Email Address"/> 
                    <input class="bdInput" type="text" name="B_Phone"  placeholder="Phones Number"/> 
                    <input class="bdInput" type="text" name="B_Country"  placeholder="Country / Region"/> 
                    <input class="bdInput" type="text" name="B_Street"  placeholder="Street Name"/> 
                    <input class="bdInput" type="text" name="B_Apt"  placeholder="Apartment, suite, unit, etc. (optional)"/> 
                    <input class="bdInput" type="text" name="B_City"  placeholder="Town / City"/> 
                    <input class="bdInput" type="text" name="B_State"  placeholder="State"/> 
                    <input class="bdInput" type="text" maxlength="5" name="B_Zip"  placeholder="ZIP Code"/> 
                </form>
            </div>
            <div class="smallContainerHalf ckGap">

            <form class="payment-form squarePaymentBox" id="fast-checkout">
            <div class="wrapper">
                <div id="card-container" ></div>
                <button id="card-button" type="button" class="SIB" onclick = "submitForms()">Place Order</button>
                <span id="payment-flow-message" class=""></span>
            </div>
            </form>

            <script type="text/javascript" src="<?php echo SQUARE_API_PATH?>\public\js\sq-card-pay.js"></script>
            <script type="text/javascript" src="<?php echo SQUARE_API_PATH?>\public\js\sq-payment-flow.js"></script>

                <!--<form class="bdForm bdNoBorder" method="POST" id="cardDetails">
                    <h3 class="bdTitle">Credit Card Information</h3>
                    <input class="bdInput" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" 
                            autocomplete="cc-number" maxlength="19" name="CC_Number" placeholder="xxxx xxxx xxxx xxxx"/> 
                    <div class="bdIBox">
                        <input class="bdInput bdIHalf" maxlength="5" type="text" name="CC_Eexpiration" placeholder="Eexpiration (MM/YY)"/> 
                        <input class="bdInput bdIHalf" maxlength="3" type="text" name="CC_CVV" placeholder="Card Security Code"/> 
                    </div>
                </form>-->

 
            </div>

            <!--<button class="SIB" onclick = "submitForms()">place order</button>-->
        </div>
    </div>
<?php include("includes/footer.php"); ?>

<script>
    async function submitForms(){

        var form = document.createElement('form');
        form.method = "post";
        form.action = "redirectChck.php";
        form.enctype = "application/x-www-form-urlencoded";

        var jsonFirearmShippingData = {};
        var jsonAccessoryShippingData = {};
        var jsonNonDropshipShippingData = {};
        var jsonBillingData = {};
        var jsonCreditCardData = {};
        var missingInfo = false;
        var badZip = false;

        if(document.getElementById('firearmShippingDetails1')){
            var FSD1 = new FormData(document.getElementById('firearmShippingDetails1'));

            for (var [key, value] of FSD1.entries()) { 
                if(value.length != 0){
                    jsonFirearmShippingData[key] = value;
                    document.getElementById('firearmShippingDetails1').style.border="none";
                    console.log(key, value);
                }else{
                    missingInfo = true;
                    document.getElementById('firearmShippingDetails1').style.border="3px solid red";
                    break;
                }
            }

            var input = document.createElement("input");
            input.type="hidden";
            input.name="FirearmShippingData";
            input.value = JSON.stringify(jsonFirearmShippingData);
            form.appendChild(input);
        }

        if(document.getElementById('firearmShippingDetailsForm')){
            missingInfo = true;
            document.getElementById('firearmShippingDetailsForm').style.border="3px solid red";
        }

        if(document.getElementById('firearmShippingDetails2')){
            var FSD2 = new FormData(document.getElementById('firearmShippingDetails2'));

            for (var [key, value] of FSD2.entries()) { 
                if(value.length != 0){
                    jsonFirearmShippingData[key] = value;
                    document.getElementById('firearmShippingDetails2').style.border="none";
                    console.log(key, value);
                }else{
                    missingInfo = true;
                    document.getElementById('firearmShippingDetails2').style.border="3px solid red";
                    break;
                }
            }

            var input = document.createElement("input");
            input.type="hidden";
            input.name="FirearmShippingData";
            input.value = JSON.stringify(jsonFirearmShippingData);
            form.appendChild(input);
        }

        if(document.getElementById('accessoryShippingDetails')){
            var ASD = new FormData(document.getElementById('accessoryShippingDetails'));

            for (var [key, value] of ASD.entries()) { 
                if(value.length != 0){

                    if(value == "AS_Zip" && !Number.isInteger(value)){
                        badZip = true;
                        break;
                    }

                    jsonAccessoryShippingData[key] = value;
                    document.getElementById('accessoryShippingDetails').style.border="none";
                    console.log(key, value);

                }else{
                    missingInfo = true;
                    document.getElementById('accessoryShippingDetails').style.border="3px solid red";
                    break;
                }
            }

            var input = document.createElement("input");
            input.type="hidden";
            input.name="AccessoryShippingData";
            input.value = JSON.stringify(jsonAccessoryShippingData);
            form.appendChild(input);
        }

        if(document.getElementById('NonDropshipShippingDetails')){
            var NDSD = new FormData(document.getElementById('NonDropshipShippingDetails'));

            for (var [key, value] of NDSD.entries()) { 
                if(value.length != 0){
                    jsonNonDropshipShippingData[key] = value;
                    document.getElementById('NonDropshipShippingDetails').style.border="none";
                    console.log(key, value);
                }else{
                    missingInfo = true;
                    document.getElementById('NonDropshipShippingDetails').style.border="3px solid red";
                    break;
                }
            }

            var input = document.createElement("input");
            input.type="hidden";
            input.name="NonDropshipShippingData";
            input.value = JSON.stringify(jsonNonDropshipShippingData);
            form.appendChild(input);
        }

        if(document.getElementById('billingDetails')){
            var BD = new FormData(document.getElementById('billingDetails'));

            for (var [key, value] of BD.entries()) { 
                if(value.length != 0){

                    if(value == "B_Zip" && !Number.isInteger(value)){
                        badZip = true;
                        break;
                    }

                    jsonBillingData[key] = value;
                    document.getElementById('billingDetails').style.border="none";
                    console.log(key, value);
                }else{
                    missingInfo = true;
                    document.getElementById('billingDetails').style.border="3px solid red";
                    break;
                }
            }

            var input = document.createElement("input");
            input.type="hidden";
            input.name="BillingData";
            input.value = JSON.stringify(jsonBillingData);
            form.appendChild(input);
        }

       //if(document.getElementById('cardDetails')){
       //    var CCD = new FormData(document.getElementById('cardDetails'));

       //    for (var [key, value] of CCD.entries()) { 
       //        if(value.length != 0){

       //            if(value == "AS_Zip" && !Number.isInteger(value)){
       //                badZip = true;
       //                break;
       //            }

       //            jsonCreditCardData[key] = value;
       //            document.getElementById('cardDetails').style.border="none";
       //            console.log(key, value);
       //        }else{
       //            missingInfo = true;
       //            document.getElementById('cardDetails').style.border="3px solid red";
       //            break;
       //        }
       //    }

       //    var input = document.createElement("input");
       //    input.type="hidden";
       //    input.name="CreditCardData";
       //    input.value = JSON.stringify(jsonCreditCardData);
       //    form.appendChild(input);
       //}
        
        document.body.appendChild(form);
        window.form = form

        if(missingInfo){
            alert("Please fill out highlighted fields!")
            form.remove();
            window.form = null;
        }else{
            
            // Clear any existing messages
            window.paymentFlowMessageEl.innerText = '';

            try {
            const result = await window.paymentcard.tokenize();
            if (result.status === 'OK') {
                // Use global method from sq-payment-flow.js
                window.createPayment(result.token);
            }
            } catch (e) {
            if (e.message) {
                window.showError(`Error: ${e.message}`);
            } else {
                window.showError('Something went wrong');
            }
            }
            

            //form.submit();
        }

    }
</script>