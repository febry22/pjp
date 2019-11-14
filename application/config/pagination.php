<?php
//konfigurasi pagination
$config['base_url'] = site_url('menu/submenu/');

//desain pagination
$config['first_link'] = 'First';
$config['last_link'] = 'Last';
$config['next_link'] = 'Next';
$config['prev_link'] = 'Prev';
$config['full_tag_open'] = '<nav><ul class="pagination pagination-sm justify-content-center">';
$config['full_tag_close'] = '</ul></nav>';
$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
$config['cur_tag_close'] = '</a></li>';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '</li>';
$config['attributes'] = array('class' => 'page-link');
