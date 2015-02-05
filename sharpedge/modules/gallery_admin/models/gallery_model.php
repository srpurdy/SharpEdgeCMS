<?php
###################################################################
##
##	Gallery Admin Database Model
##	Version: 1.07
##
##	Last Edit:
##	Feb 5 2015
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
class Gallery_model extends CI_Model 
	{
	
    function Gallery_model()
		{
		parent::__construct();
		}
	
	function get_langs()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}

	function get_images()
		{
		$images = $this->db
		->where('cat_id', $this->uri->segment(3))
		->select('*')
		->from('gallery_photos')
		->get();
		return $images;
		}

	function edit_category()
		{
		$cat_edit = $this->db->get_where('gallery_categories', array('id' => $this->uri->segment(3)));
		return $cat_edit;
		}

	function gallery_delete()
		{
		$this->db->delete('gallery_categories', array('id' => $this->uri->segment(3)));
		}

	function get_categories()
		{
		$cat = $this->db->get('gallery_categories');
		return $cat;
		}

	function edit_image()
		{
		$img_edit = $this->db->get_where('gallery_photos', array('photo_id' => $this->uri->segment(4)));
		return $img_edit;
		}

	function get_cat_name($catid)
		{
		$this->db->where('id', $catid);
		$cat_name = $this->db->get('gallery_categories');
		return $cat_name->result();
		}

	function get_photo_name($id)
		{
		$this->db->where('photo_id', $id);
		$photo_name = $this->db->get('gallery_photos');
		return $photo_name;
		}

	function insert_image($file)
		{
		$array = array(
			'cat_id' => $this->input->post('cat_id'),
			'userfile' => $file,
			'desc_one' => $this->input->post('desc_one'),
			'desc_two' => $this->input->post('desc_two'),
			'sort_id' => $this->input->post('sort_id')
		);
		$this->db->set($array);
		$this->db->insert('gallery_photos');
		$this->load->dbutil();
		$this->dbutil->optimize_table('gallery_photos');
		}

	function insert_image_by_zip($file)
		{
		$array = array(
			'cat_id' => $this->input->post('cat_id'),
			'userfile' => $file,
			'desc_one' => '',
			'desc_two' => '',
			'sort_id' => '0'
		);
		$this->db->set($array);
		$this->db->insert('gallery_photos');
		}

	function update_image()
		{
		$this->db->where('photo_id', $_POST['photo_id']);
		$this->db->update('gallery_photos', $this->db->escape($_POST));
		}

	function get_recent_image($catid)
		{
		$image = $this->db
			->where('image_gallery.catid', $catid)
			->select('image_gallery.userfile')
			->from('image_gallery')
			->order_by('image_gallery.id', 'desc')
			->limit('1')
			->get();
		return $image;
		}

	function update_gallery()
		{
		$gallery_array = array(
			'id' => $this->uri->segment(3),
			'name' => $this->input->post('name'),
			'url_name' => url_title($this->input->post('name')),
			'parent_id' => $this->input->post('parent_id'),
			'sort_id' => $this->input->post('sort_id')
		);
		$this->db->set($gallery_array);
		$this->db->where('id', $this->uri->segment(3));
		$this->db->update('gallery_categories');
		}

	function insert_gallery()
		{
		$gallery_array = array(
			'name' => $this->input->post('name'),
			'url_name' => url_title($this->input->post('name')),
			'parent_id' => $this->input->post('parent_id'),
			'sort_id' => $this->input->post('sort_id')
		);
		$this->db->set($gallery_array);
		$this->db->where('id', $this->uri->segment(3));
		$this->db->insert('gallery_categories');
		//$this->db->insert('gallery_categories', $this->db->escape($_POST));
		}
		
	function old_category_name($cat_id)
		{
		$old_cat = $this->db
			->where('id', $cat_id)
			->select('*')
			->from('gallery_categories')
			->get();
		return $old_cat;
		}
	}
?>