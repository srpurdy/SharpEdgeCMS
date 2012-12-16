<?php
###################################################################
##
##  Log Admin Database Model
##	Version: 1.00
##
##	Last Edit:
##	Dec 3 2012
##
##	Description:
##	Log Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Log_admin_model extends CI_Model
	{
    function Log_admin_model()
		{
		parent::__construct();
		}
		
	function spam_log()
		{
		$spam_log = $this->db->get('spam_log');
		return $spam_log;
		}
		
	function delete_spam_log()
		{
		$this->db->truncate('spam_log');
		}
	}
?>