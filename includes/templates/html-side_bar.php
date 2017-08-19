	<nav aria-hidden="true" class="menu" id="ui_menu" tabindex="-1">
		<div class="menu-scroll">
			<div class="menu-content">
				<a class="menu-logo text-white" href="index.php" style="background-color:#3f51b5;"><img alt="Telcomtrix Logo" src="assets/images/logo.png"><span class="text-white">Cluster</span></a>
				<ul class="nav">
					<li>
						<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('10');?>"><span class="icon icon-lg margin-right">backup</span>Import Data</a>
					</li>	
					<li>
						<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('p').'&l='.encode_url($dt);?>"><span class="icon icon-lg margin-right">system_update_alt</span>Update Remarks</a>
					</li>	
					<li>
						<a class="collapsed waves-attach" data-toggle="collapse" href="#ui_menu_components"><span class="icon icon-lg margin-right">my_location</span>Crawled Data</a>
						<ul class="menu-collapse collapse" id="ui_menu_components">
							<li>
								<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('11').'&sp='.encode_url('v').'&l='.encode_url('today');?>">Today</a>
							</li>
							<li>
								<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('11').'&sp='.encode_url('v').'&l='.encode_url('tommorow');?>">Tommorrow</a>
							</li>
							<li>
								<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('11').'&sp='.encode_url('v').'&l='.encode_url('deleted');?>">Deleted</a>
							</li>	
							<li>
								<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('11').'&sp='.encode_url('v').'&l='.encode_url('all');?>">Show All</a>
							</li>							
						</ul>
					</li>				
					<hr class="dashed_line"/>
					
					<li>
						<a class="waves-attach" href="javascript:void(0)">
							<span class="icon icon-lg margin-right">perm_data_setting</span>Maintenance
							<span class="menu-collapse-toggle collapsed waves-attach" data-target="#ui_menu_maintenance" data-toggle="collapse">
								<div class="menu-collapse-toggle-close">
									<i class="icon icon-lg text-red">close</i>
								</div>
								<div class="menu-collapse-toggle-default">
									<i class="icon icon-lg text-brand">add</i>
								</div>
							</span>
						</a>
						<ul class="menu-collapse collapse" id="ui_menu_maintenance">
						<?php if($auth->isAdmin($global_userid)){ ?>
							<li><a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('15').'&s='.encode_url('v').'&l='.encode_url('users'); ?>">Users</a></li>
						<?php } ?>
							<li><a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('15').'&s='.encode_url('v').'&l='.encode_url('installers'); ?>">Installers</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>