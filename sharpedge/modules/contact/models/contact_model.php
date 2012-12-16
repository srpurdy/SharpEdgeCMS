<?php

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

#Check if the email exists before sending it to some other email
function get_address($email)
{
	$this->db->where('email', $email);
	$the_email = $this->db->get('contact_addresses');
	return $the_email;
}
}
?>