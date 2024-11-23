<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="media/star.png">
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <div id="parallaxBox">

        <div id="logo"></div>
        <div class="arrowDown bounce"></div>


        <div id="parallaxCover"></div>
    </div>
    <div id="mainContentBox">
        <div id="mainContentTitle">welcome to <br id="showLater"> practical <div id="TwoTitle">2</div> tactical</div>
        <div id="videoBox">
            <video id="video" controls>
                <source src="media/Modern_Edge_Armory_Video_2.mp4" type="video/mp4">
            </video>
        </div>
        <div id="horizontalBorder"></div>
        <div id="mainContentContentBox">
            <div id="newsletterBox">
                <div id="newsletterTitle">newsletter</div>
                <div id="newsletterText">
                    Stay up to date on the latest news, by signing up to our newsletter. Learn about store updates, limited edition offers and more special surprises!
                </div>
                <div id="newsletterSubBox">
                    <form id="newsletterForm" method="post" name="myemailform" action="form-to-email.php">
                        <input id="emailInput" type="text" id="email" name="email" required>
                        <input id="subBtn" type="submit" name="submit" value="SUBSCRIBE">
                    </form>
                </div>
            </div>
            <div id="verticalBorder"></div>
            <div id="contactBox">
                <div id="newsletterTitle">Contact Us</div>
                <div class="contactInfoBox firstContactBox">
                    <div class="contactImg emailImg"></div>
                    <div class="contactText">sales@ModernEdgeArmory.com</div>
                </div>
                <div class="contactInfoBox">
                    <div class="contactImg emailImg"></div>
                    <div class="contactText">marketing@ModernEdgeArmory.com</div>
                </div>
                <div class="contactInfoBox">
                    <div class="contactImg phoneImg"></div>
                    <div class="contactText">(210) 842 0702</div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <p id="copyRight">Copyright &copy; 2022 Modern Edge Armory. All rights reserved</p>
    </div>
</body>
</html>