<?php
###################################################################
##
##	Gallery Module
##	Version: 1.05
##
##	Last Edit:
##	Nov 7 2013
##
##	Description:
##	Gallery Frontend System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Gallery extends MY_Controller
	{

	function Gallery()
		{
		parent::MY_Controller();
		$this->load->model('gallery_model');
		}

	function index()
		{
		$this->data['query'] = $this->gallery_model->get_cat();
		$this->data['heading'] = 'Photo Gallery';
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$data['template_path'] = $this->config->item('template_mobile_page');
			}
		else
			{
			$data['template_path'] = $this->config->item('template_page');
			}
		$this->data['page'] = $data['template_path'] . '/gallery/gallery_home';
		$this->load->vars($this->data);
		$this->load->view($this->_container_ctrl);
		}
	
	function event()
		{
		if(is_string($this->uri->segment(3)))
			{
			$data['gallery'] = $this->gallery_model->get_gallery($this->uri->segment(3));
			if($data['gallery']->result())
				{
				$get_heading = $this->gallery_model->get_heading($this->uri->segment(3));
				$set_heading = $get_heading->row();
				$data['heading'] = $set_heading->name;  
				if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
					{
					$data['template_path'] = $this->config->item('template_mobile_page');
					}
				else
					{
					$data['template_path'] = $this->config->item('template_page');
					}
				$data['page'] = $data['template_path'] . '/gallery/event_section';
				$this->load->vars($data);
				$this->load->view($this->_container_ctrl);
				}
			else
				{
				show_404('page');
				}
			}
		else
			{
			show_404('page');
			}
		}
	}