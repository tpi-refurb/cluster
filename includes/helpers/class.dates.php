<?php

if ( ! function_exists('force_date')){	
	function force_date($date_string) {
		$d=strtotime($date_string);
		return date("Y-m-d", $d);
	}
}

if ( ! function_exists('slashed_date')){	
	function slashed_date($date_string) {
		$d=strtotime($date_string);
		return date("m/d/Y", $d);
	}
}
if ( ! function_exists('dotted_date')){	
	function dotted_date($date_string) {
		$d=strtotime($date_string);
		return date("Y.m.d", $d);
	}
}

if ( ! function_exists('plain_date')){	
	function plain_date($date_string) {
		$d=strtotime($date_string);
		return date("Ymd", $d);
	}
}

if ( ! function_exists('get_datetime')){	
	function get_datetime(){
		return date("Y-m-d h:i:s");
	}
}

if ( ! function_exists('get_currentdate')){	
	function get_currentdate(){
		return date("Y-m-d");
	}
}

if ( ! function_exists('get_days')){	
	function get_days($start_date,$end_date){		
		 return round(abs(strtotime($start_date)-strtotime($end_date))/86400);		
	}
}

if ( ! function_exists('add_days')){
	function add_days($date, $days){
		return date('Y-m-d',strtotime($date.' +'.$days.' days'));
	}
}