<?php
###################################################################
##
##	Dashboard Database Model
##	Version: 0.90
##
##	Last Edit:
##	March 11 2013
##
##	Description:
##	Page Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Dashboard_model extends CI_Model 
	{
	
	function Dashboard_model()
		{
		parent::__construct();
		}

	function page_insert()
		{
		$array = array(
			'name' => $this->input->post('name'),
			'text' => $this->input->post('text2'),
			'url_name' => url_title($this->input->post('name')),
			'slide_id' => $this->input->post('slide_id'),
			'side_top' => $this->input->post('side_top'),
			'side_bottom' => $this->input->post('side_bottom'),
			'content_top' => $this->input->post('content_top'),
			'content_bottom' => $this->input->post('content_bottom'),
			'container_name' => $this->input->post('container_name'),
			'lang' => $this->input->post('lang'),
			'hide' => $this->input->post('hide'),
			'meta_desc' => $this->input->post('meta_desc'),
			'meta_keywords' => $this->input->post('meta_keywords')
		);
		$this->db->set($array);
		$this->db->insert('pages');
		}
		
	function show_comments()
		{
		$this->db->order_by('datetime', 'desc');
		$this->db->limit('10');
		$comments = $this->db->get('blog_comments');
		return $comments;
		}
	}
?>