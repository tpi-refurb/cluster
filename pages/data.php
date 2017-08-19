
	
	
	
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
						
						<h2 class="content-sub-heading">List of Crawled Data <strong class="text-brand-accent"><?php echo strtoupper($l); ?></strong></h2>
						<p>Data from imported Excel file which was crawled by <a href="#" target="_blank">WFM Crawler<sup class="margin-left-xs"><span class="icon">open_in_new</span></sup></a>.</p>
						<input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&l='.encode_url('l');?>">	
								
						<div class="tile-wrap">
							<?php								
								$dispatch->view_data_dispatch($l,$dt,$yd, $q);
							?>		
					
						</div>
					</section>
				</div>				
				
			</div>
		</div>
	</main>
	
	

