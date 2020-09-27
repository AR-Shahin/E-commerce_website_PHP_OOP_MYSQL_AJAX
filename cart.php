<?php include 'header.php'?>
    <!-- start main content -->
    <main class="main-container">
        <!-- shopping cart content -->
        <section class="shopping-cart-area">
            <!-- Begin cart -->
            <div class="ld-subpage-content">

                <div class="ld-cart">

                    <!-- Begin cart section -->
                    <section class="ld-cart-section ptb-50">

                        <div class="container">

                            <div class="row">

                                <div class="col-md-12">

                                    <!-- Begin table -->
                                    <table class="table cart-table">
                                        <thead>
                                        <tr>
                                            <th class="table-title">Product Name</th>
                                            <th class="table-title">Price</th>
                                            <th class="table-title">Available</th>
                                            <th class="table-title">Quantity</th>
                                            <th class="table-title">SubTotal</th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="cart_checkout">
                                        <tr id="empty_cart"></tr>
                                        </tbody>
                                        </tbody>
                                    </table>
                                    <!-- End table -->

                                    <div class="mt-30"></div>

                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">

                                            <table class="table total-table">

                                                <tbody>
                                                <!--    <tr>
                                                      <td class="total-table-title">Subtotal:</td>
                                                      <td>$<span id="subtotal"></span></td>
                                                  </tr>
                                                   <tr>
                                                      <td class="total-table-title">Shipping:</td>
                                                      <td>$<span id="shiping"></span></td>
                                                  </tr>
                                                  <tr>
                                                      <td class="total-table-title">TAX (10%):</td>
                                                      <td>$<span id="tax"></span></td>
                                                  </tr> -->
                                                </tbody>

                                                <tfoot>
                                                <tr>
                                                    <td>Total:</td>
                                                    <td>$<span id="total_sum"></span></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <!-- End table -->

                                            <div class="mt-30"></div>
                                            <div style="display: flex;justify-content: space-between">
                                                <div class="text-right" style="display: inline-block"><a href="index.php" class="btn btn-custom-6 btn-lger min-width-sm">Continue Shopping</a>
                                                </div>
                                                <div class="text-right" style="display: inline-block"><a href="checkout.php" class="btn btn-custom-6 btn-lger min-width-sm">Checkout</a>
                                                </div>
                                            </div>
                                            <!-- /.col-md-4 -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                            </div>

                    </section>
                    <!-- /.ld-cart-section -->

                </div>
                <!-- /.ld-cart -->
            </div>
            <!-- /.ld-subpage-content -->
            <!-- End Cart -->
        </section>
        <!-- end shopping cart content -->

    </main>

<?php include 'footer.php'?>