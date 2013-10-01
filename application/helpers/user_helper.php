<?php 

if (!function_exists('is_mine')) {
	function is_mine($user_id) {
		if($this->session->userdata('loggedin') 
			&& $session->userdata('id') == $user_id) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
