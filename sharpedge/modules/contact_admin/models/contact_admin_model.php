<?php
###################################################################
##
##	Contact Admin Database Model
##	Version: 1.03
##
##	Last Edit:
##	Sept 7 2012
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
class Contact_admin_model extends CI_Model 
	{
    function Contact_admin_model()
		{
		parent::__construct();
		}

	function show_fields()
		{
		$show_fields = $this->db		
			->select('*')
			->from('
				contact_fields
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
			'array_name' => $this->input->post('array_name'),
			'is_required' => $this->input->post('is_required'),
			'is_email' => $this->input->post('is_email'),
			'sort_id' => $this->input->post('sort_id'),
			'alignment' => $this->input->post('alignment')
		);
		$this->db->set($array);
		$this->db->insert('contact_fields');
		$this->load->dbutil();
		$this->dbutil->optimize_table('contact_fields');
		}

	function field_update()
		{
		$array = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'lang' => $this->input->post('lang'),
			'type' => $this->input->post('type'),
			'array_name' => $this->input->post('array_name'),
			'is_required' => $this->input->post('is_required'),
			'is_email' => $this->input->post('is_email'),
			'sort_id' => $this->input->post('sort_id'),
			'alignment' => $this->input->post('alignment')
		);
		$this->db->set($array);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('contact_fields');
		$this->load->dbutil();
		$this->dbutil->optimize_table('contact_fields');
		}

	function field_delete()
		{
		$this->db->delete('contact_fields', array('id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('contact_fields');
		}

	function edit_field()
		{
		$edit_field = $this->db->get_where('contact_fields', array('id' => $this->uri->segment(3)));
		return $edit_field;
		}

	function show_contacts()
		{
		$show_con = $this->db
			->select('*')
			->from('
				contact_addresses
			')
			->get();		
		return $show_con;
		}

	function contact_insert()
		{
		$array = array(
			'contact_name' => $this->input->post('contact_name'),
			'email' => $this->input->post('email')
		);
		$this->db->set($array);
		$this->db->insert('contact_addresses');
		$this->load->dbutil();
		$this->dbutil->optimize_table('contact_addresses');
		}

	function contact_update()
		{
		$array = array(
			'id' => $this->input->post('id'),
			'contact_name' => $this->input->post('contact_name'),
			'email' => $this->input->post('email')
		);
		$this->db->set($array);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('contact_addresses');
		$this->load->dbutil();
		$this->dbutil->optimize_table('contact_addresses');
		}

	function contact_delete()
		{
		$this->db->delete('contact_addresses', array('id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('blog_categories');
		}

	function edit_contact()
		{
		$edit_contact = $this->db->get_where('contact_addresses', array('id' => $this->uri->segment(3)));
		return $edit_contact;
		}

	function get_langs()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}
	}
?>