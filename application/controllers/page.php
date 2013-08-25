<?php
/**
 * page controller
 */
class Page extends Frontend_Controller {
	
    protected $models = array( 'page' );
    
	function __construct($argument) {
		parent :: __construct();
	}
    
    public function index() {
        $this->data['pages'] = $this->page->get_all();
    }
    
    public function save() {
        $data = array(
            'title' => 'second page',
            'slug' => 'second',
            'order' => 3,
            'body' => 'this is a second page',
        );
        $this->page->insert($data);
    }
    
    public function delete($id) {
        $this->page->delete($id);
    }
}
