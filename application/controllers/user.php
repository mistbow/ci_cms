<?php
class User extends Frontend_Controller {
	
	protected $helpers = array( 'cookie', 'file', 'xml' );
	
	function __construct() {
		parent :: __construct();
	}
    
    public function login() {
    	$this->data['subview'] = 'components/login_subview';
    }
    
}
