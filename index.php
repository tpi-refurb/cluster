<?php
require_once('includes/setup.php');
$current_date =date("Y-m-d");
$current_year =date("Y");
$page = decode_url((isset($_GET['p']) && $_GET['p'] != '') ? $_GET['p'] : '');	// Page No
$sp = decode_url((isset($_GET['sp']) && $_GET['sp'] != '') ? $_GET['sp'] : '');	// Sub Page
$l = decode_url((isset($_GET['l']) && $_GET['l'] != '') ? $_GET['l'] : '');		// Choice from crawled data
$dt = decode_url((isset($_GET['d']) && $_GET['d'] != '') ? $_GET['d'] : '');		// Selected Date for assignment
$ms = decode_url((isset($_GET['s']) && $_GET['s'] != '') ? $_GET['s'] : '');		// Maintenance State (View, Add, Edit and Delete)
$mp = decode_url((isset($_GET['m']) && $_GET['m'] != '') ? $_GET['m'] : '');		// Maintenance Page (Technicians, Modems, Antennas and ....)
$mc = decode_url((isset($_GET['c']) && $_GET['c'] != '') ? $_GET['c'] : '');		// Maintenance Column (by table Technicians, Modems, Antennas and ....)
$id = decode_url((isset($_GET['i']) && $_GET['i'] != '') ? $_GET['i'] : '');		// Maintenance ID (to EDIT and DELETE)
$at = decode_url((isset($_GET['at']) && $_GET['at'] != '') ? $_GET['at'] : '');	// Assigned To /Installer 1
$ap = decode_url((isset($_GET['ap']) && $_GET['ap'] != '') ? $_GET['ap'] : '');	// Assigned Partner /Installer 2
$q	= ((isset($_GET['q']) && $_GET['q'] != '') ? $_GET['q'] : '');		// Search Keyword

$location = decode_url((isset($_GET['l']) && $_GET['l'] != '') ? $_GET['l'] : ''); // Location (GMMA/NCL)

$yd = isset($_GET['yd']) && $_GET['yd'] != '' ? decode_url($_GET['yd']) : '';		// Choice from crawled data

$dt	= decode_url(isset($_COOKIE['dt'])? $_COOKIE['dt']: $dt);
$dt = empty($dt)? get_currentdate(): $dt;

$pdt = plain_date($dt);

$with_topheader = true;

$is_mobile = $detect->isMobile();

if(!$auth->isLogin())
{
	switch ($page){		
		case '1' :
			$title="Sign up";	
			$content =PAGES_PATH.DS.'signup.php';		
			break;
		case '2' :
			$title="Forgot Password";	
			$content =PAGES_PATH.DS.'forgot.php';		
			break;
		case '3' :
			$title="Reset Password";	
			$content =PAGES_PATH.DS.'reset.php';		
			break;
		case '4' :
			$title="Activate Account";	
			$content =PAGES_PATH.DS.'activate.php';		
			break;
		case '5' :
			$title="SCR Success";	
			$content =PAGES_PATH.DS.'success.php';		
			break;
		default:
			$title="Sign in";	
			$content= PAGES_PATH.DS.'signin.php';
			$page ='0';
			break;
	}
	include $content;
	exit;
}else{	
	$global_username	= decode_url($_COOKIE['Username']);
	$global_userid		= decode_url($_COOKIE['UserId']);
	$global_fullname	=$auth->getFullname($global_username);
	$global_level		=$auth->getLevel($global_username);
	switch ($page){
		case '10' :
			$title="Home";
			if($sp==='t'){
				$content=PAGES_PATH.DS.'technician.php';
			}else if($sp==='d'){
                $content=PAGES_PATH.DS.'data_date.php';
            }else{
				$content=PAGES_PATH.DS.'home.php';
			}					
			break;
		case '11' :
			$title="Cluster";
			$content=PAGES_PATH.DS.'data.php';
			break;		
		case '12' :	
			$title="New Dispatch";	
			$content=PAGES_PATH.DS.'dispatch.php';		
			break;
		case '13' :	
			$title="Settings";	
			$content=PAGES_PATH.DS.'settings.php';		
			break;	
		case '14' :	
			$title="Profile";	
			$content=PAGES_PATH.DS.'profile.php';		
			break;	
		case '15' :
			$title="Maintenance";
			$content=PAGES_PATH.DS.'maintenance.php';
			break;	
		default :
			$page ='10';
			$title="Home";	
			$content =PAGES_PATH.DS.'home.php';				
			break;
	}
	
	include TEMPLATE_PATH.DS.'html-header.php';
	include TEMPLATE_PATH.DS.'html-top_header.php';
	include TEMPLATE_PATH.DS.'html-side_bar.php';
	include TEMPLATE_PATH.DS.'html-side_profile.php';
	include TEMPLATE_PATH.DS.'html-side_search.php';
	include $content;
	include TEMPLATE_PATH.DS.'html-footer.php';
	exit;
}
	
	
?>
