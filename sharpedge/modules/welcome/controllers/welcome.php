<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$data['heading'] = 'Welcome';
		$data['page'] = 'welcome/welcome_message';
		$this->load->vars($data);
		$this->load->view($this->_container);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */