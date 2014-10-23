<?php

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
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$template_path = $this->config->item('template_mobile_page');
			}
		else
			{
			$template_path = $this->config->item('template_page');
			}
		$this->render($template_path . '/widget_views/news_photo_landing_view', $data);
		}
}