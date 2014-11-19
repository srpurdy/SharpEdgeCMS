<?php
###################################################################
##
##  News Landing Widget With Images
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
class News_Photo_Landing_Widget extends widget
	{
	function run_widget()
		{
		$this->load->config('blog_config');
		if($this->config->item('short_url') == 1)
			{
			if($this->router->fetch_class() == 'main')
				{
				$uri = $this->config->item('homepage_string');
				}
			$uri = $this->uri->segment(1);
			}
		else
			{
			if($this->router->fetch_class() == 'main')
				{
				$uri = $this->config->item('homepage_string');
				}
			$uri = $this->uri->segment(3);
			}
		$data['news_images'] = $this->frontend_model->get_news_images_slideshow_landing($uri);
		$template_path = $this->config->item('template_page');
		$this->render($template_path . '/widget_views/news_photo_landing_view', $data);
		}
	}