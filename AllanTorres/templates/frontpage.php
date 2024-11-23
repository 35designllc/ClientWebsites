<?php include("includes/header.php"); ?>
    <!--Main Page Body-->
    <div class="section heroBox">
        <!--ADD Caroucel for images-->
        <div class="contentContainer">
            <!--PHP: START-->
            <div class="heroSlideContainer">
                <div class="heroInnerContainer">
                    <div class="heroSlide">
                        <img class="heroImg" src="media/webImages/hero.svg" />
                    </div>
                    <div class="heroSlide">
                        <img class="heroImg" src="media/webImages/banner.svg" />
                    </div>
                    <div class="heroSlide">
                        <img class="heroImg" src="media/webImages/banner.svg" />
                    </div>
                    <div class="heroSlide">
                        <img class="heroImg" src="media/webImages/banner.svg" />
                    </div>
                </div>
            </div>
            <!--PHP: END-->
        </div>
    </div>
    <div class="section quickLinksBox">
        <div class="contentContainer">
            <div class="quickLinksRow">
                <a class="link" href="redirectShop.php?type=Accessory-Ammunition"><div class="quickLink qlAmmo"><p class="cornerTitle">Ammunition</p></div></a>
                <a class="link" href="redirectShop.php?type=Revolver"><div class="quickLink qlHandGun"><p class="cornerTitle">Handguns</p></div></a>
                <a class="link" href="redirectShop.php?type=Accessory-Magazines"><div class="quickLink qlAccessories"><p class="cornerTitle">Accessories</p></div></a>
                <a class="link" href="redirectShop.php?type=Accessory-Knives"><div class="quickLink qlKnives"><p class="cornerTitle">Knives</p></div></a>
            </div>
            <div class="quickLinksRow qlr2Space">
                <a class="link" href="redirectShop.php?type=Accessory-Scopes"><div class="quickLink qlOptics"><p class="cornerTitle">Optics</p></div></a>
                <a class="link" href="redirectShop.php?type=Rifle"><div class="quickLink qlRifles"><p class="cornerTitle">Rifles</p></div></a>
                <a class="link" href="redirectShop.php?type=Shotgun"><div class="quickLink qlShotguns"><p class="cornerTitle">Shotguns</p></div></a>
                <a class="link" href="redirectShop.php?type=Accessory-Silencer Accessories"><div class="quickLink qScilencer"><p class="cornerTitle">Silencers</p></div></a>
            </div>
        </div>
    </div>
    <div class="section featuredItemsBox">
        <div class="slider">
            <div class="contentContainer textContainer">    
                <div class="featuredItemsTextBox">
                    <div class="fitTitle">new arrivals</div>
                    <div class="fitSubTitle Show"><a class="link" href="redirectShop.php?type=All">see all</a></div></a>
                </div>
            </div>
            <!--PHP: START-->
            <div class="slide-track">
                <?php if($products) : ?>
                    <?php for($x = 0; $x <= 30; $x++):?>   
                        
                        <?php if($products[$x]->ITEMTYPE == "Firearm") : ?>
                        <div class="slide products">
                            <a class="link" href="item.php?itemNo=<?php echo $products[$x]->ITEMNO; ?>">
                                <div class="productImgBox">
                                    <?php $imgName = substr($products[$x]->IMAGENAME, 0, strpos($products[$x]->IMAGENAME, '.')) . ".webp"; ?>  
                                    <img class="productImg" src="media/catalog/<?php echo $imgName; ?>" alt="" />
                                </div>
                                <div class="productDescBox">
                                    <div class="productDesc">
                                        <b><?php echo $products[$x]->MANUFACTURER; ?></b>
                                        <br>
                                        <?php echo $products[$x]->DESCRIPTION1; ?>
                                    </div>
                                    <div class="productPrice">
                                        $<?php echo number_format((float)$products[$x]->MSRP, 2, '.', ''); ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif ?>
                    <?php endfor;?>
                <?php else : ?>
                    <p>No Products To Display</p>
                <?php endif ?>
            </div>
            <!--PHP: END-->
        </div>
    </div>
    <div class="section otherLinksBox">
        <div class="contentContainer">  
            <a class="link" href="redirectShop.php?type=All"><div class="bestsellersBox"><p class="cornerTitle olbTitle">Best Sellers</p></div></a>
            <a class="link" href="redirectShop.php?type=sale"><div class="clearanceBox"><p class="cornerTitle olbTitle">Clearance</p></div></a>
        </div>
    </div>
    <div class="section featuredItemsBox">
        <div class="slider">
            <div class="contentContainer textContainer">    
                <div class="featuredItemsTextBox">
                    <div class="fitTitle">exclusive</div>
                    <div class="fitSubTitle Show"><a class="link" href="redirectShop.php?type=Exclusive">see all</a></div></a>
                </div>
            </div>
            <!--PHP: START-->
            <div class="slide-track">
            <?php if($exclusiveProducts) : ?>
                    <?php for($x = 0; $x <= 30; $x++):?> 
                        <?php if($exclusiveProducts[$x]->ITEMTYPE == "Firearm") : ?>
                        <div class="slide products">
                            <a class="link" href="item.php?itemNo=<?php echo $exclusiveProducts[$x]->ITEMNO; ?>">
                                <div class="productImgBox">
                                    <?php $imgName = substr($exclusiveProducts[$x]->IMAGENAME, 0, strpos($exclusiveProducts[$x]->IMAGENAME, '.')) . ".webp"; ?> 
                                    <img class="productImg" src="media/catalog/<?php echo $imgName; ?>" alt="" />
                                </div>
                                <div class="productDescBox">
                                    <div class="productDesc">
                                        <b><?php echo $exclusiveProducts[$x]->MANUFACTURER; ?></b>
                                        <br>
                                        <?php echo $exclusiveProducts[$x]->DESCRIPTION1; ?>
                                    </div>
                                    <div class="productPrice">
                                        $<?php echo number_format((float)$exclusiveProducts[$x]->MSRP, 2, '.', ''); ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif ?>
                    <?php endfor;?>
                <?php else : ?>
                    <p>No Products To Display</p>
                <?php endif ?>
            </div>
            <!--PHP: END-->
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
                        <p class="reviewTitle">Received great customer service!</p>
                        <p class="reviewText">The deals offered by Modern Edge can't be beat and the military discount is a huge plus. Highly recommend this shop to everyone interested in buying a firearm or accessories.</p>
                        <p class="reviewName">Johnny R.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle"> Great customer service and great prices!!!</p>
                        <p class="reviewText">Alann suggested some AR-15's that he thought I might be interested in. I ended up going with one of his suggestions and I ended up saving some money over what my initial choice would have cost. </p>
                        <p class="reviewName">Terry S.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Personable, professional, and military friendly!</p>
                        <p class="reviewText">Clean shop, great prices! Highest recommendations.</p>
                        <p class="reviewName">Allen S.</p>
                    </div>
                    </div>
                    <div class="reviewSlide">
                    <div class="review">
                        <p class="reviewTitle">Flawless customer service!</p>
                        <p class="reviewText">Lightning fast turnaround and I got exactly what I wanted. The price was significantly less than other places I had looked. It's unfortunate that I can't give 10 🌟 as a rating.</p>
                        <p class="reviewName">Trevor D.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Fantastic Owner!</p>
                        <p class="reviewText">Best prices in town!</p>
                        <p class="reviewName">Mike B.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Great owner with philanthropist heart.</p>
                        <p class="reviewText">Known Alann for years and would always recommend him to anyone.  Any time I have had any questions he is always available to help me.</p>
                        <p class="reviewName">Thomas C.</p>
                    </div>
                    </div>
                    <div class="reviewSlide">
                    <div class="review">
                        <p class="reviewTitle">Great customer service!</p>
                        <p class="reviewText">Wide selection, but if they don’t have it, they can get it!</p>
                        <p class="reviewName">Reymond M.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Expedient, accurate and friendly!</p>
                        <p class="reviewText">I found Modern's price for my new rifle was the lowest and the service was of the highest quality in all respects.</p>
                        <p class="reviewName">Chuck S.</p>
                    </div>
                    <div class="review">
                        <p class="reviewTitle">Very Helpful!</p>
                        <p class="reviewText">Helped me get exactly what I was looking for.</p>
                        <p class="reviewName">Gloria M.</p>
                    </div>
                    </div>

                    <!--<div class="reviewSlide">
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
                    </div>-->
                </div>
            </div>
            <!--PHP: END-->
        </div>
    </div>
<?php include("includes/footer.php"); ?>
