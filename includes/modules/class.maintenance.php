<?php
//require 'mailer/PHPMailerAutoload.php';

class Maintenance
{
    private $db;
	
    public function __construct(\PDO $dbh)
    {
        $this->db = $dbh;
    }
	
	public function view_maintenance_user($dt){
		$this->check_dispatch($dt);
		$fdt = force_date($dt);
		$q = 'SELECT * FROM view_clus_'.$dt;
		$rs = $this->db->getResults($q);
		if(count($rs)>0){
			foreach($rs as $r){
				$bg_color = rand_color();
				$id			= $r['id'];
				$ins_id1	= $r['installer_1'];
				$ins_id2	= $r['installer_2'];
				$installer1 = $r['Installer1'];
				$installer2 = $r['Installer2'];
				$unique_id	= $id. remove_special_char($installer1);
				
				$e_id		= encode_url($id);
				$e_at		= encode_url($ins_id1);
				$e_ap		= encode_url($ins_id2);
				
				$view_link ='index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('s').'&at='.encode_url($ins_id1).'&ap='.encode_url($ins_id2);
				
				echo '<div class="tile">
					<div class="tile-side pull-left">
						<div class="avatar avatar-sm avatar-brand-accent">
							<span class="icon icon-2x">group</span>
						</div>
					</div>
					<div class="tile-action">
						<ul class="nav nav-list margin-no pull-right">
							<li>
								<a class="text-black-sec waves-attach" href="javascript:void(0)" onclick="deleteTechnician({id:\''.$e_id.'\',at:\''.$e_at.'\',ap:\''.$e_ap.'\'});"><span class="icon">delete</span></a>
							</li>
							<li>
								<a class="text-black-sec waves-attach" href="javascript:void(0)"><span class="icon">refresh</span></a>
							</li>
							<li>
								<a class="text-black-sec waves-attach" href="'.$view_link.'"><span class="icon">assignment_ind</span></a>
							</li>							
						</ul>
					</div>
					<div class="tile-inner">													
						<div class="media">													
							<div class="media-inner text-overflow">
								<span class="ui-picker-info-title">'.$installer1.'</span>
							</div>
							<div class="media-object">
								<small class="text-brand">'.$installer2.'</small>
							</div>
						</div>
					</div>
				</div>';
				
			}
		}else {									
			echo '<p class="h4 text-brand-accent">No technician was assigned for <strong class="text-brand">'.$fdt.'</strong> dispatch.</p>';
		}					
	}
	public function view_maintenance_admin($tbl){
		$q = 'SELECT * FROM users';
		$rs = $this->db->getResults($q);
		if(count($rs)>0){
			foreach($rs as $r){
				$bg_color = rand_color();
				$id			= $r['id'];
				$username	= $r['username'];
				$firstname	= $r['firstname'];
				$lastname	= $r['lastname'];
				$email		= $r['email'];
				$unique_id		= $id. remove_special_char($username);
			
				echo '
				<div class="tile tile-collapse">
					<div data-target="#'.$id.'" data-toggle="tile">
						<div class="tile-side pull-left">
							<div class="avatar avatar-sm avatar-brand">
								<span class="icon">group</span>
							</div>
						</div>
						<div class="tile-action">
							<ul class="nav nav-list margin-no pull-right">
								<li>
									<a class="text-black-sec waves-attach" href="#"><span class="icon">launch</span></a>
								</li>
								<li>
									<a class="text-black-sec waves-attach" href="#" target="_blank"><span class="icon">print</span></a>
								</li>	
								<li class="dropdown">
									<a class="dropdown-toggle text-black-sec waves-attach" data-toggle="dropdown"><span class="icon">settings</span></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li class="disabled">																
											<a href="#"><span class="icon margin-right-sm">loop</span>Add assignment..</a>
										</li>
										<li>
											<a class="waves-attach" href="javascript:void(0)" ><span class="icon margin-right-sm">delete</span>Delete</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="tile-inner">
							<div class="media">													
								<div class="media-inner text-overflow">
									<span class="ui-picker-info-title">'.$firstname.'</span>
								</div>
								<div class="media-object">
									<small class="text-brand">'.$firstname.' '.$lastname.'</small>
								</div>
							</div>
						</div>
					</div>
					<div class="tile-active-show collapse" id="'.$id.'">';
						
						
					echo '					
						<div class="tile-footer">
							<div class="tile-footer-btn pull-left">									
								<!-- @TODO -->							
							</div>
							<div class="tile-footer-btn pull-right">														
								<a class="btn btn-flat waves-attach" data-toggle="tile" href="#'.$id.'"><span class="icon">close</span>&nbsp;Cancel</a>														
							</div>
						</div>
					</div>
				</div>
				';
				
				
			}
		}
	}
	
	
	function get_fullname($id){
		$q ="SELECT concat(firstname,' ', lastname) as fullname FROM cluster.installers where id =".$id;
		$rs = $this->db->getResults($q);
		if(count($rs)>0){
			foreach($rs as $r){
				return $r['fullname'];
			}
		}
	}
}

?>
