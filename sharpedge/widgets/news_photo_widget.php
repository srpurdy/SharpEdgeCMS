<?php

class News_Photo_Widget extends widget
{
	function run_widget()
		{
		$this->load->config('blog_config');
		$data['news_images'] = $this->frontend_model->get_news_images_slideshow();
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$template_path = $this->config->item('template_mobile_page');
			}
		else
			{
			$template_path = $this->config->item('template_page');
			}
		$this->render($template_path. '/widget_views/news_photo_view', $data);
		}
}