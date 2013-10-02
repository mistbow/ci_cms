<?php
class Problem extends Frontend_Controller {
	
	protected $models = array('problem', 'user');
	
	public $create_validation = array(
		array( 'field' => 'title',
               'label' => 'title',
               'rules' => 'required' ),
        array( 'field' => 'body',
               'label' => 'body',
               'rules' => 'required' ),
        array( 'field' => 'score',
				'label' => 'score',
        		'rules' => 'required|integer' ),
               
	);
	
	function __construct() {
		parent :: __construct();
	}
    
    public function index() {
    	$config['base_url'] =  'http://6bey.com/problem/index/';
    	$config['total_rows'] = $this->problem->count_all();
		$per_page = $this->config->item('per_page');
		$now_page = intval($this->uri->segment(3));
		$offset = $per_page * ($now_page - 1);
		if($offset < 0) $offset = 0;
		$problems = $this->problem->get_problems_by_page($per_page, $offset);
		
		append_user_info($problems, 'user', 'user_id');
		append_user_info($problems, 'reply_user', 'last_reply_user_id');
		
		$this->data['topics'] = $problems;
		$this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
    }
	
	public function newproblem() {
		$this->view = 'problem/new.php';
	}
	
	public function create() {
		$user_id = get_current_user_id_and_force_login();
		$this->form_validation->set_rules($this->create_validation);
    	if ($this->form_validation->run() == TRUE) {
    		if ($this->problem->create($user_id) !== FALSE) {
    			redirect('problem/index');
    		}
    		else {
    			$this->session->set_flashdata('error', '账号或者密码错误');
    			redirect('problem/newproblem', 'refresh');
    		}
		}
	}
    
}
