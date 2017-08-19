
	
	
	
	<main class="content">
		<div class="content-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-lg-push-3 col-sm-10 col-sm-push-1">						
						<h1 class="content-heading">Crawled Data</h1>						
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
					<section class="content-inner margin-top-no">
						<div class="row">
							<div class="col-lg-4 pull-left">
								<h2 class="content-sub-heading">List of Crawled Data <strong class="text-brand-accent"><?php echo strtoupper($l); ?></strong></h2>
								<p>Data from imported Excel file which was crawled by <a href="#" target="_blank">WFM Crawler<sup class="margin-left-xs"><span class="icon">open_in_new</span></sup></a>.</p>
														
							</div>
							<div style="height:40px;"></div>
							<div class="col-lg-2 col-sm-2 pull-right">
								<div class="dropdown-wrap pull-right">
									<div class="dropdown dropdown-inline">
										<a class="btn dropdown-toggle-btn" data-toggle="dropdown"> <small>Filter Data: </small><strong class="text-brand"><?php echo $l; ?> </strong></a>
										<ul class="dropdown-menu nav">											
											<li>
												<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url($dt);?>">Selected Date</a>
											</li>
											<li>
												<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url('assigned');?>"><strong class="text-brand">Assigned Date</strong></a>
											</li>
											<li>
												<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url('today');?>">Today</a>
											</li>
											<li>
												<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url('tommorow');?>">Tommorrow</a>
											</li>
                                            <li>
                                                <a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url('deleted');?>">Deleted</a>
                                            </li>
                                            <li>
                                                <a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('yd').'&s='.encode_url('v').'&l='.encode_url('your_date');?>">Your Date</a>
                                            </li>
                                            <li>
												<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url('all');?>">Show All</a>
											</li>			
										</ul>
									</div>
								</div>		
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="media pull-left">
									<form id="search_form">
										<input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url($l);?>">						
										<div class="media-object pull-right" style="padding-right:5px;">
											<!--<label class="form-icon-label" for="input-icon-address"><span class="access-hide">Address</span><span class="icon">search</span></label>
											--><a class="fbtn fbtn-default waves-attach waves-circle waves-light" id="ui_search_button" name="ui_search_button" > <span class="icon icon-lg text-brand">search</span></a>
										</div>
										<div class="media-inner">
											<input class="form-control" id="ui_search" name="ui_search" placeholder="Search ..." type="text" value="<?php echo empty($q) ?'':$q;?>">
										</div>
									</form>
								</div>
							</div>
						</div>
						<input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url($l);?>">
						<div class="tile-wrap">
							<?php	

								$dispatch->view_data_dispatch($l,$dt,$yd,$q);
							?>			
					
						</div>
						
						
						
						<div class="row col-lg-12">						
							<div class="col-lg-6 col-xs-6 pull-left">
								<a class="fbtn waves-attach waves-circle waves-light pull-left" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('v');?>"><span class="icon">arrow_back</span></a>
							</div>
							<div class="col-lg-6 col-xs-6 pull-right">
								<a class="fbtn waves-attach waves-circle waves-light pull-right" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('p').'&l='.encode_url($dt);?>"><span class="icon">arrow_forward</span></a>
							</div>								
						</div>		
						
					</section>
				</div>				
				
			</div>
		</div>
	</main>
	
	<div aria-hidden="true" class="modal modal-va-middle fade" id="ui_dialog_tech" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-xs">
			<div class="modal-content">
				<div class="modal-heading">
					<h3 class="modal-title">Select Technician</h3>
				</div>
				<form id="assigned_tech_form" class="form">
					<div class="modal-inner" style="max-height: 420px;overflow-y: auto;">
							<input hidden type="hidden" id="d" name="d" value="<?php echo $dt;?>">
							<input hidden type="hidden" id="i" name="i" value="">
							<input hidden type="hidden" id="o" name="o" value="">
							<ul class="nav">
								<?php
									
									$dispatch->print_dialog_tech($pdt);
								
								?>
							</ul>
						
					</div>
					
				</form>
			</div>
		</div>
	</div>
	

