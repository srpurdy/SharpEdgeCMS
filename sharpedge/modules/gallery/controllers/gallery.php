<?php
###################################################################
##
##	Gallery Module
##	Version: 1.07
##
##	Last Edit:
##	Dec 3 2014
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
		$data['template_path'] = $this->config->item('template_page');
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
				$data['sub_cats'] = $this->gallery_model->get_sub_cat($set_heading->id);
				$data['template_path'] = $this->config->item('template_page');
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