<?php defined('BASEPATH') OR exit('No direct script access allowed');
###################################################################
##
##	Dashboard Module
##	Version: 1.11
##
##	Last Edit:
##	Sept 25 2012
##
##	Description:
##	Displays Google Analytics and other various information
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Dashboard extends ADMIN_Controller {

	function __construct()
		{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('carabiner');
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->config('analytics');
		$this->config->set_item('csrf_protection', FALSE);
		
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
			$this->data['heading'] = 'Dashboard';
			$this->data['template_path'] = $this->config->item('template_admin_page');
			$this->data['protect_module'] = $this->backend_model->protect_module();
			$this->data['page'] = $this->data['template_path'] . '/dashboard/dashboard_view';
			$this->load->vars($this->data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
	
	function updates()
		{
		$this->data['template_path'] = $this->config->item('template_admin_page');
		$this->data['page'] = $this->data['template_path'] . '/dashboard/updates';
		$this->load->view($this->data['page']);
		}
	
	function main()
		{
		$this->carabiner->js('shared/frameworks/mootools-1.2.1-core-yc.js');
		$this->carabiner->js('shared/frameworks/mootools-1.2-more.js');
		$this->carabiner->js('shared/plugins/swfobject.js');
		
		$this->carabiner->css('shared/utils/css-reset.css');
		$this->carabiner->css('shared/utils/clearfix.css');

		$this->carabiner->css('backend/grid/960.css');

		$this->carabiner->css('backend/global.css');
		$this->carabiner->css('backend/core.css');

		$this->carabiner->css('backend/text.css');
		$this->carabiner->css('backend/dashboard.css');
		$this->load->view('templates/base/template', array("module" => "dashboard", "view" => "browse"));
		}
	
	function clear_cache()
		{
		$mydir = BASEPATH.'cache/dashboard/'; 
		$d = dir($mydir); 
		while($entry = $d->read()) { 
		 if ($entry!= "." && $entry!= "..") { 
			@unlink(BASEPATH.'cache/dashboard/'.$entry); 
		 } 
		} 
		$d->close(); 
		}
	
	function statistics()
		{	
		$this->cache('table-','table_data','no_table_data');
		}
	
	function xml_data()
		{
		$this->cache('xml-','xml_data','empty_data');
		}
	
	function cache($filename, $view, $noresults = 'empty_data')
		{	
		$this->load->library('analytics');
		$use_cache = FALSE;

		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$profile = $this->input->post('profile');
		$cprofile = str_replace(':', '', $profile);
		
		$filepath = BASEPATH . 'cache/dashboard/'.$cprofile.'-'.$filename.$year.'-'.$month.'___'.date('Y-n-d').EXT;
		$created = substr($filepath , strlen(BASEPATH. 'cache/dashboard/'.$filename),strlen($filepath));
		$created = substr($filepath, strpos($filepath,'___')+3,-4);
		// als de huidige maand gelijk is aan de ingegeven maand
		if($use_cache)
		{
			if($month == date('n') && $year == date('Y'))
			{
				// als de created date gelijk is aan vandaag
				if($created == date('Y-n-d'))
				{
					if(file_exists($filepath))
					{
						echo file_get_contents($filepath);
						exit;
					}
				}
			}
			else
			{
				$days = days_in_month($month, $year);
				// controle of de file wel de laatste dag bevat als we niet in deze maand zitten
				foreach (range(1, $days) as $number)
				{
					$filepath = BASEPATH .
					 'cache/dashboard/'.$cprofile.'-'.$filename.$year.'-'.$month.'___'.$year.'-'.$month.'-'.$number.EXT;
					if(file_exists($filepath))
					{

						if($number == $days)
						{			
							echo file_get_contents($filepath);
							exit;
						}
						else
						{						
							@unlink($filepath);
						}
					}
				}
			}
		}
		
		$this->analytics->login($this->config->item('username'), $this->config->item('password')); // change
		$this->analytics->setProfileById($profile); // change
		$this->analytics->setMonth($month, $year);
		
		$data = array(
			'visitors' => $this->analytics->getVisitors(),
			'pageviews' => $this->analytics->getPageviews(),
			'visitsperhour' => $this->analytics->getVisitsPerHour(),
			'browsers' => $this->analytics->getBrowsers(),
			'referrers' => $this->analytics->getReferrers(),
			'searchwords' => $this->analytics->getSearchWords(),
			'screenresolutions' => $this->analytics->getScreenResolution(),
			'os' => $this->analytics->getOperatingSystem(),
			'month' => $month,
			'year' => $year
			);

		
		echo $cache = count($data['referrers']) ? 
			$this->load->view('modules/dashboard/'.$view,$data, TRUE) : $this->load->view('modules/dashboard/'. $noresults ,null, TRUE);
		
		
		// cleanup
		$max = days_in_month(date('n'), date('Y'));
		foreach (range(1, $max) as $number) {
			@unlink( BASEPATH . 'cache/dashboard/'.$cprofile.'-'.$filename.$year.'-'.$month.'___'.date('Y-n-').$number.EXT);
		}
		
		// write
		@$handle = fopen($filepath,"x+");
		@fwrite($handle,$cache);
		@fclose($handle);
		}

	function analytics_profiles()
		{
		$this->load->library('analytics');
		$this->analytics->login($this->config->item('username'), $this->config->item('password')); // change
		$aProfiles = $this->analytics->getProfileList();
		$counter = 1;
		$str = '';
		foreach($aProfiles as $value => $key)
		{
			$selected = 0;
			$comma = $counter == count($aProfiles) ? '' : '|';
			$str .= $value.','.$key.','.$selected.$comma;
			$counter++;
		}
		echo $str.'';
		}	
}