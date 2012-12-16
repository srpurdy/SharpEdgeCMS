<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");
$config['gallery_admin'] = 'Galleries';
$config['gallery_admin_level'] = true;
$config['gallery_admin_menu'] = array(
							'Manage Categories' => '/gallery_admin',
							'Add Category' => '/gallery_admin#tabs-2',
							'Add Photo' => '/gallery_admin#tabs-3',
							'Import By Zip' => '/gallery_admin#tabs-4',
);
?>