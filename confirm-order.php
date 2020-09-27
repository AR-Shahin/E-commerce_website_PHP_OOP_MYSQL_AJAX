<?php include 'header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="confirm-order-content" style="margin:30px 0;">
                <p style="font-size: 18px;text-align: center;padding:25px 0;">Thanks <b><?= $_SESSION['cusname']?></b> for Purchase. Your Order Successfully. We will contact you ASAP with delivery details. Here is your order details . . . . . .
                    <br>
                    <a href="order-details.php" class="btn btn-link" style="margin-top:15px;">Visit Here . . . .</a></p>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';?>
