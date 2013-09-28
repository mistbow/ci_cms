<?php
/**
 * user class
 */
class User_Model extends MY_Model {
	
	protected $user_basic_columns = 'id, username';
	
	public function __construct() {
        parent::__construct();
		$this->load->model('userinfo_model', 'userinfo');
		$this->load->model('token_model', 'token');
		$this->load->model('vip_model', 'vip');
	}
	public $validate = array(
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

	public function qq_register() {
		$this->skip_validation();
		$user_id = $this->insert(array(
			'username' => $this->input->post('username'),
			'password' => $this->encode_password($this->input->post('password')),
		));
		if($user_id) {
			$user_info_id = $this->userinfo->insert(array(
				'user_id' => $user_id,
				'created_on' => time(),
				'avatar' => $this->input->post('avatar'),
			));
			if(!$user_info_id) {
				log_message('error', 'User_Model|qq_register|save userinfo error|'
					.$user_id."|".$this->input->post('avatar'));
				return FALSE;
			}
			$token_id = $this->token->insert(array(
				'user_id' => $user_id,
				'third_user_id' => $this->input->post('third_user_id'),
				'access_token' => $this->input->post('access_token'),
				'add_time' => time(),
			));
			if(!$token_id) {
				log_message('error', 'User_Model|qq_register|save userinfo error|'
					.$user_id."|".$this->input->post('third_user_id')."|"
					.$this->input->post('access_token'));
				return FALSE;
			}
			
			//并且登录
			$data = array(
				'username' => $this->input->post('username'),
				'id' => $user_id,
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
		if($this->session == null) {
			return FALSE;
		} else {
			return (bool) $this->session->userdata('loggedin');
		}
	}
	
	public function encode_password ($string)
	{
		return hash('sha256', $string . config_item('encryption_key'));
	}
	
	public function get_user_by_id($id, $with_user_info = true) {
		$user = $this->get($id);
		if($user != false && $with_user_info) {
			$user_info = $this->userinfo->get_by('user_id', $id);
			$user->userInfo = $user_info;
		}
		return $user;
	}
	public function get_users_by_ids($ids, $with_user_info = true) {
		$res = array();
		if(!is_array($ids) || empty($ids)) {
			return $res;
		}
		$users = $this->select($this->user_basic_columns)->where_in('id', $ids)->get_all();
		if(empty($users)) {
			return array();
		}
		
		foreach ($users as $key => $value) {
			$res[$value->id] = $value;
		}
		if($with_user_info) {
			$userinfos = $this->userinfo->get_userinfo_by_user_ids($ids);
			foreach ($userinfos as $key => $value) {
				$res[$value->user_id]->userInfo = $value;
			}
		}
		
		return $res;
		
	}
	
}

