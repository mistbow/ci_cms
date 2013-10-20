<?php 
class Basic_autho {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('email');
		$this->load->config('basic_auth', TRUE);
		$this->load->model('basic_auth_model');
	}
	
	/**
	 * 用户注册
	 */
	public function register($username, $password, $email) {
		$id = $this->basic_auth_model->register($username, $password, $email);

        if (!$id) {
            $this->set_error('account_creation_unsuccessful');
            return FALSE;
        }
		
		$deactivate = $this->basic_auth_model->deactivate($id);
		
		if (!$deactivate) {
            $this->set_error('deactivate_unsuccessful');
            return FALSE;
        }
		
		$activation_code = $this->basic_auth_model->activation_code;
        $user            = $this->basic_auth_model->user($id)->row();
		
		$data = array(
                'id'         => $user->id,
                'email'      => $email,
                'activation' => $activation_code,
        );
		
		$message = $this->load->view(
			$this->config->item('email_templates', 'basic_auth')
			.$this->config->item('email_activate', 'basic_auth'), $data, true);

        $this->email->clear();
        $this->email->from($this->config->item('admin_email', 'basic_auth'), $this->config->item('site_title', 'ion_auth'));
        $this->email->to($email);
        $this->email->subject($this->config->item('site_title', 'basic_auth') . ' - ' . $this->lang->line('email_activation_subject'));
        $this->email->message($message);

        if ($this->email->send() == TRUE) {
            $this->set_message('activation_email_successful');
            return $id;
        }
		
		return FALSE;
	}
	
	
	
	
	/**
	 * 直接调用model层的代码
	 */
	public function __call($method, $arguments) {
		if (!method_exists( $this->basic_auth_model, $method)) {
        	throw new Exception('Undefined method Basic_auth::' . $method . '() called');
		}
		
		return call_user_func_array( array($this->basic_auth_model, $method), $arguments);
	}
	
	/**
	 * 直接获取controller的属性
	 */
	public function __get($var) {
    	return get_instance()->$var;
    }
}
