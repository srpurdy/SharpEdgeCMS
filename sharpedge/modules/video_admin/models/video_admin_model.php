<?php
###################################################################
##
##	Video Admin Database Model
##	Version: 1.00
##
##	Last Edit:
##	April 14 2014
##
##	Description:
##	Video Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Video_admin_model extends CI_Model 
	{
	
	function Video_admin_model()
		{
		parent::__construct();
		}

	//Admin Function
	function get_tags()
		{
		$tags = $this->db->get('video_categories');
		return $tags;
		}

	function show_videos($limit,$offset)
		{
		$show_videos = $this->db		
			->select('
				videos.video_id,
				videos.name,
				videos.active,
				videos.postedby,
				videos.date,
				videos.lang
			')
			->from('
				videos
			')
			->order_by('videos.date', 'desc')
			->limit($limit,$offset)
			->get();
		return $show_videos;
		}
		
	function count_videos()
		{
		$count_videos = $this->db		
			->select('
				videos.video_id
			')
			->from('
				videos
			')
			->get();
		return $count_videos;
		}

	function video_insert($userfile)
		{
		$array = array(
			'date' => $this->input->post('date'),
			'vid' => $this->input->post('vid'),
			'postedby' => $this->input->post('postedby'),
			'name' => $this->input->post('name'),
			'url_name' => url_title($this->input->post('name')),
			'play_time' => $this->input->post('play_time'),
			'is_segment' => $this->input->post('is_segment'),
			'text' => $this->input->post('text'),
			'active' => $this->input->post('active'),
			'lang' => $this->input->post('lang'),
			'userfile' => $userfile
			);
		$this->db->set($array);
		$this->db->insert('videos');
		$this->load->dbutil();
		$this->dbutil->optimize_table('videos');
		}

	function video_update()
		{
		$array = array(
			'video_id' => $this->input->post('video_id'),
			'date' => $this->input->post('date'),
			'vid' => $this->input->post('vid'),
			'postedby' => $this->input->post('postedby'),
			'name' => $this->input->post('name'),
			'url_name' => url_title($this->input->post('name')),
			'play_time' => $this->input->post('play_time'),
			'is_segment' => $this->input->post('is_segment'),
			'text' => $this->input->post('text'),
			'active' => $this->input->post('active'),
			'lang' => $this->input->post('lang'),
			'userfile' => $this->input->post('userfile')
		);
		$this->db->set($array);
		$this->db->where('video_id', $this->input->post('video_id'));
		$this->db->update('videos');
		$this->load->dbutil();
		$this->dbutil->optimize_table('videos');
		}
		
	function video_update_with_image($userfile2)
		{
		$array = array(
			'video_id' => $this->input->post('video_id'),
			'date' => $this->input->post('date'),
			'vid' => $this->input->post('vid'),
			'postedby' => $this->input->post('postedby'),
			'name' => $this->input->post('name'),
			'url_name' => url_title($this->input->post('name')),
			'play_time' => $this->input->post('play_time'),
			'is_segment' => $this->input->post('is_segment'),
			'text' => $this->input->post('text'),
			'active' => $this->input->post('active'),
			'lang' => $this->input->post('lang'),
			'userfile' => $userfile2
		);
		$this->db->set($array);
		$this->db->where('video_id', $this->input->post('video_id'));
		$this->db->update('videos');
		$this->load->dbutil();
		$this->dbutil->optimize_table('videos');
		}

	function video_delete()
		{
		$this->db->delete('videos', array('video_id' => $this->uri->segment(3)));
		$this->db->delete('video_comments', array('video_id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('videos');
		}

	function show_comments()
		{
		$this->db->order_by('datetime', 'desc');
		$comments = $this->db->get('video_comments');
		return $comments;
		}

	function edit_comment()
		{
		$edit_comment = $this->db->get_where('video_comments', array('comment_id' => $this->uri->segment(3)));
		return $edit_comment;
		}

	function comment_update()
		{
		$array = array(
			'comment_id' => $this->uri->segment(3),
			'video_id' => $this->input->post('video_id'),
			'active' => $this->input->post('active'),
			'message' => $this->input->post('message'),
			'postedby' => $this->input->post('postedby'),
			'datetime' => $this->input->post('datetime')
		);
		$this->db->set($array);
		$this->db->where('comment_id', $this->uri->segment(3));
		$this->db->update('video_comments');
		$this->load->dbutil();
		$this->dbutil->optimize_table('video_comments');
		}

	function comment_delete()
		{
		$this->db->delete('video_comments', array('comment_id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('video_comments');
		}

	function edit_video()
		{
		$edit_video = $this->db->get_where('videos', array('video_id' => $this->uri->segment(3)));
		return $edit_video;
		}

	//Categories
	function show_categories()
		{
		$show_cat = $this->db
			->select('*')
			->from('
				video_categories
			')
			->get();		
		return $show_cat;
		}

	function cat_insert()
		{
		$array = array(
			'video_cat' => $this->input->post('video_cat'),
			'video_url_cat' => url_title($this->input->post('video_cat')),
			'lang' => $this->input->post('lang')
		);
		$this->db->set($array);
		$this->db->insert('video_categories');
		$this->load->dbutil();
		$this->dbutil->optimize_table('video_categories');
		}

	function cat_update()
		{
		$array = array(
			'id' => $this->input->post('id'),
			'video_cat' => $this->input->post('video_cat'),
			'video_url_cat' => url_title($this->input->post('video_cat')),
			'lang' => $this->input->post('lang')
		);
		$this->db->set($array);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('video_categories');
		$this->load->dbutil();
		$this->dbutil->optimize_table('video_categories');
		}

	function cat_delete()
		{
		$this->db->delete('video_categories', array('id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('video_categories');
		}

	function edit_cat()
		{
		$edit_cat = $this->db->get_where('video_categories', array('id' => $this->uri->segment(3)));
		return $edit_cat;
		}

	function get_langs()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}

	function import_category($category, $video_id)
		{
		#lets insert the category if no record is found.
		$video_cat = array(
			'cat_id' => $category,
			'video_id' => $video_id
		);
		$this->db->set($video_cat);
		$this->db->insert('video_post_categories');
		}

	function get_post_categories($uri)
		{
		$get_cats = $this->db->get_where('video_post_categories', array('video_id' => $this->uri->segment(3)));
		return $get_cats;
		}

	function get_user_name($user_id)
		{
		$get_un = $this->db->get_where('users', array('id' => $user_id));
		return $get_un;
		}
	}
?>