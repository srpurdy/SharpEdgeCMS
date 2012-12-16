<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");
$config['menu_admin'] = 'Menu';
$config['menu_admin_level'] = true;
$config['menu_admin_menu'] = array(
							'Manage Menu' => '/menu_admin',
							'Add Menu Item' => '/menu_admin#tabs-2',
);
?>