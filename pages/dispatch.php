<?php
$ord_no =
$remarks =
$status =
$cbk =
$uy =
$sp =
$splitter =
$jump_wire ='';
if ($ms ==='u') {
	if(!empty($id)){
		$q ="SELECT * FROM clus_orders WHERE id=".$id;		
			$rs = $db->getResults( $q );
			if(count($rs) >0){
				foreach( $rs as $r ){
					$ord_no		= $r["ord_no"];
					$remarks	= $r["OKNo"];
					$status		= $r["status"];
					$cbk		= ($r["cbk"]==='1')? 'true': 'false';
					$uy			= $r["uy"];
					$sp			= ($r["sp"]==='1')? 'true': 'false';
					$splitter	= $r["splitter"];
					$jump_wire	= $r["jump_wire"];
					
				}
			}
	}
}
?>
	<main class="content">
		<div class="content-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-lg-push-3 col-sm-10 col-sm-push-1">						
						<h1 class="content-heading">Assignment</h1>						
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
					<section class="content-inner margin-top-no">						
					
					<?php if ($ms ==='a') { /* If ms/ State is equal to Add */ ?>
						<h2 class="content-sub-heading">New Dispatch for <?php echo $dispatch->get_installers_name($at,$ap, $pdt);?> </h2>
						<p>Add new assignment to selected technician  <span class="icon text-brand-accent"><sup>open_in_new</sup></span></p>
						<form id="new_assignment_form" class="form">
							<input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('p').'&l='.encode_url($dt);?>">
							<input hidden type="hidden" name="d" id="d" value="<?php echo ($pdt);?>">
							<input hidden type="hidden" name="s" id="s" value="<?php echo encode_url('n');?>">
							<input hidden type="hidden" name="o" id="o" value="<?php echo encode_url('0');?>">	
							<input hidden type="hidden" name="i" id="i" value="<?php echo encode_url($id);?>">	
							<input hidden type="hidden" name="ins1" id="ins1" value="<?php echo encode_url($at);?>">	
							<input hidden type="hidden" name="ins2" id="ins2" value="<?php echo encode_url($ap);?>">					
							
							
							<div class="form-group form-group-label">
								<div class="row">										
									<div class="col-md-10">													
										<label class="floating-label" for="ui_dispatch_ordno">Order No:</label>													
										<input class="form-control" id="ui_dispatch_ordno" name="ui_dispatch_ordno" type="text" value ="">
								
									</div>
								</div>												
							</div>
							<div class="form-group form-group-label">
								<div class="row">
									<div class="col-md-10">													
										<label class="floating-label" for="ui_dispatch_subsname">SubsName: </label>
										<input class="form-control" id="ui_dispatch_subsname" name="ui_dispatch_subsname" type="text" value ="">
									</div>
								</div>												
							</div>	
							<div class="form-group form-group-label">
								<div class="row">
									<div class="col-md-10">													
										<label class="floating-label" for="ui_dispatch_address">Address: </label>
										<input class="form-control" id="ui_dispatch_address" name="ui_dispatch_address" type="text" value ="">
									</div>
								</div>												
							</div>	
							
							
							<div class="row">	
								<div class="col-md-3">
									<div class="form-group form-group-label">									
										<label class="floating-label" for="ui_dispatch_serviceno">Service No: </label>
										<input class="form-control" id="ui_dispatch_serviceno" name="ui_dispatch_serviceno" type="text" value ="">
									</div>
								</div>										
								<div class="col-md-3">	
									<div class="form-group form-group-label">
										<label class="floating-label" for="ui_dispatch_contactno">Contact No: </label>
										<input class="form-control" id="ui_dispatch_contactno" name="ui_dispatch_contactno" type="text" value ="">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group form-group-label">
										<label class="floating-label" for="ui_dispatch_cabinetno">Cabinet No: </label>
										<input class="form-control" id="ui_dispatch_cabinetno" name="ui_dispatch_cabinetno" type="text" value ="">
									</div>
								</div>
							</div>			
							
							<div class="row">											
								<div class="col-md-2">	
									<div class="form-group form-group-label">
										<label class="floating-label" for="ui_dispatch_jobtype">Job Type: </label>
										<select class="form-control" id="ui_dispatch_jobtype" name="ui_dispatch_jobtype">
											<option value=""> </option>
											<option value="INST">INST</option>
											<option value="FLRP">FLRP</option>
											<option value="EXTC">EXTC</option>
											<option value="EXTR">EXTR</option>
											<option value="CHFA">CHFA</option>
											<option value="4GVB">4GVB</option>
											<option value="BBVB">BBVB</option>
											<option value="BB4G">BB4G</option>											
											<option value="WXVB">WXVB</option>
											<option value="VB4G">VB4G</option>
											<option value="VBVC">VBVC</option>
											<option value="VCVB">VCVB</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-group-label">
										<label class="floating-label" for="ui_dispatch_apptdate">Appt Date: </label>
										<input class="form-control ui_datepicker" id="ui_dispatch_apptdate" name="ui_dispatch_apptdate" type="text" value="<?php echo $dt; ?>">														
										<input hidden id="ui_apptdate_dispatch" name="ui_apptdate_dispatch" type="hidden">
									
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-group-label">									
										<label class="floating-label" for="ui_dispatch_apptslot"> Appt Slot: </label>
										<select class="form-control" id="ui_dispatch_apptslot" name="ui_dispatch_apptslot">
											<option value=""> </option>
											<option value="08:00-13:00">08:00-13:00</option>
											<option value="13:00-17:00">13:00-17:00</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-group-label">									
										<label class="floating-label" for="ui_dispatch_status"> Status </label>
										<select class="form-control" id="ui_dispatch_status" name="ui_dispatch_status">
											<option value=""> </option>
											<option value="NEW">NEW</option>
											<option value="OLD">OLD</option>
										</select>
									</div>
								</div>
							</div>												
							
						</form>	
					<?php } elseif ($ms ==='u') { /* If ms/ State is equal to Updates OK # */ ?>
						<h2 class="content-sub-heading"><?php echo $dispatch->get_installers_name($at,$ap, $pdt);?></h2>
						<p>Enter OK# or remarks for selected Order No.  <span class="icon text-brand-accent"><sup>open_in_new</sup></span></p>
						<form id="okno_update_form" class="form">
							<input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('p').'&l='.encode_url($dt);?>">
							<input hidden type="hidden" name="d" id="d" value="<?php echo ($pdt);?>">
							<input hidden type="hidden" name="s" id="s" value="<?php echo encode_url('u');?>">
							<input hidden type="hidden" name="o" id="o" value="<?php echo encode_url('0');?>">	
							<input hidden type="hidden" name="i" id="i" value="<?php echo encode_url($id);?>">	
							<input hidden type="hidden" name="ins1" id="ins1" value="<?php echo encode_url($at);?>">	
							<input hidden type="hidden" name="ins2" id="ins2" value="<?php echo encode_url($ap);?>">					
							
							
							<div class="form-group form-group-label">
								<div class="row">										
									<div class="col-md-10">													
										<label class="floating-label" for="ui_dispatch_ordno">Order No:</label>													
										<input class="form-control" id="ui_dispatch_ordno" name="ui_dispatch_ordno" type="text" value ="<?php echo $ord_no; ?>" readonly>
								
									</div>
								</div>												
							</div>
							<div class="form-group form-group-label">
								<div class="row">
									<div class="col-md-10">													
										<label class="floating-label" for="ui_dispatch_okno">OK#: </label>
										<input class="form-control" id="ui_dispatch_okno" name="ui_dispatch_okno" type="text" value ="<?php echo $remarks;?>">
									</div>
								</div>												
							</div>
							<div class="form-group form-group-label">
								<div class="row">
									<div class="col-md-10">													
										<label class="floating-label" for="ui_status">Status: </label>
										<input class="form-control" id="ui_status" name="ui_status" type="text" value ="<?php echo $status;?>">
									</div>
								</div>												
							</div>
							<div class="form-group form-group-label">
								<div class="row">
									<div class="col-md-10">													
										<div class="checkbox switch">
											<label for="ui_cbk">
											<input <?= ($cbk=='true')?'checked':''; ?> class="access-hide" id="ui_cbk" name="ui_cbk" type="checkbox" value="<?= $cbk; ?>"><span class="switch-toggle"></span> With CBK
											</label>
										</div>
									</div>
																			
								</div>												
							</div>
							<div class="form-group form-group-label">
								<div class="row">
									<div class="col-md-10">													
										<label class="floating-label" for="ui_uy">UY: </label>
										<input class="form-control" id="ui_uy" name="ui_uy" type="text" value ="<?php echo $uy;?>">
									</div>
								</div>												
							</div>
							<div class="form-group form-group-label">
								<div class="row">
									<div class="col-md-10">													
										<div class="checkbox switch">
											<label for="ui_sp">
											<input <?= ($sp=='true')?'checked':''; ?>  class="access-hide" id="ui_sp" name="ui_sp" type="checkbox" value="<?= $sp; ?>"><span class="switch-toggle"></span> With SP
											</label>
										</div>
									</div>																			
								</div>												
							</div>
							<div class="form-group form-group-label">
								<div class="row">
									<div class="col-md-10">													
										<div class="checkbox switch">
											<label for="ui_spl">
											<input <?= ($splitter=='true')?'checked':''; ?>  class="access-hide" id="ui_spl" name="ui_spl" type="checkbox" value="<?= $splitter; ?>"><span class="switch-toggle"></span> With Splitter
											</label>
										</div>
									</div>																			
								</div>												
							</div>
							<div class="form-group form-group-label">
								<div class="row">
									<div class="col-md-10">													
										<label class="floating-label" for="ui_jump_wire">Jumpering Wire: </label>
										<input class="form-control" id="ui_jump_wire" name="ui_jump_wire" type="text" value ="<?php echo $jump_wire;?>">
									</div>
								</div>												
							</div>
						</form>
					<?php } else {  ?>		
						<!-- TODO -->
					<?php } ?>				
							
						<div class="row col-lg-12">						
							<div class="col-lg-6 col-xs-6 pull-left">
								<a class="fbtn waves-attach waves-circle waves-light pull-left" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('p').'&l='.encode_url($dt);?>"><span class="icon">arrow_back</span></a>
							</div>
							<div class="col-lg-6 col-xs-6 pull-right">
							<!--
								<a class="fbtn waves-attach waves-circle waves-light pull-right" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('p').'&l='.encode_url($dt);?>"><span class="icon">arrow_forward</span></a>
							-->
							</div>								
						</div>		
										
					</section>
				</div>				
				
			</div>
		</div>
	</main>
	
	

