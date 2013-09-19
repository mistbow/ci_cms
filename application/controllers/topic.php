<?php
class Topic extends Frontend_Controller {
	
	protected $models = array('topic');
	
	function __construct() {
		parent :: __construct();
	}
    
    public function index() {
    }
	
	public function newtopic() {
		if(!$this->session->userdata('loggedin') 
			|| !isset($this->session->userdata('id'))) {
			redirect('qq/login');	
		}
		$this->view = 'topic/new.php';
	}
    
	public function create() {
		if(!$this->session->userdata('loggedin') 
			|| !isset($this->session->userdata('id'))) {
			redirect('qq/login');	
		}
		$user_id = $this->session->userdata('id');
		$validate = $this->topic->create_validation;
		$this->form_validation->set_rules($validate);
    	if ($this->form_validation->run() == TRUE) {
    		if ($this->topic->create($user_id) == TRUE) {
    			redirect('');
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
}
