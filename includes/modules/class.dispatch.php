<?php
//require 'mailer/PHPMailerAutoload.php';

class Dispatch
{
    private $db;
	private $config;
	
    public function __construct(\PDO $dbh,$cfg)
    {
        $this->db = $dbh;
		$this->config = $cfg;
    }
	
	public function check_dispatch($dt){
		//$cdt = plain_date(get_currentdate());
	
		$sql = "CREATE TABLE IF NOT EXISTS `cluster`.`clus_".$dt."` (
				  `id` INT NOT NULL AUTO_INCREMENT,
				  `installer_1` INT(11) NOT NULL,
				  `installer_2` INT(11) NULL,
				  `ord_no` VARCHAR(45) NULL,
				  PRIMARY KEY (`id`));";  
				  
		$this->db->run($sql);
  
		$sql_view = "CREATE OR REPLACE VIEW `view_clus_".$dt."` AS
				SELECT 
					cc.id,
					cc.installer_1,
					CONCAT(ci.firstname, ' ', ci.lastname) AS Installer1,
					cc.installer_2,
					(SELECT 
							CONCAT(ci.firstname, ' ', ci.lastname)
						FROM
							installers AS ci
						WHERE
							cc.installer_2 = ci.id) AS Installer2
				FROM
					cluster.clus_".$dt." AS cc,
					installers AS ci
				WHERE
					cc.installer_1 = ci.id";
					
		$this->db->run($sql_view);
		
		$sql_clus ="CREATE TABLE IF NOT EXISTS `clus_assignment_".$dt."` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `ord_no` varchar(50) NOT NULL,
			  `JobType` varchar(5) DEFAULT NULL,
			  `ServiceNo` varchar(50) DEFAULT NULL,
			  `SubsName` varchar(100) NOT NULL,
			  `FullName` varchar(100) NOT NULL,
			  `ContactNo` varchar(100) DEFAULT NULL,
			  `CabinetNo` varchar(50) DEFAULT NULL,
			  `JobDescription` varchar(255) DEFAULT NULL,
			  `ApptDate` date DEFAULT NULL,
			  `ApptSlot` varchar(50) DEFAULT NULL,
			  `ApptSlotFrom` varchar(50) DEFAULT NULL,
			  `ApptSlotTo` varchar(50) DEFAULT NULL,
			  `HistoryStatus` varchar(50) DEFAULT NULL,
			  `AccountNo` varchar(50) DEFAULT NULL,
			  `InstAddress` text,
			  `ExchangeCode` varchar(5) DEFAULT NULL,
			  `JobTypeId` varchar(25) DEFAULT NULL,
			  `JobStatus` varchar(50) DEFAULT NULL,
			  `ServiceType` varchar(5) DEFAULT NULL,
			  `JobActivityList` text,
			  `unique_ord_no` varchar(50) NOT NULL,
			  `active` int(1) DEFAULT '1',
			  `assigned_to` int(11) DEFAULT NULL,
			  `assigned_partner` int(11) DEFAULT NULL,
			  `assigned_date` date DEFAULT NULL,
			  `OKNo` varchar(255) DEFAULT NULL,
			  PRIMARY KEY (`id`),
			  UNIQUE KEY `id_UNIQUE` (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
			//$this->db->run($sql_clus);
	}
	
	public function view_dispatch($dt){
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
				
				$view_link ='index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('s').'&l='.encode_url('h').'&at='.encode_url($ins_id1).'&ap='.encode_url($ins_id2);
				
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

    public function view_print_dispatch($dt){
		$fdt = force_date($dt);
		$q = 'SELECT * FROM view_clus_'.$dt;
		$rs = $this->db->getResults($q);
		if(count($rs)>0){
			foreach($rs as $r){
				$bg_color = rand_color();
				$id				= $r['id'];
				$assigned_to	= $r['installer_1'];
				$assigned_partner = $r['installer_2'];
				$installer1		= $r['Installer1'];
				$installer2		= $r['Installer2'];
				$unique_id		= $id. remove_special_char($installer1);
				
				$e_id		= encode_url($id);
				$e_at		= encode_url($assigned_to);
				$e_ap		= encode_url($assigned_partner);
				
				$add_link ='index.php?p='.encode_url('12').'&sp='.encode_url('t').'&s='.encode_url('a').'&at='.encode_url($assigned_to).'&ap='.encode_url($assigned_partner);
				$print_link ='includes/exports/print.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('s').'&at='.encode_url($assigned_to).'&ap='.encode_url($assigned_partner).'&dt='.encode_url($fdt);
				$view_link ='index.php?p='.encode_url('10').'&sp='.encode_url('t').'&s='.encode_url('s').'&l='.encode_url('d').'&at='.encode_url($assigned_to).'&ap='.encode_url($assigned_partner);
				
				$cq ="SELECT * FROM clus_orders WHERE assigned_to =".$assigned_to." AND assigned_partner =".$assigned_partner." AND assigned_date ='".$dt."' AND OKNo is null;";
				$rs = $this->db->getResults($cq);
				$count = count($rs);
				$ccount =0;
				if($count>=1){
					$ccount ='<span class="avatar avatar-red avatar-xs">'.$count.'</span>';
				}else{
					$ccount ='<span class="avatar avatar-green avatar-xs"><span class="icon">check</span></span>';
				}
		
				
				echo '
				<div class="tile tile-collapse">
					<div data-target="#'.$id.'" data-toggle="tile">
						<div class="tile-side pull-left">
							'.$ccount.'
						</div>
						<div class="tile-action">
							<ul class="nav nav-list margin-no pull-right">
								<li>
									<a class="text-black-sec waves-attach" href="'.$add_link.'"><span class="icon">add</span></a>
								</li>
								<li>
									<a class="text-black-sec waves-attach" href="'.$print_link.'" target="_blank"><span class="icon">print</span></a>
								</li>	
								<li>
									<a class="text-black-sec waves-attach" href="'.$view_link.'"><span class="icon">assignment_ind</span></a>
								</li>	
								<li class="dropdown">
									<a class="dropdown-toggle text-black-sec waves-attach" data-toggle="dropdown"><span class="icon">settings</span></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li class="disabled">																
											<a href="'.$view_link.'"><span class="icon margin-right-sm">loop</span>Add assignment..</a>
										</li>
										<li>
											<a class="waves-attach" href="javascript:void(0)" onclick="deleteTechnician({id:\''.$e_id.'\',at:\''.$e_at.'\',ap:\''.$e_ap.'\'});"><span class="icon margin-right-sm">delete</span>Delete</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="tile-inner">
							<div class="media">													
								<div class="media-inner text-overflow">
									<span class="ui-picker-info-title"> '.$installer1.'</span>
								</div>
								<div class="media-object">
									<small class="text-brand">'.$installer2.'</small>
								</div>
							</div>
						</div>
					</div>
					<div class="tile-active-show collapse" id="'.$id.'">
						<div class="tile-sub">';
				
									
									$q ="SELECT * FROM clus_orders WHERE assigned_to =".$assigned_to." AND assigned_partner =".$assigned_partner." AND assigned_date ='".$dt."';";
									$rs = $this->db->getResults($q);
									if(count($rs)>0){
										foreach($rs as $r){
											$iid			= $r['id'];
											$ord_no			= $r['ord_no'];
											$subsName		= $r['FullName'];
											$cabinetNo		= $r['CabinetNo'];
											$address		= $r['InstAddress'];
											$apptSlot		= $r['ApptSlot'];
											$okNo			= $r['OKNo'];
											
											$update_link ='index.php?p='.encode_url('12').'&sp='.encode_url('t').'&s='.encode_url('u').'&at='.encode_url($assigned_to).'&ap='.encode_url($assigned_partner).'&i='.encode_url($iid);
				
											$this->test_list_print($iid,$ord_no,$subsName,$cabinetNo,$address,$apptSlot,$okNo,$update_link);
										}
									}else{
										echo '<p class="h5 text-red">No job orders assigned for <strong class="text-brand">'.strtoupper($installer1).'</strong> .</p>';
									}
						
					echo '</div>
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
	
	function test_list_print($id, $ord_no,$subsName,$cabinetNo,$address,$apptSlot,$okNo,$update_link){
		$ok =empty($okNo)? '<span class="avatar avatar-red avatar-xs"><span class="icon">warning</span></span>':'<span class="avatar avatar-green avatar-xs"><span class="icon">check</span></span>';
		
		echo '<div class="tile">					
					<div class="tile-action">
						<ul class="nav nav-list margin-no pull-right">
							<li>
								'.$ok.'
							</li>	
							<li>
								<a class="text-black-sec waves-attach" href="'.$update_link.'" ><span class="icon">system_update_alt</span></a>
							</li>	
							<li>
								<a class="text-black-sec waves-attach" href="javascript:void(0)" onclick="confirmDeactivate(\''.encode_url('0').'\',\''.encode_url('clus_orders').'\',\''.encode_url($id).'\')"><span class="icon">close</span></a>
							</li>							
						</ul>
					</div>
					<div class="tile-inner">													
						<div class="media">													
							<div class="media-inner text-overflow">
								<span class="ui-picker-info-title"><strong>'.$ord_no.'</strong></span>
								<span style="width:30%;">&nbsp;&nbsp;</span>
								<span class="text-brand-accent">'.$subsName.'</span>
							</div>
							<div class="media-object">
								<small><strong class="text-brand">'.$apptSlot.'</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$address.'</small>
							</div>
							<div class="media-object">
								<small>OK Number:</small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong class="text-brand">'.$okNo.'</strong>
							</div>
						</div>
					</div>
				</div>';
	}
	
	function view_installer_dispatch($assigned_to,$assigned_partner, $dt){
		
		$q ="SELECT * FROM clus_orders WHERE assigned_to =".$assigned_to." AND assigned_partner =".$assigned_partner." AND assigned_date ='".$dt."';";
		$rs = $this->db->getResults($q);
		if(count($rs)>0){
			foreach($rs as $r){
				$iid		= $r['id'];
				$ord_no		= $r['ord_no'];
				$subsName	= $r['FullName'];
				$cabinetNo	= $r['CabinetNo'];
				$address	= $r['InstAddress'];
				$apptSlot	= $r['ApptSlot'];
				$okNo		= $r['OKNo'];
				
				$update_link ='index.php?p='.encode_url('12').'&sp='.encode_url('t').'&s='.encode_url('u').'&at='.encode_url($assigned_to).'&ap='.encode_url($assigned_partner).'&i='.encode_url($iid);
				
				$this->test_list_print($iid,$ord_no,$subsName,$cabinetNo,$address,$apptSlot,$okNo,$update_link);
			}
		}else{
			echo '<p class="h5 text-red">No job orders assigned...</p>';
		}
	}
	
	function view_data_dispatch($l, $dt,$yd, $search_key){
		$search_criteria = '';
		if(!empty($search_key)){
			if($l ==='all'){
				$search_criteria = " (ord_no LIKE '%".$search_key."%' OR SubsName LIKE '%".$search_key."%' OR FullName LIKE '%".$search_key."%' OR CabinetNo LIKE '%".$search_key."%')" ;
			}else{
				$search_criteria = " AND (ord_no LIKE '%".$search_key."%' OR SubsName LIKE '%".$search_key."%' OR FullName LIKE '%".$search_key."%' OR CabinetNo LIKE '%".$search_key."%')" ;			
			}
		}

        $ydt = force_date($yd);
        $fdt = force_date($dt);
        $pdt = plain_date($dt);
		$q ="SELECT * FROM clus_orders WHERE active =0;".$search_criteria;
		if($l ==='today'){
			$q ="SELECT * FROM clus_orders WHERE active =1 AND ApptDate ='".$fdt."'".$search_criteria;
		}else if($l ==='tommorow'){
			$q ="SELECT * FROM clus_orders WHERE active =1 AND ApptDate ='".add_days($fdt,1)."'".$search_criteria;
		}else if($l ==='assigned'){
            $q ="SELECT * FROM clus_orders WHERE active =1 AND assigned_date ='".$fdt."'".$search_criteria;
        }else if($l ==='your_date'){
            $q ="SELECT * FROM clus_orders WHERE active =1 AND ApptDate ='".$ydt."'".$search_criteria;
        }else if($l ==='deleted'){
			$q ="SELECT * FROM clus_orders WHERE active =0".$search_criteria;							
		}else if($l ==='all'){
			if(empty($search_key)){
				$q ="SELECT * FROM clus_orders";
			}else{
				$q ="SELECT * FROM clus_orders WHERE ".$search_criteria;
			}
		}else{
			$q ="SELECT * FROM clus_orders WHERE active =1 AND ApptDate ='".$dt."'".$search_criteria;
		}
		
		$rs = $this->db->getResults($q);
		if(count($rs)>0){
			$rowIndex= 0;
			foreach($rs as $r){
				$rowIndex += 1;
				$id				= $r['id'];
				$ord_no			= $r['ord_no'];
				$jobType		= $r['JobType'];
				$subsName		= $r['FullName'];
				$cabinetNo		= $r['CabinetNo'];
				$apptSlot		= $r['ApptSlot'];
				$address		= $r['InstAddress'];
				$assigned_to	= $r['assigned_to'];
				$assigned_partner	= $r['assigned_partner'];
				$assigned_date	= $r['assigned_date'];
				$serviceType	= $r['ServiceType'];
				$unique_ord_no	= $r['unique_ord_no'];
				$trim_unique_ord_no	= remove_special_char($r['unique_ord_no']);
				
				$serviceNo	= $r['ServiceNo'];
				$contactNo	= $r['ContactNo'];
				$apptDate	= $r['ApptDate'];
				$jobDescription	= $r['JobDescription'];
				$jt = $jobType==='FLRP'? 'R':'I';
				$is_noteastwood = false;
				$avatar = '';//$jobType==='FLRP' ? '<span class="avatar avatar-inline avatar-brand margin-right">'.$rowIndex.'<small>Rep</small></span>':'<span class="avatar avatar-inline avatar-brand-accent margin-right">'.$rowIndex.'<small>Ins</small></span>';
				if($jobType==='FLRP'){					
					if(strpos($address, 'EASTWOOD') !==false){
						$is_noteastwood = false;
						$avatar ='<span class="avatar avatar-inline avatar-brand margin-right">'.$rowIndex.'<small>Rep</small></span>';
					}else{
						if(strpos($cabinetNo, 'QCY123') !==false ||
						strpos($cabinetNo, 'QCY124') !==false ||
						strpos($cabinetNo, 'QCY126') !==false ||
						strpos($cabinetNo, 'QCY771') !==false ||
						strpos($cabinetNo, 'QCY774') !==false){
							$is_noteastwood = false;
							$avatar ='<span class="avatar avatar-inline avatar-brand margin-right">'.$rowIndex.'<small>Rep</small></span>';
						}else{
							$is_noteastwood = true;
							$avatar ='<span class="avatar avatar-inline margin-right">'.$rowIndex.'<small>Rep</small></span>';							
						}
					}
				}else{
					$avatar ='<span class="avatar avatar-inline avatar-brand-accent margin-right">'.$rowIndex.' <small>Ins</small></span>';	
				}
				
				
				if(!empty($assigned_to) and ($assigned_date === $dt)){
					
					$avatar = '<span class="avatar avatar-inline avatar-green margin-right"><span class="icon icon-2x" style="color:#FFF">group</span><small class="text-white">'.$jt.'</small></span>';
				}else{
					if(!empty($assigned_to) and ($assigned_date< $dt)){
						$avatar = '<span class="avatar avatar-inline avatar-orange margin-right"><span class="icon icon-2x" style="color:#FFF">directions_bike</span><small class="text-white">'.$jt.'</small></span>';
					}
				}
				
				$delete_link =($l==='deleted')?'<a class="text-black-sec waves-attach" href="javascript:void(0)" onclick="confirmActivate(\''.encode_url('1').'\',\''.encode_url('clus_orders').'\',\''.encode_url($id).'\')"><span class="icon text-green">check</span></a>':
												'<a class="text-black-sec waves-attach" href="javascript:void(0)" onclick="confirmDeactivate(\''.encode_url('0').'\',\''.encode_url('clus_orders').'\',\''.encode_url($id).'\')"><span class="icon">delete</span></a>';
														
				
				$assigned_details = '<strong class="text-brand-accent">Not assign</strong>';
				if(!empty($assigned_to) and  !empty($assigned_partner)){
					if($this->db->tableExist("view_clus_".$pdt)){
						$sql_ass = "SELECT * FROM cluster.view_clus_".$pdt." WHERE  installer_1 =".$assigned_to." AND installer_2 = ".$assigned_partner;
						$rs = $this->db->getResults($sql_ass);
						if(count($rs)>0){
							foreach($rs as $r){
								$installer1	= $r['Installer1'];
								$installer2	= $r['Installer2'];
								$assigned_details = '<small class="text-muted">Assigned to --></small> <strong class="text-brand-accent">'.$installer1.'</strong>:<strong class="text-brand">'.$installer2.'</strong>: &nbsp;&nbsp;'.$assigned_date;
							}
						}else{
							$alt_pdt = plain_date($assigned_date);
							if($this->db->tableExist("view_clus_".$alt_pdt)){
								$sql_ass = "SELECT * FROM cluster.view_clus_".$alt_pdt." WHERE  installer_1 =".$assigned_to." AND installer_2 = ".$assigned_partner;
								$rs = $this->db->getResults($sql_ass);
								if(count($rs)>0){
									foreach($rs as $r){
										$installer1	= $r['Installer1'];
										$installer2	= $r['Installer2'];
										$assigned_details = '<small class="text-muted">Assigned to --></small> <strong class="text-brand-accent">'.$installer1.'</strong>:<strong class="text-brand">'.$installer2.'</strong>: &nbsp;&nbsp;'.$assigned_date;
									}
								}
							}
						}
					}
				}
				$print_jobType = ($jobType==='FLRP') ? 'REPAIR':'INSTALL';
				$print_date = slashed_date($dt);
				$print_link ='https://wfm.globe.com.ph/workforce-webapp/Workforce/cwiprntpopup?matrix_alternate_template=/cwiPrint.jsp&Action=getPdf&cat=sel&selectedVal=0&totalCountBysearch=1&startIndex=0&svc_type=&acv_type=&ord_no='.$ord_no.'&companyId=TELQC&dispatcherId=TEL-QC-'.$print_jobType.'&apptBookId=&staffId=&apptStatus=&jobType=&svcNo=&nodeId=&mgmtArea=&apptDateFrom='.$print_date.'&apptDateTo='.$print_date;
				$alt_print_hist ='https://wfm.globe.com.ph/workforce-webapp/Workforce/cwiprntpopup?matrix_alternate_template=/cwiPrint.jsp&Action=getPdf&cat=sel&selectedVal=0&totalCountBysearch=1&startIndex=0&svc_type=&acv_type=&ord_no='.$ord_no.'&companyId=TELQC&dispatcherId=TEL-QC-'.$print_jobType.'&apptBookId=&staffId=&apptStatus=H&jobType=&svcNo=&nodeId=&mgmtArea=&apptDateFrom='.$print_date.'&apptDateTo='.$print_date;
				$alt_print_exe ='https://wfm.globe.com.ph/workforce-webapp/Workforce/cwiprntpopup?matrix_alternate_template=/cwiPrint.jsp&Action=getPdf&cat=sel&selectedVal=0&totalCountBysearch=1&startIndex=0&svc_type=&acv_type=&ord_no='.$ord_no.'&companyId=TELQC&dispatcherId=TEL-QC-'.$print_jobType.'&apptBookId=&staffId=&apptStatus=E&jobType=&svcNo=&nodeId=&mgmtArea=&apptDateFrom='.$print_date.'&apptDateTo='.$print_date;
				$alt_print_act ='https://wfm.globe.com.ph/workforce-webapp/Workforce/cwiprntpopup?matrix_alternate_template=/cwiPrint.jsp&Action=getPdf&cat=sel&selectedVal=0&totalCountBysearch=1&startIndex=0&svc_type=&acv_type=&ord_no='.$ord_no.'&companyId=TELQC&dispatcherId=TEL-QC-'.$print_jobType.'&apptBookId=&staffId=&apptStatus=A&jobType=&svcNo=&nodeId=&mgmtArea=&apptDateFrom='.$print_date.'&apptDateTo='.$print_date;
				$alt_print_can ='https://wfm.globe.com.ph/workforce-webapp/Workforce/cwiprntpopup?matrix_alternate_template=/cwiPrint.jsp&Action=getPdf&cat=sel&selectedVal=0&totalCountBysearch=1&startIndex=0&svc_type=&acv_type=&ord_no='.$ord_no.'&companyId=TELQC&dispatcherId=TEL-QC-'.$print_jobType.'&apptBookId=&staffId=&apptStatus=C&jobType=&svcNo=&nodeId=&mgmtArea=&apptDateFrom='.$print_date.'&apptDateTo='.$print_date;
				$alt_print_rej ='https://wfm.globe.com.ph/workforce-webapp/Workforce/cwiprntpopup?matrix_alternate_template=/cwiPrint.jsp&Action=getPdf&cat=sel&selectedVal=0&totalCountBysearch=1&startIndex=0&svc_type=&acv_type=&ord_no='.$ord_no.'&companyId=TELQC&dispatcherId=TEL-QC-'.$print_jobType.'&apptBookId=&staffId=&apptStatus=R&jobType=&svcNo=&nodeId=&mgmtArea=&apptDateFrom='.$print_date.'&apptDateTo='.$print_date;
				$alt_print_pen ='https://wfm.globe.com.ph/workforce-webapp/Workforce/cwiprntpopup?matrix_alternate_template=/cwiPrint.jsp&Action=getPdf&cat=sel&selectedVal=0&totalCountBysearch=1&startIndex=0&svc_type=&acv_type=&ord_no='.$ord_no.'&companyId=TELQC&dispatcherId=TEL-QC-'.$print_jobType.'&apptBookId=&staffId=&apptStatus=PC&jobType=&svcNo=&nodeId=&mgmtArea=&apptDateFrom='.$print_date.'&apptDateTo='.$print_date;
				
				//if($is_noteastwood ===true and $this->config->dispatch_hide_noteastwood==='1'){
					//@ TODO --Nothing...
					
				//}else {
				echo '
				<div class="tile tile-collapse">
					<div data-target="#'.$trim_unique_ord_no.'" data-toggle="tile">
						<div class="tile-side pull-left">
							<!--
							<div class="avatar avatar-sm avatar-brand">
								<span class="icon">backup</span>
							</div>
							-->
							'.$avatar.'
						</div>
						<div class="tile-action">
							<ul class="nav nav-list margin-no pull-right">
								<li>
									<a class="text-black-sec waves-attach assigned_to" id="assigned_'.$id.'" href="javascript:void(0)" onclick="assignedTo({id:\''.$id.'\', ord_no:\''.$unique_ord_no.'\'});"><span class="icon">person</span></a>
								</li>
								<!--
								<li>
									'.$delete_link.'
								</li>
								-->
								<li>
									<a class="text-black-sec waves-attach assigned_to" href="'.$print_link.'" target="_blank"><span class="icon">print</span></a>
								</li>
								<li class="dropdown">
									<a class="dropdown-toggle text-black-sec waves-attach" data-toggle="dropdown"><span class="icon">settings</span></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li class="disabled">																
											<a href="javascript:void(0)" onclick="assignedTo({id:\''.$id.'\', ord_no:\''.$unique_ord_no.'\'});"><span class="icon margin-right-sm">person</span>Assign to...</a>
										</li>
										<li>
											<a class="waves-attach" href="'.$alt_print_act.'" target="_blank"><span class="icon margin-right-sm">print</span>Print as Active</a>
										</li>
										<li>
											<a class="waves-attach" href="'.$alt_print_hist.'" target="_blank"><span class="icon margin-right-sm">print</span>Print as Historic</a>
										</li>
										<li>
											<a class="waves-attach" href="'.$alt_print_exe.'" target="_blank"><span class="icon margin-right-sm">print</span>Print as Executing</a>
										</li>
										<li>
											<a class="waves-attach" href="'.$alt_print_can.'" target="_blank"><span class="icon margin-right-sm">print</span>Print as Cancelled</a>
										</li>
										<li>
											<a class="waves-attach" href="'.$alt_print_rej.'" target="_blank"><span class="icon margin-right-sm">print</span>Print as Rejected</a>
										</li>
										<li>
											<a class="waves-attach" href="'.$alt_print_pen.'" target="_blank"><span class="icon margin-right-sm">print</span>Print as Pending Cancelled</a>
										</li>
										<li>
											<a class="waves-attach" href="javascript:void(0)" onclick="confirmDeactivate(\''.encode_url('0').'\',\''.encode_url('clus_orders').'\',\''.encode_url($id).'\')"><span class="icon margin-right-sm">delete</span>Delete</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="tile-inner">
							<div class="media">													
								<div class="media-inner text-overflow">
									<span class="ui-picker-info-title">'.$ord_no.'</span>
								</div>
								<div class="media-object">
									<small class="text-brand">'.$subsName.'</small>
								</div>
							</div>
						</div>
					</div>
					<div class="tile-active-show collapse" id="'.$trim_unique_ord_no.'">
						<div class="tile-sub">
							<p>
							<strong class="text-brand">'.$serviceNo.'</strong> <span style="width:200px;"></span>'.$cabinetNo.'<br>		
							<span class="text-brand">'.$apptSlot.'</span> <span style="width:200px;"></span><span class="label label-brand-accent">'.$serviceType.' </span><br>		
							<small class="text-brand">'.$apptDate.'</small> <span style="width:200px;"></span><span class="label">'.$jobType.' </span><br>	
							<small>'.$jobDescription.'</small><br>
							<small>'.$address.'</small>
							</p>
						</div>
						<div class="tile-footer">
							<div class="tile-footer-btn pull-left">									
								'.$assigned_details.'								
							</div>
							<div class="tile-footer-btn pull-right">														
								<a class="btn btn-flat waves-attach" data-toggle="tile" href="#'.$trim_unique_ord_no.'"><span class="icon">close</span>&nbsp;Cancel</a>														
							</div>
						</div>
					</div>
				</div>
				';
				//}
			}
		}else{
			echo '<p class="h4 text-brand-accent">No data found  for <strong class="text-brand">'.strtoupper($l).'</strong> data.</p>';
		}					
	}
	
	function print_select_tech(){
		$q = 'SELECT * FROM installers WHERE active =1';
		$rs = $this->db->getResults($q);
		if(count($rs)>0){
			foreach($rs as $r){
				$id = $r['id'];
				$name = $r['firstname'].' '.$r['lastname'];
				echo '<option value="'.encode_url($id).'">'.$name.'</option>';
			}
		}
	}
	
	function print_dialog_tech($pdt){
		$q = "SELECT * FROM view_clus_".$pdt;
		if($this->db->tableExist("view_clus_".$pdt)){
			$rs = $this->db->getResults($q);
			if(count($rs)>0){
				foreach($rs as $r){
					$id = $r['id'];
					$ins_id1 = $r['installer_1'];
					$ins_id2 = $r['installer_2'];
					$ins_name1 = $r['Installer1'];
					$ins_name2 = $r['Installer2'];
					echo '<li>
							<a class="margin-bottom-sm waves-attach" data-dismiss="modal"  href="javascript:void(0)" onclick="onAssignTech({id:\''.encode_url($id).'\',ins1:\''. encode_url($ins_id1).'\',ins2:\''.encode_url($ins_id2).'\'});">
								<div class="avatar avatar-sm avatar-brand-accent">
									<span class="icon">group</span>
								</div>
								<span style="width:20pt;"></span>
								<div class="media p-l-2">													
									<div class="media-inner text-overflow">
										<span class="ui-picker-info-title">'.$ins_name1.'</span>
									</div>
									<div class="media-object">
										<small class="text-brand">'.$ins_name2.'</small>
									</div>
								</div>
							</a>
						</li>';
				}
			}else{
				echo '<div class="media margin-bottom margin-top">
						<div class="media-object pull-left">
							<span class="icon icon-lg text-brand-accent">info_outline</span>
						</div>
						<div class="media-inner">
						<span class="h4 text-brand">No techician found. Please add technician.</span>
						</div>
					</div>';
				
			}
		}
	}
	
	function add_technician($table, $installer1, $installer2){
		$data = array();
		$data['installer_1'] = $installer1;
		$data['installer_2'] = $installer2;
		
		$this->db->insert($table, $data);
	}
	
	function get_installers_name($at,$ap,$pdt){
		$q ="SELECT * FROM view_clus_".$pdt." WHERE installer_1 =".$at." AND installer_2 =".$ap;
		$rs = $this->db->getResults($q);
		if(count($rs)>0){
			foreach($rs as $r){
				$ins1 = $r['Installer1'];
				$ins2 = $r['Installer2'];
				return '<strong class="text-brand-accent">'.$ins1.'</strong>:&nbsp;<small class="text-brand">'.$ins2.'</small>';
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
