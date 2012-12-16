<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");
$config['blog_admin'] = 'Articles';
$config['blog_admin_level'] = true;
$config['blog_admin_menu'] = array(
							'Manage Articles' => '/blog_admin',
							'New Article' => '/blog_admin#tabs-2',
							'Manage Categories' => '/blog_admin#tabs-3',
							'Add Category' => '/blog_admin#tabs-4',
							'Manage Comments' => '/blog_admin#tabs-5',
);
?>