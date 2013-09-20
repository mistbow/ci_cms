<?php
class Topic extends Frontend_Controller {
	
	protected $models = array('topic');
	
	function __construct() {
		parent :: __construct();
		$this->load->library('pagination');
	}
    
    public function index() {
    	$config['base_url'] = $this->uri->uri_string();
        $config['total_rows'] = $this->topic->count_all();
        $config['per_page'] = 5;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		
		$this->pagination->initialize($config); 
		$this->data['topics'] = $this->topic->limit($config['per_page'], $this->uri->segment(3));
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
