    <!--Footer-->
    <div class="footer">
        <div class="emailContactFormBox">
            <div class="contentContainer footer_contentContainer">
                <div class="footerContactFormTitleBox">
                    <div class="footerContactFormTitle">Looking for something specific?</div>
                </div>
                <form class="footerContactForm" method="POST" name="myContactForm" action="emailRedirect.php" enctype="application/x-www-form-urlencoded">
                    <input class="footerEmailContactEntry" id="email" type="email"  name="email" placeholder="Enter your email." required>
                    <textarea class="footerContactEntry" id="text" type="text" name="text" placeholder="How can we help?" required></textarea>
                    <input class="footerContactSubmit" type="submit" name="footerContactSubmit" value="Submit">
                </form>
            </div>
        </div>
        <div class="newsletterBox">
            <div class="contentContainer">  
                <div class="newsletterTextBox Show">
                    <p class="newsletterText">Subscribe to our newsletter, stay updated on our latest prices, and newest arrivals!</p>
                </div>
                <div class="newsletterEntryBox Show">
                    <form class="footerSubscribeForm" method="POST" name="myemailform" action="emailRedirect.php" enctype="application/x-www-form-urlencoded">
                        <input class="footerEmailEntry" id="email" type="email"  name="email" placeholder="Enter your email..." required>
                        <input class="footerSubmit" type="submit" name="newsletterSubscribe" value="Subscribe">
                    </form>
                </div>
                <div class="newsletterSocialBox">
                    <p class="newsletterText nltSmaller ">Follow Us</p>
                    <a href="https://www.facebook.com/"><img class="socialIcons" src="media/webImages/facebookLogo.svg" alt="facebook_Logo"/></a>
                    <a href="https://www.instagram.com/"><img class="socialIcons" src="media/webImages/instagramLogo.svg" alt="instagram_Logo"/></a>
                    <a href="https://www.youtube.com/"><img class="socialIcons" src="media/webImages/youtubeLogo.svg" alt="youtube_Logo"/></a>
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
                        <a class="footerLink" href="index.php"><li>Home</li></a>
                        <a class="footerLink" href="about.php"><li>About</li></a>
                        <a class="footerLink" href="redirectShop.php?type=All"><li>Shop</li></a>
                        <a class="footerLink" href="cart.php"><li>Cart</li></a>
                        <a class="footerLink" href="checkout.php"><li>Checkout</li></a>
                        <!--<a class="footerLink" href="login.php"><li>Login</li></a>
                        <a class="footerLink" href="login.php"><li>Register</li></a>
                        <a class="footerLink" href="#"><li>Track Order</li></a>-->
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
                    <img class="footerLogo" src="media/webImages/MEA_LOGO_LTE.png"/>
                </div>
                <div class="footerCpText">Copyright © 2022 Modern Edge Armory. All rights reserved</div>
            </div>
        </div>
    </div> 

</body>
</html>