<?php

class Problem_Model extends MY_Model {
	
	protected $home_page_columns = 'id, node_id, title, user_id, replies_count, last_reply_user_id
			, replied_at, created_at, updated_at';
	
	public function __construct() {
        parent::__construct();
	}
	
	public function create($user_id) {
		$time = time();
		$problem_id = $this->insert(array(
			'title' => $this->input->post('title'),
			'body' => $this->input->post('body'),
			'score' => $this->input->post('score'),
			'replied_at' => $time,
			'created_at' => $time,
			'user_id' => $user_id,
		));
		return $problem_id;
	}

	public function update_problem($user_id) {
		$topic_id = $this->input->post('id');
		$data['id'] = $topic_id;
		$data['user_id'] = $user_id;
		$res = $this->get_by($data);
		if($res == null) {
			return FALSE;
		}
		$update_data['title'] = $this->input->post('title');
		$update_data['body'] = $this->input->post('body');
		$update_data['updated_at'] = time();
		return $this->update($topic_id, $update_data);
	}
	
	public function get_topics_by_page($per_page, $offset) {
		return $this->select($this->home_page_columns)
					->order_by(array('replied_at' => 'desc', 'created_at' => 'desc'))
					->limit($per_page, $offset)
					->get_all();
	}
	
	public function add_reply($topic_id, $user_id) {
		$res = $this->db->where('id', $topic_id)
			->set('replies_count', 'replies_count+1', FALSE)
			->set('last_reply_user_id', $user_id)
			->set('replied_at', time())
			->update($this->_table);
		return $res;
	}
}