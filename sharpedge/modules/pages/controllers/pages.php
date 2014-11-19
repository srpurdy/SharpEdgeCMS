<?php
###################################################################
##
##	Pages Module
##	Version: 1.08
##
##	Last Edit:
##	Nov 18 2014
##
##	Description:
##	Page Frontend System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Pages extends MY_Controller
	{

	function Pages()
		{
		parent::__construct();
		$this->load->model('page_model');
		}

	function index()
		{
		echo "Directory Access Not Allowed";
		}
		
	function view()
		{
		if($this->config->item('short_url') == 1)
			{
			$seg = $this->uri->segment(1);
			}
		else
			{
			$seg = $this->uri->segment(3);
			}
			//Update Page Views
			$this->page_model->update_views($seg);
			$this->data['heading'] = $this->data['page_heading'];
			$this->data['template_path'] = $this->config->item('template_page');
			$this->data['page'] = $this->data['template_path'] . '/pages/page_view';
			$this->load->vars($this->data);
			$this->load->view($this->_container_pages);
		}
	
	function home_direct()
		{
		if($this->config->item('short_url') == 1)
			{
			redirect($this->config->item('homepage_string'));
			}
		else
			{
			redirect('pages/view/'.$this->config->item('homepage_string'));
			}
		}
	}