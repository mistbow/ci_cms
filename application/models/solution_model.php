<?php

class Solution_Model extends MY_Model {
	
	public function __construct() {
        parent::__construct();
	}
	
	public function create($problem_id, $user_id) {
		$solution_id = $this->insert(array(
			'problem_id' => $problem_id,
			'body' => $this->input->post('body'),
			'user_id' => $user_id,
			'created_at' => time(),
		));
		return $solution_id;
	}
	
	public function get_problem_solutions($problem_id) {
		return $this->order_by('created_at', 'desc')
					->get_many_by('problem_id', $problem_id);
	}
	
	public function delete_by_problem_id($problem_id) {
		return $this->delete_by('problem_id', $problem_id);
	}
}