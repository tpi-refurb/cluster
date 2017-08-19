<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" name="viewport">
	<title>Login - TLR</title>

	<!-- css -->
	<link href="assets/css/base.css" rel="stylesheet">
	<link href="assets/css/project.css" rel="stylesheet">
	<link href="assets/css/animate.css" rel="stylesheet">

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
									<div class="card-inner">
										<h1 class="card-heading center">Login TLR Updater</h1>
									</div>
								</div>
								<!--
								<div class="progress">
									<div class="progress-bar-indeterminate"></div>
								</div>
								-->
								<div class="card-inner">
								
									<p class="text-center">
										<span class="avatar avatar-inline avatar-lg">
											<img alt="Login" src="assets/images/logo-b.png">
										</span>
									</p>
									<form id="signin_form" class="form">
									
											
										<div class="form-group form-group-label">
											<div class="row">											
												<div class="col-md-10 col-md-push-1">
												
													<label class="floating-label" for="ui_login_username">Username</label>													
													<input class="form-control" id="ui_login_username" name="ui_login_username" type="text">
												</div>
											</div>
										</div>
										<div class="form-group form-group-label">
											<div class="row">
												<div class="col-md-10 col-md-push-1">
													<label class="floating-label" for="ui_login_password">Password</label>
													<input class="form-control" id="ui_login_password" name="ui_login_password" type="password">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-10 col-md-push-1">
													<button type="submit" class="btn btn-block btn-brand waves-attach waves-light" id="signin_button">Sign In</button>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-10 col-md-push-1">
													<div class="checkbox checkbox-adv">
														<label for="ui_login_remember">
															<input class="access-hide" id="ui_login_remember" name="ui_login_remember" type="checkbox">Stay signed in
															<span class="checkbox-circle"></span><span class="checkbox-circle-check"></span><span class="checkbox-circle-icon icon">done</span>
														</label>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="clearfix">							
							<p class="margin-no-top pull-left"><a class="btn btn-flat btn-brand waves-attach" href="<?php echo 'index.php?p='.encode_url('2');?>">Forgot Password?</a></p>
						
							<p class="margin-no-top pull-right"><a class="btn btn-flat btn-brand waves-attach" href="<?php echo 'index.php?p='.encode_url('1');?>">Create an account</a></p>
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

	<!--
	<div aria-hidden="true" class="modal modal-va-middle fade" id="ui_dialog_message" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-xs">
			<div class="modal-content">
				<div class="modal-heading">
					<p class="modal-title" id="message_title">Message Title</p>
				</div>
				<div class="modal-inner">
					<p class="h5 margin-top-sm text-black-hint" id="message_body">Message body.</p>
				</div>
				<div class="modal-footer">
					<p class="text-right">
						<a class="btn btn-flat btn-brand-accent waves-attach" data-dismiss="modal">Cancel</a>
					</p>
				</div>
			</div>
		</div>
	</div>
	-->
	<!-- js -->
	<script src="assets/js/jquery-3.1.0.min.js"></script>	
	<script src="assets/js/base.min.js"></script>
	<script src="assets/js/project.min.js"></script>
	<script src="assets/js/marianz.dialog.js"></script>
	<script src="assets/js/marianz.auth.js"></script>
</body>
</html>