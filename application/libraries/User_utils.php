<?php 
class User_utils {
	
	public function get_current_user_id() {
		$user_id = $this->session->userdata('user_id');
		if(!$user_id) {
			return FALSE;
		}
		return $user_id;
	}
}
