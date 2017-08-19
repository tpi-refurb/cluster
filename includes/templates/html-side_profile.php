<nav aria-hidden="true" class="menu menu-right" id="ui_menu_profile" tabindex="0">
		<div class="menu-scroll">
			<div class="menu-top">
				<div class="menu-top-img">
					<img alt="<?php echo $global_fullname; ?>" src="assets/images/landscape.jpg">
				</div>
				<div class="menu-top-info">
					<a class="menu-top-user" href="javascript:void(0)">
					<span class="avatar avatar-inline margin-right">
					<img alt="<?php echo $global_fullname; ?>" src="assets/images/users/avatar-001.jpg"></span><?php echo $global_fullname; ?></a>
				</div>
				<div class="menu-top-info-sub">
					<small><?php echo $db->getValue('users_group','group_name','id='.$global_level); ?></small>
				</div>
			</div>
			<div class="menu-content">
				<ul class="nav">
					<li>
						<a class="waves-attach" href="javascript:void(0)">
							<span class="icon icon-lg margin-right">account_box</span>Profile Settings
							<span class="menu-collapse-toggle collapsed waves-attach" data-target="#ui_menu_profile_settings" data-toggle="collapse">
								<div class="menu-collapse-toggle-close">
									<i class="icon icon-lg">close</i>
								</div>
								<div class="menu-collapse-toggle-default">
									<i class="icon icon-lg">add</i>
								</div>
							</span>
						</a>
						<ul class="menu-collapse collapse" id="ui_menu_profile_settings">
							<li>
								<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('14').'&s='.encode_url('vp'); ?>">View Profile</a>
							</li>
							<li>
								<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('14').'&s='.encode_url('cp'); ?>">Change Password</a>
							</li>
							<li>
								<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('14').'&s='.encode_url('ua'); ?>">Update Avatar</a>
							</li>
						</ul>
					</li>
					<?php if($auth->isAdmin($global_userid)){ ?>
					<li>
						<a class="waves-attach" href="javascript:void(0)"><span class="icon icon-lg margin-right">supervisor_account</span>Manage Users</a>
					</li>
					<?php } ?>
					<li>
						<a class="waves-attach" href="<?php echo 'index.php?p='.encode_url('13'); ?>"><span class="icon icon-lg margin-right">settings</span>Settings</a>
					</li>
					<li>
						<a class="waves-attach" href="logout.php"><span class="icon icon-lg margin-right">settings_power</span>Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>