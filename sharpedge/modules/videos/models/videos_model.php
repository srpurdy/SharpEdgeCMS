<?php
###################################################################
##
##	Videos Database Model
##	Version: 1.00
##
##	Last Edit:
##	April 15 2014
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
class Videos_model extends CI_Model 
	{
	
    function Videos_model()
		{     
		parent::__construct();
		}

	function get_cat()
		{
		$this->db->where('video_categories.lang', $this->config->item('language_abbr'));
		$this->db->order_by('video_cat', 'asc');
		$cat = $this->db->get('video_categories');
		return $cat;
		}
		
	function get_videos_category()
		{
		$videos = $this->db
			->where('video_categories.video_url_cat', $this->uri->segment(3))
			->where('video_categories.id = video_post_categories.cat_id')
			->where('video_post_categories.video_id = videos.video_id')
			->where('videos.lang', $this->config->item('language_abbr'))
			->where('videos.active', 'Y')
			->select('
				videos.video_id,
				videos.name,
				videos.url_name,
				videos.userfile,
				videos.vid,
				videos.is_segment,
				videos.text,
				videos.lang,
				videos.active,
				videos.postedby,
				videos.play_time
			')
			->from('videos,video_categories,video_post_categories')
			->order_by('videos.name', 'asc')
			->get();
		return $videos;
		}
		
	function get_video($url)
		{
		$this->db->where('url_name', $url);
		$video = $this->db->get('videos');
		return $video;
		}
	}
?>