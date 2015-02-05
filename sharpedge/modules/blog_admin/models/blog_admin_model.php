<?php
###################################################################
##
##	Blog Admin Database Model
##	Version: 1.16
##
##	Last Edit:
##	Jan 20 2015
##
##	Description:
##	Gallery Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Blog_admin_model extends CI_Model 
	{
	
	function Blog_admin_model()
		{
		parent::__construct();
		}

	//Admin Function
	function get_tags()
		{
		$this->db->order_by('blog_cat', 'ASC');
		$tags = $this->db->get('blog_categories');
		return $tags;
		}

	function show_blog($limit,$offset)
		{
		$show_blog = $this->db		
			->select('
				blog.blog_id,
				blog.name,
				blog.views,
				blog.active,
				blog.postedby,
				blog.date,
				blog.lang,
				(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
			')
			->from('
				blog
			')
			->order_by('date', 'desc')
			->limit($limit,$offset)
			->get();
		return $show_blog;
		}
		
	function count_posts()
		{
		$count_posts = $this->db		
			->select('
				blog.blog_id
			')
			->from('
				blog
			')
			->get();
		return $count_posts;
		}

	function blog_insert($userfile)
		{
		$array = array(
			'date' => $this->input->post('date'),
			'gallery_display' => $this->input->post('gallery_display'),
			'gallery_id' => $this->input->post('gallery_id'),
			'postedby' => $this->input->post('postedby'),
			'name' => $this->input->post('name'),
			'url_name' => url_title($this->input->post('name')),
			'text' => $this->input->post('text'),
			'active' => $this->input->post('active'),
			'lang' => $this->input->post('lang'),
			'userfile' => $userfile
			);
		$this->db->set($array);
		$this->db->insert('blog');
		$this->load->dbutil();
		$this->dbutil->optimize_table('blog');
		}

	function blog_update()
		{
		$array = array(
			'blog_id' => $this->input->post('blog_id'),
			'gallery_display' => $this->input->post('gallery_display'),
			'gallery_id' => $this->input->post('gallery_id'),
			'date' => $this->input->post('date'),
			'postedby' => $this->input->post('postedby'),
			'name' => $this->input->post('name'),
			'url_name' => url_title($this->input->post('name')),
			'text' => $this->input->post('text'),
			'active' => $this->input->post('active'),
			'lang' => $this->input->post('lang'),
			'userfile' => $this->input->post('userfile')
		);
		$this->db->set($array);
		$this->db->where('blog_id', $this->input->post('blog_id'));
		$this->db->update('blog');
		$this->load->dbutil();
		$this->dbutil->optimize_table('blog');
		}
		
	function blog_update_with_image($userfile2)
		{
		$array = array(
			'blog_id' => $this->input->post('blog_id'),
			'gallery_display' => $this->input->post('gallery_display'),
			'gallery_id' => $this->input->post('gallery_id'),
			'date' => $this->input->post('date'),
			'postedby' => $this->input->post('postedby'),
			'name' => $this->input->post('name'),
			'url_name' => url_title($this->input->post('name')),
			'text' => $this->input->post('text'),
			'active' => $this->input->post('active'),
			'lang' => $this->input->post('lang'),
			'userfile' => $userfile2
		);
		$this->db->set($array);
		$this->db->where('blog_id', $this->input->post('blog_id'));
		$this->db->update('blog');
		$this->load->dbutil();
		$this->dbutil->optimize_table('blog');
		}

	function blog_delete()
		{
		$this->db->delete('blog', array('blog_id' => $this->uri->segment(3)));
		$this->db->delete('blog_comments', array('blog_id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('blog');
		}
		
	function reset_views($post_id)
		{
		$this->db->where('blog_id', $post_id);
		$views = $this->db->get('blog');
		foreach($views->result() as $v)
			{
			$blog_id = $v->blog_id;
			}
		$reset = array(
			'blog_id' => $blog_id,
			'views' => '0'
		);
		$this->db->set($reset);
		$this->db->where('blog_id', $blog_id);
		$this->db->update('blog');
		$this->load->dbutil();
		$this->dbutil->optimize_table('blog');
		}

	function show_comments($post)
		{
		$this->db->where('blog_id', $post);
		$this->db->order_by('datetime', 'desc');
		$comments = $this->db->get('blog_comments');
		return $comments;
		}

	function edit_comment()
		{
		$edit_comment = $this->db->get_where('blog_comments', array('comment_id' => $this->uri->segment(3)));
		return $edit_comment;
		}

	function comment_update()
		{
		$array = array(
			'comment_id' => $this->uri->segment(3),
			'blog_id' => $this->input->post('blog_id'),
			'active' => $this->input->post('active'),
			'message' => $this->input->post('message'),
			'postedby' => $this->input->post('postedby'),
			'datetime' => $this->input->post('datetime')
		);
		$this->db->set($array);
		$this->db->where('comment_id', $this->uri->segment(3));
		$this->db->update('blog_comments');
		$this->load->dbutil();
		$this->dbutil->optimize_table('blog_comments');
		}

	function comment_delete()
		{
		$this->db->delete('blog_comments', array('comment_id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('blog_comments');
		}

	function edit_blog()
		{
		$edit_blog = $this->db->get_where('blog', array('blog_id' => $this->uri->segment(3)));
		return $edit_blog;
		}

	//Categories
	function show_categories()
		{
		$show_cat = $this->db
			->select('*')
			->from('
				blog_categories
			')
			->get();		
		return $show_cat;
		}

	function cat_insert()
		{
		$array = array(
		'blog_cat' => $this->input->post('blog_cat'),
		'blog_url_cat' => url_title($this->input->post('blog_cat')),
		'lang' => $this->input->post('lang')
		);
		$this->db->set($array);
		$this->db->insert('blog_categories');
		$this->load->dbutil();
		$this->dbutil->optimize_table('blog_categories');
		}

	function cat_update()
		{
		$array = array(
		'id' => $this->input->post('id'),
		'blog_cat' => $this->input->post('blog_cat'),
		'blog_url_cat' => url_title($this->input->post('blog_cat')),
		'lang' => $this->input->post('lang')
		);
		$this->db->set($array);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('blog_categories');
		$this->load->dbutil();
		$this->dbutil->optimize_table('blog_categories');
		}

	function cat_delete()
		{
		$this->db->delete('blog_categories', array('id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('blog_categories');
		}

	function edit_cat()
		{
		$edit_blog = $this->db->get_where('blog_categories', array('id' => $this->uri->segment(3)));
		return $edit_blog;
		}

	function get_langs()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}

	function import_category($category, $post_id)
		{
		#lets insert the category if no record is found.
		$blog_cat = array(
			'cat_id' => $category,
			'post_id' => $post_id
		);
		$this->db->set($blog_cat);
		$this->db->insert('post_categories');
		}

	function get_post_categories($uri)
		{
		$get_cats = $this->db->get_where('post_categories', array('post_id' => $this->uri->segment(3)));
		return $get_cats;
		}

	function get_user_name($user_id)
		{
		$get_un = $this->db->get_where('users', array('id' => $user_id));
		return $get_un;
		}
		
	function get_galleries()
		{
		$galleries = $this->db
			->select('
				id,
				name
			')
			->from('gallery_categories')
			->order_by('name', 'asc')
			->get();
		return $galleries;
		}
	}
?>