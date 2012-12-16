<?php
###################################################################
##
##	Template Database Model
##	Version: 1.01
##
##	Last Edit:
##	Sept 7 2012
##
##	Description:
##	Template Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Template_model extends CI_Model 
	{
	
	function Template_model()
		{
		parent::__construct();
		}

	function get_containers()
		{
		$get_container = $this->db->get('containers');
		return $get_container;
		}

	function container_edit()
		{
		$menu_edit = $this->db->get_where('containers', array('c_id' => $this->uri->segment(3)));
		return $menu_edit;
		}

	function container_update()
		{
		$this->db->where('c_id', $_POST['c_id']);
		$this->db->update('containers', $this->db->escape($_POST));
		}

	function container_insert()
		{
		$this->db->insert('containers', $this->db->escape($_POST));
		}

	function container_delete()
		{
		$this->db->delete('containers', array('c_id' => $this->uri->segment(3)));	
		}
	}
?>