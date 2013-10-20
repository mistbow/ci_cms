<?php 
class Basic_auth_model extends MY_Model {
	
	public function __construct() {
		parent::__construct();
		$this->store_salt      = $this->config->item('store_salt', 'basic_auth');
		$this->salt_length     = $this->config->item('salt_length', 'basic_auth');
	}
        	
	public function register($username, $password, $email) {
		$manual_activation = $this->config->item('manual_activation', 'basic_auth');
		
	 	$salt       = $this->store_salt ? $this->salt() : FALSE;
		$password   = $this->hash_password($password, $salt);
		
		$data = array(
		    'username'   => $username,
		    'salt'       => $salt,
		    'password'   => $password,
		    'email'      => $email,
		    'created_on' => time(),
		    'active'     => ($manual_activation === false ? 1 : 0)
		);
		
		$this->db->insert($this->tables['users'], $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	
	public function deactivate($id = NULL) {
		if (!isset($id)) {
			$this->set_error('deactivate_unsuccessful');
			return FALSE;
		}

		$activation_code       = sha1(md5(microtime()));
		$this->activation_code = $activation_code;

		$data = array(
		    'activation_code' => $activation_code,
		    'active'          => 0
		);

		$this->db->update($this->tables['users'], $data, array('id' => $id));

		$return = $this->db->affected_rows() == 1;
		if ($return)
			$this->set_message('deactivate_successful');
		else
			$this->set_error('deactivate_unsuccessful');

		return $return;
	}
	
	public function salt() {
		return substr(md5(uniqid(rand(), true)), 0, $this->salt_length);
	}
	
	public function hash_password($password, $salt=false, $use_sha1_override=FALSE) {
		if (empty($password)) {
			return FALSE;
		}

		//bcrypt
		if ($use_sha1_override === FALSE && $this->hash_method == 'bcrypt') {
			return $this->bcrypt->hash($password);
		}


		if ($this->store_salt && $salt) {
			return  sha1($password . $salt);
		} else {
			$salt = $this->salt();
			return  $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
		}
	}
}
