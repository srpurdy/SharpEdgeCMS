<?php
###################################################################
##
##	Userfields Admin Database Model
##	Version: 1.00
##
##	Last Edit:
##	April 1 2015
##
##	Description:
##	Contact Admin Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Userfields_admin_model extends CI_Model 
	{
    function Userfields_admin_model()
		{
		parent::__construct();
		}

	function show_fields()
		{
		$show_fields = $this->db		
			->select('*')
			->from('
				user_fields
			')
			->order_by('sort_id', 'asc')
			->get();		
		return $show_fields;
		}

	function field_insert()
		{
		$array = array(
			'name' => $this->input->post('name'),
			'lang' => $this->input->post('lang'),
			'type' => $this->input->post('type'),
			'list' => $this->input->post('list'),
			'on_register' => $this->input->post('on_register'),
			'is_required' => $this->input->post('is_required'),
			'sort_id' => $this->input->post('sort_id')
		);
		$this->db->set($array);
		$this->db->insert('user_fields');
		$this->load->dbutil();
		$this->dbutil->optimize_table('user_fields');
		}

	function field_update()
		{
		$array = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'lang' => $this->input->post('lang'),
			'type' => $this->input->post('type'),
			'list' => $this->input->post('list'),
			'on_register' => $this->input->post('on_register'),
			'is_required' => $this->input->post('is_required'),
			'sort_id' => $this->input->post('sort_id')
		);
		$this->db->set($array);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('user_fields');
		$this->load->dbutil();
		$this->dbutil->optimize_table('user_fields');
		}

	function field_delete()
		{
		$this->db->delete('user_fields', array('id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('user_fields');
		$this->db->delete('custom_field_data', array('field_id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('custom_field_data');
		}

	function edit_field()
		{
		$edit_field = $this->db->get_where('user_fields', array('id' => $this->uri->segment(3)));
		return $edit_field;
		}

	function get_langs()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}
	}
?>