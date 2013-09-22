<?php

class Topic_Model extends MY_Model {
	
	protected $home_page_columns = 'id, node_id, title, user_id, replies_count, last_reply_user_id
			, replied_at, created_at, updated_at';
	
	public function __construct() {
        parent::__construct();
	}
	
	public $create_validation = array(
		array( 'field' => 'title',
               'label' => 'title',
               'rules' => 'required' ),
        array( 'field' => 'body',
               'label' => 'body',
               'rules' => 'required' ),
	);
	
	public function create($user_id) {
		$topic_id = $this->insert(array(
			'title' => $this->input->post('title'),
			'body' => $this->input->post('body'),
			'created_at' => time(),
			'user_id' => $user_id,
		));
		return $topic_id;
	}
	
	public function get_topics_by_page($per_page, $offset) {
		return $this->select($this->home_page_columns)
					->order_by(array('replied_at' => 'desc', 'created_at' => 'desc'))
					->limit($per_page, $offset)
					->as_array()
					->get_all();
	}
}