<?php
class Frontend_Controller extends MY_Controller
{
	protected $helpers = array( 'cookie', 'file', 'xml', 'form' );
	
	function __construct ()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->data['meta_title'] = '6bey website CMS';
	}
}