<?php
require_once '../../vendor/autoload.php';
use App\classes\User;
use App\classes\DBoperation;
use App\classes\Manage;
session_start();
$ob = new User();
$obD = new DBoperation();
$obM = new Manage();
$obH = new \App\classes\Helper();
if(isset($_POST['check_username'])){
    echo $ob->verify_username('users',$_POST['username']);
    exit();
}

if(isset($_POST['check_email'])){
    echo $data =  $ob->verify_email('users',$_POST['email']);
    exit();
}

if(isset($_POST['fullname']) AND isset($_POST['email'])){
    $fullname = $_POST['fullname'];
    $e = $ob->verify_email('users',$_POST['email']);
    if($e == 'already_exists'){
        echo 'emailExists';
        exit();
    }else{
        $email = $_POST['email'];
    }
    $username = $_POST['username'];
    $options = ["COST" => 12];
    $password = $_POST['password1'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT, $options);
    $signup_date = date("Y-m-d H:i:s");
    $fields = array(
        "fullname" => $fullname,
        "username" => $username,
        "email" => $email,
        "password" => $hash_password,
        "status" => '0',
        "sign_date" => $signup_date,
        "last_login" => $signup_date,
    );
    $id = $ob->insert_record('users',$fields);
    if($id){
        echo 'INSERTED_USER';
        exit();
    }else{
        echo 'NOT_INSERTED_USER';
        exit();
    }

}

if(isset($_POST['log_email']) and isset($_POST['password'])){
    $data =  $ob->verify_email('users',$_POST['log_email']);
    if($data === 'invalid_email'){
        echo 'invalid_email';
        exit();
    }elseif ($data === 'ok'){
        echo 'NOT_REGISTER';
        exit();
    }elseif ($data === 'already_exists'){
        $email = $_POST['log_email'];
        $rows = $ob->single_record('users',["email" => $email]);
        $usr_pass = $rows['password'];
        if(password_verify($_POST['password'],$usr_pass)){
            $usr_id =  $rows['user_id'];
            $username =  $rows['username'];
            $_SESSION['user_id'] = $usr_id;
            $_SESSION['username'] = $username;
            $_SESSION['user_email'] = $email;
            $date = date("Y-m-d H:i:s");
            $ob->changeLoginTime($data,$usr_id);
            echo 'SUCCESS_LOGIN';
            exit();
        }else{
            echo 'PASSWORD_NOT_MATCH';
        }

    }
}


//DB Operations
//fetch category
if (isset($_POST["getCategory"])) {
    $rows = $obD->fetch_data('categories','cat_id','DESC');
    foreach ($rows as $row) {
        echo "<option value='".$row["cat_id"]."'>".$row["catname"]."</option>";
    }
    exit();
}

//FETCH BRAND
if (isset($_POST["getBrand"])) {
    $rows = $obD->fetch_data("brands",'brand_id','DESC');
    foreach ($rows as $row) {
        echo "<option value='".$row["brand_id"]."'>".strtoupper($row["brandname"])."</option>";
    }
    exit();
}
//Add Category
if(isset($_POST["catname"]) && isset($_POST["parent_cat"])) {
    $cat = $_POST["catname"];
    $pcat = $_POST["parent_cat"];
    if($obD->single_record('categories',["catname" => $cat])){
        echo 'EXISTS';
        exit();
    }else{
        if($obD->insert_record('categories',["catname" => $cat,"parent_cat" => $pcat])){
            echo 'INSERTED_CATEGORY';
            exit();
        }else{
            echo 'NOT_INSERTED_CATEGORY';
            exit();
        }
    }
}

//ADD BRAND
if(isset($_POST['brandname'])){
    $bnd = $_POST['brandname'];
    if($obD->single_record('brands',["brandname" => $bnd])){
        echo 'EXISTS';
        exit();
    }else{
        if($obD->insert_record('brands',["brandname" => $bnd])){
            echo 'INSERTED_BRAND';
            exit();
        }else{
            echo 'NOT_INSERTED_BRAND';
            exit();
        }
    }
}

//manage category

if (isset($_POST["manageCategory"])) {

    $result = $obM->manageRecordWithPagination("categories",$_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = ((($_POST["pageno"] - 1) * 5)*2)+1;
        foreach ($rows as $row) {
            ?>
            <tr class="text-center">
                <td><?php echo $n; ?></td>
                <td class="text-left"><?php echo ucwords($row["category"]); ?></td>
                <td>
                    <?= $row["parent"] == NULL? 'Root':$row["parent"]; ?>
                </td>
                <td>
                    <a href="#" did="<?php echo $row['cat_id']; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>
                    <a href="#" eid="<?php echo $row['cat_id']; ?>" data-toggle="modal" data-target="#categoryModal" class="btn btn-info btn-sm edit_cat">Edit</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
    }
}
//Delete Category
if (isset($_POST["deleteCategory"])) {
    $result = $obM->deleteRecord("categories","cat_id",$_POST["id"]);
    echo $result;
    exit();
}
//Update Category
if (isset($_POST["updateCategory"])) {
    $id = $_POST['id'];
    $result = $obM->single_record("categories",["cat_id"=>$id]);
    echo json_encode($result);
    exit();
}
//Update Record after getting data
if (isset($_POST["update_category"])) {
    $id = $_POST["cid"];
    $name = $_POST["update_category"];
    $parent = $_POST["parent_cat"];
    $result = $obM->update_record("categories",["cat_id"=>$id],["parent_cat"=>$parent,"catname"=>$name]);
    echo $result;
}
//--------------------------Manage bnd--------------------------------

if (isset($_POST["manageBrand"])) {
    $result = $obM->manageRecordWithPagination("brands",$_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = ((($_POST["pageno"] - 1) * 5)*2)+1;
        foreach ($rows as $row) {
            ?>
            <tr class="text-center">
                <td><?php echo $n; ?></td>
                <td class="text-left"><?php echo ucwords($row["brandname"]); ?></td>
                <td>
                    <a href="#" did="<?php echo $row['brand_id']; ?>" class="btn btn-danger btn-sm del_brand">Delete</a>
                    <a href="#" eid="<?php echo $row['brand_id']; ?>" data-toggle="modal" data-target="#brandModal" class="btn btn-info btn-sm edit_brand">Edit</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
    }
}
//Delete
if (isset($_POST["deleteBrand"])) {
    $result = $obM->deleteRecord("brands","brand_id",$_POST["id"]);
    echo $result;
    exit();
}

//Update Brand
if (isset($_POST["updateBrand"])) {
    $result = $obM->single_record("brands",["brand_id" => $_POST["id"]]);
    echo json_encode($result);
    exit();
}

//Update Record after getting data
if (isset($_POST["update_brand"])) {
    $m = new Manage();
    $id = $_POST["bid"];
    $name = $_POST["update_brand"];
    $result = $m->update_record("brands",["brand_id"=>$id],["brandname"=>$name]);
    echo $result;
}
//-----------------------------------------Product----------------
//Check Product name
if(isset($_POST['check_product_name'])){
    $pname = $_POST['productname'];
    $pname = $obH->filter($pname);
    echo $data =  $obD->verify_Double_data('products',["productname" => $pname]);
    exit();
}

//add product
if(isset($_POST['productname']) and isset($_POST['quantity'])){
    $bool = false;
    $productname = $obH->filter($_POST['productname']);
    $checkPro = $obD->verify_Double_data('products',["productname" => $productname]);
    if($checkPro === 'already_exists'){
        echo 'already_exists';
        exit();
    }else if($checkPro === 'ok'){
        $bool = true;
        $select_cat = $obH->filter($_POST['select_cat']);
        $select_brand = $obH->filter($_POST['select_brand']);
        $keywords = $obH->filter($_POST['keywords']);
        $description = $obH->filter($_POST['description']);
        $status = $_POST['status'];
        $type = $_POST['type'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $image = $_FILES['image']['name'];
        $permit = array('png','jpg','jpeg');
        $ext = explode('.',$image);
        $ext = strtolower(end($ext));
        if(in_array($ext,$permit) === false){
            echo "EXT_NOT_MATCH";
            exit();
        }else{

            $image = substr(md5(time()),0,10) . '.' .$ext;
            $product_fields = array(
                "productname" => $productname,
                "cat_id" => $select_cat,
                "brand_id" => $select_brand,
                "price" => $price,
                "quantity" => $quantity,
                "keywords" => $keywords,
                "description" => $description,
                "status" => $status,
                "type" => $type,
                "image" => $image
            );
            if($obD->insert_record('products',$product_fields)){
                $upload = '../uploads/products/' . $image;
                move_uploaded_file($_FILES['image']['tmp_name'],$upload);
                echo "PRODUCT_INSERTED";
                exit();
            }else{
                echo "PRODUCT_NOT_INSERTED";
                exit();
            }
        }
    }
}

//manage product
if (isset($_POST["manageProduct"])) {
    $result = $obM->manageRecordWithPagination("products",$_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = ((($_POST["pageno"] - 1) * 5)*2)+1;

        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo ucwords($row["productname"]); ?></td>
                <td><?php echo ucwords($row["catname"]); ?></td>
                <td><?php echo ucwords($row["brandname"]); ?></td>
                <td><img width="60px" src="uploads/products/<?php echo $row["image"];?>" alt=""></td>
                <td><?php echo $row["price"]; ?></td>
                <td><?php echo $row["quantity"]; ?></td>
                <td><?php echo $row["add_date"]; ?></td>
                <td>
                    <?php
                    if($row["status"] == 0){
                        echo '<a href="#" class="btn btn-success btn-sm active-s" pid ='. $row["product_id"].'>Active</a>';
                    }else{
                        echo '<a href="#" class="btn btn-danger btn-sm inactive-s" pid='.$row["product_id"].'>Inactive</a>';
                    }
                    ?>

                </td>
                <td>
                    <?php
                    if($row["type"] == 0){
                        echo '<a href="#" class="btn btn-warning btn-sm">F</a>';
                    }elseif($row["type"] == 1){
                        echo '<a href="#" class="btn btn-success btn-sm">N</a>';
                    }
                    else{
                        echo '<a href="#" class="btn btn-info btn-sm">T</a>';
                    }
                    ?>

                </td>
                <td>
                    <a href="#" vid="<?php echo $row['product_id']; ?>" data-toggle="modal" data-target="#form_products_view" class="btn btn-info btn-sm view_product">View</a>
                    <a href="#" eid="<?php echo $row['product_id']; ?>" data-toggle="modal" data-target="#productModal_update" class="btn btn-warning btn-sm edit_product">Edit</a>
                    <a href="#" did="<?php echo $row['product_id']; ?>" class="btn btn-danger mt-1 btn-sm del_product">Delete</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
    }
}
//Delete
if (isset($_POST["deleteProduct"])) {
    $r =  $obM->single_record('products',["product_id" => $_POST["id"]]);
    $img = $r['image'];
    $path = '../uploads/products/'.$img;
    $result = $obM->deleteRecord("products","product_id",$_POST["id"]);
    if($result){
        unlink($path);
    }
    echo $result;
    exit();
}
//view single pro
if(isset($_POST['single_product'])){
    $id = $_POST['id'];
    $data = $obM->getSingleProduct($id);
    echo json_encode($data);
}
//Update Product
if (isset($_POST["updateProduct"])) {
    $result = $obM->getSingleProduct($_POST["id"]);
    echo json_encode($result);
    exit();
}
//Update Record after getting data
if (isset($_POST["up_productname"])) {
    $bool = true;
    $productname = $obH->filter($_POST['up_productname']);
    $select_cat = $obH->filter($_POST['select_cat']);
    $select_brand = $obH->filter($_POST['select_brand']);
    $keywords = $obH->filter($_POST['up_keywords']);
    $description = $obH->filter($_POST['up_description']);
    $status = $_POST['up_status'];
    $type = $_POST['up_type'];
    $price = $_POST['up_price'];
    $quantity = $_POST['up_productquantity'];
    $id = $_POST['pid'];
    if(!isset($_FILES['up_image']['name'])){
        $product_fields = array(
            "productname" => $productname,
            "cat_id" => $select_cat,
            "brand_id" => $select_brand,
            "price" => $price,
            "quantity" => $quantity,
            "keywords" => $keywords,
            "description" => $description,
            "status" => $status,
            "type" => $type,
        );
        if($res = $obM->update_record('products',["product_id" => $id],$product_fields)){
            echo $res;
            exit();
        }
    }else{
        $image = $_FILES['up_image']['name'];
        $permit = array('png','jpg','jpeg');
        $ext = explode('.',$image);
        $ext = strtolower(end($ext));
        if(in_array($ext,$permit) === false){
            echo "EXT_NOT_MATCH";
            exit();
        }else {
            $image = substr(md5(time()), 0, 10) . '.' . $ext;
            $product_fields = array(
                "productname" => $productname,
                "cat_id" => $select_cat,
                "brand_id" => $select_brand,
                "price" => $price,
                "quantity" => $quantity,
                "keywords" => $keywords,
                "description" => $description,
                "status" => $status,
                "type" => $type,
                "image" => $image
            );
            $r =  $obM->single_record('products',["product_id" => $id]);
            $img = $r['image'];
            $path = '../uploads/products/'.$img;
            if($res = $obM->update_record('products',["product_id" => $id],$product_fields)){
                $upload = '../uploads/products/' . $image;
                move_uploaded_file($_FILES['up_image']['tmp_name'],$upload);
                unlink($path);
                echo $res;
                exit();
            }
        }
    }

    echo $result;
}
//-----------------------------------------------------------------------------------------front
//getCategory_front
if (isset($_POST["getCategory_front"])) {
    $rows = $obD->fetch_data('categories','cat_id','DESC');
    foreach ($rows as $row) {
        echo "<a class='entry categories' fcid='".$row['cat_id']."' style='font-size:16px;font-weight:500' href=''><span><i class='fa fa-angle-right'></i>".ucwords($row["catname"])."</span></a>";
    }
    exit();
}
//fetch product in front
if (isset($_POST["front_product"])) {
    $result = $obM->manageRecordWithPagination("products",$_POST["pageno"],12);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = ((($_POST["pageno"] - 1) * 5)*2)+1;

        foreach ($rows as $row) {
            ?>
            <div class="col-md-3 col-sm-6" style="padding:0;">
                <!-- Shopping items -->
                <div class="shopping-item">
                    <!-- Image -->
                    <a href="single-product.php?pid=<?= base64_encode($row['product_id'])?>"><img style="height: 210px;width: 343px" class="img-responsive" src="admin/uploads/products/<?=$row['image'] ?>" alt="" /></a>
                    <!-- Shopping item name / Heading -->
                    <h4><a href="single-product.php?pid=<?= base64_encode($row['product_id'])?>"><?= $row['productname']?></a><span class="color pull-right">$ <?= $row['price']?></span></h4>
                    <div class="clearfix"></div>
                    <!-- Buy now button -->
                    <div class="visible-xs">
                        <a id="add_to_cart" class="btn btn-color btn-sm" href="" fpid =<?= $row['product_id']?>>Buy Now</a>
                    </div>
                    <!-- Shopping item hover block & link -->
                    <div class="item-hover bg-color hidden-xs">
                        <a id="add_to_cart"  fpid =<?= $row['product_id']?>>Add to cart</a>
                    </div>
                </div>
            </div>
            <?php
            $n++;
        }
        ?>
        <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
    }
}

//category wise product
if (isset($_POST["category_wise_product"])) {
    $cid = $_POST['cat_id'];
    $result = $obM->manageRecordWithPagination("products",1,9,'C',$cid);
    $rows = $result["rows"];
    # $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (((1 - 1) * 5)*2)+1;

        foreach ($rows as $row) {
            ?>
            <div class="col-md-3 col-sm-6" style="padding:0;">
                <!-- Shopping items -->
                <div class="shopping-item">
                    <!-- Image -->
                    <a href="single-product.php?pid=<?= base64_encode($row['product_id'])?>"><img style="height: 210px;width: 343px" class="img-responsive" src="admin/uploads/products/<?=$row['image'] ?>" alt="" /></a>
                    <!-- Shopping item name / Heading -->
                    <h4><a href="single-product.php?pid=<?= base64_encode($row['product_id'])?>"><?= $row['productname']?></a><span class="color pull-right">$ <?= $row['price']?></span></h4>
                    <div class="clearfix"></div>
                    <!-- Buy now button -->
                    <div class="visible-xs">
                        <button id="add_to_cart" class="button-add-to-cart" fpid =<?= $row['product_id']?>>Buy Now</button>
                    </div>
                    <!-- Shopping item hover block & link -->
                    <div class="item-hover bg-color hidden-xs">
                        <a id="add_to_cart"  fpid =<?= $row['product_id']?>>Add to cart</a>
                    </div>
                </div> </div>
            <?php
            $n++;
        }
        ?>
        <!--  <tr><td colspan="5"><?php #echo $pagination; ?></td></tr>-->
        <?php
        exit();
    }
}


//Rand product
if (isset($_POST["random_suggest_product"])) {
    $result = $obM->manageRecordWithPagination("products",1,9,'R');
    $rows = $result["rows"];
    # $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (((1 - 1) * 5)*2)+1;

        foreach ($rows as $row) {
            ?>
            <div class="col-md-3 col-sm-6">
                <div class="product  item first">
                    <article>
                        <figure>
                            <a href="single-product.php?pid=<?= base64_encode($row['product_id'])?>">
                                <img style="height: 210px;width: 343px" src="admin/uploads/products/<?=$row['image'] ?>" class="img-responsive" alt="T_2_front">
                            </a>
                            <figcaption><span class="amount" style="margin-top:10px;display: inline-block;">$<?=$row['price'] ?></span></figcaption>
                        </figure>

                        <h4 class="title"><a href="single-product.php?pid=<?= base64_encode($row['product_id'])?>"><?= $row['productname']?></a></h4>
                        <button id="add_to_cart" class="button-add-to-cart" fpid =<?= $row['product_id']?>>Add to cart</button>
                    </article>

                </div>
            </div>
            <?php
            $n++;
        }
        ?>
        <!--  <tr><td colspan="5"><?php #echo $pagination; ?></td></tr>-->
        <?php
        exit();
    }
}


if (isset($_POST["shop_Page_Product"])) {
    $result = $obM->manageRecordWithPagination("products",$_POST["pageno"],9);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = ((($_POST["pageno"] - 1) * 5)*2)+1;

        foreach ($rows as $row) {
            ?>
            <div class="col-xs-12 col-sm-6 col-md-4 product-item filter-featured">
                <div class="product-img">
                    <img style="width: 270px;height: 260px;" src="admin/uploads/products/<?=$row['image'] ?>" alt="product">
                    <?php
                    if($row['status'] == 1){
                        ?>
                        <div class="product-new">
                            new
                        </div>
                    <?php } ?>
                    <div class="product-hover">
                        <div class="product-cart">
                            <a id="add_to_cart" class="btn btn-secondary btn-block" fpid =<?= $row['product_id']?>>Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $n++;
        }
        ?>
        <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
    }
}

//status
if(isset($_POST['change_status_make_inactive'])){
    $pid = $_POST['pid'];
    echo $obM->update_record('products',["product_id" => $pid],["status" => 1]);
    exit();
}
//status
if(isset($_POST['change_status_make_active'])){
    $pid = $_POST['pid'];
    echo $obM->update_record('products',["product_id" => $pid],["status" => 0]);
    exit();
}
//---------------------------------------------ORDER-------------------------------
if(isset($_POST['countNewOrder'])){
    echo $obM->countRow('orders',["status" => 0]);
    exit();
}
if(isset($_POST['countShiftOrder'])){
    echo $obM->countRow('orders',["status" => 1]);
    exit();
}
if(isset($_POST['countTotalProducts'])){
    echo $obM->countRow('products',["status" => 0]);
    exit();
}
if(isset($_POST['countTotalCompleterOrder'])){
    echo $obM->countRow('orders',["status" => 3]);
    exit();
}
//manage new order
if (isset($_POST["get_newOrders"])) {
    $result = $obM->manageRecordWithPagination("orders",$_POST["pageno"],100,'newOrder');
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = ((($_POST["pageno"] - 1) * 5)*2)+1;

        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?=$row['date'] ?></td>
                <td>
                    <a href="#" vid="<?php echo $row['cus_id'];?>" data-toggle="modal" data-target="#customer_details" class="btn btn-link btn-sm view_customer"><?php echo $row['cus_fname'];?></a>
                </td>
                <td><?=$row['pro_name'] ?></td>
                <td><?=$row['price'] ?></td>
                <td><?=$row['quantity'] ?></td>
                <td><?=$row['total_amnt'] ?></td>
                <td><?php if($row['status'] == 0) {echo '<a class="badge badge-warning text-light">New </a>';} ?></td>
                <td><a href="" class="btn btn-info shift-order btn-xs" oid="<?=$row['odr_id']?>">Shift</a></td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
    }
}


if(isset($_POST['shift_order'])){
    $oid = $_POST['oid'];
   echo $obM->update_record('orders',["odr_id" =>$oid],["status" => 1]);
    exit();
}
//manage shift order

if (isset($_POST["get_shiftOrder"])) {

    $result = $obM->manageRecordWithPagination("orders",$_POST["pageno"],50,"shiftOrder");
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = ((($_POST["pageno"] - 1) * 5)*2)+1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td>
                    <a href="#" vid="<?php echo $row['cus_id'];?>" data-toggle="modal" data-target="#customer_details" class="btn btn-link btn-sm view_customer"><?php echo $row['cus_fname'];?></a>
                </td>
                <td><?=$row['pro_name'] ?></td>
                <td><?=$row['price'] ?></td>
                <td><?=$row['quantity'] ?></td>
                <td><?=$row['total_amnt'] ?></td>
                <td><?php if($row['status'] == 1) {echo '<a class="badge badge-info text-light">Shift </a>';} ?></td>
                <td><a href="" class="btn btn-success shift-delivery btn-xs" oid="<?=$row['odr_id']?>">Delivery</a></td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
    }
}


if(isset($_POST['shift_delivery'])){
    $oid = $_POST['oid'];
    echo $obM->update_record('orders',["odr_id" =>$oid],["status" => 2]);
    exit();
}
if(isset($_POST['make_trush_delivery'])){
    $oid = $_POST['oid'];
    echo $obM->update_record('orders',["odr_id" =>$oid],["status" => 3]);
    exit();
}

if (isset($_POST["get_deliveryOrder"])) {

    $result = $obM->manageRecordWithPagination("orders",$_POST["pageno"],100,"delivery");
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = ((($_POST["pageno"] - 1) * 5)*2)+1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td>
                    <a href="#" vid="<?php echo $row['cus_id'];?>" data-toggle="modal" data-target="#customer_details" class="btn btn-link btn-sm view_customer"><?php echo $row['cus_fname'];?></a>
                </td>
                <td><?=$row['pro_name'] ?></td>
                <td><?=$row['price'] ?></td>
                <td><?=$row['quantity'] ?></td>
                <td><?=$row['total_amnt'] ?></td>
                <td><?php if($row['status'] == 2) { ?>
                        <a class="badge make-rece badge-warning text-light" oid="<?= $row['odr_id']?>">Deliveried </a>
                    <?php }
                else if($row['status'] == 3) {echo '<a class="badge badge-success text-light">Received </a>'; } ?></td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
    }
}

//Get Cus details
if (isset($_POST["getCusDetails"])) {
    $cid = $_POST['cid'];
    $result = $obM->single_record("customers",["cus_id"=>$cid]);
    echo json_encode($result);
    exit();
}
if(isset($_POST['countTotalSell'])){
    $sum =  $obM->countColumnSum('orders',"total_amnt",["status" => 3]);
   echo $sum = $sum + ($sum * 0.1);
    exit();
}