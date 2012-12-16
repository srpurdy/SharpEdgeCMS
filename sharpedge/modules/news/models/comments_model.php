<?php

class comments_model extends CI_Model
	{

    function __construct()
		{
		parent::__construct();
		}

	function get_blog_comments()
		{
		$blog_com = $this->db
			->where('blog.url_name', $this->uri->segment(3))
			->where('blog.blog_id = blog_comments.blog_id')
			->where('blog_comments.user_id = profile_fields.user_id')
			->where('profile_fields.user_id = users.id')
			->where('blog.lang', $this->config->item('language_abbr'))
			->where('blog_comments.active', 'Y')
			->select('
				blog.blog_id,
				blog.url_name,
				blog_comments.comment_id,
				blog_comments.message,
				blog_comments.postedby,
				blog_comments.active,
				blog_comments.datetime,
				profile_fields.display_name,
				profile_fields.nickname,
				profile_fields.avatar,
				profile_fields.website,
				profile_fields.signature,
				profile_fields.location,
				profile_fields.intrests,
				profile_fields.occupation,
				profile_fields.total_posts,
				users.first_name,
				users.last_name
			')
			->from('
				blog,
				profile_fields,
				users
			')
			->order_by('blog_comments.datetime', 'desc')
			->join('blog_comments', 'blog_comments.blog_id = blog.blog_id')
			->get();
		return $blog_com;
		}

	function count_comments()
		{
		$count_c = $this->db
			->where('blog.blog_id = blog_comments.blog_id')
			->where('blog.active', 'Y')
			->where('blog_comments.active', 'Y')
			->select('
				blog.blog_id,
				blog.active,
				blog_comments.blog_id,
				blog_comments.active
			')
			->from('
				blog_comments
			')
			->join('blog', 'blog.blog_id = blog_comments.blog_id')
			->get();
		return $count_c;
		}

	function count_comments_home()
		{
		$count_c = $this->db
			->where('blog.blog_id = blog_comments.blog_id')
			->where('blog.active', 'Y')
			->where('blog_comments.active', 'Y')
			->select('
				blog.blog_id,
				blog.active,
				blog_comments.blog_id,
				blog_comments.active
			')
			->from('
				blog_comments
			')
			->join('blog', 'blog.blog_id = blog_comments.blog_id')
			->get();
		return $count_c;
		}

	function comment_insert()
		{
		$array = array(
			'blog_id' => $this->input->post('blog_id'),
			'user_id' => $this->session->userdata('user_id'),
			'datetime' => $this->input->post('datetime'),
			'postedby' => $this->input->post('postedby'),
			'message' => $this->input->post('message'),
			'active' => $this->input->post('active')
		 );
		$this->db->set($array);
		$this->db->insert('blog_comments');
		$this->load->dbutil();
		$this->dbutil->optimize_table('blog_comments');
		
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->select('total_posts');
		$get_posts = $this->db->get('profile_fields');
		
		foreach($get_posts->result() as $gp)
			{
			$total_posts = $gp->total_posts;
			}
		
		$array_post_count = array(
			'total_posts' => $total_posts +1
		);
		$this->db->set($array_post_count);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('profile_fields');
		$this->load->dbutil();
		$this->dbutil->optimize_table('profile_fields');
		}
	}
?>