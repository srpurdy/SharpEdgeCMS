<?php

class Config_model extends CI_Model 
	{
	
	function Config_model()
		{
		parent::__construct();
		}

	function get_langs()
		{
		$this->db->order_by('lang', 'asc');
		$langs = $this->db->get('languages');
		return $langs;
		}
	}
?>