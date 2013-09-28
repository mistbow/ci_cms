<?php
class User extends Frontend_Controller {

	protected $models = array('user');

	function __construct() {
		parent::__construct();
		$this->load->library('user_utils');
	}

	public function index() {
		$this -> data['subview'] = 'components/login_subview';
		$this -> view = 'user/login.php';
	}

	public function loggedin() {
		return (bool)$this -> session -> userdata('loggedin');
	}

	public function login() {
		if ($this -> loggedin())
			redirect('');

		$validate = $this -> user -> login_validate;
		$this -> form_validation -> set_rules($validate);
		if ($this -> form_validation -> run() == TRUE) {
			// We can login and redirect
			if ($this -> user -> login() == TRUE) {
				redirect('');
			} else {
				$this -> session -> set_flashdata('error', '账号或者密码错误');
				redirect('user/login', 'refresh');
			}
		}
		$this -> data['subview'] = 'components/login_subview';
	}

	public function logout() {
		$dashboard = 'dashboard';
		$this -> user -> logout();
		redirect('');
	}

	public function register() {
		if ($this -> user -> loggedin() == TRUE) {
			redirect('');
		}

		$validate = $this -> user -> validate;
		$this -> form_validation -> set_rules($validate);
		if ($this -> form_validation -> run() == TRUE) {
			// We can login and redirect
			if ($this -> user -> register() == TRUE) {
				redirect('');
			} else {
				$this -> session -> set_flashdata('error', '对不起，系统错误请稍后注册');
			}
		}
		$this -> data['subview'] = 'components/register_subview';
	}

	public function show() {
		if ($this -> uri -> segment(3) === FALSE) {
			$user_id = $this->user_utils->get_current_user_id();
			if($user_id === FALSE) {
				echo '404';exit;
			}
		} else {
			$user_id = $this -> uri -> segment(3);
		}
		
		$this->data['user_id'] = $user_id;
	}

}
