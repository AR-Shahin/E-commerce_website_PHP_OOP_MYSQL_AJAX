<?php include 'header.php'?>

<!-- start main content -->
<main class="container">
    <style>
        .border-danger{
            border-color: red;
        }
    </style>
	<section>

		<div class="signuppanel">

			<div class="row">

				<div class="col-md-7 col-md-offset-2">

					<form action="" method="post" id="cus_reg_form" onsubmit="return false" autocomplete="off">

						<h3 class="nomargin">Sign Up</h3>
                        <?php
                        if(!isset($_SESSION['cus_id'])){ ?>
                            <p class="mt5 mb20">Already a member? <a href="signin.php"><strong>Sign In</strong></a></p>
                        <?php } ?>
						<label class="control-label">Name</label>
						<div class="row mb10">
							<div class="col-sm-6">
								<input type="text" class="form-control" id="fname" placeholder="Firstname" name="fname" />
                                <div id="f_error"></div>
							</div>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="lname" placeholder="Lastname" name="lname"/>
                                <div id="l_error"></div>
							</div>
						</div>

						<div class="mb10">
							<label class="control-label">Username</label>
							<input type="text" class="form-control" id="uname" name="uname"/>
                            <div id="u_error"></div>
						</div>

						<div class="mb10">
							<label class="control-label">Password</label>
							<input type="password" class="form-control" id="pass1" name="password1"/>
                            <div id="p1_error"></div>
						</div>

						<div class="mb10">
							<label class="control-label">Retype Password</label>
							<input type="password" class="form-control" id="pass2" />
                            <div id="p2_error"></div>
						</div>
						<div class="row mb10">
                            <label class="control-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phn"/>
                            <div id="p_error"></div>
						</div>

						<div class="mb10">
							<label class="control-label">Email Address</label>
							<input type="text" class="form-control" id="email" name="email" />
                            <div id="e_error"></div>
						</div>
                        <div class="mb10">
                            <label class="control-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"/>
                            <div id="add_error"></div>
                        </div>
						<br />
						<button class="btn btn-success btn-block">Sign Up</button>
					</form>
				</div><!-- col-sm-6 -->

			</div><!-- row -->



		</div><!-- signuppanel -->

	</section>
</main>
<!-- end  main content -->
<?php include 'footer.php'?>