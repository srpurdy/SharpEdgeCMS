<?php
###################################################################
##
##  News Widget With Images
##	Version: 1.02
##
##	Last Edit:
##	May 22 2015
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
			if($this->router->fetch_class() == 'main')
				{
				$config['base_url'] = site_url(). '/' . $this->config->item('homepage_string') . '/';
				$data['uri'] = $this->config->item('homepage_string');
				}
			else
				{
				$config['base_url'] = site_url(). '/' . $this->uri->segment(1) . '/';
				$data['uri'] = $this->uri->segment(1);
				}
				
			$config['uri_segment'] = '2';
				
			if($data['uri'] == 'News')
				{
				$data['news_widget'] = $this->frontend_model->get_blogposts($config['per_page'],$this->uri->segment($config['uri_segment']));
				$config['per_page'] = '28';
				}
			else
				{
				$data['news_widget'] = $this->frontend_model->get_blogposts_homepage($config['per_page'],$this->uri->segment($config['uri_segment']), url_title('News + Events'));
				$config['per_page'] = '4';
				}
			}
		else
			{
			if($this->router->fetch_class() == 'main')
				{
				$config['base_url'] = site_url(). '/pages/view/' . $this->config->item('homepage_string') . '/';
				$data['uri'] = $this->config->item('homepage_string');
				}
			else
				{
				$config['base_url'] = site_url(). '/pages/view/' . $this->uri->segment(3) . '/';
				$data['uri'] = $this->uri->segment(3);
				}
				
			$config['uri_segment'] = '4';
				
			if($data['uri'] == 'News')
				{
				$data['news_widget'] = $this->frontend_model->get_blogposts($config['per_page'],$this->uri->segment($config['uri_segment']));
				$config['per_page'] = '28';
				}
			else
				{
				$data['news_widget'] = $this->frontend_model->get_blogposts_homepage($config['per_page'],$this->uri->segment($config['uri_segment']), url_title('News + Events'));
				$config['per_page'] = '4';
				}
			}
			
		//Pagination Config
		$config['num_links'] = '4';
		$config['cur_tag_open'] = '<a class="disabled" href="#">';
		$config['cur_tag_close'] = '</a>';
			
		//db queries
		$data['reviews_news'] = $this->frontend_model->get_review_news();
		$data['featured_news'] = $this->frontend_model->get_featured_news();
		$count_posts = $this->frontend_model->count_results();
		$template_path = $this->config->item('template_page');	
		$config['total_rows'] =  count($count_posts->result());
		$this->pagination->initialize($config);
		
		//Lets go already!
		$this->render($template_path. '/widget_views/news_widget_photos', $data);
	   }
	}