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
	
	public function update_reply($user_id) {
		$reply_id = $this->input->post('id');
		$data['id'] = $reply_id;
		$data['user_id'] = $user_id;
		$res = $this->get_by($data);
		if($res == null) {
			return FALSE;
		}
		$result['topic_id'] = $res->topic_id;
		$update_data['body'] = $this->input->post('body');
		$update_data['updated_at'] = time();
		$result['reply_id'] = $this->update($reply_id, $update_data);
		return $result;
	}
	
	public function get_topic_replies($topic_id) {
		return $this->order_by('created_at', 'desc')
					->get_many_by('topic_id', $topic_id);
	}
	
	public function delete_by_topic_id($topic_id) {
		return $this->delete_by('topic_id', $topic_id);
	}
}