<?php include 'inc/header.php'?>
<?php include 'inc/navbar.php'?>
<?php include 'inc/leftbar.php'?>
    <div class="row">
        <div class="col-12 col-md-4">
            <h2>Add Brand</h2>
            <hr>
            <form action="" method="post" id="add_brand_form" onsubmit="return false" autocomplete="off">
                <div class="form-group">
                    <label for="brandname">Brand Name:</label>
                    <input type="text" class="form-control" name="brandname" id="brandname" placeholder="Brand Name ">
                    <small id="brand_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info btn-block" name="addbrandbtn" id="addbrandbtn" value="Add New Brand">
                </div>
            </form>
        </div>
        <div class="col-12 col-md-8">
            <h2>Manage Brand</h2>
            <hr>

            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Brand</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="get_brand">
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
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Update Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_brand_form" onsubmit="return false">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="hidden" name="bid" id="bid" value=""/>
                            <input type="text" class="form-control" name="update_brand" id="update_brand" aria-describedby="emailHelp" placeholder="Enter Brand">
                            <small id="brand_error" class="form-text text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Brand</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'?>