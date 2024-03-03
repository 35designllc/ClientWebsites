<!DOCTYPE html>
<html lang="en">
<head>
    <!--META-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
    <link rel="stylesheet" href="<?php echo BASE_URI; ?>templates/css/index.css">
    <!--JAVASCRIPT-->

    <!--FONTS-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Black+Ops+One&display=swap');
    </style>
    <!--TITLE-->
    <title>Modern Edge Armory | Home</title>

    <!--FAVICON-->
    <link rel="icon" type="image/png" href="media/webImages/star.png"/>

</head>
<body>
    <!--Header-->
    <div class="header">
        <div class="contentContainer headerContainer">
            <div class="headerLogoBox">
                <a class="link" href="index.php"><img class="headerLogo" src="media/webImages/MEA_LOGO_LTE.png"/></a>
            </div>
            <div class="headerSearchBox Show">
                <form class="headerSearchForm" action="shop.php" method="post">
                    <input class="headerSearch" type="text" placeholder="Search..." name="search">
                    <button class="headerSubmit" type="submit"><i class="searchIcon"></i></button>
                </form>
            </div>
            <div class="headerMemberLinksBox">
                <div class="headerMemberLinks">
                    <a class="link" href="login.php"><div class="SignIn">Sign In</div></a>
                    <div class="link Seperator">|</div>
                    <a class="link" href="cart.php"><img class="Cart" src="media/webImages/cart.svg"/></a>
                </div>
            </div>
            <div class="headerSearchBox noShow">
                <form class="headerSearchForm" action="shop.php" method="post">
                    <input class="headerSearch" type="text" placeholder="Search..." name="search">
                    <button class="headerSubmit" type="submit"><i class="searchIcon"></i></button>
                </form>
            </div>
        </div>
    </div>