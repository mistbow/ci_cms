<?php
class Topic extends Frontend_Controller {
	
	protected $models = array('topic', 'user', 'reply');
	
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
		$topics = $this->topic->get_topics_by_page($per_page, $offset);
		$this->_append_user_info($topics);
		
		$this->data['topics'] = $topics;
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
	
	public function reply() {
		$user_id = $this->_check_logged_in();
		$validate = $this->reply->create_validation;
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run() == TRUE) {
			$topic_id = $this->input->post('topic_id');
    		if ($this->reply->create($topic_id, $user_id) !== FALSE) {
    			$this->topic->add_reply($topic_id, $user_id);
    			redirect('topic/show/'.$topic_id);
    		}
    		else {
    			$this->session->set_flashdata('error', '参数错误');
    			redirect('topic/show/'.$topic_id, 'refresh');
    		}
		}
	}
	
	public function show() {
		$topic_id = $this->uri->segment(3);
		$topic = $this->topic->get($topic_id);
		
		$user_id = $topic->user_id;
		$user = $this->user->get($user_id);
		$topic->user->id = $user_id;
		$topic->user->username = $user->username;
		
		$replies = $this->reply->get_topic_replies($topic_id);
		$this->_append_user_info($replies);
		$topic->replies = $replies;
		
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
	
	/**
	 * 加载用户信息
	 */
	private function _append_user_info(&$items) {
		if(!empty($items)) {
			foreach ($items as $key => $value) {
				$req[] = $value->user_id;
			}
			$users = $this->_get_users_by_ids($req);
			
			foreach ($items as $key => &$value) {
				$user_id = $value->user_id;
				$value->user = $users[$user_id];
			}
		}
	}
	
	private function _get_users_by_ids($ids) {
		$req = array_unique($ids);
		return $this->user->get_users_by_ids($req);
	}
}
