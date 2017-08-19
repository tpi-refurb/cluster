	<?php
	
	$header = 'Profile';
	if($ms==='cp'){
		$header = 'Change Password';
	}else if($ms==='ua'){
		$header = 'Avatar';
	}else{
		$header = 'Profile';
	}
	
	
	
	?>
	<main class="content">
		<div class="content-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
						<h1 class="content-heading"><?php echo $header; ?></h1>
					</div>					
				</div>		
			</div>		
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
					<section class="content-inner margin-top-no">
						<form id="profile_form" class="form" enctype="multipart/form-data">
						<?php if($ms==='cp'){ ?>
							<h2 class="content-sub-heading">Change Password</h2>
							<div class="media margin-bottom margin-top">
								<div class="media-object pull-left">
									<span class="icon icon-lg text-brand-accent">info_outline</span>
								</div>
								<div class="media-inner">
									<span>Enter your current password.</span>
								</div>
							</div>	
							<div class="form-group form-group-label">
								<div class="row">										
									<div class="col-md-10">													
										<label class="floating-label" for="ui_oldpassword">Current Password</label>													
										<input class="form-control" id="ui_oldpassword" name="ui_oldpassword" type="text" value ="">
								
									</div>
								</div>												
							</div>
							<div class="media margin-bottom margin-top">
								<div class="media-object pull-left">
									<span class="icon icon-lg text-brand-accent">info_outline</span>
								</div>
								<div class="media-inner">
									<span>Enter new password and re-type for verification.</span>
								</div>
							</div>						
							<div class="form-group form-group-label">
								<div class="row">										
									<div class="col-md-10">													
										<label class="floating-label" for="ui_password">New Password</label>													
										<input class="form-control" id="ui_password" name="ui_password" type="text" value ="">
								
									</div>
								</div>												
							</div>
							<div class="form-group form-group-label">
								<div class="row">
									<div class="col-md-10">													
										<label class="floating-label" for="ui_password_confirm">Re-type Password: </label>
										<input class="form-control" id="ui_password_confirm" name="ui_password_confirm" type="text" value ="">
									</div>
								</div>												
							</div>
						<?php }else if($ms==='ua'){ ?>
								<p class="h4 text-brand-accent">Coming Soon...</p>
						<?php }else{ ?>
								<p class="h4 text-brand-accent">Coming Soon...</p>
						<?php } ?>
						</form>
					</section>
				</div>
			</div>
		</div>
	</main>
	
	

