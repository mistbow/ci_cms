<?php
class Frontend_Controller extends MY_Controller
{
	protected $helpers = array( 'url', 'cookie', 'file', 'xml'
		, 'form', 'timer', 'user', 'date' );
	
	function __construct ()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->data['meta_title'] = '6bey website CMS';
	}
}