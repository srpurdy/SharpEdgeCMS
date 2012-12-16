<?php
###################################################################
##
##	Search Database Model
##	Version: 1.01
##
##	Last Edit:
##	Sept 7 2012
##
##	Description:
##	Search Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class search_model extends CI_Model
	{

	function __construct()
		{
		parent::__construct();
		}

	function do_search($terms)
		{
		$terms_array = explode(' ', $terms);

		$this->db->like('text', $terms);
		foreach($terms_array as $key)
			{
			$this->db->or_like('text', $key);
			}
		$this->db->select('*');
		$this->db->from('pages');
		$search = $this->db->get();
		return $search;
		}

	function do_search_news($terms)
		{
		$terms_array = explode(' ', $terms);

		$this->db->like('text', $terms);
		foreach($terms_array as $key)
			{
			$this->db->or_like('text', $key);
			}
		$this->db->select('*');
		$this->db->from('blog');
		$search = $this->db->get();
		return $search;
		}
	}
?>