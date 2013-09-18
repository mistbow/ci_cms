<?php
class Qq extends Frontend_Controller {
	function __construct() {
		parent :: __construct();
		$this->load->library('Qc');
	}
	
	public function login() {
		$this->Qc->qq_login();
	}
	
	public function callback() {
		$this->Qc->qq_callback();
		$openid = $this->Qc->get_openid();
		$this->data['openid'] = $openid;
	}
}