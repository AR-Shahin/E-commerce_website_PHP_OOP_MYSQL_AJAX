<?php include "header.php";?>


    <!-- start main content -->
    <main class="main-container" style="margin-top:30px;">
        <!--Checkout Area Start-->
        <section class="checkout-area area-padding ptb-40">
            <!-- Begin checkout -->
            <div class="ld-subpage-content">

                <div class="checkout-content">

                    <!-- Begin checkout section -->
                    <section class="checkout">

                        <section class="checkout-section">

                            <div class="ld-checkout-inner">

                                <div class="xs-margin"></div>

                                <div class="accordion" id="collapse">

                                    <div class="accordion-group panel darkerbg">

                                        <div class="container">
                                            <h2 class="accordion-title">

                <span>1. Billing Informations
                </span> <a class="accordion-btn open" data-toggle="collapse" href="#collapse-two"></a></h2>

                                            <div class="accordion-body collapse in" id="collapse-two">

                                                <div class="row accordion-body-wrapper">

                                                    <form action="" method="post" id="cus_bill_form" onsubmit="return false" autocomplete="off" >

                                                        <div class="col-sm-6 padding-right-md">
                                                            <h3 class="subtitle">Your Personal Details</h3>

                                                            <div class="xs-margin half">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="firstname" class="form-label">Enter your first name

                                                                    <span class="required">*
                </span>
                                                                </label>
                                                                <input type="text" name="firstname" id="firstname" class="form-control input-lg" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="lastname" class="form-label">Enter your last name

                                                                    <span class="required">*
                </span>
                                                                </label>
                                                                <input type="text" name="lastname" id="lastname" class="form-control input-lg" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="email2" class="form-label">Enter your e-mail

                                                                    <span class="required">*
                </span>
                                                                </label>
                                                                <input type="email" name="email2" id="email2" class="form-control input-lg" required readonly>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="telephone" class="form-label">Enter your Phone

                                                                    <span class="required">*
                </span>
                                                                </label>
                                                                <input type="text" name="telephone" id="telephone" class="form-control input-lg" required>
                                                            </div>

                                                            <div class="top-10px">
                                                            </div>

                                                        </div>

                                                        <div class="md-margin visible-xs clearfix">
                                                        </div>

                                                        <div class="col-sm-6 padding-left-md">
                                                            <h3 class="subtitle">Your Address</h3>

                                                            <div class="xs-margin half">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="address1" class="form-label">Enter your address 1
                                                                </label>
                                                                <input type="text" name="address1" id="address1" class="form-control input-lg">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="address2" class="form-label">Enter your address 2
                                                                </label>
                                                                <input type="text" name="address2" id="address2" class="form-control input-lg">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="city" class="form-label">Enter your city

                                                                    <span class="required">*
                </span>
                                                                </label>
                                                                <input type="text" name="city" id="city" class="form-control input-lg" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="postcode" class="form-label">Enter your post code
                                                                </label>
                                                                <input type="text" name="postcode" id="postcode" class="form-control input-lg" required>
                                                            </div>

                                                            <div class="top-5px">
                                                            </div>
                                                            <div class="xs-margin">
                                                            </div>
                                                            <input type="submit" class="btn btn-custom btn-lg min-width-md" value="Continue">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-group panel">

                                        <div class="container">
                                            <h2 class="accordion-title">

                <span>2. Delivery Details
                </span> <a class="accordion-btn" data-toggle="collapse" href="#collapse-three"></a></h2>

                                            <div class="accordion-body collapse" id="collapse-three">

                                                <div class="row accordion-body-wrapper">

                                                    <div class="col-md-12">

                                                        <p>Delivery details here...</p>
                                                    </div>
                                                </div>

                                                <div class="lg-margin2x">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-group panel">

                                        <div class="container">
                                            <h2 class="accordion-title">

                <span>3. Delivery Method
                </span> <a class="accordion-btn" data-toggle="collapse" href="#collapse-four"></a></h2>

                                            <div class="accordion-body collapse" id="collapse-four">

                                                <div class="row accordion-body-wrapper">

                                                    <div class="col-md-12">

                                                        <p>Delivery methods here...</p>
                                                    </div>
                                                </div>

                                                <div class="lg-margin2x">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-group panel">

                                        <div class="container">
                                            <h2 class="accordion-title mb-0">

                <span>5. Confirm Order
                </span> <a class="accordion-btn open" data-toggle="collapse" href="#collapse-five"></a></h2>

                                            <div class="accordion-body collapse in" id="collapse-five">

                                                <div class="row accordion-body-wrapper">

                                                    <div class="col-md-12">
                                                        <table class="table checkout-table">
                                                            <thead>
                                                            <tr>
                                                                <th class="table-title">Product Name</th>
                                                                <th class="table-title">Price</th>
                                                                <th class="table-title">Quantity</th>
                                                                <th class="table-title">SubTotal</th>

                                                            </tr>
                                                            </thead>
                                                            <tbody id="checkout_iteams">
                                                            <tr>
                                                                <td class="product-name-col">
                                                                    <figure>
                                                                        <a href="#"><img src="img/product/special-item-1.jpg" alt="White linen sheer dress"></a>
                                                                    </figure>
                                                                    <h3 class="product-name"><a href="#">White linen sheer dress</a></h3>
                                                                    <ul>
                                                                        <li>Color: White</li>
                                                                        <li>Size: SM</li>
                                                                    </ul>
                                                                </td>
                                                                <td class="product-code">MP125984154
                                                                </td>
                                                                <td class="product-price-col">

                                                                    <span class="product-price-special">$1175
                </span>
                                                                </td>
                                                                <td>

                                                                    <div class="custom-quantity-input">
                                                                        <input type="text" name="quantity" value="1">
                                                                    </div>
                                                                </td>
                                                                <td class="product-total-col">

                                                                    <span class="product-price-special">$1175
                </span>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="close-button"></a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="checkout-total-title" colspan="4">

                                                                    <span>TOTAL:
                </span>
                                                                </td>
                                                                <td class="checkout-total-price cart-total" colspan="2">$780.00
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>

                                                        <div class="md-margin half">
                                                        </div>

                                                        <div class="text-right"><a id="confirm_order" href="" class="btn btn-custom-6 btn-lger min-width-slg">CONFIRM ORDER</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="xlg-margin">
                                </div>

                            </div>

                        </section>


                    </section>
                    <!-- End checkout section -->


                </div>
                <!-- /.checkout-content -->
            </div>
            <!-- /.ld-subpage-content -->
            <!-- End checkout -->
        </section>
        <!--End of Checkout Area-->


    </main>
    <!-- end main content -->

<?php include "footer.php";?>