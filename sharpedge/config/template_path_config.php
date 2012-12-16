<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->CI = get_instance();
#location to template directory.
$config['template_url']	= "/themes/". $this->CI->config->item('theme') ."/container";

#location to mobile template directory.
$config['template_mobile_url']	= "/themes/". $this->CI->config->item('mobile_theme') ."/container";

#location for page containers
$config['template_page'] = "/themes/". $this->CI->config->item('theme');

#location for mobule page containers
$config['template_mobile_page'] = "/themes/". $this->CI->config->item('mobile_theme');

#location to template directory for admin
$config['template_url_admin']	= "/themes/". $this->CI->config->item('admin_theme') ."/container";

#location to admin containers
$config['template_admin_page'] = "/themes/" . $this->CI->config->item('admin_theme');
?>