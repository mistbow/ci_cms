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

if (!function_exists('get_current_user_id_and_force_login')) {
	function get_current_user_id_and_force_login($force_login = TRUE) {
		$CI =& get_instance();
		$user_id = $CI->session->userdata('id');
		$logged_in = $CI->session->userdata('loggedin');
		if($force_login) {
			if(!$logged_in || empty($user_id)) {
				redirect('qq/login');	
			}
		}
		return $user_id;
	}
}