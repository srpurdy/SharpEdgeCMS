<?php
###################################################################
##
##	Blog Feed Module
##	Version: 1.02
##
##	Last Edit:
##	July 16 2014
##
##	Description:
##	Blog Feed System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Blog_feed extends MY_Controller
	{

	function Blog_feed()
		{
		parent::MY_Controller();
		#Language

		#Libarays
		$this->load->library('form_validation');
		$this->load->library('zip');

		#Models
		$this->load->model('blog_feed_model');

		#Helpers
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('xml');
		}

	function index()
		{
		}
	 
	function rss()
		{
		$data['encoding'] = 'utf-8';
		$data['feed_name'] = base_url() . ' News';
		$data['feed_url'] = base_url();
		$data['page_description'] = 'News';
		$data['page_language'] = 'en-us';
		$data['creator_email'] = 'sales@purdydesigns.com';
		$data['posts'] = $this->blog_feed_model->get_blogposts('20', '0');
		$data['template_path'] = $this->config->item('template_page');
		header("Content-Type: application/rss+xml");
		$this->load->view($data['template_path'] . '/blog_feed/rss', $data);
		}
	}