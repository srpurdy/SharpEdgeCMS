<?php
###################################################################
##
##	Menu Admin Database Model
##	Version: 1.05
##
##	Last Edit:
##	Sept 7 2012
##
##	Description:
##	Menu Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Menu_admin_model extends CI_Model
	{
    function Menu_admin_model()
		{
		parent::__construct();
		}
		
	function menu_index()
		{
		$this->db->order_by("parent_id", "asc");
		$menu_index = $this->db->get('menu');
		return $menu_index;
		}

	function menu_edit()
		{
		$menu_edit = $this->db->get_where('menu', array('id' => $this->uri->segment(3)));
		return $menu_edit;
		}

	function menu_update()
		{
		$this->db->where('id', $_POST['id']);
		$this->db->update('menu', $this->db->escape($_POST));
		}

	function menu_insert()
		{
		$this->db->insert('menu', $this->db->escape($_POST));
		}

	function menu_delete()
		{
		$this->db->delete('menu', array('id' => $this->uri->segment(3)));	
		}

	function get_pages()
		{
		$pages = $this->db->get('pages');
		return $pages;
		}

	function get_langs()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}
	}
?>