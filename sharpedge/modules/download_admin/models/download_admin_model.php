<?php
###################################################################
##
##	Download Admin Model
##	Version: 0.91
##
##	Last Edit:
##	June 29 2012
##
##	Description:
##	Download Admin Control System.
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Download_admin_model extends CI_Model 
	{
	
    function Download_admin_model()
		{     
		parent::__construct();
		}
	
	function get_downloads()
		{
		$downloads = $this->db->get('downloads');
		return $downloads;
		}

	function insert_download($userfile)
		{
		$array = array(
			'cat_id' => 0,
			'userfile' => $userfile,
			'download_name' => $this->input->post('download_name'),
			'desc' => $this->input->post('desc'),
			'isProduct' => $this->input->post('isProduct'),
			'sort_id' => url_title($this->input->post('sort_id')),
			);
		$this->db->set($array);
		$this->db->insert('downloads');
		$this->load->dbutil();
		$this->dbutil->optimize_table('downloads');
		}

	function update_download($userfile)
		{
		if($userfile == '')
			{
			$userfile = $this->input->post('current_file');
			}
		$array = array(
			'download_id' => $this->input->post('download_id'),
			'cat_id' => 0,
			'userfile' => $userfile,
			'download_name' => $this->input->post('download_name'),
			'desc' => $this->input->post('desc'),
			'isProduct' => $this->input->post('isProduct'),
			'sort_id' => url_title($this->input->post('sort_id')),
		);
		$this->db->set($array);
		$this->db->where('download_id', $this->input->post('download_id'));
		$this->db->update('downloads');
		$this->load->dbutil();
		$this->dbutil->optimize_table('downloads');
		}

	function delete_download()
		{
		$this->db->delete('downloads', array('download_id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('downloads');
		}

	function edit_download()
		{
		$edit_download = $this->db->get_where('downloads', array('download_id' => $this->uri->segment(3)));
		return $edit_download;
		}

	function get_langs()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}
	}
?>