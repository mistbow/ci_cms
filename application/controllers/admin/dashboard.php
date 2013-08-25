<?php
class Dashboard extends Admin_Controller {
	
	function __construct() {
		parent :: __construct();
	}
    
    public function index() {
        $this->view = 'admin/_layout_main';
    }
    
    public function modal() {
        $this->view = 'admin/_layout_modal';
    }
}
