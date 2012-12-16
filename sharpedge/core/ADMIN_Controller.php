<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/* The MX_Controller class is autoloaded as required */
###################################################################
##
##	Admin Controller Class
##	Version: 1.02
##
##	Last Edit:
##	Dec 15 2012
##
##	Description:
##	
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class ADMIN_Controller extends MX_Controller
	{
	var $data = array();

	function ADMIN_Controller()
		{
		$this->load->config('template_config');
		$this->load->config('template_path_config');
		$this->load->config('website_config');
		$this->load->config('blog_config');
		$this->load->model('config_model');
		$this->lang->load('sharpedge', $this->config->item('language'));
		$this->data['admin_theme'] = $this->config->item('admin_theme');
		$this->data['template'] = $this->config->item('template_url_admin');
		$this->data['j_ui_theme'] = $this->config->item('j_ui_theme');

		#Load Global Models
		$this->load->model('frontend_model');
		$this->load->model('backend_model');

		#Get Available Admin Modules
		$this->data['admin_module_array'] = $this->frontend_model->admin_modules();

		$this->_container = $this->data['template'];
		$this->load->vars($this->data);
		}
	}