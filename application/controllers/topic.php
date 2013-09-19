<?php
class Topic extends Frontend_Controller {
	
	function __construct() {
		parent :: __construct();
	}
    
    public function index() {
    }
	
	public function newtopic() {
		$this->view = 'topic/new.php';
	}
    
	public function create() {
		
	}
}
