<?php
class User extends Frontend_Controller {
	
	function __construct() {
		parent :: __construct();
	}
    
    public function login() {
    	$this->data['subview'] = 'components/login_subview';
    }
    
}
