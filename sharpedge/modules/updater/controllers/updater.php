<?php
###################################################################
##
##	Updater Module
##	Version: 0.71
##
##	Last Edit:
##	Dec 31 2012
##
##	Description:
##	Software Updater Module
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Updater extends ADMIN_Controller
	{
	
	function Updater()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('typography');
		$this->load->helper('directory');
		$this->load->helper('file');
		
		#Libraries
		$this->load->library('ion_auth');
		$this->load->library('session');
	
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
	
	//Displays User Interface to the update system.
	function index()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['heading'] = 'SharpEdge Updater';
			$data['version'] = $this->check_version();
			$data['latest_version'] = $this->check_remote_version();
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] = $data['template_path'] . '/updater/main_updater';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
		
	//This function checks the currently installed software version.
	function check_version()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$path = 'assets/current_version.txt';
		
			$current_version = file_get_contents($path);
			return $current_version;
			}
		else
			{
			echo "access denied";
			}
		}
		
	function check_version_ajax()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['version'] = $this->check_version();
			$template_path = $this->config->item('template_admin_page');
			$this->load->view($template_path . '/updater/version', $data);
			}
		else
			{
			echo "access denied";
			}
		}
		
	//Finds out what the most recent available version is.
	function check_remote_version()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$url  = 'http://www.purdydesigns.com/sharpedge_updates/core/current_version.txt';
			$path = 'assets/updates/remote_version.txt';
	 
			$fp = fopen($path, 'w');
	 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_FILE, $fp);
	 
			$data = curl_exec($ch);
	 
			curl_close($ch);
			fclose($fp);
			
			$version = file_get_contents($path);
			return $version;
			}
		else
			{
			echo "access denied";
			}
		}
		
	function get_summary_file()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$current_version = $this->check_version();
			$url  = 'http://www.purdydesigns.com/sharpedge_updates/core/'.$current_version.'/summary_of_old_'.$current_version.'_to_new_version.txt';
			$path = 'assets/updates/summary_of_old_'.$current_version.'_to_new_version.txt';
	 
			$fp = fopen($path, 'w');
	 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_FILE, $fp);
	 
			$data = curl_exec($ch);
	 
			curl_close($ch);
			fclose($fp);
			
			$summary = file_get_contents($path);
			return $summary;
			}
		else
			{
			echo "access denied";
			}
		}
		
	function get_remote_checksum()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$current_version = $this->check_version();
			//Runs remote php script to determine the latest update checksum.
			$url = 'http://www.purdydesigns.com/sharpedge_updates/core/checksum.php?current_version='. $current_version;
			$curl1 = curl_init();
			curl_setopt ($curl1, CURLOPT_URL, $url);
			curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
			$checksum_data = curl_exec($curl1);
			curl_close($curl1);
			
			return $checksum_data;
			}
		else
			{
			echo "access denied";
			}
		}
		
	private function directoryToArray($directory, $recursive = true, $listDirs = true, $listFiles = true, $exclude = '')
	    {
        $arrayItems = array();
        $skipByExclude = false;
        $handle = opendir($directory);
        if ($handle) {
            while (false !== ($file = readdir($handle))) {
            preg_match("/(^(([\.]){1,2})$|(\.(svn|git|md))|(Thumbs\.db|\.DS_STORE))$/iu", $file, $skip);
            if($exclude){
                preg_match($exclude, $file, $skipByExclude);
            }
            if (!$skip && !$skipByExclude) {
                if (is_dir($directory. DIRECTORY_SEPARATOR . $file)) {
                    if($recursive) {
                        $arrayItems = array_merge($arrayItems, $this->directoryToArray($directory. DIRECTORY_SEPARATOR . $file, $recursive, $listDirs, $listFiles, $exclude));
                    }
                    if($listDirs){
                        $file = $directory . DIRECTORY_SEPARATOR . $file;
                        $arrayItems[] = $file;
                    }
                } else {
                    if($listFiles){
                        $file = $directory . DIRECTORY_SEPARATOR . $file;
                        $arrayItems[] = $file;
                    }
                }
            }
        }
        closedir($handle);
        }
        return $arrayItems;
		}
	
	//This function will download the update for the software and logically figure out which updates need to be applied in order to complete the entire update process.
	function download_core_update()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$filelist = $this->directoryToArray('assets/updates/');
			foreach($filelist as $file)
				{
				if(is_dir($file))
					{
					rmdir($file);
					}
				else
					{
					unlink($file);
					}
				}
			$downloading = "Downloading Core Update.....";
			//Check Remote Version
			//$check_version = $this->check_remote_version();
			$check_version = $this->check_remote_version();
			$current_version = $this->check_version();
			if($check_version > $current_version)
				{
				$url  = 'http://www.purdydesigns.com/sharpedge_updates/core/'.$current_version.'/se_core_update.zip';
				$path = 'assets/updates/se_core_update.zip';
		 
				$fp = fopen($path, 'w');
		 
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_FILE, $fp);
		 
				$data = curl_exec($ch);
		 
				curl_close($ch);
				fclose($fp);
				
				//Now that we have downloaded the remote file we will now check it's digital signature to confirm this is the correct file.
				$this->process_core_update($downloading);
				}
			else
				{
				$filelist = $this->directoryToArray('assets/updates/');
				foreach($filelist as $file)
					{
					if(is_dir($file))
						{
						rmdir($file);
						}
					else
						{
						unlink($file);
						}
					}
				echo 'Your already up to date. Ending Process...';
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	//This function will download the specfied module that has an update available based on the selected update tier.
	function download_module_update()
		{
		}
		
	//We will now process the file once it as been downloaded and confirm it's digital signature, then extract it's contents.
	function process_core_update($downloading)
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$download_process = $downloading;
			//Lets Get the Update Summary Remote File - This is an information file on the update that is downloaded.
			$summary_file = $this->get_summary_file();
			
			$checking_sum = 'Checking checksums for valid file';
			
			//Lets check the files signature.
			$current_version = $this->check_version();
			$path = 'assets/updates/se_core_update.zip';
			$local_checksum = sha1_file($path);
			$remote_checksum = $this->get_remote_checksum();
			
			if($local_checksum == $remote_checksum)
				{
				$checksum_ok =  'Checksums matched remote download';
				
				#Make a temp folder to store source of the zip file
				$making_temp = "Making temp folder for update process";
				@mkdir($_SERVER['DOCUMENT_ROOT']. '/assets/updates/temp');
				
				//Lets extract the archive to the updates folder. Run the extractor module
				$extract_zip = "Extracting Zip Archive of update to temp folder.";
				$zip = new ZipArchive;
				if ($zip->open($path) === TRUE)
					{
					$zip->extractTo('./assets/updates/temp');
					$zip->close();
					}
				else
					{
					echo "Failed to extract files from zip archive.";
					}
				
				//Lets now copy all new files to the proper locations which completes the update process. Run the extractor module
				$copy_update = "Copying all files included in the update package";
				$this->recurse_copy('./assets/updates/temp', './');
				
				//Lets check to see if an .sql file is included, and if so to process the sql update file. Run the extractor module.
				$old_version = $current_version;
				$new_version = $this->check_version();
				$db_update = $this->update_database($new_version,$old_version);
				
				//Lets update the current version to the new downloaded version.
				
				//Lets clean up after ourselves by deleting all the update files that are no longer needed.
				$delete_temp = 'Deleting temp files used for update process.';
				$filelist = $this->directoryToArray('assets/updates/');
				foreach($filelist as $file)
					{
					if(is_dir($file))
						{
						rmdir($file);
						}
					else
						{
						unlink($file);
						}
					}
				
				//Now that the update is completed lets do another version check to see if anymore updates are available.
				$this->summary($checksum_ok,$download_process,$summary_file,$checking_sum,$making_temp,$extract_zip,$copy_update,$delete_temp,$current_version,$db_update);
				/*
				$check_version = $this->check_remote_version();
				$current_version = $this->check_version();
				if($check_version > $current_version)
					{
					//They're is still more updates available so lets download that as well.
					//$this->download_core_update();
					}
				else
					{
					//Looks like we updated to the latest version. So lets let the user know they are up to date.
					$this->summary();
					}
				*/
				}
			else
				{
				echo "failed checksum... exiting";
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function recurse_copy($src,$dst)
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$dir = opendir($src);
			@mkdir($dst);
			while(false !== ( $file = readdir($dir)) ) {
				if (( $file != '.' ) && ( $file != '..' )) {
					if ( is_dir($src . '/' . $file) ) {
						$this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
					}
					else {
						copy($src . '/' . $file,$dst . '/' . $file);
					}
				}
			}
			closedir($dir);
			}
		else
			{
			echo "access denied";
			}
		} 
		
	//We will now process the file once it as been downloaded and confirm it's digital signature, then extract it's contents.	
	function process_module_update()
		{
		}
	
	//This function will check for any included sql file to process, if one is included in the update package this will perform the mysql updates required to run the new updates.
	function run_mysql_update_process()
		{
		}
		
	//This displays a summary of the updates that will be included, and maybe information that may be needed to know to manually update theme files for compatability.
	function summary($checksum_ok,$download_process,$summary_file,$checking_sum,$making_temp,$extract_zip,$copy_update,$delete_temp,$current_version,$db_update)
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['checksum'] = $checksum_ok;
			$data['downloading'] = $download_process;
			$data['summary'] = $summary_file;
			$data['checksum_process'] = $checking_sum;
			$data['make_temp'] = $making_temp;
			$data['extract'] = $extract_zip;
			$data['copy_process'] = $copy_update;
			$data['deleted_files'] = $delete_temp;
			$data['database_update'] = $db_update;
			$path = 'assets/updates/summary_of_old_'.$current_version.'_to_new_version.txt';
			//$data['summary'] = file_get_contents($path);
			$data['template_path'] = $this->config->item('template_admin_page');
			$this->load->view($data['template_path'] . '/updater/update_summary', $data);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function update_database($version,$old_version)
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->load->library('update_database');
			$update_db = $this->update_database->process_sql($version,$old_version);
			return $update_db;
			}
		else
			{
			echo "access denied";
			}
		}
	}