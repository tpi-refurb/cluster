
	
	<?php if($sp==='yd'){ ?>




    <main class="content">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
                        <h1 class="content-heading">Select Date</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">

                    <section class="content-inner margin-top-no">
                        <h2 class="content-sub-heading">Select a date use for filter</h2>
                        <form id="selectdt_form" class="form" enctype="multipart/form-data">
                            <input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('h').'&s='.encode_url('v');?>">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-md-push-1">
                                        <span class="pull-left" style="width:80%;">
                                        <label for="date_dispatch">Your Date:</label>
                                        <input class="form-control ui_datepicker" id="date_filter" name="date_filter" type="text" value="<?php echo $dt; ?>">
                                        <input hidden id="ui_date_filter" name="ui_date_filter" type="hidden">
</span>
                                         <span class="pull-right">
											<a class="fbtn fbtn-brand waves-attach waves-circle waves-light" id="ui_view_filter_date"><span class="icon">arrow_forward</span></a>
										</span>

                                    </div>
                                </div>
                            </div>


                            </div>

                        </form>

                    </section>
                </div>
            </div>
        </div>
    </main>

    <?php } else { ?>

    <main class="content">
		<div class="content-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
						<h1 class="content-heading">Import Data</h1>
					</div>					
				</div>		
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
						
					<section class="content-inner margin-top-no">
						<h2 class="content-sub-heading">Browse Excel File</h2>
						<p>Excel file containing crawled data from <a href="#" target="_blank">WFM Crawler<sup class="margin-left-xs"><span class="icon">open_in_new</span></sup></a>.</p>
						<form id="excel_form" class="form" enctype="multipart/form-data">
							<input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('h').'&s='.encode_url('v');?>">
							
							<div class="form-group">
								<div class="row">											
									<div class="col-md-6 col-md-push-1">													
										<label for="date_dispatch">Date Dispatch:</label>
										<input class="form-control ui_datepicker" id="date_dispatch" name="date_dispatch" type="text" value="<?php echo $dt; ?>">														
										<input hidden id="ui_date_dispatch" name="ui_date_dispatch" type="hidden">



                                    </div>
								</div>												
							</div>
											
							<div class="form-group form-group-label">
								<div class="row">											
									<div class="col-md-10 col-md-push-1">
										<span class="pull-left" style="width:80%;">
											<input class="form-control" id="ui_excel_file" name="ui_excel_file" type="text" value="Choose file..."  value ="" readonly>
											<input type="file" accept=".xls, .xlsx" name="excel_file" id="excel_file" class="form-control" onchange="fileChange()"  style="display: none;" hidden>
										
											<!-- @Start Show loading in importing -->
											<div class="el-loading">
												<div class="el-loading-indicator el-loading-indicator-linear">
													<div class="progress progress-position-absolute-top">
														<div class="progress-bar-indeterminate"></div>
													</div>
												</div>
											</div>
											<!-- @End Show loading in importing -->
										
										</span>	
										
										<span class="pull-right">
											<a class="fbtn fbtn-brand waves-attach waves-circle waves-light" onclick="$('#excel_file').click();" id="ui_browse_excel"><span class="icon">folder</span></a>
										</span>
									</div>
								</div>
								<div class="row">											
									<div class="col-md-10 col-md-push-1">
										<span class="pull-left" style="width:80%;">
											<!-- Empty -->
										</span>										
										<span class="pull-right">
											<a class="fbtn waves-attach waves-circle waves-light" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('v');?>"><span class="icon">arrow_forward</span></a>
										</span>
									</div>
								</div>			
							</div>
							
						</form>				
						
					</section>
				</div>
			</div>
		</div>
	</main>

    <?php }  ?>

