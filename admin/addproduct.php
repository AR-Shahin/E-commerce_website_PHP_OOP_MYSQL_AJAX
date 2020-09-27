<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
?>
<?php include 'inc/header.php'?>
<?php include 'inc/navbar.php'?>
<?php include 'inc/leftbar.php'?>
    <div class="row">
        <div class="col-12">
            <h2>Add Product</h2>
            <hr>

            <form id="add_product_form" onsubmit="return false" autocomplete="off" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Date</label>
                        <input type="text" class="form-control" name="added_date" id="added_date" value="<?= date("Y-m-d"); ?>" readonly/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="productname" id="productname" placeholder="Enter Product Name" >
                        <small id="product_name_error" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 col-12">
                        <label>Category</label>
                        <select class="form-control" id="select_cat" name="select_cat" />
                        </select>
                        <small id="product_cat_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Brand</label>
                        <select class="form-control" id="select_brand" name="select_brand" />
                        </select>
                        <small id="product_brand_error" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 col-12">
                        <label>Product Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price of Product" /><small id="product_price_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" /><small id="product_quantity_error" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 col-12">
                        <label>Product Keywords</label>
                        <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Enter Keywords of Product" /><small id="product_keywords_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Image</label>
                        <input type="file" class="form-control" id="image" name="image" />
                        <small id="product_image_error" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control w-100" style="display: block;"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 col-12">
                        <span class="d-block mb-2 mt-1">Status</span>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="status"  class="custom-control-input" value="0" id="status"><span class="custom-control-label">Active</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="status" class="custom-control-input" value="1" id="status"><span class="custom-control-label">Inactive</span>
                        </label>
                        <small id="product_status_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <span class="d-block mb-2 mt-1">Type</span>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="type"  class="custom-control-input" value="0"><span class="custom-control-label">Feature</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="type" class="custom-control-input" value="1"><span class="custom-control-label">New</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="type" class="custom-control-input" value="2"><span class="custom-control-label">Top</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Add Product</button>
                </div>
            </form>
        </div>
    </div>
<?php include 'inc/footer.php'?>