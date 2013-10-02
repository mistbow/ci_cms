<?php
class Problem extends Frontend_Controller {
	
	protected $models = array('problem');
	
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
