<?php
	$ord_no = '';
	$active = 1;
	$form_id = ($ms==='a')? 'add_form_'.$location : 'edit_form_'.$location;


?>
	<main class="content">
		<div class="content-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
						<h1 class="content-heading"><?php echo strtoupper($location); ?></h1>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
					<section class="content-inner margin-top-no">
						<div class="card">
							<div class="card-main">
								<div class="card-inner">
									
									
								<h2 class="content-sub-heading">Settings</h2>	
									
									<div class="tile-wrap">
									
										<form id="settings_form" class="form">
											<input hidden type="hidden" name="r" id="r" value="<?php echo 'index.php?p='.encode_url('11').'&s='.encode_url('v').'&m='.encode_url($mp).'&c='.encode_url($mc); ?>">
											<input hidden type="hidden" name="t" id="t" value="<?php echo encode_url($mp);?>">
											<input hidden type="hidden" name="c" id="c" value="<?php echo encode_url($mc);?>">
											<input hidden type="hidden" name="i" id="i" value="<?php echo encode_url($id);?>">
											<input hidden type="hidden" name="s" id="s" value="<?php echo encode_url($ms);?>">
											<input hidden type="hidden" name="l" id="l" value="<?php echo encode_url($location);?>">
											
											
											<p>
												<a class="btn btn-flat collapsed waves-attach" data-toggle="collapse" href="#ui_collapse_data">
													<span class="collapsed-hide"><span class="icon">remove_circle</span>  Hide Updates Configuration </span>
													<span class="collapsed-show"><span class="icon">add_circle</span> Show Updates Configuration</span>
												</a>
											</p>
											<div class="collapsible-region collapse" id="ui_collapse_data">
												<div class="form-group form-group-label">
													<div class="row">											
														<div class="col-md-10 col-md-push-1">
															
															<div class="checkbox switch">
																<label for="ui_settings_autoconfirm">
																	<input class="access-hide" id="ui_settings_autoconfirm" name="ui_settings_autoconfirm" type="checkbox"><span class="switch-toggle"></span> Automatic confirm client registration
																</label>
															</div>
														</div>
													</div>												
												</div>												
											</div>
													
											<?php 
												
												$keys = array('dispatch'=>'Dispatch');
												if($auth->isAdmin($global_userid)){
													$keys = array('site'=>'Site','smtp'=>'Email','cookie'=>'Cookies','dispatch'=>'Dispatch');
												}
												foreach($keys as $k => $v){
													?>
													
													<p>
														<a class="btn btn-flat collapsed waves-attach" data-toggle="collapse" href="#ui_collapse_<?php echo $k;?>">
															<span class="collapsed-hide"><span class="icon">remove_circle</span>  Hide <?php echo $v;?> Configuration </span>
															<span class="collapsed-show"><span class="icon">add_circle</span> Show <?php echo $v;?> Configuration</span>
														</a>
													</p>
													<div class="collapsible-region collapse" id="ui_collapse_<?php echo $k;?>">
														<?php 
															$q = "SELECT * FROM config WHERE setting LIKE '".$k."%';";
															//$q = "SELECT * FROM tlr.config;";
															$rs = $db->getResults($q);
															foreach($rs as $r){ 
																$name = $r['setting'];
																$val = $r['value'];
																$type = $r['type'];
																$desc = $r['description'];
																$setting = str_replace('site_','', $name);
															
																if($type=='BOOLEAN'){
																	$checked = ($val==='1')? 'checked' : '';
																	$val = ($val==='1')? 'on' : 'off';
																	echo '<div class="form-group form-group-label">
																		<div class="row">											
																			<div class="col-md-10 col-md-push-1">													
																				<div class="checkbox switch" '.$checked.'>
																					<label for="ui_settings_'.$name.'">
																					<input '.$checked.' class="access-hide" id="ui_settings_'.$name.'" name="ui_settings_'.$name.'" type="checkbox" value="'.$val.'"><span class="switch-toggle"></span> '.$desc.'
																					</label>
																				</div>
																			</div>
																		</div>												
																	</div>';
																//}else if (preg_match('#^VARCHAR#i', $type) === 1){
																	
																}else{
																	echo '<div class="form-group form-group-label">
																		<div class="row">											
																			<div class="col-md-10 col-md-push-1">													
																				<label class="floating-label" for="ui_settings_'.$name.'">'.$desc.'</label>													
																				<input class="form-control" id="ui_settings_'.$name.'" name="ui_settings_'.$name.'" type="text" value ="'.$val.'">
																		
																			</div>
																		</div>												
																	</div>';
																}
															}
															
														?>
													</div>
													
													<?php
												}
											
											
											?>
											
											
										</form>
									
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</main>
	
	