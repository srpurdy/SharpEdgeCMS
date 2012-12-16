<?php
###################################################################
##
##	Gallery Admin Module
##	Version: 1.16
##
##	Last Edit:
##	Nov 26 2012
##
##	Description:
##	Gallery Admin System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	Updated to use image_moo instead image_lib
##
##################################################################
class Gallery_admin extends ADMIN_Controller
	{
    function Gallery_admin()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('date');
		$this->load->helper('file');
		$this->load->helper('directory');
		
		#Libaraies
		$this->load->library('ftp');
		$this->load->library('image_lib'); 
		$this->load->library('image_moo');
		
		#Models
		$this->load->model('gallery_model');
		
		#Configs
		$this->load->config('gallery_config');
	
		#Load Module User Protection
		$check_perm = $this->backend_model->protect_module();
		$this->data['module_read'] = 'N';
		$this->data['module_write'] = 'N';
		$this->data['module_delete'] = 'N';
		$check_perm = $this->backend_model->get_module_permissions();
		if($check_perm->result())
			{
			foreach($check_perm->result() as $pm)
				{
				$this->data['module_read'] = $pm->read;
				$this->data['module_write'] = $pm->write;
				$this->data['module_delete'] = $pm->delete;
				}
			}
		else
			{
			$this->data['module_read'] = 'N';
			$this->data['module_write'] = 'N';
			$this->data['module_delete'] = 'N';
			}
		}
	
    function index()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['heading'] = 'Manage Gallery';
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['query'] = $this->gallery_model->get_categories();
			$data['langs'] = $this->gallery_model->get_langs();
			$data['page'] = $data['template_path'] . '/gallery_admin/gallery_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}

    function editgallery()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Edit Category';
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['query'] = $this->gallery_model->edit_category();
				$data['page'] = $data['template_path'] . '/gallery_admin/editgallery';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				//Get Old Category Name
				$old_cat = $this->gallery_model->old_category_name($this->input->post('id'));
				
				foreach($old_cat->result() as $oc)
					{
					rename("assets/gallery/photos/".url_title($oc->name),"assets/gallery/photos/".url_title($this->input->post('name')));
					}
				
				$this->gallery_model->update_gallery();
				$this->load->dbutil();
				$this->dbutil->optimize_table('gallery_categories');
				
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('gallery_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function addgallery()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				if(isset($_POST['name']))
					{
					redirect('gallery_admin/#tabs-2');
					}
				else
					{
					$data['heading'] = 'Add Category';
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['page'] = 'addgallery';
					$this->load->view($data['template_path'] . '/gallery_admin/addgallery', $data);
					}
				}
			else
				{
				$this->gallery_model->insert_gallery();
				$this->load->dbutil();
				$this->dbutil->optimize_table('gallery_categories');
				
				#Create Gallery Folders
				@mkdir($_SERVER['DOCUMENT_ROOT']. '/assets/gallery/photos/' . url_title($this->input->post('name')));
				@mkdir($_SERVER['DOCUMENT_ROOT']. '/assets/gallery/photos/' . url_title($this->input->post('name')) . '/normal');
				@mkdir($_SERVER['DOCUMENT_ROOT']. '/assets/gallery/photos/' . url_title($this->input->post('name')) . '/thumbs');
				
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('gallery_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function deletegallery()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->gallery_model->gallery_delete();
			$msg = $this->lang->line('delete');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('gallery_admin');
			}
		else
			{
			echo "access denied";
			}
		}

	function image()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['heading'] = "Manage Images";
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['images'] = $this->gallery_model->get_images();
			$data['page'] = $data['template_path'] . '/gallery_admin/image_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function update_thumbnails_display()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['heading'] = "Update Thumbnails";
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['images'] = $this->gallery_model->get_images();
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->view($data['template_path'] . '/gallery_admin/update_thumbnails', $data);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function update_thumbnails()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$query = $this->gallery_model->get_categories();
			foreach($query->result() as $q)
				{
				$this->db->where('cat_id', $q->id);
				$images = $this->db->get('gallery_photos');
				foreach($images->result() as $i)
					{
					$userfile = 'assets/gallery/photos/'.$i->userfile;
					$userfile_normal = 'assets/gallery/photos/'.url_title($q->name).'/normal/'.$i->userfile;
					$userfile_thumb = 'assets/gallery/photos/'.url_title($q->name).'/thumbs/'.$i->userfile;
					
					//Create Thumbnail
					$this->image_moo
						->load($userfile_normal)
						->set_jpeg_quality($this->config->item('thumbnail_quality'))
						->resize_crop($this->config->item('thumbnail_maxwidth'),$this->config->item('thumbnail_maxheight'))
						->save($userfile_thumb, TRUE);
						
					//Create Normal Size
					$this->image_moo
						->load($userfile)
						->set_jpeg_quality($this->config->item('normal_quality'))
						->resize($this->config->item('normal_maxwidth'),$this->config->item('normal_maxheight'))
						->save($userfile_normal, TRUE);
					}
				}
			$msg = $this->lang->line('updated');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('gallery_admin');
			}
		else
			{
			echo "access denied";
			}
		}
	
	function editimage()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('desc_one', 'desc_one', 'xss_clean');
			$this->form_validation->set_rules('desc_two', 'desc_two', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Edit Image';
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['edit_image'] = $this->gallery_model->edit_image();
				$data['vcate'] = $this->db->get('gallery_categories');
				$data['page'] = $data['template_path'] . '/gallery_admin/editimage';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->gallery_model->update_image();
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('/gallery_admin/image/'. $this->uri->segment(3));
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function addimage()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('userfile', 'userfile', 'xss_clean');
			$this->form_validation->set_rules('desc_one', 'desc_one', 'xss_clean');
			$this->form_validation->set_rules('desc_two', 'desc_two', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				if(isset($_POST['desc_one']))
					{
					redirect('gallery_admin/#tabs-3');
					}
				else
					{
					$data['error'] = '';
					$data['heading'] = 'Add Image';
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['page'] = 'addimage';
					$data['vcate'] = $this->db->get('gallery_categories');
					$this->load->view($data['template_path'] . '/gallery_admin/addimage', $data);
					}
				}
			else
				{
				#Upload file
				$config['upload_path'] = './assets/gallery/photos/';
				$config['allowed_types'] = 'png|jpg|gif';
				$config['max_size']	= '20000';
				$config['max_width']  = '5000';
				$config['max_height']  = '5000';
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload())
					{
					$error = array('error' => $this->upload->display_errors());
					$data['heading'] = 'Add Image';
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['page'] = $data['template_path'] . '/gallery_admin/addimage';
					$data['vcate'] = $this->db->get('gallery_categories');
					$this->load->vars($data);    
					$this->load->view($this->_container, $error);
					}
				else
					{
					$cat_name = $this->gallery_model->get_cat_name($this->input->post('cat_id'));
					
				foreach($cat_name as $cn)
					{
					$get_cat_name = $cn->name;
					}
					
					$data = array('upload_data' => $this->upload->data());
					$updatea = $this->upload->data();
					
					$thumb_path = 'assets/gallery/photos/'.url_title($get_cat_name).'/thumbs/' . $data['upload_data']['file_name'];
					$normal_path = 'assets/gallery/photos/'.url_title($get_cat_name).'/normal/' . $data['upload_data']['file_name'];
					
					//Create Thumbnail
					$this->image_moo
						->load($updatea['full_path'])
						->set_jpeg_quality($this->config->item('thumbnail_quality'))
						->resize_crop($this->config->item('thumbnail_maxwidth'),$this->config->item('thumbnail_maxheight'))
						->save($thumb_path, TRUE);
						
					//Create Normal Size
					$this->image_moo
						->load($updatea['full_path'])
						->set_jpeg_quality($this->config->item('normal_quality'))
						->resize($this->config->item('normal_maxwidth'),$this->config->item('normal_maxheight'))
						->save($normal_path, TRUE);
					
					#Insert file info into database
					$userfile = $data['upload_data']['file_name'];
					$this->gallery_model->insert_image($userfile);
					$msg = $this->lang->line('added');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('gallery_admin/image/' . $this->input->post('cat_id'));
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function deleteimage()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			#Get the photo name
			$photo_name = $this->gallery_model->get_photo_name($this->uri->segment(4));
			foreach($photo_name->result() as $pn)
				{
				#Get the Category Name
				$cat_name = $this->gallery_model->get_cat_name($pn->cat_id);
				
				foreach($cat_name as $ca)
					{
					$get_cat_name = $ca->name;
					}
					
				#Delete the file on the server.
				@unlink('assets/gallery/photos/' . url_title($get_cat_name) . '/normal/'. $pn->userfile);
				@unlink('assets/gallery/photos/' . url_title($get_cat_name) . '/thumbs/'. $pn->userfile);
				}
				
			#Delete DB Entry.
			$this->db->delete('gallery_photos', array('photo_id' => $this->uri->segment(4)));
				
			#Now lets redirect
			redirect('gallery_admin/image/' . $this->uri->segment(3));
			}
		else
			{
			echo "access denied";
			}
		}
	
	function import_zip()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('userfile', 'userfile', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				if(isset($_POST['cat_id']))
					{
					redirect('gallery_admin/#tabs-4');
					}
				else
					{
					$data['error'] = '';
					$data['heading'] = 'Import Zip File';
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['page'] = 'import_zip';
					$data['vcate'] = $this->db->get('gallery_categories');
					$this->load->view($data['template_path'] . '/gallery_admin/import_zip', $data);
					}
				}
			else
				{
				#Upload file
				$config['upload_path'] = './assets/gallery/photos/import_zip';
				$config['allowed_types'] = 'zip';
				$config['max_size']	= '20000';
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload())
					{
					$error = array('error' => $this->upload->display_errors());
					$data['error'] = '';
					$data['heading'] = 'Import Zip File';
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['page'] = $data['template_path'] . '/gallery_admin/import_zip';
					$data['vcate'] = $this->db->get('gallery_categories');
					$this->load->vars($data);    
					$this->load->view($this->_container, $error);
					}
				else
					{
					#Get the Category Name
					$cat_name = $this->gallery_model->get_cat_name($this->input->post('cat_id'));
					foreach($cat_name as $ca)
						{
						$get_cat_name = $ca->name;
						}
					
					#Get the uploaded zip file
					$zip = new ZipArchive;
					$zip_array = array('upload_data' => $this->upload->data());
					$zip_file = $zip_array['upload_data']['full_path'];
					
					#Make a temp folder to store source zip files
					@mkdir($_SERVER['DOCUMENT_ROOT']. '/assets/gallery/photos/import_zip/' . url_title($get_cat_name));
					
					#Open the Zip File, and extract it's contents.
					if ($zip->open($zip_file) === TRUE)
						{
						$zip->extractTo('./assets/gallery/photos/import_zip/'.url_title($get_cat_name));
						$zip->close();
						}
					else
						{
						echo "Failed to extract files from zip archive.";
						}
					
					#Get an array of extracted files from the temp import folder.
					$extracted_files = directory_map('assets/gallery/photos/import_zip/' . url_title($get_cat_name));
					
					$this->thumb_moo($extracted_files,$get_cat_name);
					$this->normal_moo($extracted_files,$get_cat_name);
					
					#loop through the results.
					foreach($extracted_files as $row => $value)
						{
						#Insert file info into database
						$userfile = $value;
						$this->gallery_model->insert_image_by_zip($userfile);
						}
						
						#Optimize the Database Table
						$this->load->dbutil();
						$this->dbutil->optimize_table('gallery_photos');
						
						#We will now do garbage collection and delete all the extra junk created during this import.
						delete_files('assets/gallery/photos/import_zip/', TRUE);
						
						#Okay everything is done lets re-direct back to the category these files were uploaded to.
						redirect('gallery_admin/image/' . $this->input->post('cat_id'));
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
		function thumb_moo($extracted_files,$get_cat_name)
			{
			#loop through the results.
				foreach($extracted_files as $row => $value)
					{
					$import_path = 'assets/gallery/photos/import_zip/' . url_title($get_cat_name).'/'.$value;
					$thumb_path = 'assets/gallery/photos/'.url_title($get_cat_name).'/thumbs/'.$value;
					$normal_path = 'assets/gallery/photos/'.url_title($get_cat_name).'/normal/'.$value;
					
					//Create Thumbnail
					$this->image_moo
						->load($import_path)
						->set_jpeg_quality($this->config->item('thumbnail_quality'))
						->resize_crop($this->config->item('thumbnail_maxwidth'),$this->config->item('thumbnail_maxheight'))
						->save($thumb_path, TRUE);
					}
			}
			
		function normal_moo($extracted_files,$get_cat_name)
			{
			#loop through the results.
				foreach($extracted_files as $row => $value)
					{
					$import_path = 'assets/gallery/photos/import_zip/' . url_title($get_cat_name).'/'.$value;
					$thumb_path = 'assets/gallery/photos/'.url_title($get_cat_name).'/thumbs/'.$value;
					$normal_path = 'assets/gallery/photos/'.url_title($get_cat_name).'/normal/'.$value;
						
					//Create Normal Size
					$this->image_moo
						->load($import_path)
						->set_jpeg_quality($this->config->item('normal_quality'))
						->resize($this->config->item('normal_maxwidth'),$this->config->item('normal_maxheight'))
						->save($normal_path, TRUE);
					}
			}
	}