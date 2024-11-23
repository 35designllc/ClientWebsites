<?php include("includes/header.php"); ?>
    <div class="section shopItemBox">
        <div class="contentContainer shopItemContainer">  
            <div class="shopItemContainerBox">  
                <!-- Container for our gallery -->
                <div class="shopItem">
                    <!-- All images with side view -->
                    <div class="sideView">
                        <div class="sideViewImgBox">
                            <?php $imgName = substr($item[0]->IMAGENAME, 0, strpos($item[0]->IMAGENAME, '.')) . ".webp"; ?>  
                            <img class="" src="media/catalog/<?php echo $imgName; ?>" onclick="change(this.src, this.className)">
                        </div>
                        <div class="sideViewImgBox">
                            <?php $imgName = substr($item[0]->IMAGENAME, 0, strpos($item[0]->IMAGENAME, '.')) . ".webp"; ?>  
                            <img class="reversedImg" src="media/catalog/<?php echo $imgName; ?>" onclick="change(this.src, this.className)">
                        </div>
                    </div>
                    <!-- Main view of our gallery -->
                    <div class="mainView">
                        <div class="mainViewImgBox">
                         <?php $imgName = substr($item[0]->IMAGENAME, 0, strpos($item[0]->IMAGENAME, '.')) . ".webp"; ?>  
                         <img class="" src="media/catalog/<?php echo $imgName; ?>" id="main" alt="IMAGE">
                        </div>
                    </div>
                </div>
                <div class="shopItemDescription">
                    <div class="shopItemTitleBox">
                        <h1 class="shopItemTitle"><?php echo $item[0]->ITEMNO; ?></h1>
                    </div>
                    <div class="shopItemDescBox">
                        <div class="shopItemDesc"><?php echo $item[0]->DESCRIPTION1; ?></div>
                        <div class="shopItemDesc"><?php echo $item[0]->CALIBERGAUGE; ?></div>
                        <p>
                            <div><b>MANUFACTURER:</b> <?php echo $item[0]->MANUFACTURER; ?></div>
                            <div><b>MFG MDL #:</b> <?php echo $item[0]->MANUFACTURERMODELNO; ?></div>
                            <div><b>UPC:</b> <?php echo $item[0]->UPC; ?></div>
                            <br>
                            <?php if($qty != NULL):?>
                                
                                <div><b>IN STOCK:</b> <?php echo $qty; ?></div>
                            <?php else: ?>
                                <div><b>OUT OF STOCK!</b></div>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="shopItemPriceQtyBox">
                        <div class="shopItemPriceBox">
                            <?php if($item[0]->ONSALE == "TRUE"): ?>
                                <p class="shopItemPrice" style="color:red;">SALE! $<?php echo number_format((float)($item[0]->MSRP - ($item[0]->MSRP*.05)), 2, '.', ''); ?></p>
                            <?php else: ?>
                                <p class="shopItemPrice">$<?php echo number_format((float)$item[0]->MSRP, 2, '.', ''); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="shopItemQtyBox">
                            <label for="qty" class="shopItemQuantityLabel">QUANTITY: </label>
                            <select name="qty" class="shopItemQuantitySelect" onchange="changeQty(this.value)">
                                <?php for($x = 0; $x <= $qty; $x++) :?>
                                <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                <?php endfor; ?>
                            </select>
                            <script>
                                function changeQty(val){
                                    document.getElementById("qtySub1").value = val;
                                    document.getElementById("qtySub2").value = val;
                                }
                            </script>
                        </div>
                    </div>
                    <div class="shopItemButtonsBox">
                        <form action="redirectCt.php" method="post">
                            <input type="hidden" name="productNumber" value="<?php echo $item[0]->ITEMNO; ?>"/>
                            <?php if(isset($price)):?>
                                <input type="hidden" id="price" name="price" value="<?php echo $price; ?>"/>
                            <?php else: ?>
                                <input type="hidden" id="price" name="price" value="<?php echo $item[0]->PRICE; ?>"/>
                            <?php endif;?>
                            <input type="hidden" id="qtySub1" name="quantity"/>
                            <button class="SIB" >add to cart</button>
                        </form>
                        <form action="redirectChck.php" method="post">
                            <input type="hidden" name="productNumber" value="<?php echo $item[0]->ITEMNO; ?>"/>
                            <?php if(isset($price)):?>
                                <input type="hidden" id="price" name="price" value="<?php echo $price; ?>"/>
                            <?php else: ?>
                                <input type="hidden" id="price" name="price" value="<?php echo $item[0]->PRICE; ?>"/>
                            <?php endif;?>
                            <input type="hidden" id="qtySub2" name="quantity"/>
                            <button class="SIB" >buy now</button>
                        </form>
                    </div>
                    <div class="mRestrictionsWarningBox">
                            <?php if((preg_match("/Accessory-.*/", $item[0]->TYPE)) &&
                                      (($item[0]->MANUFACTURER == "AAC (Advanced Armament)") || 
                                      ($item[0]->MANUFACTURER == "Gemtech") ||
                                      ($item[0]->MANUFACTURER == "GLOCK") ||
                                      ($item[0]->MANUFACTURER == "IWI - Israel Weapon Industries") ||
                                      ($item[0]->MANUFACTURER == "Q") ||
                                      ($item[0]->MANUFACTURER == "Trijicon") ||
                                      ($item[0]->MANUFACTURER == "SIG SAUER") ||
                                      ($item[0]->MANUFACTURER == "Winchester"))):?>
                            <p class="mRestrictionsWarningTitle">IMPORTANT!</p>
                            <p class="mRestrictionsWarning">The following Manufacturer: <u><b><?php echo $item[0]->MANUFACTURER?></b></u> does not allow accessories in their catalog to be drop-shipped to consumers.</p>
                            <p class="mRestrictionsWarning">This accessory will need to be shipped to Moden Edge Armory FFL Location.</p>
                            <?php endif;?>
                            <?php if((("Revolver" == $item[0]->TYPE) || 
                                     ("Rifle" == $item[0]->TYPE) || 
                                     ("Semi-Auto Pistol" == $item[0]->TYPE) ||
                                     ("Shotgun" == $item[0]->TYPE)) &&
                                      (($item[0]->MANUFACTURER == "FN") || 
                                      ($item[0]->MANUFACTURER == "Franklin Armory") ||
                                      ($item[0]->MANUFACTURER == "Gemtech") ||
                                      ($item[0]->MANUFACTURER == "GLOCK") ||
                                      ($item[0]->MANUFACTURER == "Heckler and Koch (HK USA)") ||
                                      ($item[0]->MANUFACTURER == "IWI - Israel Weapon Industries") ||
                                      ($item[0]->MANUFACTURER == "Marlin") ||
                                      ($item[0]->MANUFACTURER == "Q") ||
                                      ($item[0]->MANUFACTURER == "Ruger") ||
                                      ($item[0]->MANUFACTURER == "Smith and Wesson") ||
                                      ($item[0]->MANUFACTURER == "Springfield Armory") ||
                                      ($item[0]->MANUFACTURER == "Walther Arms") ||
                                      ($item[0]->MANUFACTURER == "Winchester"))):?>
                            <p class="mRestrictionsWarningTitle">IMPORTANT!</p>
                            <p class="mRestrictionsWarning">The following Manufacturer: <u><b><?php echo $item[0]->MANUFACTURER?></b></u> does not allow firearms in their catalog to be drop-shipped to consumers.</p>
                            <p class="mRestrictionsWarning">This firearms will need to be shipped to Moden Edge Armory FFL Location.</p>
                            <?php endif;?>
                        </div>
                </div>
                    
            </div>  
            <div class="moreItemContainerBox">
                <div class="moreItemDescBox">
                    <h4 class="moreItemDescTitle">PRODUCT INFORMATION & SPECS</h4>
                    <p>
                        <?php if($item[0]->MANUFACTURER != NULL) : ?>
                            <div class="moreItemDesc"> <b>MANUFACTURER: </b> <?php   echo $item[0]->MANUFACTURER; ?> </div>
                        <?php endif ?> 
                        
                        <?php if($item[0]->FAMILY != NULL) : ?>
                        <div class="moreItemDesc"> <b>FAMILY: </b> <?php echo $item[0]->FAMILY; ?> <br> </div>
                        <?php endif ?> 
                        
                        <?php if($item[0]->MODEL != NULL) : ?>
                        <div class="moreItemDesc"> <b>MODEL: </b> <?php echo $item[0]->MODEL; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->TYPE != NULL) : ?>
                        <div class="moreItemDesc"> <b>TYPE: </b> <?php echo $item[0]->TYPE; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->CALIBERGAUGE != NULL) : ?>
                        <div class="moreItemDesc"> <b>CALIBER/GAUGE: </b> <?php echo $item[0]->CALIBERGAUGE; ?> <br> </div>
                        <?php endif ?> 
                        
                        <?php if($item[0]->FINISHTYPE != NULL) : ?>
                        <div class="moreItemDesc"> <b>FINISH TYPE: </b> <?php echo $item[0]->FINISHTYPE; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->FINISH != NULL) : ?>
                        <div class="moreItemDesc"> <b>FINISH: </b> <?php echo $item[0]->FINISH; ?> <br> </div>
                        <?php endif ?> 
                        
                        <?php if($item[0]->FRAME != NULL) : ?>
                        <div class="moreItemDesc"> <b>FRAME: </b> <?php echo $item[0]->FRAME; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->STOCKFRAMEGRIPS != NULL) : ?>
                        <div class="moreItemDesc"> <b>STOCK/GRIPS: </b> <?php echo $item[0]->STOCKFRAMEGRIPS; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->BARRELLENGTH != NULL) : ?>
                        <div class="moreItemDesc"> <b>BARREL: </b> <?php echo $item[0]->BARRELLENGTH; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->OVERALLLENGTH != NULL) : ?>
                        <div class="moreItemDesc"> <b>OVERALL LENGTH: </b> <?php echo $item[0]->OVERALLLENGTH; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->CAPACITY != NULL) : ?>
                        <div class="moreItemDesc"> <b>CAPACITY: </b> <?php echo $item[0]->CAPACITY; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->MAGAZINE != NULL) : ?>
                        <div class="moreItemDesc"> <b>MAG DESCRIPTION: </b> <?php echo $item[0]->MAGAZINE; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->SIGHTS != NULL) : ?>
                        <div class="moreItemDesc"> <b>SIGHTS: </b> <?php echo $item[0]->SIGHTS; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->SIGHTSTYPE != NULL) : ?>
                        <div class="moreItemDesc"> <b>SIGHT TYPE: </b> <?php echo $item[0]->SIGHTSTYPE; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->WEIGHT != NULL) : ?>
                        <div class="moreItemDesc"> <b>WEIGHT: </b> <?php echo $item[0]->WEIGHT; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->PACKAGEWIDTH != NULL) : ?>
                        <div class="moreItemDesc"> <b>SHIPPING WEIGHT: </b> <?php echo $item[0]->PACKAGEWIDTH; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->SAFETY != NULL) : ?>
                        <div class="moreItemDesc"> <b>SAFETY FEATURES: </b> <?php echo $item[0]->SAFETY; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->MANUFACTURERMODELNO != NULL) : ?>
                        <div class="moreItemDesc"> <b>MFG MODEL NO: </b> <?php echo $item[0]->MANUFACTURERMODELNO; ?> <br> </div>
                        <?php endif ?> 

                        <?php if($item[0]->UPC != NULL) : ?>
                        <div class="moreItemDesc"> <b>UPC: </b> <?php echo $item[0]->UPC; ?> <br> </div>
                        <?php endif ?> 
                    </p>
                </div>
                <div class="moreItemsBox">
                    <h3 class="moreItemsTitle">RELATED</h3>
                    <div class="moreItems">
                    <?php $randIndex = count($Related);
                          $currentCount = 0;
                          $maxItemCount = 6;
                    ?>
                        <?php if($randIndex > 0) : ?> 
                            <?php for($x = 0; $x < 6; $x++):?>   
                                <?php if($currentCount < $maxItemCount) : ?> 
                                <?php $randItem = rand(0,$randIndex-1) ?>
                                <div class="slide products acP">
                                    <a class="link" href="item.php?itemNo=<?php echo $Related[$randItem]->ITEMNO;?>">
                                        <div class="productImgBox acpIB">
                                            <?php $imgName = substr($Related[$randItem]->IMAGENAME, 0, strpos($Related[$randItem]->IMAGENAME, '.')) . ".webp"; ?>  
                                            <img class="productImg" src="media/catalog/<?php echo $imgName; ?>" alt="<?php echo $imgName?>" />
                                        </div>
                                        <div class="productDescBox">
                                            <div class="productDesc acDs">
                                                <b><?php echo $Related[$randItem]->ITEMNO;?></b>
                                                <br>
                                                <?php echo $Related[$randItem]->DESCRIPTION1; ?>
                                            </div>
                                            <div class="productPrice acPr">
                                                <?php if($Related[$randItem]->ONSALE == "TRUE"): ?>
                                                    <p style="padding:0; margin:0; color:red;">SALE! $<?php echo number_format((float)($Related[$randItem]->MSRP - ($Related[$randItem]->MSRP*.05)), 2, '.', ''); ?></p>
                                                <?php else: ?>
                                                    $<?php echo number_format((float)$Related[$randItem]->MSRP, 2, '.', ''); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php $currentCount = $currentCount + 1;?>
                                <?php endif ?>
                            <?php endfor; ?>
                        <?php endif ?>
                    </div>
                    <!--<a class="link" href="shop.php?type=Accessory-%"><div class="SIB">see more</div></a>-->
                </div>
            </div>
        </div>  
    </div>


    <div class="section reviewsBox">
        <div class="contentContainer reviewContainer">    
            <div class="reviewsTextBox">
                <div class="revewTitle">Reviews</div>
            </div>
            <!--PHP: START-->
            <div class="reviewSlideContainer">
                <div class="reviewInnerContainer">
                    <div class="reviewSlide">
                    <div class="review">
                        <p class="reviewTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="reviewText">Aliquam in placerat leo, at congue lectus. Nullam hendrerit magna vel sapien iaculis, a bibendum libero viverra. Suspendisse potenti.</p>
                        <p class="reviewName">Andriy B.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="reviewText">Aliquam in placerat leo, at congue lectus. Nullam hendrerit magna vel sapien iaculis, a bibendum libero viverra. Suspendisse potenti.</p>
                        <p class="reviewName">Andriy B.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="reviewText">Aliquam in placerat leo, at congue lectus. Nullam hendrerit magna vel sapien iaculis, a bibendum libero viverra. Suspendisse potenti.</p>
                        <p class="reviewName">Andriy B.</p>
                    </div>
                    </div>
                    <div class="reviewSlide">
                    <div class="review">
                        <p class="reviewTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="reviewText">Aliquam in placerat leo, at congue lectus. Nullam hendrerit magna vel sapien iaculis, a bibendum libero viverra. Suspendisse potenti.</p>
                        <p class="reviewName">Andriy B.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="reviewText">Aliquam in placerat leo, at congue lectus. Nullam hendrerit magna vel sapien iaculis, a bibendum libero viverra. Suspendisse potenti.</p>
                        <p class="reviewName">Andriy B.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="reviewText">Aliquam in placerat leo, at congue lectus. Nullam hendrerit magna vel sapien iaculis, a bibendum libero viverra. Suspendisse potenti.</p>
                        <p class="reviewName">Andriy B.</p>
                    </div>
                    </div>
                    <div class="reviewSlide">
                    <div class="review">
                        <p class="reviewTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="reviewText">Aliquam in placerat leo, at congue lectus. Nullam hendrerit magna vel sapien iaculis, a bibendum libero viverra. Suspendisse potenti.</p>
                        <p class="reviewName">Andriy B.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="reviewText">Aliquam in placerat leo, at congue lectus. Nullam hendrerit magna vel sapien iaculis, a bibendum libero viverra. Suspendisse potenti.</p>
                        <p class="reviewName">Andriy B.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="reviewText">Aliquam in placerat leo, at congue lectus. Nullam hendrerit magna vel sapien iaculis, a bibendum libero viverra. Suspendisse potenti.</p>
                        <p class="reviewName">Andriy B.</p>
                    </div>
                    </div>
                    <div class="reviewSlide">
                    <div class="review">
                        <p class="reviewTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="reviewText">Aliquam in placerat leo, at congue lectus. Nullam hendrerit magna vel sapien iaculis, a bibendum libero viverra. Suspendisse potenti.</p>
                        <p class="reviewName">Andriy B.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="reviewText">Aliquam in placerat leo, at congue lectus. Nullam hendrerit magna vel sapien iaculis, a bibendum libero viverra. Suspendisse potenti.</p>
                        <p class="reviewName">Andriy B.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="reviewText">Aliquam in placerat leo, at congue lectus. Nullam hendrerit magna vel sapien iaculis, a bibendum libero viverra. Suspendisse potenti.</p>
                        <p class="reviewName">Andriy B.</p>
                    </div>
                    </div>
                </div>
            </div>
            <!--PHP: END-->
        </div>
    </div>
<?php include("includes/footer.php"); ?>

<script>
function change(src, className){
    document.getElementById('main').src = src;
    document.getElementById('main').className = className;
}
</script>
