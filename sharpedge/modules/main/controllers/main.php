<?php
###################################################################
##
##	Main Module
##	Version: 1.00
##
##	Last Edit:
##	Sept 25 2012
##
##	Description:
##	Main System - Redirection Module
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Main extends MY_Controller
	{

	function Main()
		{
		parent::__construct();
		}

	function index()
		{
		$expires = 60*60*24*14;
		header("HTTP/1.0 302 Redirect");
		header("Vary: User-Agent");
		header("Cache-Control: private");
		header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
		if($this->config->item('short_url') == 1)
			{
			redirect($this->config->item('homepage_string'));
			}
		else
			{
			redirect('pages/view/'.$this->config->item('homepage_string'));
			}
		}
	}