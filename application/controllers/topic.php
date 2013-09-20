<?php
class Topic extends Frontend_Controller {
	
	protected $models = array('topic');
	
	function __construct() {
		parent :: __construct();
		$this->load->library('pagination');
	}
    
    public function index() {
    	$config['base_url'] =  'http://6bey.com/topic/index/';
    	$config['total_rows'] = $this->topic->count_all();
		$per_page = $this->config->item('per_page');
		$now_page = intval($this->uri->segment(3));
		$offset = $per_page * ($now_page - 1);
		if($offset < 0) $offset = 0;
		$this->data['topics'] = $this->topic->limit($per_page, $offset)->get_all();
		$this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
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
	
	public function show() {
		$topic_id = $this->uri->segment(3);
		$topic = $this->topic->get($topic_id);
		$this->data['topic'] = $topic;
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
