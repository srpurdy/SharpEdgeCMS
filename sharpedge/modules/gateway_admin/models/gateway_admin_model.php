<?php
###################################################################
##
##	Gateway Admin Database Model
##	Version: 1.00
##
##	Last Edit:
##	Sept 7 2012
##
##	Description:
##	Gateway Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Gateway_admin_model extends CI_Model 
	{
	
    function Gaetway_admin_model()
		{     
		parent::__construct();
		}
		
	function get_gateways()
		{
		$gateways = $this->db->get('gateways');
		return $gateways;
		}

	function gateway_edit()
		{
		$gateway_edit = $this->db->get_where('gateways', array('gateway_id' => $this->uri->segment(3)));
		return $gateway_edit;
		}

	function gateway_update()
		{
		$this->db->where('gateway_id', $_POST['gateway_id']);
		$this->db->update('gateways', $this->db->escape($_POST));
		}

	function gateway_insert()
		{
		$array = array(
			'name' => $this->input->post('name'),
			'module_name' => $this->input->post('module_name'),
			'active' => $this->input->post('active')
		);
		$this->db->set($array);
		$this->db->insert('gateways', $this->db->escape($_POST));
		}

	function gateway_delete()
		{
		$this->db->delete('gateways', array('gateway_id' => $this->uri->segment(3)));
		}
	}
?>