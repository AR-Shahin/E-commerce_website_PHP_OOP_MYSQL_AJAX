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
        .splash-container {
            max-width: 440px;
        }
        .card-body{
            padding: .8rem;
        }
        .custom-control-label {
            line-height: 2.5;
            font-size: 12px;
        }
    </style>
    <div class="splash-container">
        <?php if(isset($_GET['fail_mgs'])){ ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?=$_GET['fail_mgs'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
        <div class="card ">
            <div class="card-body">
                <form class="splashc-container" action="" method="post" id="reg_form" onsubmit="return false" autocomplete="off">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-1">Registrations Form</h3>
                            <p>Please enter your user information.</p>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control" type="text" name="fullname"placeholder="Full Name" id="fullname">
                                <small id="fname_error" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="username" placeholder="Username" id="username">
                                <small id="uname_error" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <input class="form-control " type="email" name="email" id="email"placeholder="E-mail">
                                <small id="email_error" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <input class="form-control " id="pass1" type="password" placeholder="Password" name="password1">
                                <small id="p1_error" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <input class="form-control"  placeholder="Confirm Password" name="password2" id="pass2" type="password">
                                <small id="p2_error" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" required><span class="custom-control-label">By creating an account, you agree the <a href="#">terms and conditions</a></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-block btn-primary" type="submit" name="reg_btn">Register My Account</button>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <p>Already member? <a href="login.php" class="text-secondary">Login Here.</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include 'inc/footer.php'?>