<?php 

if (!function_exists('is_mine')) {
	function is_mine($session, $user_id) {
		if($session->userdata('loggedin') 
			&& $session->userdata('id') == $user_id) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
