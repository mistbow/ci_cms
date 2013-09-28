<?php
class User_utils {
	
	public $CI;
	
	public function __construct() {
		if (!isset($this->CI))
        {
            $this->CI =& get_instance();
        }
        $this->CI->load->library('session');
	}

	public function get_current_user_id() {
		$user_id = $this->CI->session->userdata('id');
		if (!$user_id) {
			return FALSE;
		}
		return $user_id;
	}

}
