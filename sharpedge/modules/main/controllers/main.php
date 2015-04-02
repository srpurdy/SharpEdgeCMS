<?php
###################################################################
##
##	Main Module
##	Version: 1.12
##
##	Last Edit:
##	Feb 25 2015
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
		$this->data['heading'] = $this->data['page_heading'];
		$this->data['template_path'] = $this->config->item('template_page');
		$this->data['page'] = $this->data['template_path'] . '/pages/page_view';
		$this->load->vars($this->data);
		$this->load->view($this->_container_pages);
		}
	}
?>