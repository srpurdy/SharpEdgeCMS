<?php
###################################################################
##
##	Gallery Model
##	Version: 1.02
##
##	Last Edit:
##	Jan 29 2014
##
##	Description:
##	Gallery Database Calls
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Gallery_model extends CI_Model 
	{
	
    function Gallery_model()
		{     
		parent::__construct();
		}

	function get_cat()
		{
		$cat = $this->db
			->select('
				id,
				name,
				url_name,
				(select gallery_photos.userfile from gallery_photos where gallery_photos.cat_id = gallery_categories.id ORDER BY gallery_photos.photo_id desc LIMIT 1) as recent_image,
			')
			->from('gallery_categories')
//			->order_by('sort_id', 'asc')
			->order_by('name', 'asc')
			->get();
		return $cat;
		}
		
	function get_gallery($uri)
		{
		$gallery = $this->db
			->where('gallery_categories.url_name', $uri)
			->where('gallery_categories.id = gallery_photos.cat_id')
			->select('
				gallery_photos.photo_id,
				gallery_photos.cat_id,
				gallery_photos.userfile,
				gallery_photos.desc_one,
				gallery_photos.desc_two,
				gallery_photos.sort_id
			')
			->from('gallery_photos,gallery_categories')
			->order_by('gallery_photos.sort_id', 'asc')
			->get();
		return $gallery;
		}
		
	function get_heading($uri)
		{
		$heading = $this->db
			->where('url_name', $uri)
			->select('name')
			->from('gallery_categories')
			->get();
		return $heading;
		}
	}
?>