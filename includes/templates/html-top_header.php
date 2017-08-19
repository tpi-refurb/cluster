<header class="header header-transparent header-waterfall ui-header">
		<ul class="nav nav-list pull-left">
		
			<li>
				<a data-toggle="menu" href="#ui_menu">
					<span class="icon icon-lg">menu</span>
				</a>
			</li>
		</ul>
		<!--
		<a class="header-logo margin-left-no" href="index.php">TLR Updater</a>
		-->
		<a class="header-logo margin-left-no" href="index.php">
			<span class="access-hide">Cluster  <sub class="text-muted" style="font-size:8pt;"><?php echo $dt; ?></sub></span>
			<!--<span ><img alt="Telcomtrix Logo" src="images/logo.png"></span>-->
			Cluster  <sub class="text-muted" style="font-size:8pt;"><?php echo $dt; ?></sub>
		</a>
		
		<ul class="nav nav-list pull-right">
			
			<li>
				<a data-toggle="menu" href="#search">
					<span class="access-hide">Search</span>
					<span class="icon icon-lg">search</span>
					<span class="header-close icon icon-close"></span>
				</a>
			</li>
			
			<li>
				<!--
				<a data-toggle="menu" href="#ui_menu_profile">
					<span class="icon icon-lg">menu</span>
				</a>
				-->
				<a data-toggle="menu" href="#ui_menu_profile">
					<span class="access-hide"><?php echo $global_username; ?></span>
					
					<?php 
						$avatar =$auth->getAvatar($global_username);
						$avatar_color =$auth->getAvatarColor($global_username);
						$initial = getFullnameInitial($global_fullname);
						if(empty($avatar)){
							echo '<span class="avatar avatar-sm"><img width="32" height="32" color="'.$avatar_color.'" letters="'.$initial.'" /></span>';
						}else{
							echo '<span class="avatar avatar-sm"><img alt="'.$global_username.'" src="'.$avatar.'"></span>';
						}
					?>
					
					
				</a>
			</li>
		</ul>
	</header>