<?php
class Qq extends Frontend_Controller {
	function __construct() {
		parent :: __construct();
		$this->load->library('qc');
	}
	
	public function login() {
		$this->qc->qq_login();
		exit;
	}
	
	public function callback() {
		$access_token = $this->qc->qq_callback();
		$openid = $this->qc->get_openid();
		$this->data['openid'] = $openid;
		$this->data['access_token'] = $access_token;
	}
}