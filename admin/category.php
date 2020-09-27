<?php include 'inc/header.php'?>
<?php include 'inc/navbar.php'?>
<?php include 'inc/leftbar.php'?>
    <div class="row">
        <div class="col-12 col-md-4">
            <h2>Add Category</h2>
            <hr>
            <form action="" method="post" id="add_cat_form" onsubmit="return false" autocomplete="off">
                <div class="form-group">
                    <label for="catname">Category Name:</label>
                    <input type="text" class="form-control" name="catname" id="catname" placeholder="Category Name ">
                    <small id="cat_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="catname">Parent Category:</label>
                    <select class="form-control" id="parent_cat" name="parent_cat">

                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info btn-block" name="addcatbtn" id="addcatbtn" value="Add New Category">
                </div>
            </form>
        </div>
        <div class="col-12 col-md-8">
            <h2>Manage Category</h2>
            <hr>
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Parent</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="get_category">
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
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #fff;">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_category_form" onsubmit="return false">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="hidden" name="cid" id="cid" value=""/>
                            <input type="text" class="form-control" name="update_category" id="update_category_name" aria-describedby="emailHelp" placeholder="Enter Category Name">
                            <small id="cat_error" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Parent Category</label>
                            <select class="form-control " id="p_cat" name="parent_cat">

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'?>