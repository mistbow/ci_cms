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
		
		append_user_info($topics, 'user', 'user_id');
		append_user_info($topics, 'reply_user', 'last_reply_user_id');
		
		$this->data['topics'] = $topics;
		$this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
    }
	
	public function newtopic() {
		get_current_user_id_and_force_login();
		$this->view = 'topic/new.php';
	}
    
	public function create() {
		$user_id = get_current_user_id_and_force_login();
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
		$user_id = get_current_user_id_and_force_login();
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
		$user = $this->user->get_user_by_id($user_id);
		$topic->user = $user;
		
		$replies = $this->reply->get_topic_replies($topic_id);
		append_user_info($replies, 'user', 'user_id');
		$topic->replies = $replies;
		
		$this->data['topic'] = $topic;
	}
	
	public function edit() {
		$topic_id = $this->uri->segment(3);
		$topic = $this->topic->get($topic_id);
		if($topic == null) {
			echo '404';exit;
		}
		$user_id = $topic->user_id;
		if(is_mine($user_id)) {
			$this->data['topic'] = $topic;
		} else {
			echo '404';exit;
		}
	}
	
	public function update() {
		$user_id = get_current_user_id_and_force_login();
		$validate = $this->topic->update_validation;
		$this->form_validation->set_rules($validate);
    	if ($this->form_validation->run() == TRUE) {
    		$topic_id = $this->input->post('id');
    		if ($this->topic->update_topic($user_id) !== FALSE) {
    			redirect('topic/show/'.$topic_id);
    		}
    		else {
    			$this->session->set_flashdata('error', '账号或者密码错误');
    			redirect('topic/show/'.$topic_id);
    		}
		}
	}
	
	public function delete() {
		$topic_id = $this->uri->segment(3);
		$topic = $this->topic->get($topic_id);
		if($topic == null) {
			echo '404';exit;
		}
		$user_id = $topic->user_id;
		if(is_mine($user_id)) {
			$reply_result = $this->reply->delete_by_topic_id($topic_id);
			$topic_result = $this->topic->delete($topic_id);
			$this->data['reply_result'] = $reply_result;
			$this->data['topic_result'] = $topic_result;
		} else {
			echo '404';exit;
		}
	}
	
}
