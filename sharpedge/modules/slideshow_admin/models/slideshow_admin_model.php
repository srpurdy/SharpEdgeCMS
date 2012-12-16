<?php
###################################################################
##
##	Slideshow Database Model
##	Version: 1.01
##
##	Last Edit:
##	Sept 7 2012
##
##	Description:
##	Slideshow Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Slideshow_admin_model extends CI_Model 
	{
	
	function Slideshow_admin_model()
		{
		parent::__construct();
		}

	function get_images()
		{
		$this->db->order_by('sort_id', 'asc');
		$tags = $this->db->get('slideshow');
		return $tags;
		}

	function show_slideshow()
		{
		$show_slide = $this->db		
			->select('*')
			->from('
				slideshow
			')
			->get();		
		return $show_slide;
		}

	function image_insert($userfile)
		{
		$array = array(
			'userfile' => $userfile,
			'desc_one' => $this->input->post('desc_one'),
			'desc_two' => $this->input->post('desc_two'),
			'sort_id' => $this->input->post('sort_id')
		);
		$this->db->set($array);
		$this->db->insert('slideshow');
		$this->load->dbutil();
		$this->dbutil->optimize_table('slideshow');
		}

	function image_update()
		{
		$array = array(
			'userfile' => $this->input->post('userfile'),
			'desc_one' => $this->input->post('desc_one'),
			'desc_two' => $this->input->post('desc_two'),
			'sort_id' => $this->input->post('sort_id')
		);
		$this->db->set($array);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('slideshow');
		$this->load->dbutil();
		$this->dbutil->optimize_table('slideshow');
		}

	function image_delete()
		{
		$this->db->delete('slideshow', array('id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('slideshow');
		}

	function edit_image()
		{
		$edit_slide = $this->db->get_where('slideshow', array('id' => $this->uri->segment(3)));
		return $edit_slide;
		}

	function show_slidegroups()
		{
		$show_cat = $this->db		
			->select('*')
			->from('
				slideshow_group
			')
			->get();		
		return $show_cat;
		}

	function group_insert($tags)
		{
		$array = array(
			'name' => $this->input->post('name'),
			'images' => $this->input->post('images')
		);
		$this->db->set($array);
		$this->db->insert('slideshow_group');
		$this->load->dbutil();
		$this->dbutil->optimize_table('slideshow_group');
		}

	function group_update($tags)
		{
		$array = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'images' => $this->input->post('images')
		);
		$this->db->set($array);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('slideshow_group');
		$this->load->dbutil();
		$this->dbutil->optimize_table('slideshow_group');
		}

	function group_delete()
		{
		$this->db->delete('slideshow_group', array('id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('slideshow_group');
		}

	function edit_group()
		{
		$edit_blog = $this->db->get_where('slideshow_group', array('id' => $this->uri->segment(3)));
		return $edit_blog;
		}
	}
?>