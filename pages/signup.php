<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" name="viewport">
	<title>Signup - TLR</title>

	<!-- css -->
	<link href="assets/css/base.css" rel="stylesheet">
	<link href="assets/css/project.css" rel="stylesheet">

	<!-- favicon -->
	<!-- ... -->
</head>
<body class="page-brand">
	
	<main class="content">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-lg-push-4 col-sm-6 col-sm-push-3">
					<section class="content-inner">
						<div class="card">
							<div class="card-main">
								<div class="card-header">
									<div class="card-header">
										<div class="card-header-side pull-left">
											<div class="avatar">
												<img alt="Signup Avatar" src="assets/images/users/avatar-001.jpg">
											</div>
										</div>
										<div class="card-inner">
											<span class="card-heading">Create new Account</span>
										</div>
									</div>
								</div>
								<!--
								<div class="progress">
									<div class="progress-bar-indeterminate"></div>
								</div>
								-->
								<div class="card-inner">
									<form id="signup_form" class="form">
										<div class="form-group form-group-label">
											<div class="row">
												<div class="col-md-10 col-md-push-1">
													<label class="floating-label" for="ui_signup_username">Username</label>
													<input class="form-control" id="ui_signup_username" name="ui_signup_username" type="text" required data-rule-minlength="3">
												</div>
											</div>
										</div>
										<div class="form-group form-group-label">
											<div class="row">
												<div class="col-md-10 col-md-push-1">
													<label class="floating-label" for="ui_signup_email">Email</label>
													<input class="form-control" id="ui_signup_email" name="ui_signup_email" type="email" required data-rule-minlength="3">
												</div>
											</div>
										</div>
										<div class="form-group form-group-label">
											<div class="row">
												<div class="col-md-10 col-md-push-1">
													<label class="floating-label" for="ui_signup_firstname">Firstname</label>
													<input class="form-control" id="ui_signup_firstname" name="ui_signup_firstname" type="text" required data-rule-minlength="2">
												</div>
											</div>
										</div>
										<div class="form-group form-group-label">
											<div class="row">
												<div class="col-md-10 col-md-push-1">
													<label class="floating-label" for="ui_signup_lastname">Lastname</label>
													<input class="form-control" id="ui_signup_lastname" name="ui_signup_lastname" type="text" required data-rule-minlength="2">
												</div>
											</div>
										</div>
										<div class="form-group form-group-label">
											<div class="row">
												<div class="col-md-10 col-md-push-1">
													<label class="floating-label" for="ui_signup_password">Password</label>
													<input class="form-control" id="ui_signup_password" name="ui_signup_password" type="password" required data-rule-minlength="5">
												</div>
											</div>
										</div>
										<div class="form-group form-group-label">
											<div class="row">
												<div class="col-md-10 col-md-push-1">
													<label class="floating-label" for="ui_signup_confirmpassword">Re-type Password</label>
													<input class="form-control" id="ui_signup_confirmpassword" name="ui_signup_confirmpassword" type="password" required data-rule-minlength="5">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-10 col-md-push-1">
													<button type="submit" class="btn btn-block btn-brand waves-attach waves-light" id="signup_button" >Sign Up</button>
												</div>
											</div>
										</div>
										
									</form>
								</div>
							</div>
						</div>
						<div class="clearfix">						
							<span><small>Already have account? </small></span><span class="margin-no-top"><a class="btn btn-flat btn-brand waves-attach" href="<?php echo 'index.php?p='.encode_url('0');?>">Signin</a></span>
						</div>
					</section>
				</div>
			</div>
		</div>
	</main>
	<footer class="ui-footer">
		<div class="container">
			<p>&copy; 2016 Telcomtrix</p>
		</div>
	</footer>

	<!-- js -->
	<script src="assets/js/jquery-3.1.0.min.js"></script>	
	<script src="assets/js/base.min.js"></script>
	<script src="assets/js/project.min.js"></script>
	<script src="assets/js/marianz.dialog.js"></script>
	<script src="assets/js/marianz.auth.js"></script>
</body>
</html>