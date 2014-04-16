<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#Name of the theme 
$config['theme'] = 'default_bootstrap';

#Name of the theme for the admin section
$config['admin_theme'] = 'admin_2014';

#Name of the mobile theme
$config['mobile_theme'] = 'mobile_default';

#Wither Mobile Support is Turned On/Off
$config['mobile_support'] = false;
$config['mobile_debug'] = false; // only used for pc debugging purposes. (should be set to false on a production website)

#location to template directory.
$config['template_url']	= "/themes/". $config['theme'] ."/container";

#location to mobile template directory.
$config['template_mobile_url']	= "/themes/". $config['mobile_theme'] ."/container";

#location for page containers
$config['template_page'] = "/themes/". $config['theme'];

#location for mobule page containers
$config['template_mobile_page'] = "/themes/". $config['mobile_theme'];

#location to template directory for admin
$config['template_url_admin']	= "/themes/". $config['admin_theme'] ."/container";

#location to admin containers
$config['template_admin_page'] = "/themes/" . $config['admin_theme'];

#Jquery UI Theme
$config['j_ui_theme'] = 'base';

$config['template'] = 'Templates';
$config['template_level'] = true;
$config['template_menu'] = array(
							'Manage Layouts' => '/template/manage_containers',
							'Add Layout' => '/template/manage_containers#tabs-2',
							'Add Theme' => '/template/manage_containers#tabs-3',
							'New File' => '/template/manage_containers#tabs-4',
							'Edit File' => '/template/manage_containers#tabs-5',
);
?>