<?php
class Admin_Controller extends MY_Controller {

    protected $helpers = array( 'url' );
	protected $models = array('user');
	
    function __construct() {
        parent::__construct();
		$this->load->library('session');
        $this->data['meta_title'] = '6bey website CMS';
		
		if ($this->user->loggedin() == FALSE && $this->user->email != '117064092@qq.com') {
			redirect('user/login');
		}
    }

}
