<?php
class User extends Frontend_Controller {
	
	protected $models = array( 'user');
	
	function __construct() {
		parent :: __construct();
	}
    
    public function login() {
    	$validate = $this->user->login_validate;
		$this->form_validation->set_rules($validate);
    	if ($this->form_validation->run() == TRUE) {
    		// We can login and redirect
    	}
    	$this->data['subview'] = 'components/login_subview';
    }
	
	public function register() {
		$this->data['subview'] = 'components/register_subview';
	}
    
}
