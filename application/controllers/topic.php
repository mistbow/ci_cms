<?php
class Topic extends Frontend_Controller {
	
	protected $models = array('topic');
	
	function __construct() {
		parent :: __construct();
	}
    
    public function index() {
    	$topics = $this->topic->get_all();
		$this->data['topics'] = $topics;
    }
	
	public function newtopic() {
		$this->_check_logged_in();
		$this->view = 'topic/new.php';
	}
    
	public function create() {
		$user_id = $this->_check_logged_in();
		$validate = $this->topic->create_validation;
		$this->form_validation->set_rules($validate);
    	if ($this->form_validation->run() == TRUE) {
    		if ($this->topic->create($user_id) !== FALSE) {
    			redirect('topic/index');
    		}
    		else {
    			$this->session->set_flashdata('error', '账号或者密码错误');
    			redirect('topic/create', 'refresh');
    		}
		}
	}
	
	public function edit() {
		
	}
	
	public function update() {
		
	}
	
	private function _check_logged_in() {
		$user_id = $this->session->userdata('id');
		$logged_in = $this->session->userdata('loggedin');
		if(!$logged_in || empty($user_id)) {
			redirect('qq/login');	
		}
		return $user_id;
	}
}
