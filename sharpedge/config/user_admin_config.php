<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");
$config['user_admin'] = 'Users';
$config['user_admin_level'] = true;
$config['user_admin_menu'] = array(
							'Manage Users' => '/user_admin',
							'Add User' => '/user_admin/#tabs-2',
							'Manage Groups/Roles' => '/user_admin/#tabs-3',
							'Add Group/Role' => '/user_admin/#tabs-4',
							'Add User To Group' => '/user_admin/#tabs-5'
);
?>