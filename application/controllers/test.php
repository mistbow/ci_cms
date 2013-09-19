<?php
class Test extends Frontend_Controller {
	
	protected $models = array('token');
	
	function __construct() {
		parent :: __construct();
	}
    
	public function debug() {
		$res = $this->token->check_token($this->input->get('third_user_id'));
		var_dump($res);exit;
	}
    
}
