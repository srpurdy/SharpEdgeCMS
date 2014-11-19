<?php
###################################################################
##
##  News Slider Widget
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
class News_Photo_Widget extends widget
	{
	function run_widget()
		{
		$this->load->config('blog_config');
		$data['news_images'] = $this->frontend_model->get_news_images_slideshow();
		$template_path = $this->config->item('template_page');
		$this->render($template_path. '/widget_views/news_photo_view', $data);
		}
	}