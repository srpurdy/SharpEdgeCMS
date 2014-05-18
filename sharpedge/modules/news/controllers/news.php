<?php
###################################################################
##
##	Blog Module
##	Version: 1.10
##
##	Last Edit:
##	May 4 2014
##
##	Description:
##	Blog / News Frontend Display.
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class News extends MY_Controller {

	function News()
		{
		parent::__construct();
		#Libarays
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('image_lib');
		$this->lang->load('recaptcha');
		$this->load->library('recaptcha');
		$this->load->library('pagination');

		#Models
		$this->load->model('frontend_model');
		$this->load->model('blog_model');
		$this->load->model('comments_model');

		#Helpers
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->helper('smiley');
		
		#Config
		$this->load->config('blog_config');
		}

	function index()
		{
		if(is_string($this->uri->segment(3)) OR $this->uri->segment(3) == '')
			{
			$config['base_url'] = site_url(). '/news/page/';
			$config['per_page'] = $this->config->item('blog_per_page');
			$config['uri_segment'] = '3';
			$config['num_links'] = '4';
			$config['cur_tag_open'] = '<a class="disabled" href="#">';
			$config['cur_tag_close'] = '</a>';
			$data['blog'] = $this->blog_model->get_blogposts($config['per_page'],$this->uri->segment(3));
			$bid = 0;
			
			if($data['blog']->result())
				{
				foreach($data['blog']->result() as $nw)
					{
					//We got a result
					$blog_id[$bid] = $nw->blog_id;
					$bid++;
					}
				}
			else
				{
				$blog_id[$bid] = '0';
				}
			$news_tags = $this->blog_model->get_news_tags($blog_id);
			if($news_tags)
				{
				for($tid = 0; $tid <= count($news_tags) -1; $tid++)
					{
					$data['tags'][$tid] = $news_tags[$tid];
					}
				}
			else
				{
				$tid = 0;
				$data['tags'][$tid] = '';
				}
					
			$data['count_posts'] = $this->blog_model->count_results();
			$config['total_rows'] =   count($data['count_posts']->result());
			$this->pagination->initialize($config);
			$data['heading'] = $this->lang->line('label_news');
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['page'] = $data['template_path'] . '/news/show_blog';
			$this->load->vars($data);
			$this->load->view($this->_container_ctrl);
			}
		else
			{
			show_404('page');
			}
		}

	function page()
		{
		if(is_string($this->uri->segment(3)))
			{
			$config['base_url'] = site_url(). '/news/page/';
			$config['per_page'] = $this->config->item('blog_per_page');
			$config['uri_segment'] = '3';
			$config['num_links'] = '4';
			$config['cur_tag_open'] = '<a class="disabled" href="#">';
			$config['cur_tag_close'] = '</a>';
			$data['blog'] = $this->blog_model->get_blogposts($config['per_page'],$this->uri->segment(3));
			$bid = 0;
			
			if($data['blog']->result())
				{
				foreach($data['blog']->result() as $nw)
					{
					//We got a result
					$blog_id[$bid] = $nw->blog_id;
					$bid++;
					}
				}
			else
				{
				$blog_id[$bid] = '0';
				}
			$news_tags = $this->blog_model->get_news_tags($blog_id);
			if($news_tags)
				{
				for($tid = 0; $tid <= count($news_tags) -1; $tid++)
					{
					$data['tags'][$tid] = $news_tags[$tid];
					}
				}
			else
				{
				$tid = 0;
				$data['tags'][$tid] = '';
				}
			$data['count_posts'] = $this->blog_model->count_results();
			$config['total_rows'] =   count($data['count_posts']->result());
			$this->pagination->initialize($config);
			$data['heading'] = $this->lang->line('label_news');
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['page'] = $data['template_path'] . '/news/show_blog';
			$this->load->vars($data);
			$this->load->view($this->_container_ctrl);
			}
		else
			{
			show_404('page');
			}
		}

	function comments()
		{
		$this->form_validation->set_message('required', 'The Field %s is Required');
		$this->form_validation->set_rules('postedby', 'postedby', 'xss_clean|required');
		$this->form_validation->set_rules('message', 'message', 'xss_clean|required');
		if($this->config->item('image_security') == true)
			{
			$this->form_validation->set_rules('recaptcha_response_field', 'recaptcha_response_field', 'xss_clean|required|callback_check_captcha');
			}
		$this->form_validation->set_error_delimiters('<h5>', '</h5>');
		
		if($this->form_validation->run($this) == FALSE)
			{
			$data['query'] = $this->comments_model->get_blog_comments();
			$data['blog_post'] = $this->blog_model->blog_single_post();
			$data['heading'] = $this->blog_model->blog_heading();
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['page'] = $data['template_path'] . '/news/blog_comments';
			$this->load->vars($data);
			$this->load->view($this->_container_ctrl, array('recaptcha'=>$this->recaptcha->get_html()));
			}
		else
			{
			if($this->input->post('parent_id') > '0')
				{
				// Send Emails
				$get_users = $this->blog_model->get_email_users($this->input->post('parent_id'));
				$get_users_topic = $this->blog_model->get_email_users_topic($this->input->post('parent_id'));
				$this->load->library('email');
				$config['protocol'] = 'mail';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';

				$this->email->initialize($config);
				foreach($get_users->result() as $gu)
					{
					$this->email->from('shaun@thesimpit.com', 'TheSimPit');
					$this->email->to($gu->email);

					$this->email->subject('Reply to your comment at TheSimPit');
					$this->email->message('You have a reply to your comment on TheSimPit.<br /><br /> You can view the message at:'. site_url(). '/news/comments/'.$this->uri->segment(3));

					$this->email->send();
					}
				foreach($get_users_topic->result() as $gut)
					{
					$this->email->from('shaun@thesimpit.com', 'TheSimPit');
					$this->email->to($gut->email);

					$this->email->subject('Reply to your comment at TheSimPit');
					$this->email->message('You have a reply to your comment on TheSimPit.<br /><br /> You can view the message at:'. site_url(). '/news/comments/'.$this->uri->segment(3));

					$this->email->send();
					}
				}
			$this->comments_model->comment_insert();
			redirect('./news/comments/' . $this->uri->segment(3));
			}
		}
	
	function ajax_gallery()
		{
		$gallery_name = $this->blog_model->gallery_name();
		foreach($gallery_name->result() as $gn)
			{
			$data['heading'] = $gn->name;
			}
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$data['template_path'] = $this->config->item('template_mobile_page');
			}
		else
			{
			$data['template_path'] = $this->config->item('template_page');
			}
		$data['post_gallery'] = $this->blog_model->get_post_gallery();
		$this->load->view($data['template_path'] . '/news/post_gallery', $data);
		}

	function check_captcha($val)
		{
		if ($this->recaptcha->check_answer($this->input->ip_address(),$this->input->post('recaptcha_challenge_field'),$val))
			{
			return TRUE;
			}
		else
			{
			$this->form_validation->set_message('check_captcha',$this->lang->line('recaptcha_incorrect_response'));
			return FALSE;
			}
		}

	function blog_post()
		{
		$data['query'] = $this->blog_model->blog_single_post();
		$data['heading'] = $this->blog_model->blog_heading();
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$data['template_path'] = $this->config->item('template_mobile_page');
			}
		else
			{
			$data['template_path'] = $this->config->item('template_page');
			}
		$data['page'] = $data['template_path'] . '/news/blog_post';
		$this->load->vars($data);
		$this->load->view($this->_container_ctrl);
		}
		
	function tag()
		{
		if(is_string($this->uri->segment(3)))
			{
			if(!is_numeric($this->uri->segment(3)))
				{
				$data['heading'] = $this->uri->segment(3);
				$data['tagged_posts'] = $this->blog_model->get_posts_by_tag($this->uri->segment(3));
				if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
					{
					$data['template_path'] = $this->config->item('template_mobile_page');
					}
				else
					{
					$data['template_path'] = $this->config->item('template_page');
					}
				$data['page'] = $data['template_path'] . '/news/tag_list';
				$this->load->vars($data);
				$this->load->view($this->_container_ctrl);
				}
			else
				{
				show_404('page');
				}
			}
		else
			{
			show_404('page');
			}
		}
}