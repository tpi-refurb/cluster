
	<main class="content">
		<div class="content-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-lg-push-3 col-sm-10 col-sm-push-1">						
						<h1 class="content-heading">Technicians</h1>						
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
					<section class="content-inner margin-top-no">						
						
					<?php if($ms=='v') { /* If ms/ State is equal to View */  ?> 
						<h2 class="content-sub-heading">List of Technician</h2>
						<p>Add technician <span class="icon">open_in_new</span></p>
						<div class="tile-wrap">
							<input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('v');?>">
							<input hidden type="hidden" name="d" id="d" value="<?php echo encode_url($pdt);?>">
							<input hidden type="hidden" name="s" id="s" value="<?php echo encode_url('d'); // set default state to delete ?>">
							
							<?php
								$dispatch->view_dispatch($pdt);					
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
					<?php } elseif ($ms ==='p') { /* If ms/ State is equal to Print */ ?>
						<h2 class="content-sub-heading">Job Order Per Technician</h2>
						<p>List of dispatch order no. <span class="icon">open_in_new</span></p>
						<div class="tile-wrap" id="print_dispatch">						
							<input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('p').'&l='.encode_url($dt);?>">								
							<input hidden type="hidden" name="d" id="d" value="<?php echo encode_url($pdt);?>">
							<input hidden type="hidden" name="s" id="s" value="<?php echo encode_url('d'); // set default state to delete ?>">
						
							<?php
								$dispatch->view_print_dispatch($pdt);					
							?>
						</div>
						
						<div class="row col-lg-12">						
							<div class="col-lg-6 col-xs-6 pull-left">
								<a class="fbtn waves-attach waves-circle waves-light pull-left" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url($dt);?>"><span class="icon">arrow_back</span></a>
							</div>
							<div class="col-lg-6 col-xs-6 pull-right">								
								<a class="fbtn waves-attach fbtn-green waves-circle waves-light pull-right" href="<?php echo 'includes/exports/excel.2.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('s').'&at='.encode_url($at).'&ap='.encode_url($ap).'&dt='.encode_url($pdt); ?>"><span class="icon">file_download</span></a>
								
							</div>								
						</div>
					<?php } elseif ($ms ==='s') { /* If ms/ State is equal to Select */ ?>
						<h2 class="content-sub-heading">Job Orders <?php echo $dispatch->get_installers_name($at,$ap, $pdt);?></h2>
						<p>List of dispatch order no. <span class="icon">open_in_new</span></p>
						<div class="tile-wrap">
							<input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('p').'&l='.encode_url($dt);?>">	
						
							<?php
								$dispatch->view_installer_dispatch($at,$ap,$pdt);					
							?>
						</div>
						
						<div class="row col-lg-12">						
							<div class="col-lg-6 col-xs-6 pull-left">
								<?php if($l==='h') { ?>
								<a class="fbtn waves-attach waves-circle waves-light pull-left" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('v').'&l='.encode_url($dt);?>"><span class="icon">arrow_back</span></a>
								<?php } else { ?>
								<a class="fbtn waves-attach waves-circle waves-light pull-left" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('p').'&l='.encode_url($dt);?>"><span class="icon">arrow_back</span></a>
								<?php } ?>
							</div>
							<div class="col-lg-6 col-xs-6 pull-right">
								<!--
								<a class="fbtn waves-attach waves-circle waves-light pull-right" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url($dt);?>"><span class="icon">arrow_forward</span></a>
								-->
							</div>								
						</div>
					<?php } elseif ($ms ==='a') { /* If ms/ State is equal to Add */ ?>
						<h2 class="content-sub-heading">Add Technician</h2>
						<p>Add technician with assignment  <span class="icon text-brand-accent"><sup>open_in_new</sup></span></p>
						<form id="add_tech_form" class="form">
							<input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('v');?>">
							<input hidden type="hidden" name="d" id="d" value="<?php echo encode_url($pdt);?>">
							<input hidden type="hidden" name="s" id="s" value="<?php echo encode_url($ms);?>">
							<input hidden type="hidden" name="i" id="i" value="<?php echo encode_url($id);?>">
							
							
							
							<div class="form-group form-group-label">
								<div class="row">											
									<div class="col-md-10 col-md-push-1">													
										<label for="ui_tech_installer1">Installer 1</label>													
										<select class="select2" name="ui_tech_installer1" id="ui_tech_installer1" style="width:100%">
											<?php
												$dispatch->print_select_tech();
											?>
										</select>
								
									</div>
								</div>												
							</div>
							<div class="form-group form-group-label">
								<div class="row">											
									<div class="col-md-10 col-md-push-1">													
										<label for="ui_tech_installer2">Installer 2: </label>
										<select class="select2" name="ui_tech_installer2" id="ui_tech_installer2" style="width:100%">
											<?php
												$dispatch->print_select_tech();
											?>
										</select>
									</div>
								</div>												
							</div>							
						</form>	
						
						<div class="row col-md-10">						
							<div class="col-md-4 col-xs-4 pull-left">
								<a class="fbtn waves-attach waves-circle waves-light" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('v');?>"><span class="icon">arrow_back</span></a>
							</div>
							<div class="col-md-6 col-xs-6 pull-right">								
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
	
	

