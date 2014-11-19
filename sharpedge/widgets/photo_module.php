<?php
###################################################################
##
##  Slider Widget
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
class Photo_Module extends widget
	{
	function run_widget()
		{
		if($this->router->fetch_class() == 'pages')
			{
			if($this->config->item('short_url') == 1)
				{
				$data['page_info'] = $this->frontend_model->get_page_section($this->uri->segment(1));
				}
			else
				{
				$data['page_info'] = $this->frontend_model->get_page_section($this->uri->segment(3));
				}
			}
		else
			{
			if($this->router->fetch_class() == 'main')
				{
				$data['page_info'] = $this->frontend_model->get_page_section($this->config->item('homepage_string'));
				}
			else
				{
				$data['page_info'] = $this->frontend_model->get_ctrl_section($this->uri->segment(1));
				}
			}
		$template_path = $this->config->item('template_page');
		$this->render($template_path . '/widget_views/photo_module', $data);
		}
	}