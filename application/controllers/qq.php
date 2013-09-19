<?php
class Qq extends Frontend_Controller {
	
	protected $models = array('token');
	
	function __construct() {
		parent :: __construct();
		$this->load->library('qc');
	}
	
	public function login() {
		$this->qc->qq_login();
		exit;
	}
	
	public function callback() {
		$access_token = $this->qc->qq_callback();
		$openid = $this->qc->get_openid();
		if($this->token->check_token_exits($openid)) {
			$this->token->update_access_token($openid, $access_token);
		}
		$ret = $qc->get_info();
		if($ret['ret'] == 0){
			$this->data['username'] = $ret['nickname'];
			$this->data['avatar'] = $ret['figureurl_qq_1'];
			$this->data['third_user_id'] = $openid;
			$this->data['access_token'] = $access_token;
			$this->data['subview'] = 'qq_register_subview';
		}else{
		    $this->data['ret'] = 1;
			$this->data['error'] = '网络错误，获取用户头像姓名失败';
		}
		
		$this->view = 'qq/register.php';
	}
	
	public function create() {
		
	}
}