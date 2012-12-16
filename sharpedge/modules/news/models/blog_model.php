<?php
###################################################################
##
##	Blog Database Model
##	Version: 1.04
##
##	Last Edit:
##	Sept 7 2012
##
##	Description:
##	Blog Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Blog_model extends CI_Model 
	{
	
    function Blog_model()
		{
		parent::__construct();
		}
	
	function count_results()
		{
		$count_p = $this->db
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('
				blog.blog_id,
			')
			->from('
				blog
			')
			->get();
		return $count_p;
		}

	function count_results_home()
		{
		$count_p = $this->db
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('
				blog.blog_id,
			')
			->from('
				blog
			')
			->get();
		return $count_p;
		}

	//Frontend Function
	function get_blogposts($num, $offset)
		{	
		$get_posts = $this->db		
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('
			blog.blog_id,
			blog.name,
			blog.url_name,
			blog.text,
			blog.active,
			blog.postedby,
			blog.date,
			blog.lang,
			blog.tags,
			(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
			')
			->from('
				blog
			')
			->limit($num, $offset)
			->order_by('blog.date', 'desc')
			->get();
		return $get_posts;
		}
		
	function get_news_tags($blog_id)
		{
		$news_tags = $this->db
			->where_in('post_categories.post_id', $blog_id)
			->where('post_categories.cat_id = blog_categories.id')
			->select('
				post_categories.post_id,
				post_categories.cat_id,
				blog_categories.blog_cat,
				blog_categories.blog_url_cat
			')
			->from('post_categories,blog_categories')
			->get();
		return $news_tags->result_array();
		}
		
	function get_posts_by_tag($cat)
		{	
		$get_posts = $this->db		
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->where('blog_categories.blog_url_cat', $this->uri->segment(3))
			->where('blog_categories.id = post_categories.cat_id')
			->where('post_categories.post_id = blog.blog_id')
			->select('
			blog.blog_id,
			blog.name,
			blog.url_name,
			blog.text,
			blog.active,
			blog.postedby,
			blog.date,
			blog.lang,
			blog.tags,
			(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
			')
			->from('blog, blog_categories, post_categories')
			->order_by('blog.date', 'desc')
			->get();
		return $get_posts;
		}

	function get_blogposts_home($num, $offset)
		{	
		$get_posts = $this->db
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('*')
			->from('
				blog
			')
			->limit($num, $offset)
			->order_by('blog.date', 'desc')
			->get();
		return $get_posts;
		}


	function blog_single_post()
		{
		$single_post = $this->db
			->select('*')
			->where('blog.url_name', $this->uri->segment(3))
			->where('lang', $this->config->item('language_abbr'))
			->get('blog'); 
		return $single_post;
		}
		
	function get_post_gallery()
		{
		$post_gallery = $this->db
			->where('cat_id', $this->uri->segment(3))
			->select('
				userfile,
				desc_one,
				desc_two,
				sort_id,
				photo_id
			')
			->from('gallery_photos')
			->get();
		return $post_gallery;
		}
	
	function gallery_name()
		{
		$gallery_name = $this->db
			->where('id', $this->uri->segment(3))
			->select('name')
			->from('gallery_categories')
			->get();
		return $gallery_name;
		}

	function check_blog_record()
		{
		$this->db->where('blog_id', $this->uri->segment(3));
		$check_record = $this->db->get('blog');
		return $check_record;
		}

	function blog_heading()
		{
		$get_heading = $this->db->select('name')->where('url_name', $this->uri->segment(3))->where('lang', $this->config->item('language_abbr'))->get('blog');
		if($get_heading->result())
			{
			$set_heading = $get_heading->row();
			$page_heading = $set_heading->name;
			}
		else
			{
			$page_heading = '';
			show_404('page');
			}
		return $page_heading;
		}
	}
?>