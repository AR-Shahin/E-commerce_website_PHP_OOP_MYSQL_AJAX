<?php include 'header.php'?>
<?php
use App\classes\Manage;

$obM = new Manage();
$id = base64_decode($_GET['pid']);
$data = $obM->getSingleProduct($id);
$cmnt = $obM->countRow('comments',["pro_id" => $id]);
$ro = $obM->fetch_data_conditions('comments',["pro_id" => $id]);

?>
<!-- Start Loading -->
<section class="loading-overlay">
    <div class="Loading-Page">
        <h1 class="loader">Loading...</h1>
    </div>
</section>
<!-- start main content -->
<main class="main-container" style="margin-top:20px;">
    <section class="product_content_area pt-40">
        <!-- start of page content -->
        <div class="lookcare-product-single container">
            <div class="row">
                <div class="main col-xs-12" role="main">
                    <div class=" product">
                        <div class="row">
                            <div class="col-md-5 col-sm-6 summary-before ">
                                <div class="product-slider product-shop">
                                    <span class="onsale">Sale!</span>
                                    <ul class="slides">
                                        <li data-thumb="admin/uploads/products/<?= $data['image']?>">
                                            <a href="admin/uploads/products/<?= $data['image']?>" data-imagelightbox="gallery" class="hoodie_7_front">
                                                <img src="admin/uploads/products/<?= $data['image']?>" class="attachment-shop_single " alt="image" style="width: 100%">
                                            </a>
                                        </li>
                                        <li data-thumb="admin/uploads/products/<?= $data['image']?>">
                                            <a href="admin/uploads/products/<?= $data['image']?>" data-imagelightbox="gallery" class="hoodie_7_back">
                                                <img src="admin/uploads/products/<?= $data['image']?>" class="attachment-shop_single" alt="image" style="width: 100%">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-7 product-review entry-summary">
                                <h1 class="product_title"><?= $data['productname']?></h1>
                                <div class="woocommerce-product-rating">
                                    <div class="star-rating" title="Rated 4.00 out of 5">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <a href="#reviews" class="woocommerce-review-link">(<span class="count">3</span> customer reviews)</a>
                                </div>
                                <div>
                                    <p class="price"><del><span class="amount">$50</span></del>
                                        <ins><span class="amount">$<?= $data['price']?></span></ins></p>
                                </div>
                                <p><?= substr($data['description'],0,100)?></p>
                                <form class="variations_form cart" method="post">
                                    <a id="add_to_cart" fpid =<?= $data['product_id']?> type="submit" class="cart-button" style="margin:10px 0;display: inline-block;">Add to cart</a>
                                </form>
                                <div class="product_meta">
                                    <span class="sku_wrapper">SKU: <span class="sku">N/A</span>.</span>
                                    <span class="posted_in" style="font-size: 18px">Categorie: <a href="#" rel="tag"><?= $data['catname']?></a></span>
                                    <span class="posted_in" style="font-size: 18px">Brand : <a href="#" rel="tag"><?= $data['brandname']?></a></span>
                                </div>
                                <div class="share-social-icons">

                                    <a href="#" target="_blank" title="Share on Facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="#" target="_blank" title="Share on Twitter">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="#" target="_blank" title="Pin on Pinterest">
                                        <i class="fa fa-pinterest"></i>
                                    </a>
                                    <a href="#" target="_blank" title="Share on Google+">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- .summary -->
                        </div>
                        <div class="wrapper-description">

                            <ul class="tabs-nav clearfix">
                                <li class="active">Description</li>
                                <li>Review (<?= $cmnt?>)</li>
                            </ul>
                            <div class="tabs-container product-comments">

                                <div class="tab-content">
                                    <section class="related-products">

                                        <h2>Product Description</h2>

                                        <p>
                                            <?= $data['description']?>
                                        </p>

                                        <h3 class="section-title">Related Products</h3>

                                        <div class="related-products-wrapper">

                                            <div class="related-products-carousel">

                                                <div class="product-control-nav">
                                                    <a class="prev"><i class="fa fa-angle-left"></i></a>
                                                    <a class="next"><i class="fa fa-angle-right"></i></a>
                                                </div>

                                                <div class="products-top"></div>
                                                <div class="row product-listing">
                                                    <div id="product-cavrousel" class="product-listing">
                                                        <div id="recomand_iteams_front"></div>

                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </section>
                                </div>

                                <div class="tab-content">
                                    <div class="panel entry-content">

                                        <h2>Product Description</h2>

                                        <p><?= $data['description']?></p>
                                    </div>

                                    <div class="panel entry-content">

                                        <div id="reviews">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div id="comments">
                                                        <h3><?= $cmnt?> reviews for Ship Your Idea</h3>
                                                        <ol class="commentlist" id="commentList">

                                                            <?php
                                                            if(!$ro == false){
                                                            foreach ($ro as $row){
                                                            ?>
                                                            <li class="comment depth-1">
                                                                <div class="comment_container">
                                                                    <img alt="gravatar" src="img/user.png" class="avatar photo">
                                                                    <div class="comment-text">
                                                                        <p class="meta">
                                                                            <span class="star-rating" title="Rated 4.00 out of 5">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </span>
                                                                            <strong><?=$row['cus_name']?></strong> – <time><?=$row['date']?></time>:
                                                                        </p>

                                                                        <div class="description">
                                                                            <p><?=$row['comment']?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
<?php } } ?>
                                                        </ol>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div id="review_form_wrapper">
                                                        <div id="review_form">
                                                            <div id="respond" class="comment-respond">
                                                                <h3 class="comment-reply-title">Add a review </h3>
                                                                <form action="" method="post" id="commentform" class="comment-form" autocomplete="off" onsubmit="return false">
                                                                    <p class="comment-form-author"><label for="author">Name <span class="required">*</span></label> <input id="author" name="author" type="text" value="<?=$_SESSION['cusname']?>" readonly></p>
                                                                    <input type="hidden" name="pro_id" value="<?=$id?>">
                                                                    <p class="comment-form-email"><label for="email">Email <span class="required">*</span></label> <input id="email" name="email" type="text" value="<?= $_SESSION['cus_email']?>" readonly></p>
                                                                    <p class="comment-form-comment"><label for="comment">Your Review</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>
                                                                    <p class="form-submit">
                                                                        <input name="submit" type="submit" id="submi_comment" class="submit" value="Submit">
                                                                    </p>
                                                                </form>
                                                            </div>
                                                            <!-- #respond -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>





                    </div>
                    <!-- #product-293 -->



                </div>
                <!-- end of main -->

            </div>
            <!-- end of .row -->

        </div>

        <!-- end of page content -->
    </section>

    <!-- service area -->
    <section class="block gray no-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-box no-margin go-simple">
                        <div class="mini-service-sec">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mini-service">
                                        <i  class="fa fa-paper-plane"></i>
                                        <div class="mini-service-info">
                                            <h3>Worldwide Delivery</h3>
                                            <p>unc tincidunt, on cursusau gmetus, lorem Hore</p>
                                        </div>
                                    </div><!-- Mini Service -->
                                </div>
                                <div class="col-md-3">
                                    <div class="mini-service">
                                        <i  class="fa  fa-newspaper-o"></i>
                                        <div class="mini-service-info">
                                            <h3>Worldwide Delivery</h3>
                                            <p>unc tincidunt, on cursusa ugmetus, lorem Hore</p>
                                        </div>
                                    </div><!-- Mini Service -->
                                </div>
                                <div class="col-md-3">
                                    <div class="mini-service">
                                        <i  class="fa fa-medkit"></i>
                                        <div class="mini-service-info">
                                            <h3>Friendly Stuff</h3>
                                            <p>unc tincidunt, on cursusau gmetus, lorem Hore</p>
                                        </div>
                                    </div><!-- Mini Service -->
                                </div>
                                <div class="col-md-3">
                                    <div class="mini-service">
                                        <i  class="fa  fa-newspaper-o"></i>
                                        <div class="mini-service-info">
                                            <h3>24/h Support</h3>
                                            <p>unc tincidunt, on cursusa ugmetus, lorem Hore</p>
                                        </div>
                                    </div><!-- Mini Service -->
                                </div>
                            </div>
                        </div><!-- Mini Service Sec -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- end service area -->
</main>
<!-- end main content -->


<?php include "footer.php"?>






<script type="text/javascript">
    /*-----------------------------------------------------------------------------------*/
    /* Flex Slider
     /*-----------------------------------------------------------------------------------*/
    if (jQuery().flexslider) {

        // Product Page Flex Slider
        $('.product-slider').flexslider({
            animation: "slide",
            animationLoop: false,
            slideshow: false,
            prevText: '<i class="fa fa-angle-left"></i>',
            nextText: '<i class="fa fa-angle-right"></i>',
            animationSpeed: 250,
            controlNav: "thumbnails"
        });

    }


    /*-----------------------------------------------------------------------------------*/
    /* Product Carousel
     /*-----------------------------------------------------------------------------------*/
    if (jQuery().owlCarousel) {
        var productCarousel = $("#product-carousel");
        productCarousel.owlCarousel({
            loop: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                900: {
                    items: 3
                },
                1100: {
                    items: 4
                }
            }
        });

        // Custom Navigation Events
        $(".product-control-nav .next").on("click", function() {
            productCarousel.trigger('next.owl.carousel');
        });

        $(".product-control-nav .prev").on("click", function() {
            productCarousel.trigger('prev.owl.carousel');
        });
    }



    /*-----------------------------------------------------------------------------------*/
    /* Tabs
     /*-----------------------------------------------------------------------------------*/
    $(function() {
        var $tabsNav = $('.tabs-nav'),
            $tabsNavLis = $tabsNav.children('li');

        $tabsNav.each(function() {
            var $this = $(this);
            $this.next().children('.tab-content').stop(true, true).hide()
                .first().show();
            $this.children('li').first().addClass('active').stop(true, true).show();
        });

        $tabsNavLis.on('click', function(e) {
            var $this = $(this);
            $this.siblings().removeClass('active').end()
                .addClass('active');
            var idx = $this.parent().children().index($this);
            $this.parent().next().children('.tab-content').stop(true, true).hide().eq(idx).fadeIn();
            e.preventDefault();
        });

    });


    /*-----------------------------------------------------------------------------------*/
    /*	Tabs Widget
     /*-----------------------------------------------------------------------------------*/
    $('.footer .tabbed .tabs li:first-child, .tabbed .tabs li:first-child').addClass('current');
    $('.footer .block:first, .tabbed .block:first').addClass('current');


    $('.tabbed .tabs li').on("click", function() {
        var $this = $(this);
        var tabNumber = $this.index();

        /* remove current class from other tabs and assign to this one */
        $this.siblings('li').removeClass('current');
        $this.addClass('current');

        /* remove current class from current block and assign to related one */
        $this.parent('ul').siblings('.block').removeClass('current');
        $this.closest('.tabbed').children('.block:eq(' + tabNumber + ')').addClass('current');
    });



    /*-----------------------------------------------------------------------------------*/
    /*	Image Lightbox
     /*  http://osvaldas.info/image-lightbox-responsive-touch-friendly
     /*-----------------------------------------------------------------------------------*/
    if (jQuery().imageLightbox) {

        // ACTIVITY INDICATOR

        var activityIndicatorOn = function() {
                $('<div id="imagelightbox-loading"><div></div></div>').appendTo('body');
            },
            activityIndicatorOff = function() {
                $('#imagelightbox-loading').remove();
            },


            // OVERLAY

            overlayOn = function() {
                $('<div id="imagelightbox-overlay"></div>').appendTo('body');
            },
            overlayOff = function() {
                $('#imagelightbox-overlay').remove();
            },


            // CLOSE BUTTON

            closeButtonOn = function(instance) {
                $('<button type="button" id="imagelightbox-close" title="Close"></button>').appendTo('body').on('click touchend', function() {
                    $(this).remove();
                    instance.quitImageLightbox();
                    return false;
                });
            },
            closeButtonOff = function() {
                $('#imagelightbox-close').remove();
            },

            // ARROWS

            arrowsOn = function(instance, selector) {
                var $arrows = $('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>');

                $arrows.appendTo('body');

                $arrows.on('click touchend', function(e) {
                    e.preventDefault();

                    var $this = $(this),
                        $target = $(selector + '[href="' + $('#imagelightbox').attr('src') + '"]'),
                        index = $target.index(selector);

                    if ($this.hasClass('imagelightbox-arrow-left')) {
                        index = index - 1;
                        if (!$(selector).eq(index).length)
                            index = $(selector).length;
                    } else {
                        index = index + 1;
                        if (!$(selector).eq(index).length)
                            index = 0;
                    }

                    instance.switchImageLightbox(index);
                    return false;
                });
            },
            arrowsOff = function() {
                $('.imagelightbox-arrow').remove();
            };

        // Lightbox for individual image
        var lightboxInstance = $('a[data-imagelightbox="lightbox"]').imageLightbox({
            onStart: function() {
                overlayOn();
                closeButtonOn(lightboxInstance);
            },
            onEnd: function() {
                closeButtonOff();
                overlayOff();
                activityIndicatorOff();
            },
            onLoadStart: function() {
                activityIndicatorOn();
            },
            onLoadEnd: function() {
                activityIndicatorOff();
            }
        });

        // Lightbox for product gallery
        var gallerySelector = 'a[data-imagelightbox="gallery"]';
        var galleryInstance = $(gallerySelector).imageLightbox({
            quitOnDocClick: false,
            onStart: function() {
                overlayOn();
                closeButtonOn(galleryInstance);
                arrowsOn(galleryInstance, gallerySelector);
            },
            onEnd: function() {
                overlayOff();
                closeButtonOff();
                arrowsOff();
                activityIndicatorOff();
            },
            onLoadStart: function() {
                activityIndicatorOn();
            },
            onLoadEnd: function() {
                activityIndicatorOff();
                $('.imagelightbox-arrow').css('display', 'block');
            }
        });

    }



</script>



</body>


</html>