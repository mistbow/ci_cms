<?php
class Qq extends Frontend_Controller {
	
	protected $models = array('token', 'user');
	
	function __construct() {
		parent :: __construct();
		$this->load->library('qc');
	}
	
	public function login() {
		$this->qc->qq_login();
		$this->view = FALSE;
	}
	
	public function callback() {
		$access_token = $this->qc->qq_callback();
		$openid = $this->qc->get_openid();
		$token_info = $this->token->get_by('third_user_id', $openid);
		//用户注册过了，直接将用户登录
		if(!empty($token_info)) {
			if($access_token != $token_info->access_token) {
				$this->token->update_access_token($openid, $access_token);
			}
			$user = $this->user->get_by('id', $token_info->user_id);
			$data = array(
				'username' => $user->username,
				'id' => $user->id,
				'loggedin' => TRUE,
			);
			$this->session->set_userdata($data);
			redirect('');
		} else {
			//用户还没有注册过，切换到注册界面
			$ret = $this->qc->get_user_info();
			if($ret['ret'] == 0){
				$this->data['username'] = $ret['nickname'];
				$this->data['avatar'] = $ret['figureurl_qq_1'];
				$this->data['third_user_id'] = $openid;
				$this->data['access_token'] = $access_token;
				$this->data['subview'] = 'components/qq_register_subview';
			}else{
			    $this->data['ret'] = 1;
				$this->data['error'] = '网络错误，获取用户头像姓名失败';
			}
			
			$this->view = 'qq/register.php';
		}
		
	}
	
	public function register() {
		$validate = $this->user->validate;
		$this->form_validation->set_rules($validate);
    	if ($this->form_validation->run() == TRUE) {
    		// We can login and redirect
    		if ($this->user->qq_register() !== FALSE) {
    			redirect('');
    		}
    		else {
    			$this->session->set_flashdata('error', '对不起，系统错误请稍后注册');
    		}
    	}
		$this->data['subview'] = 'components/qq_register_subview';
	}
}
