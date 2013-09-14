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
	
	public $login_validate = array(
        array( 'field' => 'email', 
               'label' => 'email',
               'rules' => 'required|valid_email' ),
        array( 'field' => 'password',
               'label' => 'password',
               'rules' => 'required' ),
    );
	
	public function login ()
	{
		$user = $this->get_by(array(
			'email' => $this->input->post('email'),
			'password' => $this->encode_password($this->input->post('password')),
		), TRUE);
		
		if (count($user)) {
			// Log in user
			$data = array(
				'username' => $user->username,
				'email' => $user->email,
				'id' => $user->id,
				'loggedin' => TRUE,
			);
			$this->session->set_userdata($data);
			return TRUE;
		}
		return FALSE;
	}

	public function register() {
		$this->skip_validation();
		$userId = $this->insert(array(
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => $this->encode_password($this->input->post('password')),
			'created_on' => time(),
		));
		if($userId) {
			$data = array(
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'id' => $userId,
				'loggedin' => TRUE,
			);
			$this->session->set_userdata($data);
			return TRUE;
		}
		return FALSE;
	}

	public function logout ()
	{
		$this->session->sess_destroy();
	}

	public function loggedin ()
	{
		return (bool) $this->session->userdata('loggedin');
	}
	
	public function encode_password ($string)
	{
		return hash('sha256', $string . config_item('encryption_key'));
	}
	
}

