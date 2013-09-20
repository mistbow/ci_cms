<?php 
$config['base_url'] = $this->uri->uri_string();
$config['total_rows'] = $this->topic->count_all();
$config['per_page'] = 5;
$config['use_page_numbers'] = TRUE;
$config['full_tag_open'] = '<ul class="pagination">';
$config['full_tag_close'] = '</ul>';
$config['cur_tag_open'] = '<li class="active"><a href="#">';
$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';