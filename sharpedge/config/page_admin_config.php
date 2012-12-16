<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");
$config['page_admin'] = 'Pages';
$config['page_admin_level'] = true;
$config['page_admin_menu'] = array(
							'Manage Pages' => '/page_admin',
							'Add Page' => '/page_admin#tabs-2',
							'Manage Drafts' => '/page_admin#tabs-3',
);
?>