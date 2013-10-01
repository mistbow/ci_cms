<?php

class Reply_Model extends MY_Model {
	
	public function __construct() {
        parent::__construct();
	}
	
	public $create_validation = array(
        array( 'field' => 'topic_id',
           'label' => 'topic_id',
           'rules' => 'required' ),
       array( 'field' => 'body',
	       'label' => 'body',
	       'rules' => 'required' ),
	);
	
	public function create($topic_id, $user_id) {
		$reply_id = $this->insert(array(
			'topic_id' => $topic_id,
			'body' => $this->input->post('body'),
			'user_id' => $user_id,
			'created_at' => time(),
		));
		return $reply_id;
	}
	
	public function get_topic_replies($topic_id) {
		return $this->order_by('created_at', 'desc')
					->get_many_by('topic_id', $topic_id);
	}
	
	public function delete_by_topic_id($topic_id) {
		return $this->delete_by('topic_id', $topic_id);
	}
}