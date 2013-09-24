<?php
/**
 * userinfo class
 */
class Userinfo_Model extends MY_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function get_userinfo_by_user_ids($ids) {
		return $this->where_in('user_id', $ids)->get_all();
	}
	
}