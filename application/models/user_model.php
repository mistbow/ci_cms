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
			'password' => $this->salt($this->input->post('password'), $this->input->post('email')),
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
		$userId = $this->insert(array(
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => $this->salt($this->input->post('password'), $this->input->post('email')),
			'created_on' => time(),
		));
		if($userId) {
			$data = array(
				'username' => $user->username,
				'email' => $user->email,
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

	function salt($toHash,$email){ 
	    $password = str_split($toHash,(strlen($toHash)/2)+1); 
	    $hash = hash('md5', $email.$password[0].'centerSalt'.$password[1]); 
	    return $hash; 
	}
	
}

