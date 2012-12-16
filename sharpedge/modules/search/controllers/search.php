<?php
###################################################################
##
##	Search Module
##	Version: 1.02
##
##	Last Edit:
##  Oct 25 2012
##
##	Description:
##	Searches through pages and blog posts.
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	Added more logic to search system.
##
##################################################################
class Search extends MY_Controller {

	function Search()
		{
		parent::__construct();
		$this->load->model('search_model');
		}
	
	function index()
		{
		$data['heading'] = 'Search Results';
		$search_string = $this->input->post('search', TRUE);
		$spaces = false;
		if(!$spaces)
			{
			$string = preg_replace('/\s+/u', '', $search_string);
			}
			
		$chars = preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY);
		$char_count = count($chars);
		if($char_count > 3)
			{
			$data['do_search'] = $this->search_model->do_search($search_string);
			$data['do_search_news'] = $this->search_model->do_search_news($search_string);
			$data['string_search'] = $search_string;
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['page'] = $data['template_path']. '/search/search_result';
			$this->load->vars($data);
			$this->load->view($this->_container_ctrl);
			}
		else
			{
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['page'] = $data['template_path']. '/search/search_error';
			$this->load->vars($data);
			$this->load->view($this->_container_ctrl);
			}
		}
	}