<?php include "header.php"?>
    <!-- start main content -->
    <main class="container">

        <section>

            <div class="signinpanel">

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php
                        if(isset($_GET['success_mgs'])){ ?>
                            <p style="color: green;"><?=  $_GET['success_mgs']?></p>
                        <?php  } ?>
                        <form action="" method="post" id="cus_log_form" onsubmit="return false" autocomplete="off">
                            <h4 class="nomargin">Sign In</h4>
                            <p class="mt5 mb20">Login to access your account.</p>
                            <input type="email" class="form-control uname" placeholder="Email" name="cus_email" id="cus_uname"/>
                            <div id="log_cus_u_error"></div>
                            <input type="password" class="form-control pword" placeholder="Password" name="cus_pass" id="cus_pass"/>
                            <div id="log_cus_p_error"></div>
                            <a href="#"><small>Forgot Your Password?</small></a>
                            <button class="btn btn-success btn-block">Sign In</button>

                        </form>
                    </div><!-- col-sm-5 -->




                </div><!-- row -->


            </div><!-- signin -->

        </section>
    </main>
    <!-- end  main content -->

<?php include "footer.php";?>