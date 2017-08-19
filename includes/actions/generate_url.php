<?php
/**
 * Created by PhpStorm.
 * User: TARSIER
 * Date: 10/24/2016
 * Time: 7:47 PM
 */
 
 require('../setup.php');
$dt = isset($_GET['dt'])?$_GET['dt']:'';
$res = array();
if(empty($dt)){
    $res['error'] = true;
    $res['title'] = 'Error';
    $res['message'] = 'Please select date.';
}else{
    $res['error'] = false;
    $res['url']='index.php?p='.encode_url('10').'&sp='.encode_url('d').'&s='.encode_url('v').'&d='.encode_url($dt).'&yd='.encode_url($dt).'&l='.encode_url('your_date');
}

echo json_encode($res);