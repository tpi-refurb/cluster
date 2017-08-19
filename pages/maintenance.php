
	<main class="content">
		<div class="content-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-lg-push-3 col-sm-10 col-sm-push-1">						
						<h1 class="content-heading"><?php echo ucwords($l); ?></h1>						
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
					<section class="content-inner margin-top-no">						
						
					<?php if($l=='users') { /* If ms/ State is equal to View */  ?> 
						<h2 class="content-sub-heading">Manage Users</h2>
						<p>List of Users <span class="icon">open_in_new</span></p>
						<div class="tile-wrap">
							
							<?php
								$mainten->view_maintenance_admin($l);					
							?>
						</div>
						
						<div class="row col-lg-12">						
							<div class="col-lg-6 col-xs-6 pull-left">
								<a class="fbtn waves-attach waves-circle waves-light pull-left" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('h').'&s='.encode_url('v');?>"><span class="icon">arrow_back</span></a>
							</div>
							<div class="col-lg-6 col-xs-6 pull-right">
								<a class="fbtn waves-attach waves-circle waves-light pull-right" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url($dt);?>"><span class="icon">arrow_forward</span></a>
							</div>								
						</div>
						
					<?php } elseif ($l ==='installers') { /* If ms/ State is equal to Select */ ?>
						<h2 class="content-sub-heading">Manage Installers</h2>
						<p>List of  installers <span class="icon">open_in_new</span></p>
						<div class="tile-wrap">
							<input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('p').'&l='.encode_url($dt);?>">	
						
							<?php
								$mainten->view_maintenance_admin($l);
							?>
						</div>
						
						<div class="row col-lg-12">						
							<div class="col-lg-6 col-xs-6 pull-left">
								<a class="fbtn waves-attach waves-circle waves-light pull-left" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('v').'&l='.encode_url($dt);?>"><span class="icon">arrow_back</span></a>
							</div>
							<div class="col-lg-6 col-xs-6 pull-right">
								<!--
								<a class="fbtn waves-attach waves-circle waves-light pull-right" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url($dt);?>"><span class="icon">arrow_forward</span></a>
								-->
							</div>								
						</div>					
					
					<?php } else {  ?>		
						<!-- TODO -->
					<?php } ?>				
											
					</section>
				</div>				
				
			</div>
		</div>
	</main>
	
	

