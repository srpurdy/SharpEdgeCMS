<?php
###################################################################
##
##	Language Database Model
##	Version: 1.01
##
##	Last Edit:
##	Sept 7 2012
##
##	Description:
##	Language Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Lang_model extends CI_Model 
	{
	
    function Lang_model()
		{
		parent::__construct();
		}
		
	function get_languages()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}

	function lang_edit()
		{
		$lang_edit = $this->db->get_where('languages', array('id' => $this->uri->segment(3)));
		return $lang_edit;
		}

	function lang_update()
		{
		$this->db->where('id', $_POST['id']);
		$this->db->update('languages', $this->db->escape($_POST));
		}

	function lang_insert()
		{
		$array = array(
			'lang' => $this->input->post('lang'),
			'lang_short' => $this->input->post('lang_short')
		);
		$this->db->set($array);
		$this->db->insert('languages', $this->db->escape($_POST));
		}

	function lang_delete()
		{
		$this->db->delete('languages', array('id' => $this->uri->segment(3)));
		}
	}
?>