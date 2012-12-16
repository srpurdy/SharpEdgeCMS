<?php
###################################################################
##
##	Blog Feed Database Model
##	Version: 1.01
##
##	Last Edit:
##	Sept 7 2012
##
##	Description:
##	Blog Feed Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Blog_feed_model extends CI_Model 
{
    function Blog_feed_model()
		{
		parent::__construct();
		}

	function get_blogposts($num, $offset)
		{	
		$get_posts = $this->db		
			->where('blog.active', 'Y')
			->select('*')
			->from('
				blog
			')
			->limit($num, $offset)
			->order_by('blog.date', 'desc')
			->get();
		return $get_posts;
		}
	}
?>