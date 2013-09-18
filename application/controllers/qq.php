<?php
class Qq extends Frontend_Controller {
	function __construct() {
		parent :: __construct();
		$this->load->library('QC');
	}
	
	public function login() {
		$this->QC->qq_login();
	}
	
	public function callback() {
		$this->QC->qq_callback();
		$openid = $this->QC->get_openid();
		$this->data['openid'] = $openid;
	}
}