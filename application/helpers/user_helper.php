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


/**
 * 加载用户信息
 */
if (!function_exists('append_user_info')) {
	function append_user_info(&$items, $object_name, $user_field_name) {
		if(!empty($items)) {
			foreach ($items as $key => $value) {
				$req[] = $value->$user_field_name;
			}
			$users = get_users_by_ids($req);
			
			foreach ($items as $key => &$value) {
				$user_id = $value->$user_field_name;
				if(!$user_id) {
					continue;
				}
				$value->$object_name = $users[$user_id];
			}
		}
	}
}

if (!function_exists('get_users_by_ids')) {
	function get_users_by_ids($ids) {
		$CI =& get_instance();
		$req = array_unique($ids);
		return $CI->user->get_users_by_ids($req);
	}
}