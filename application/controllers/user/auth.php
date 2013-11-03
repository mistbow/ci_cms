<?php
class Auth extends Frontend_Controller {
	
	function __construct() {
		parent :: __construct();
		$this->load->library('basic_auth');
	}
	
	public function register() {
		$this->data['title'] = "用户注册";
		
		//validate form input
		$this->form_validation->set_rules('username', $this->lang->line('create_user_validation_username_label'), 'required|xss_clean');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
		
		if ($this->form_validation->run() == true) {
			$username = $this->input->post('username');
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');
			
		}
		
		if($this->basic_auth->register($username, $email, $password)) {
			$this->session->set_flashdata('message', $this->basic_auth->messages());
			redirect("auth", 'refresh');
		} else {
			$this->data['message'] = (validation_errors() 
				? validation_errors() : ($this->ion_auth->errors() 
				? $this->basic_auth->errors() : $this->session->flashdata('message')));
			
			$this->data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			);
			
			$this->data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			
			$this->data['password'] = array(
				'name'  => 'password',
				'id'    => 'password',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			
			$this->data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'id'    => 'password_confirm',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);
			$this->_render_page('auth/create_user', $this->data);
		}
	}
	
}