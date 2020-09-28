<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
<?php include 'inc/leftbar.php';?>

    <h2>Delivery Orders <span class="badge badge-primary"></span></h2>
    <table class="table table-hover table-bordered text-center">
        <thead>
        <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Amount</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody id="get_delivery_order">
        <!--<tr>
          <td>1</td>
          <td>Electronics</td>
          <td>Root</td>
          <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
          <td>
              <a href="#" class="btn btn-danger btn-sm">Delete</a>
              <a href="#" class="btn btn-info btn-sm">Edit</a>
          </td>
        </tr>-->
        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="customer_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer Details </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td><span id="cusName"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><span id="cusEmail"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td><span id="cusPhone"></span></td>
                                        </tr><tr>
                                            <th>Address 1</th>
                                            <td><span id="cusAdd1"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Address 2</th>
                                            <td><span id="cusAdd2"></span></td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <td><span id="cusCity"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Post Code</th>
                                            <td><span id="cusPcode"></span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php';?>