<?php
session_start();
if(isset($_SESSION['user_id'])){
    header('location:index.php');
}
?>
<?php include 'inc/header.php'?>
 <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
<div class="splash-container">
    <?php if(isset($_GET['success_mgs'])){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=$_GET['success_mgs'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <div class="card ">
        <div class="card-header text-center"><a href="index.php"><img class="logo-img" src="assets/images/black-logo.png" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
        <div class="card-body">
            <form action="" method="post" id="login_form" onsubmit="return false" autocomplete="off">
                <div class="form-group">
                    <input class="form-control form-control-lg" id="log_email" type="email" name="log_email" placeholder="Email" autocomplete="off">
                     <small id="log_email_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" id="password" type="password" placeholder="Password" name="password">
                     <small id="log_pass_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
            </form>
        </div>
        <div class="card-footer bg-white p-0  ">
            <div class="card-footer-item card-footer-item-bordered">
                <a href="registration.php" class="footer-link">Create An Account</a></div>
            <div class="card-footer-item card-footer-item-bordered">
                <a href="#" class="footer-link">Forgot Password</a>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'?>