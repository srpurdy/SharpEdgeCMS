<?php
###################################################################
##
##  Videos Module
##	Version: 1.01
##
##	Last Edit:
##	Oct 28 2014
##
##	Description:
##  Products Frontend Display.
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Videos extends MY_Controller
	{

	function Videos()
		{
		parent::MY_Controller();
		$this->load->model('videos_model');
		$this->load->config('video_config');
		}

	function index()
		{
		$this->data['video_categories'] = $this->videos_model->get_cat();
		$this->data['heading'] = 'Videos';
		$data['template_path'] = $this->config->item('template_page');
		$this->data['page'] = $data['template_path'] . '/videos/video_categories';
		$this->load->vars($this->data);
		$this->load->view($this->_container_ctrl);
		}
	
	function category()
		{
		$data['videos'] = $this->videos_model->get_videos_category();
		$get_heading = $this->db->select('video_cat')->where( 'video_url_cat', $this->uri->segment(3) )->get('video_categories');
		$set_heading = $get_heading->row();
		$data['heading'] = $set_heading->video_cat;
		$data['template_path'] = $this->config->item('template_page');
		$data['page'] = $data['template_path'] . '/videos/videos_in_category';
		$this->load->vars($data);
		$this->load->view($this->_container_ctrl);
		}
	
	function video()
		{
		$data['video'] = $this->videos_model->get_video($this->uri->segment(3));
		$get_heading = $this->db->select('name')->where( 'url_name', $this->uri->segment(3) )->get('videos');
		$set_heading = $get_heading->row();
		$data['heading'] = $set_heading->name;
		$data['template_path'] = $this->config->item('template_page');
		$data['page'] = $data['template_path'] . '/videos/video_details';
		$this->load->vars($data);
		$this->load->view($this->_container_ctrl);
		}
	}