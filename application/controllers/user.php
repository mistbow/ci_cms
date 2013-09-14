<?php
class User extends Frontend_Controller {
	
	protected $models = array( 'user');
	
	function __construct() {
		parent :: __construct();
	}
	
	public function index() {
		$this->data['subview'] = 'components/login_subview';
		$this->view = 'user/login.php';
	}
    
    public function login() {
    	$dashboard = 'dashboard';
		if(!is_null($this->user) && $this->user->loggedin() == TRUE) {
			redirect($dashboard);
		}
		
    	$validate = $this->user->login_validate;
		$this->form_validation->set_rules($validate);
    	if ($this->form_validation->run() == TRUE) {
    		// We can login and redirect
    		if ($this->user->login() == TRUE) {
    			redirect($dashboard);
    		}
    		else {
    			$this->session->set_flashdata('error', '账号或者密码错误');
    			redirect('user/login', 'refresh');
    		}
    	}
    	$this->data['subview'] = 'components/login_subview';
    }
	
	public function logout() {
		$this->user->logout();
		redirect('user/login');
	}
	public function register() {
		$dashboard = 'dashboard';
		if(!is_null($this->user) && $this->user->loggedin() == TRUE) {
			redirect($dashboard);
		}
		
    	$validate = $this->user->validate;
		$this->form_validation->set_rules($validate);
    	if ($this->form_validation->run() == TRUE) {
    		// We can login and redirect
    		if ($this->user->register() == TRUE) {
    			redirect($dashboard);
    		}
    		else {
    			$this->session->set_flashdata('error', '对不起，系统错误请稍后注册');
    			redirect($dashboard);
    		}
    	}
		$this->data['subview'] = 'components/register_subview';
	}
    
}
