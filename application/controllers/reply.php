<?php 
class Reply extends Frontend_Controller {
	
	protected $models = array('topic', 'user', 'reply');
	
	function __construct() {
		parent :: __construct();
	}
	
	function edit() {
		$reply_id = $this->uri->segment(3);
		$reply = $this->reply->get($reply_id);
		if($reply == null) {
			echo '404';exit;
		}
		$user_id = $reply->user_id;
		if(is_mine($user_id)) {
			$this->data['reply'] = $reply;
		} else {
			echo '404';exit;
		}
	}
	
}
