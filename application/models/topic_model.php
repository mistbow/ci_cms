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
			'create_time' => time(),
			'user_id' => $user_id,
		));
	}
}