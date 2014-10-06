<?php
###################################################################
##
##	Main Module
##	Version: 1.10
##
##	Last Edit:
##	Oct 6 2014
##
##	Description:
##	Main System - Redirection Module
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Main extends MY_Controller
	{

	function Main()
		{
		parent::__construct();
		$this->load->model('pages/page_model');
		}

	function index()
		{
	    //echo "test";
		$this->data['heading'] = $this->data['page_heading'];
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$this->data['template_path'] = $this->config->item('template_mobile_page');
			}
		else
			{
			$this->data['template_path'] = $this->config->item('template_page');
			}
		$this->data['page'] = $this->data['template_path'] . '/pages/page_view';
		$this->load->vars($this->data);
		$this->load->view($this->_container_pages);
		}
	}
?>