<?php
class Qq extends Frontend_Controller {
	function __construct() {
		parent :: __construct();
		$this->load->library('qc');
	}
	
	public function login() {
		$this->qc->qq_login();
	}
	
	public function callback() {
		$this->qc->qq_callback();
		$openid = $this->qc->get_openid();
		$this->data['openid'] = $openid;
	}
}