<?php
###################################################################
##
##  AddThis Widget
##	Version: 1.01
##
##	Last Edit:
##	Oct 28 2014
##
##	Description:
##  
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Addthis_Widget extends widget
	{
	function run_widget()
		{
		$template_path = $this->config->item('template_page');
		$this->render($template_path . '/widget_views/addthis_widget');
		}
	}