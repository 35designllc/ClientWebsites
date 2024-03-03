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
                <a class="link" href="shop.php?type=Accessory-Ammunition"><div class="quickLink qlAmmo"><p class="cornerTitle">Ammunition</p></div></a>
                <a class="link" href="shop.php?type=Revolver"><div class="quickLink qlHandGun"><p class="cornerTitle">Handguns</p></div></a>
                <a class="link" href="shop.php?type=Accessory-Magazines"><div class="quickLink qlAccessories"><p class="cornerTitle">Accessories</p></div></a>
                <a class="link" href="shop.php?type=Accessory-Knives"><div class="quickLink qlKnives"><p class="cornerTitle">Knives</p></div></a>
            </div>
            <div class="quickLinksRow qlr2Space">
                <a class="link" href="shop.php?type=Accessory-Scopes"><div class="quickLink qlOptics"><p class="cornerTitle">Optics</p></div></a>
                <a class="link" href="shop.php?type=Rifle"><div class="quickLink qlRifles"><p class="cornerTitle">Rifles</p></div></a>
                <a class="link" href="shop.php?type=Shotgun"><div class="quickLink qlShotguns"><p class="cornerTitle">Shotguns</p></div></a>
                <a class="link" href="shop.php?type=All"><div class="quickLink qlDeals"><p class="cornerTitle">Deals</p></div></a>
            </div>
        </div>
    </div>
    <div class="section featuredItemsBox">
        <div class="slider">
            <div class="contentContainer textContainer">    
                <div class="featuredItemsTextBox">
                    <div class="fitTitle">new arrivals</div>
                    <div class="fitSubTitle Show"><a class="link" href="shop.php?type=All">see all</a></div></a>
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
                                        $<?php echo number_format((float)$products[$x]->PRICE, 2, '.', ''); ?>
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
            <a class="link" href="shop.php?type=All"><div class="bestsellersBox"><p class="cornerTitle olbTitle">Best Sellers</p></div></a>
            <a class="link" href="shop.php?type=All"><div class="clearanceBox"><p class="cornerTitle olbTitle">Clearance</p></div></a>
        </div>
    </div>
    <div class="section featuredItemsBox">
        <div class="slider">
            <div class="contentContainer textContainer">    
                <div class="featuredItemsTextBox">
                    <div class="fitTitle">daily specials</div>
                    <div class="fitSubTitle Show"><a class="link" href="shop.php?type=All">see all</a></div></a>
                </div>
            </div>
            <!--PHP: START-->
            <div class="slide-track">
            <?php if($products) : ?>
                    <?php for($x = 30; $x <= 60; $x++):?> 
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
                                        $<?php echo number_format((float)$products[$x]->PRICE, 2, '.', ''); ?>
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
