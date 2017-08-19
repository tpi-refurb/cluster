<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" name="viewport">
	<title>Forgot Password - Cluster</title>

	<!-- css -->
	<link href="assets/css/base.min.css" rel="stylesheet">
	<link href="assets/css/project.min.css" rel="stylesheet">

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
											<span class="card-heading">Forgot Password?</span>
										</div>
									</div>
								</div>
								<!--
								<div class="progress">
									<div class="progress-bar-indeterminate"></div>
								</div>
								-->
								<div class="card-inner">
									<p><span class="icon icon-lg text-brand-accent">info_outline</span> Please enter your valid email address then check in your email inbox for the reset code.</p>
									<form id="signin_form">
										
										<div class="form-group form-group-label">
											<div class="row">
												<div class="col-md-8 col-md-push-1">
													<label class="floating-label" for="email">Email</label>
													<span>
														<input class="form-control" id="email" name="email" type="email" required data-rule-minlength="3">
													</span>
												</div>
												<div class="col-md-2 col-md-push-1">
													<a class="fbtn fbtn-brand waves-attach waves-circle waves-light"> <span class="icon icon-lg text-white">send</span></a>

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
	<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>	
	<script src="assets/js/base.min.js"></script>
	<script src="assets/js/project.min.js"></script>
	<script src="assets/js/marianz.auth.js"></script>
</body>
</html>