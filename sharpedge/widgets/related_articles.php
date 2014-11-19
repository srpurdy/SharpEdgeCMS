<?php
###################################################################
##
##  Related News Widget
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
class Related_Articles extends widget
	{
	function run_widget()
		{
		$data['related'] = $this->frontend_model->related_news($this->uri->segment(3));
		$template_path = $this->config->item('template_page');
		$this->render($template_path. '/widget_views/related_articles', $data);
		}       
	}