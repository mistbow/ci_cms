<?php 

if (!function_exists('is_mine')) {
	function is_mine($user_id) {
		$CI =& get_instance();
		if($CI->session->userdata('loggedin') 
			&& $CI->session->userdata('id') == $user_id) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
