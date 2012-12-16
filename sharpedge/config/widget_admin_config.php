<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");
$config['widget_admin'] = 'Widgets';
$config['widget_admin_level'] = true;
$config['widget_admin_menu'] = array(
							'Manage Widgets' => '/widget_admin',
							'New Widget' => '/widget_admin#tabs-2',
							'Manage Widget Groups' => '/widget_admin#tabs-3',
							'New Widget Group' => '/widget_admin#tabs-4',
							'New Widget Group Item' => '/widget_admin#tabs-5',
);
?>