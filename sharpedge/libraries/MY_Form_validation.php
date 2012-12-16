<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/* The MX_Controller class is autoloaded as required */
class MY_Form_validation extends CI_Form_validation{
    
    function run($module = '', $group = ''){
        (is_object($module)) AND $this->CI = &$module;
            return parent::run($group);
    }
    
}