<?php 
class Reply extends Frontend_Controller {
	
	protected $models = array('topic', 'user', 'reply');
	
	public $update_validation = array(
		array( 'field' => 'id',
               'label' => 'id',
               'rules' => 'required' ),
        array( 'field' => 'body',
               'label' => 'body',
               'rules' => 'required' ),
	);
	
	function __construct() {
		parent :: __construct();
	}
	
	function edit() {
		$reply_id = $this->uri->segment(3);
		$reply = $this->reply->get($reply_id);
		if($reply == null) {
			echo '404';exit;
		}
		$user_id = $reply->user_id;
		if(is_mine($user_id)) {
			$this->data['reply'] = $reply;
		} else {
			echo '404';exit;
		}
		$this->view = 'topic/reply_edit.php';
	}
	
	public function update() {
		$user_id = $this->_check_logged_in();
		$this->form_validation->set_rules($this->update_validation);
    	if ($this->form_validation->run() == TRUE) {
    		$reply_id = $this->input->post('id');
			$res = $this->reply->update_reply($user_id);
    		if ($res !== FALSE) {
    			redirect('topic/show/'.$res['topic_id']);
    		}
    		else {
    			$this->session->set_flashdata('error', '账号或者密码错误');
    			echo '404';exit;
    		}
		}
	}
	
}
