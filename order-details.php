<?php include 'header.php'; ?>
<div class="container">
    <style>
        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            padding: 25px  5px;


        }
    </style>
    <div class="row" style="margin:20px 0;">
        <div class="col-md-12">
            <!-- Begin table -->
            <table class="table cart-table table-hover table-bordered">
                <thead>
                <tr>
                    <th class="table-title">Product Name</th>
                    <th class="table-title">Quantity</th>
                    <th class="table-title">Total Price</th>
                    <th class="table-title">Order Date</th>
                    <th class="table-title">Actions</th>
                </tr>
                </thead>
                <tbody id="oder_product">
                <!--   <tr>
                    <td class="product-name-col">
                        <figure>
                            <a href="#"><img style="width: 80px;" class="img-responsive" src="admin/uploads/products/0fe3f72952.jpg" alt="Mustard yellow ruffle dress"></a>
                        </figure>
                        <h2 class="product-name"><a href="#">Lorem ipsum dolor sit ametelit.</a></h2>
                    </td>
                    <td>8</td>
                    <td>5000</td>
                    <td>xxxxxxxxxx</td>
                    <td>xxxxxxxxxx</td>
                </tr>  -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'footer.php';?>
