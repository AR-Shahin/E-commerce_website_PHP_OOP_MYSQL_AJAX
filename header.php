<?php require_once 'vendor/autoload.php';
session_start();
$page = explode('/',$_SERVER['PHP_SELF']);
$page = end($page);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
    <!--<![endif]-->

    <head>
        <title>Home page</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fav icon -->
        <link rel="shortcut icon" href="img/favicon.ico">

        <!-- Font -->
        <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,900,700,700italic,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700%7CDancing+Script%7CMontserrat:400,700%7CMerriweather:400,300italic%7CLato:400,700,900' rel='stylesheet' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Cantata+One' rel='stylesheet' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet' type='text/css'>
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!--flex slider stylesheet-->
        <link rel="stylesheet" href="css/flexslider.css" />
        <!--lightbox stylesheet-->
        <link rel="stylesheet" href="css/image-light-box.css" />
        <!-- Magnific Popup -->
        <link href="css/magnific-popup.css" rel="stylesheet">

        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skin-lblue.css">

        <link rel="stylesheet" href="css/ecommerce.css">

        <!-- Owl carousel -->
        <link href="css/owl.carousel.css" rel="stylesheet">

        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" type="text/css" href="css/revolutionslider_settings.css" media="screen" />

        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>

    <body class="style-14">

        <!-- Start Loading -->
        <section class="loading-overlay">
            <div class="Loading-Page">
                <h1 class="loader">Loading...</h1>
            </div>
        </section>
        <!-- End Loading  -->

        <!-- start header -->
        <header>
            <!-- Top bar starts -->
            <div class="top-bar navbar-fixed-top">
                <div class="container">
                    <!-- Contact starts -->
                    <div class="tb-contact pull-left">
                        <!-- Email -->
                        <i class="fa fa-envelope color"></i> &nbsp; <a href="mailto:devshahin107@gmail.com">contact@domain.com</a>
                        &nbsp;&nbsp;
                        <!-- Phone -->
                        <i class="fa fa-phone color"></i>    +8801754100439
                    </div>
                    <!-- Contact ends -->

                    <!-- Shopping kart starts -->
                    <div class="tb-shopping-cart pull-right">
                        <div class="tb-social pull-right" style="margin-left:8px;">
                            <div class="brand-bg text-right">
                                <!-- Brand Icons -->
                                <?php
                                if(isset($_SESSION['cus_id'])){ ?>
                                <a href="logout.php" class="btn btn-xs btn-danger" style="color: #fff;">Logout</a>
                              <?php } ?>
                                <?php
                                if(!isset($_SESSION['cus_id'])){ ?>
                                <a href="signin.php" class="btn btn-xs btn-info" style="color: #fff;">Log in</a>
                                    <a href="signup.php" class="btn btn-xs btn-success" style="color: #fff;">Registration</a>
                                <?php } ?>
                                <?php
                                if(isset($_SESSION['cusname'])){ ?>
                                    <span style="color: #fff;margin-left:5px;">Hi <?= $_SESSION['cusname']?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- Link with badge -->
                        <a href="#" class="btn btn-white btn-xs b-dropdown"><i class="fa fa-shopping-cart"></i> <i class="fa fa-angle-down color"></i> <span class="badge badge-color">0</span></a>
                        <!-- Dropdown content with item details -->
                        <div class="b-dropdown-block">
                            <!-- Heading -->
                            <h4><i class="fa fa-shopping-cart color"></i> Your Items</h4>
                            <ul class="list-unstyled" id="cart_items">
                                <!-- Item 1 -->
                                <li id="nullll">
                                    <!-- Item image -->
                                    <div class="cart-img">
                                        <a href="#"><img src="img/ecommerce/view-cart/1.png" alt="" class="img-responsive" /></a>
                                    </div>
                                    <!-- Item heading and price -->
                                    <div class="cart-title">
                                        <h5><a href="#">Premium Quality Shirt</a></h5>
                                        <!-- Item price -->
                                        <span class="label label-color label-sm">$1,90</span>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                            </ul>

                            <?php
                            if(isset($_SESSION['cus_id'])){ ?>
                                <a href="cart.php" class="btn btn-white btn-sm">View Cart</a> &nbsp; <a href="checkout.php" class="btn btn-color btn-sm">Checkout</a>
                            <?php } ?>

                        </div>
                    </div>
                    <!-- Shopping kart ends -->
                    <!-- Search section for responsive design -->

                    <div class="tb-search pull-left">
                        <a href="#" class="b-dropdown"><i class="fa fa-search square-2 rounded-1 bg-color white"></i></a>
                        <div class="b-dropdown-block">
                            <form>
                                <!-- Input Group -->
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Typggge Something" >
                                    <span class="input-group-btn">
                                        <button class="btn btn-color" type="button">Search</button>
                                    </span>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- Search section ends -->

                    <!-- Social media starts -->
                    <div class="tb-social pull-right">
                        <div class="brand-bg text-right">
                            <!-- Brand Icons -->
                            <a href="#" class="facebook"><i class="fa fa-facebook square-2 rounded-1"></i></a>
                            <a href="#" class="twitter"><i class="fa fa-twitter square-2 rounded-1"></i></a>
                            <a href="#" class="google-plus"><i class="fa fa-google-plus square-2 rounded-1"></i></a>
                        </div>
                    </div>

                    <!-- Social media ends -->

                    <div class="clearfix"></div>
                </div>
            </div>

            <!-- Top bar ends -->

            <!-- Header One Starts -->
            <div class="header-1" style="margin-top:25px;">

                <!-- Container -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <!-- Logo section -->
                            <div class="logo">
                                <h1><a href="index.php"><i class="fa fa-bookmark-o mr-1"></i> AR Shop</a></h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-2 col-sm-5 col-sm-offset-3 hidden-xs">
                            <!-- Search Form -->
                            <?php
                            if($page === 'index.php'){
                            ?>
                            <div class="header-search">
                                <form>
                                    <!-- Input Group -->
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Type Something" name="search_btn" id="search_btn">
                                        <span class="input-group-btn">
                                            <button class="btn btn-color" type="button" id="search_by_key">Search</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>

                <!-- Navigation starts -->

                <div class="navi">
                    <div class="container">
                        <div class="navy">
                            <ul>
                                <!-- Main menu -->
                                <li><a href="index.php">Home</a>
                                </li>
                                <li><a href="shop.php">Shop</a>
                                </li>
                                <?php
                                if(isset($_SESSION['cus_id'])){ ?>
                                    <li><a href="cart.php">Cart</a>
                                    </li>
                                    <li><a href="order-details.php">Order Page</a>
                                    </li>
                                <?php } ?>

                                <li><a href="about.php">About Us</a></li>
                                <li><a href="contact.php">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Navigation ends -->

            </div>

            <!-- Header one ends -->

        </header>
        <style>
            #suggestTxt {
                background:  rgba(45, 52, 54, 0.84);
                display: inline-block;
                position: absolute;
                left: 51%;
                z-index: 5;
                color: #fff;
                padding: 20px;
                margin-top: ;
                margin-top: -83px;
            }
            #suggestTxt ul{
                margin:0;
                padding:0;
            }
            #suggestTxt ul li{
                list-style: none;
                cursor: pointer;
                font-size: 16px;
                margin:5px 0;
                display: block;
                font-weight:500;
            }
        </style>
        <!-- end header --> <span id="suggestTxt" class="suggest_tst"></span>