<?php
class Exercise extends Frontend_Controller {

	protected $helpers = array( 'url' );

	function __construct() {
		parent::__construct();
		$this->load->library('category');
	}
	
	public function index() {
		$this->data['category'] = $this->category->getClasses();
	}

	
}
