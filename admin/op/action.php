<?php
require_once '../../vendor/autoload.php';
use App\classes\User;
use App\classes\DBoperation;
use App\classes\Manage;
use App\classes\Cart;
session_start();
$ob = new User();
$obD = new DBoperation();
$obM = new Manage();
$obH = new \App\classes\Helper();
$obC = new \App\classes\Cart();

//chck usr name
if(isset($_POST['check_username'])){
    $n = $_POST['username'];
    echo $ob->verify('customers',["cus_uname" => $n]);
    exit();
}
if(isset($_POST['fname']) AND isset($_POST['email'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $e = $ob->verify_email('customers',$_POST['email'],'cus_id');
    if($e == 'already_exists'){
        echo 'emailExists';
        exit();
    }else{
        $email = $_POST['email'];
    }
    $uname = $_POST['uname'];
    $phn = $_POST['phn'];
    $add = $_POST['address'];
    $options = ["COST" => 12];
    $password = $_POST['password1'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT, $options);
    $signup_date = date("Y-m-d H:i:s");
    $fields = array(
        "cus_fname" => $fname,
        "cus_lname" => $lname,
        "cus_uname" => $uname,
        "email" => $email,
        "cus_pass" => $hash_password,
        "cus_phone" => $phn,
        "cus_address" => $add,
        "total_order" => 0,
        "add_date" => $signup_date,
    );

    $id = $ob->insert_record('customers',$fields);
    if($id){
        echo 'INSERTED_USER';
        exit();
    }else{
        echo 'NOT_INSERTED_USER';
        exit();
    }

}
//cus login
if(isset($_POST['cus_email']) and isset($_POST['cus_pass'])){

    $data =  $ob->verify_email('customers',$_POST['cus_email'],'cus_id');
    if($data === 'invalid_email'){
        echo 'invalid_email';
        exit();
    }elseif ($data === 'ok'){
        echo 'NOT_REGISTER';
        exit();
    }elseif ($data === 'already_exists'){
        $email = $_POST['cus_email'];
        $rows = $ob->single_record('customers',["email" => $email]);
        $usr_pass = $rows['cus_pass'];
        if(password_verify($_POST['cus_pass'],$usr_pass)){
            $usr_id =  $rows['cus_id'];
            $cusname =  $rows['cus_fname'];
            $_SESSION['cus_id'] = $usr_id;
            $_SESSION['cusname'] = $cusname;
            $_SESSION['cus_email'] = $email;
            echo 'SUCCESS_LOGIN';
            exit();
        }else{
            echo 'PASSWORD_NOT_MATCH';
        }

    }
}
//search content
if(isset($_POST['skill'])) {
    $s = $_POST['skill'];
    echo $obM->autoComplete($s);
    exit();

}
//search product
if (isset($_POST["search_suggest_product"])) {
    $key = $_POST["key"];
    $result = $obM->manageRecordWithPagination("products",1,9,'search',0,$key);
    $rows = $result["rows"];
    # $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (((1 - 1) * 5)*2)+1;

        foreach ($rows as $row) {
            ?>
            <div class="col-md-3 col-sm-6" style="padding-bottom:15px;">
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

//add to cart
if(isset($_POST['add_to_cart'])){

    if(!isset($_SESSION['cus_id'])){
        echo 'PLZ_LOGIN';
        exit();
    }else {
        $pid = $_POST['pid'];
        $userID = $_SESSION['cus_id'];
        $double = $obM->checkDoubleItem('carts', ["u_id" => $userID, "p_id" => $pid]);
        if ($double === 'EXISTS') {
            echo 'EXISTS';
            exit();
        } else {
            $Pdata = $obM->single_record('products', ["product_id" => $pid]);
            $pname = $Pdata['productname'];
            $pimage = $Pdata['image'];
            $price = $Pdata['price'];
            $qty = $Pdata['quantity'];

            $fields = array(
                "p_id" => $pid,
                "ip_add" => 0,
                "u_id" => $userID,
                "p_name" => $pname,
                "p_image" => $pimage,
                "avilavle" => $qty,
                "quantity" => 1,
                "price" => $price,
                "total_amnt" => $price,
            );
            $insert = $ob->insert_record('carts', $fields);
            if ($insert) {
                echo 'PRODUCT_ADD_CART';
                exit();
            } else {
                echo 'PRODUCT_NOT_ADD_CART';
                exit();
            }
        }
    }
}

//--------------------------------cart//
//count cart
if(isset($_POST['count_cart_item']) && isset($_SESSION['cus_id'])){
    $userID = $_SESSION['cus_id'];
    echo $count = $obD->countRows('carts', ["u_id" => $userID]);
    exit();
}
//get cart get_checkout_items
if(isset($_POST['get_cart_item']) && isset($_SESSION['cus_id'])) {
    $userID = $_SESSION['cus_id'];
    $rows = $obD->fetch_data_conditions('carts', ["u_id" => $userID]);
    if($rows === false){
        echo 'null';
        exit();
    }
    foreach ($rows as $row) { ?>
        <li>
            <!-- Item image -->
            <div class="cart-img">
                <a href="#"><img src="admin/uploads/products/<?= $row['p_image'] ?>" alt="" class="img-responsive"/></a>
            </div>
            <!-- Item heading and price -->
            <div class="cart-title">
                <h5><a href="#"><?= $row['p_name'] ?></a></h5>
                <!-- Item price -->
                <span class="label label-color label-sm">$ <?= $row['price'] ?></span>
            </div>
            <div class="clearfix"></div>
        </li>
    <?php }
}

//get cart get_checkout_items

if(isset($_POST['get_checkout_items']) && isset($_SESSION['cus_id'])) {
    $userID = $_SESSION['cus_id'];
    $sum = 0;
    $rows = $obD->fetch_data_conditions('carts', ["u_id" => $userID]);
    if($rows === false){
        echo 'null';
        exit();
    }
    foreach ($rows as $row) {
        $tm = array($row['total_amnt']);
        $tam = array_sum($tm);
        $sum += $tam;
        ?>
        <tr>
            <td class="product-name-col">
                <figure>
                    <a href="#"><img style="width: 80px;" class="img-responsive" src="admin/uploads/products/<?= $row['p_image'] ?>" alt="Mustard yellow ruffle dress"></a>
                </figure>
                <h2 class="product-name"><a href="#"><?= $row['p_name'] ?></a></h2>
            </td>
            <td class="product-code">
                <input type="text" value="<?= $row['price']?>" class="form-control price" id="price-<?= $row['p_id']?>" pid = <?= $row['p_id'] ?> readonly >
            </td>
            <td class="product-price-col">
                <span class="product-price-special"><input id="avl-<?= $row['p_id'] ?>" class="form-control avl" type="text" value="<?= $row['avilavle']?>" readonly pid = <?= $row['p_id'] ?>></span>
            </td>
            <td>
                <div class="custom-quantity-input">
                    <input id="qty-<?= $row['p_id']?>" type="text" name="quantity" value="<?= $row['quantity'] ?>" class="form-control qty" pid = <?= $row['p_id']?>>
                </div>
            </td>
            <td class="product-total-col">
                <span class="product-price-special"><input id="total-<?= $row['p_id'];?>" class="form-control total" pid = <?= $row['p_id'] ?> type="text" value="<?= $row['total_amnt'] ?>" readonly></span>
            </td>
            <td>
                <a href="" up_id =<?= $row['p_id']?>  class="btn btn-xs btn-info update" style="display: inline-block;margin-bottom:20px;"><i class="fa fa-plus"></i></a>
                <a  href="" rmv_id =<?= $row['p_id']?> " class="btn btn-xs btn-danger remove" ><i class="fa fa-times"></i></a>
            </td>
        </tr>
    <?php }


}

if(isset($_POST['delete_checkout_items'])){
    $userID = $_SESSION['cus_id'];
    $pid = $_POST['pid'];
    echo $obD->delete_record('carts',["u_id" => $userID,"p_id"=> $pid]);
    exit();
}

if(isset($_POST['update_checkout_items'])){
    $userID = $_SESSION['cus_id'];
    $pid = $_POST['pid'];
    $total = $_POST['total'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    echo $obM->update_record('carts',["u_id" => $userID,"p_id"=> $pid],["quantity" => $qty,"total_amnt" => $total]);
    exit();
}

if(isset($_POST['calculate_price'])){
    $userID = $_SESSION['cus_id'];
    $sum = 0;
    $rows = $obD->fetch_data_conditions('carts', ["u_id" => $userID]);
    if($rows === false){
        echo 'null';
        exit();
    }
    foreach ($rows as $row) {
        $sum+= $row['total_amnt'];
    }
    echo json_encode($sum);
    exit();
}

//get customer data
if(isset($_POST['get_customer_data'])){
    $userID = $_SESSION['cus_id'];
    $rows = $obD->single_record('customers', ["cus_id" => $userID]);
    if($rows === false){
        echo 'null';
        exit();
    }
    echo json_encode($rows);
    exit();
}
//update billing
if(isset($_POST['firstname']) and isset($_POST['telephone'])){
    $userID = $_SESSION['cus_id'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $phone = $_POST['telephone'];
    $add1 = $_POST['address1'];
    $add2 = $_POST['address2'];
    $city = $_POST['city'];
    $zip = $_POST['postcode'];
    $fields = array(
        "cus_fname" => $fname,
        "cus_lname" => $lname,
        "cus_phone" => $phone,
        "cus_address" => $add1,
        "cus_address_2" => $add2,
        "cus_city" => $city,
        "cus_zip" => $zip
    );

    echo $res = $obM->update_record('customers',["cus_id" => $userID],$fields);
    exit();
}
//get cart get_checkout_items last
if(isset($_POST['checkout_items']) && isset($_SESSION['cus_id'])) {
    $userID = $_SESSION['cus_id'];
    $sum = 0;

    $rows = $obD->fetch_data_conditions('carts', ["u_id" => $userID]);
    if($rows === false){
        echo 'null';
        exit();
    }
    foreach ($rows as $row) {
        $sum+= $row['total_amnt'];
        ?>
        <tr>
            <td class="product-name-col">
                <figure>
                    <a href="#"><img style="width: 80px" src="admin/uploads/products/<?= $row['p_image'] ?>" alt="White linen sheer dress"></a>
                </figure>
                <h3 class="product-name"><a href="#"><?= $row['p_name'] ?></a></h3>
            </td>
            <td class="product-code"><?= $row['price'] ?>
            </td>
            <td class="product-price-col">
<span class="product-price-special"><?= $row['quantity'] ?>
                </span>
            </td>
            <td>

                <div class="custom-quantity-input">
                   <span class="product-price-special">$<?= $row['total_amnt'] ?>
                </div>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td class="checkout-total-title" colspan="3">
            <span>SUBTOTAL:
                </span>
        </td>
        <td class="checkout-total-price cart-total" colspan="2"> $<?= $sum?>
        </td>
    </tr>
    <tr>
        <td class="checkout-total-title" colspan="3">
            <span>Shipping:
                </span>
        </td>
        <td class="checkout-total-price cart-total" colspan="2"> $20
        </td>
    </tr>
    <tr>
        <td class="checkout-total-title" colspan="3">
            <span>TAX (10%):
                </span>
        </td>
        <td class="checkout-total-price cart-total" colspan="2"> $<?php
            echo $tax = $sum  *  0.1;
            ?>
        </td>
    </tr>
    <tr>
        <td class="checkout-total-title" colspan="3">
            <span>TOTAL:
                </span>
        </td>
        <td class="checkout-total-price cart-total" colspan="2"> $<?php
            echo $sum + $tax + 20;
            ?>
        </td>
    </tr>
    <?php
}

if(isset($_POST['confirm_order'])){
    $userID = $_SESSION['cus_id'];
    $rows = $obD->fetch_data_conditions('carts', ["u_id" => $userID]);
    foreach ($rows as $row) {
        $pid = $row['p_id'];
        $pname = $row['p_name'];
        $pimage = $row['p_image'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $avl = $row['avilavle'];
        $total = $row['total_amnt'];
        $fields = array(
            "cus_id" =>$userID,
            "pro_id" =>$pid,
            "pro_name" =>$pname,
            "quantity" =>$quantity,
            "price" =>$price,
            "total_amnt" =>$total,
            "pro_image" =>$pimage,
            "status" => 0,
            "process" => 0,
            "comment" => 'order'
        );
        $insert = $obD->insert_record('orders',$fields);
        if($insert){
            $newAvl = $avl - $quantity;
            $obM->update_record('products',["product_id" =>$pid],["quantity" => $newAvl]);
            $obD->delete_record('carts',["u_id" => $userID ]);
        }
    }
}
//get confirm order
if(isset($_POST['get_order_product']) && isset($_SESSION['cus_id'])) {
    $userID = $_SESSION['cus_id'];
    $rows = $obM->getAllOrderProduct($userID );
    if($rows === false){
        echo 'null';
        exit();
    }
    foreach ($rows as $row) { ?>
        <tr>
            <td class="product-name-col">
                <figure>
                    <a href="#"><img style="width: 80px;" class="img-responsive" src="admin/uploads/products/<?=$row['pro_image']?>" alt="Mustard yellow ruffle dress"></a>
                </figure>
                <h2 class="product-name"<a href="#"><?=$row['pro_name']?></a></h2>
            </td>
            <td><?=$row['quantity']?></td>
            <td><?=$row['total_amnt']?></td>
            <td><?=$row['date']?></td>
            <td>
                <?php
                if($row['status'] == 0){
                    echo '<a class="btn btn-xs btn-warning">Pending</a>';
                }else if($row['status'] == 1){
                    echo '<a  class="btn btn-xs btn-info">Shipping</a>';
                }else if($row['status'] == 2){
                    echo "<a class='btn btn-xs btn-success'>Received</a>
                           <a href='' class='btn btn-xs btn-danger' id='del_oder_product' pid = ".$row["pro_id"]." >Delete</a>";
                }
                ?>
            </td>
        </tr>
    <?php }
}

if(isset($_POST['delete_user_order_product'])){
    $userID = $_SESSION['cus_id'];
    $pid = $_POST['pid'];
   echo $obM->update_record('orders',["cus_id" => $userID,"pro_id" => $pid],["status" => 3]);
    exit();
}
?>

