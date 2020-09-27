<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
?>
<?php include 'inc/header.php'?>
<?php include 'inc/navbar.php'?>
<?php include 'inc/leftbar.php'?>
    <table class="table table-hover table-bordered text-center">
        <thead>
        <tr>
            <th>#</th>
            <th>Product name</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Status</th>
            <th>Type</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody id="get_product">
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
    <!-- View Modal -->
    <div class="modal fade" id="form_products_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Sproductname"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table  table-bordered table-hover">
                        <tbody id="modal_product">
                        <tr>
                            <th>Category</th>
                            <td id="category"></td>
                            <th>Brand</th>
                            <td id="brand">Demo</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td id="price">$ 550.25</td>
                            <th>Quantity</th>
                            <td id="quantity">50</td>
                        </tr>
                        <tr>
                            <th>Keywords</th>
                            <td id="keywords" colspan="3"></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td id="status">Demo</td>
                            <th>Type</th>
                            <td id="type">Demo</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: center">
                                <div id="image"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Added Date</th>
                            <td id="date" colspan="2"></td>
                        </tr>
                        <tr>
                            <td id="description" colspan="4"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="productModal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_product_form" onsubmit="return false">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Product Name</label>
                                <input type="hidden" id="pid" name="pid">
                                <input type="text" class="form-control" name="up_productname" id="up_productname" placeholder="Enter Product Name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Category</label>
                                <select class="form-control" id="u_cat" name="select_cat" />
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Brand</label>
                                <select class="form-control" id="select_brand" name="select_brand" />
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Product Price</label>
                                <input type="text" class="form-control" id="up_price" name="up_price" placeholder="Enter Price of Product"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Quantity</label>
                                <input type="text" class="form-control" id="up_productquantity" name="up_productquantity" placeholder="Enter Quantity"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Keywords</label>
                                <input type="text" class="form-control" id="up_keywords" name="up_keywords" placeholder="Enter Price of Product"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="up_status"  class="custom-control-input" value="0" id="up_status"><span class="custom-control-label">Active</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="up_status" class="custom-control-input" value="1" id="up_status"><span class="custom-control-label">Inactive</span>
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Type</label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="up_type"  class="custom-control-input" value="0" id="up_type"><span class="custom-control-label">Feature</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="up_type" class="custom-control-input" value="1"><span class="custom-control-label" id="up_type">New</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="up_type" class="custom-control-input" value="2"><span class="custom-control-label" id="up_type">Top</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Image</label>
                                <input type="file" class="form-control" id="up_image" name="up_image" value="vv"/>
                            </div>
                            <div class="form-group col-md-6 text-center">
                                <span id="image_S"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea name="up_description" id="up_description" cols="30" rows="5" class="form-control w-100" style="display: block;"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Update Product</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'?>