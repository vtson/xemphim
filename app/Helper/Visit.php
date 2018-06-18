<?php
namespace App\Helper;
use App\Models\VisitModel as VisitModel;
class Visit{

	function get_visitor_ip() {
	    $ip = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ip = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ip = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ip = $_SERVER['REMOTE_ADDR'];
	    else
	        $ip = 'none';
	  
	    return $ip;
	}

	function visited(){
		$ip = $this->get_visitor_ip();

		if(isset($_SESSION['visitor'])){
			if ((time() - $_SESSION['visitor']['start']) > 1800) {
    			unset($_SESSION['visitor']);
    		}
    		return false;
		}
		
		$_SESSION['visitor'] = array('ip' => $ip, 'start' => time());

		$visitModel = new VisitModel();

		$visitModel->ip = $ip;
		$visitModel->create_at = date('Y-m-d', time());

		$visitModel->save();
	}
}