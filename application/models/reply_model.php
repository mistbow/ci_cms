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
       array( 'field' => 'user_id',
	       'label' => 'user_id',
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
	
	public function get_topics_by_page($per_page, $offset) {
		return $this->select($this->home_page_columns)
					->order_by(array('replied_at' => 'desc', 'created_at' => 'desc'))
					->limit($per_page, $offset)
					->get_all();
	}
}