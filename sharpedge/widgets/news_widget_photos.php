<?php

class News_Widget_Photos extends widget
	{
	function run_widget()
		{
		//Libraries
		$this->load->library('pagination');
		
		//Config
		$this->load->config('blog_config');
		
		//Check for short url
		if($this->config->item('short_url') == 1)
			{
			$config['base_url'] = site_url(). '/' . $this->uri->segment(1) . '/';
			$data['uri'] = $this->uri->segment(1);
			}
		else
			{
			$config['base_url'] = site_url(). '/pages/view/' . $this->uri->segment(3) . '/';
			$data['uri'] = $this->uri->segment(3);
			}
			
		//Per page
		if($data['uri'] == 'News')
			{
			$config['per_page'] = '28';
			}
			else
			{
			$config['per_page'] = '4';
			}
			
		//Pagination Config
		$config['num_links'] = '4';
		$config['cur_tag_open'] = '<a class="disabled" href="#">';
		$config['cur_tag_close'] = '</a>';
		
		//Check for short url
		if($this->config->item('short_url') == 1)
			{
			$config['uri_segment'] = '2';
			if($data['uri'] == 'News')
				{
				$data['news_widget'] = $this->frontend_model->get_blogposts($config['per_page'],$this->uri->segment(2));
				}
			else
				{
				$data['news_widget'] = $this->frontend_model->get_blogposts_homepage($config['per_page'],$this->uri->segment(2), url_title('News + Events'));
				}
			}
		else
			{
			$config['uri_segment'] = '4';
			if($data['uri'] == 'News')
				{
				$data['news_widget'] = $this->frontend_model->get_blogposts($config['per_page'],$this->uri->segment(4));
				}
			else
				{
				$data['news_widget'] = $this->frontend_model->get_blogposts_homepage($config['per_page'],$this->uri->segment(4), url_title('News + Events'));
				}
			}
			
		//db queries
		$data['reviews_news'] = $this->frontend_model->get_review_news();
		$data['featured_news'] = $this->frontend_model->get_featured_news();
		$count_posts = $this->frontend_model->count_results();
		
		//Check user agent for mobile support.
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$template_path = $this->config->item('template_mobile_page');
			}
		else
			{
			$template_path = $this->config->item('template_page');
			}
			
		$config['total_rows'] =  count($count_posts->result());
		$this->pagination->initialize($config);
		
		//Lets go already!
		$this->render($template_path. '/widget_views/news_widget_photos', $data);
	   }
	}