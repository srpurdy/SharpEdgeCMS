<?php
###################################################################
##
##	Contact Module
##	Version: 1.00
##
##	Last Edit:
##  Feb 25 2015
##
##	Description:
##	Contact Form Frontend System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Contact_model extends CI_Model 
	{
    function Contact_model()
		{     
		parent::__construct();
		}

	function get_fields()
		{
		$this->db->order_by('sort_id', 'asc');
		$this->db->where('lang', $this->config->item('language_abbr'));
		$fields = $this->db->get('contact_fields');
		return $fields;
		}

	function get_addresses()
		{
		$addresses = $this->db->get('contact_addresses');
		return $addresses;
		}

	function get_address($email)
		{
		$this->db->where('email', $email);
		$the_email = $this->db->get('contact_addresses');
		return $the_email;
		}
	}
?>