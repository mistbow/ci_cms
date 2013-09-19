<?php
/**
 * token class
 */
class Token_Model extends MY_Model {
	
	public function check_token($third_user_id) {
		return $this->get_by('third_user_id', $third_user_id);
	}
	
	public function update_access_token($third_user_id, $access_token) {
		return $this->update_by('third_user_id', $third_user_id
			, array('access_token' => $access_token));
	}
}