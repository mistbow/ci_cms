<?php
class Admin_Controller extends MY_Controller {

    protected $helpers = array( 'url' );

    function __construct() {
        parent::__construct();
        $this->data['meta_title'] = '6bey website CMS';
    }

}
