<?php

class Log_model extends CI_Model 
	{
	
	function Log_model()
		{     
		parent::__construct();
		}

	function log_spam($email,$ip)
		{
		$array = array(
			'email' => $email,
			'ip_address' => $ip
		);
		$this->db->set($array);
		$this->db->insert('spam_log');
		}
	}