<?php

class Topic_Model extends MY_Model {
	
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
}