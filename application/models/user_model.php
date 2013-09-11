<?php
/**
 * user class
 */
class User_Model extends MY_Model {
	
	public $validate = array(
        array( 'field' => 'email', 
               'label' => 'email',
               'rules' => 'required|valid_email|is_unique[users.email]' ),
        array( 'field' => 'password',
               'label' => 'password',
               'rules' => 'required' ),
        array( 'field' => 'password_confirmation',
               'label' => 'confirm password',
               'rules' => 'required|matches[password]' ),
    );
	
	function __construct($argument) {
		parent :: __construct();
	}
}

