<?php
###################################################################
##
##	Module Admin Database Model
##	Version: 1.01
##
##	Last Edit:
##	Sept 7 2012
##
##	Description:
##  Module Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Module_admin_model extends CI_Model 
	{
	
    function Module_admin_model()
		{
		parent::__construct();
		}

	function module_index()
		{
		$this->db->order_by("id", "asc");
		$page_index = $this->db->get('modules');
		return $page_index;
		}

	function module_edit()
		{
		$page_edit = $this->db->get_where('modules', array('id' => $this->uri->segment(3)));
		return $page_edit;
		}

	function module_update()
		{
		$this->db->where('id', $_POST['id']);
		$this->db->update('modules', $this->db->escape($_POST));
		}

	function get_slideshow()
		{
		$slide = $this->db->get('slideshow_group');
		return $slide;
		}

	function module_insert()
		{
		$array = array(
			'name' => $this->input->post('name'),
			'slide_id' => $this->input->post('slide_id'),
			'side_top' => $this->input->post('side_top'),
			'side_bottom' => $this->input->post('side_bottom'),
			'content_top' => $this->input->post('content_top'),
			'content_bottom' => $this->input->post('content_bottom'),
			'container' => $this->input->post('container')
		);
		$this->db->set($array);
		$this->db->insert('modules', $this->db->escape($_POST));
		}

	function module_delete()
		{
		$this->db->delete('modules', array('id' => $this->uri->segment(3)));
		}

	function get_groups()
		{
		$groups = $this->db->get('widget_groups');
		return $groups;
		}
	}
?>