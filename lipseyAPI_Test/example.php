<?php
//run the following to setup autoloading
//composer dump-autoload -o
require_once('vendor/autoload.php'); //only needed if not run anywhere else


use lipseys\ApiIntegration\LipseysClient;


$client = new LipseysClient("modernedgearmorydropship@gmail.com", "123456!");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--META-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
    <link rel="stylesheet" href="../frontend/index.css">
    <!--JAVASCRIPT-->

    <!--FONTS-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Black+Ops+One&display=swap');
    </style>
    <!--TITLE-->
    <title>Modern Edge Armory | Home</title>

    <!--FAVICON-->
    <link rel="icon" type="image/png" href="../frontend/media/star.png"/>

</head>
<body>
    <!--Header-->
    <div class="header">
        <div class="contentContainer headerContainer">
            <div class="headerLogoBox">
                <a class="link" href="../frontend/index.html"><img class="headerLogo" src="../frontend/media/MEA_LOGO_LTE.png"/></a>
            </div>
            <div class="headerSearchBox Show">
                <form class="headerSearchForm" action="/action_page.php">
                    <input class="headerSearch" type="text" placeholder="Search..." name="search">
                    <button class="headerSubmit" type="submit"><i class="searchIcon"></i></button>
                </form>
            </div>
            <div class="headerMemberLinksBox">
                <div class="headerMemberLinks">
                    <a class="link" href="login.html"><div class="SignIn">Sign In</div></a>
                    <div class="link Seperator">|</div>
                    <a class="link" href="login.html"><img class="Cart" src="../frontend/media/cart.svg"/></a>
                </div>
            </div>
            <div class="headerSearchBox noShow">
                <form class="headerSearchForm" action="/action_page.php">
                    <input class="headerSearch" type="text" placeholder="Search..." name="search">
                    <button class="headerSubmit" type="submit"><i class="searchIcon"></i></button>
                </form>
            </div>
        </div>
    </div>

    <!--Main Page Body-->
    <div class="section heroBox">
        <!--ADD Caroucel for images-->
        <div class="contentContainer">
            <!--PHP: START-->
            <div class="heroSlideContainer">
                <div class="heroInnerContainer">
                    <div class="heroSlide">
                        <img class="heroImg" src="../frontend/media/hero.svg" />
                    </div>
                    <div class="heroSlide">
                        <img class="heroImg" src="../frontend/media/banner.svg" />
                    </div>
                    <div class="heroSlide">
                        <img class="heroImg" src="../frontend/media/banner.svg" />
                    </div>
                    <div class="heroSlide">
                        <img class="heroImg" src="../frontend/media/banner.svg" />
                    </div>
                </div>
            </div>
            <!--PHP: END-->
        </div>
    </div>
    <div class="section quickLinksBox">
        <div class="contentContainer">
            <div class="quickLinksRow">
                <a class="link" href="shop.html"><div class="quickLink qlAmmo"><p class="cornerTitle">Ammunition</p></div></a>
                <a class="link" href="shop.html"><div class="quickLink qlHandGun"><p class="cornerTitle">Handguns</p></div></a>
                <a class="link" href="shop.html"><div class="quickLink qlAccessories"><p class="cornerTitle">Accessories</p></div></a>
                <a class="link" href="shop.html"><div class="quickLink qlKnives"><p class="cornerTitle">Knives</p></div></a>
            </div>
            <div class="quickLinksRow qlr2Space">
                <a class="link" href="shop.html"><div class="quickLink qlOptics"><p class="cornerTitle">Optics</p></div></a>
                <a class="link" href="shop.html"><div class="quickLink qlRifles"><p class="cornerTitle">Rifles</p></div></a>
                <a class="link" href="shop.html"><div class="quickLink qlShotguns"><p class="cornerTitle">Shotguns</p></div></a>
                <a class="link" href="shop.html"><div class="quickLink qlDeals"><p class="cornerTitle">Deals</p></div></a>
            </div>
        </div>
    </div>
    <?php print_r($client->CatalogItem("RU1022RB")); ?>
    <?php $img = $client->CatalogItem("RU1022RB")['data']['imageName']; ?>
    <div class="section featuredItemsBox">
        <div class="slider">
            <div class="contentContainer textContainer">    
                <div class="featuredItemsTextBox">
                    <div class="fitTitle">daily specials</div>
                    <div class="fitSubTitle Show"><a class="link" href="shop.html">see all</a></div></a>
                </div>
            </div>
            <!--PHP: START-->
            <div class="slide-track">
                <div class="slide products">
                    <a class="link" href="item.html">
                        <div class="productImgBox">
                            <img class="productImg" src="https://www.lipseyscloud.com/images/<?php echo $img;?>" alt="" />
                        </div>
                        <div class="productDescBox">
                            <div class="productDesc">
                                Colt Anaconda Stainless 44Mag/44Spl 8" Barrel 6Rd
                            </div>
                            <div class="productPrice">
                                $1,799.00
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="slide products">
                    <a class="link" href="item.html">
                        <div class="productImgBox">
                            <img class="productImg" src="https://www.lipseyscloud.com/images/<?php echo $img;?>" alt="" />
                        </div>
                        <div class="productDescBox">
                            <div class="productDesc">
                                Colt Anaconda Stainless 44Mag/44Spl 8" Barrel 6Rd
                            </div>
                            <div class="productPrice">
                                $1,799.00
                            </div>
                        </div>
                    </a>
                </div>
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

    <!--Footer-->
    <div class="footer">
        <div class="newsletterBox">
            <div class="contentContainer">  
                <div class="newsletterTextBox Show">
                    <p class="newsletterText">Subscribe to our newsletter, stay updated on our latest prices, and newest arrivals!</p>
                </div>
                <div class="newsletterEntryBox Show">
                    <form class="footerSubscribeForm" action="/action_page.php">
                        <input class="footerEmailEntry" type="email" placeholder="Enter your email..." name="email">
                        <button class="footerSubmit" type="submit">Subscribe</button>
                    </form>
                </div>
                <div class="newsletterSocialBox">
                    <p class="newsletterText nltSmaller ">Follow Us</p>
                    <a href="https://www.facebook.com/"><img class="socialIcons" src="media/facebookLogo.svg" alt="facebook_Logo"/></a>
                    <a href="https://www.instagram.com/"><img class="socialIcons" src="media/instagramLogo.svg" alt="instagram_Logo"/></a>
                    <a href="https://www.youtube.com/"><img class="socialIcons" src="media/youtubeLogo.svg" alt="youtube_Logo"/></a>
                </div>
            </div>
        </div>
        <div class="footerLinksBox">
            <div class="contentContainer footerFlex">  
                <div class="footerLinks f1">
                    <div class="f1Title">contact us</div>
                    <ul class="f1Table">
                        <li class="footerLink">T: (210) 842 0702</li>
                        <li class="footerLink">E: sales@ModernEdgeArmory.com</li>
                        <li class="footerLink">E: marketing@ModernEdgeArmory.com</li>
                    </ul>
                </div>
                <div class="footerLinks f2">
                    <div class="f2Title">sitemap</div>
                    <ul class="f2Table">
                        <a class="footerLink" href="index.html"><li>Home</li></a>
                        <a class="footerLink" href="about.html"><li>About</li></a>
                        <a class="footerLink" href="shop.html"><li>Shop</li></a>
                        <a class="footerLink" href="cart.html"><li>Cart</li></a>
                        <a class="footerLink" href="checkout.html"><li>Checkout</li></a>
                        <a class="footerLink" href="login.html"><li>Login</li></a>
                        <a class="footerLink" href="login.html"><li>Register</li></a>
                        <a class="footerLink" href="#"><li>Track Order</li></a>
                    </ul>
                </div>
                <div class="footerLinks f3">
                    <div class="f3Title">legal</div>
                    <ul class="f3Table">
                        <a class="footerLink" href="#"><li>Return Policy</li></a>
                        <a class="footerLink" href="#"><li>Privacy Policy</li></a>
                        <a class="footerLink" href="#"><li>Shipping Restrictions</li></a>
                        <a class="footerLink" href="#"><li>Terms & Conditions</li></a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footerCPBox">
            <div class="contentContainer">  
                <div class="footerLogoBox">
                    <img class="footerLogo" src="../frontend/media/MEA_LOGO_LTE.png"/>
                </div>
                <div class="footerCpText">Copyright © 2022 Modern Edge Armory. All rights reserved</div>
            </div>
        </div>
    </div> 

</body>
</html>


<?php 

//print_r($client->PricingAndQuantity());
//print_r($client->AllocationPricingAndQuantity());
//print_r($client->ValidateItem("RU1022RB"));
/*print_r($client->Order(array(
    "PoNumber" => "Po Number",
    "EmailConfirmation" => true,
    "DisableEmail" => true,
    "Items" => array(
        array(
            "ItemNo" => "HERR22MBS6",
            "Quantity" => 1,
            "Note" => "note"
        )
    )
));*/
/*print_r($client->AllocationOrder(array(
    "PONumber" => "Po Number",
    "EmailConfirmation" => true,
    "DisableEmail" => true,
    "Items" => array(
        array(
            "ItemNo" => "RULCP",
            "Quantity" => 1,
            "Note" => "note"
        )
    )
)));*/
/*print_r($client->AllocationOrder(array(
    "PONumber" => "Po Number",
    "EmailConfirmation" => true,
    "DisableEmail" => true,
    "Items" => array(
        array(
            "ItemNo" => "RULCP",
            "Quantity" => 1,
            "Note" => "note"
        )
    )
)));*/
/*
print_r($client->DropShipAccessories(array(
    "PoNumber" => "PoNumber",
    "BillingName" => "BillingName",
    "BillingAddressLine1" => "BillingAddressLine1",
    "BillingAddressLine2" => "BillingAddressLine2",
    "BillingAddressCity" => "BillingAddressCity",
    "BillingAddressState" => "LA",
    "BillingAddressZip" => "70764",
    "ShippingName" => "ShippingName",
    "ShippingAddressLine1" => "ShippingAddressLine1",
	"ShippingAddressLine2" => "ShippingAddressLine2",
	"ShippingAddressCity" => "Baton Rouge",
	"ShippingAddressState" => "LA",
	"ShippingAddressZip" => "70764",
	"MessageForSalesExec" => "Thanks",
    "DisableEmail" => true,
    "Overnight" => false,
    "Items" => array(
        array(
            "ItemNo" => "LP171714",
            "Quantity" => 1,
            "Note" => ""
        )
    )
)));*/

/*print_r($client->DropShipFirearms(array(
    "Ffl" => "123123123123123",
    "Name" => "Name",
    "PoNumber" => "Po Number",
    "Phone" => "1231231234",
    "DelayShipping" => false,
    "DisableEmail" => true,
    "Items" => array(
        array(
            "ItemNo" => "RU1022RB",
            "Quantity" => 1,
            "Note" => "note"
        )
    )
)));*/
$date = new DateTime();
$date->modify('-5 day');
//print_r($client->OneDaysShipping($date->format("m/d/y")));
?>