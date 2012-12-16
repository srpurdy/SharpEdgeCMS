<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name Smarty
* @package Plenty Parser
* @subpackage Driver
* @copyright 2011
* @author Dwayne Charrington
* @license http://philsturgeon.co.uk/code/dbad-license
* @version 1.0
*/

class Pp_smarty extends CI_Driver {
	
	protected $ci;
    
    protected $_smarty;
    
    public function __construct()
    {
        $this->ci = get_instance();
        $this->ci->config->load('plentyparser');

        // Require Smarty
        require_once APPPATH."third_party/Smarty/Smarty.class.php";
        
        // Store the Smarty library
        $this->_smarty = new Smarty;
        
        // Smarty config options
        $this->_smarty->setTemplateDir(config_item('parser.smarty.location'));
        $this->_smarty->setCompileDir(config_item('parser.smarty.compile_dir'));
        $this->_smarty->setCacheDir(config_item('parser.smarty.cache_dir'));
        $this->_smarty->setConfigDir(config_item('parser.smarty.config_dir'));

        // Add helper directories as plugin directories
        $this->_smarty->addPluginsDir(FCPATH . 'system/helpers/');
        $this->_smarty->addPluginsDir(APPPATH . 'helpers/');

        // Delimiters
        $this->_smarty->left_delimiter  = config_item("parser.smarty.left.delim");
        $this->_smarty->right_delimiter = config_item("parser.smarty.right.delim");

        // Cache life time in seconds
        $this->_smarty->cache_lifetime  = config_item('parser.smarty.cache_lifetime');
        
        // Should let us access Codeigniter stuff in views
        $this->assign_var("CI", $this->ci);

        // Codeigniter base constants as variables.
        $this->assign_var('APPPATH',APPPATH);
        $this->assign_var('BASEPATH',BASEPATH);
        $this->assign_var('FCPATH',FCPATH);

        // Disable Smarty security policy
        $this->_smarty->disableSecurity();
        
        // Turn on/off debug
	$this->_smarty->debugging  = config_item('parser.smarty.debug');
    }
    
    /**
    * Call
    * able to call native Smarty methods
    * @returns void
    */
    public function __call($method, $params=array())
    {
		
	if(!method_exists($this, $method))
        {
		call_user_func_array(array($this->_smarty, $method), $params);
			
	}
    }
    
    /**
    * Assign Var
    * Assign a variable for template view use
    * 
    * @param mixed $name
    * @param mixed $val
    * @returns void
    */
    public function assign_var($name, $val)
    {
        // If an empty variable name
        if (empty($name))
        {
            show_error('Smarty assign var function expects a name and value for assigning variables');
        }
        
        // Call Smarty assign function
        $this->_smarty->assign($name, $val);
    }
    
    /**
    * Parse
    * Display or return template contents
    * 
    * @param mixed $template
    * @param array $data
    * @param mixed $return
    */
    public function parse($template, $data = array(), $return = false)
    {        
        // If we have variables to assign, lets assign them
        if ($data)
        {
            foreach ($data AS $key => $val)
            {
                $this->_smarty->assign($key, $val);
            }
        }
        
        // If we're returning the template contents
        if ($return === true)
        {
            return $this->_smarty->fetch($template);
        }
        else
        {
            $this->_smarty->display($template);
        }
    }
    
    /**
    * Parse string
    * Parses a string as a template and can be returned or displayed
    * 
    * @param mixed $string
    * @param mixed $data
    */
    public function parse_string($string, $data = array())
    {
        return $this->_smarty->fetch('string:'.$string, $data);
    }


    /**
     * Registers plugin to be used in templates
     *
     * @param string $type plugin type
     * @param string $tag name of template tag
     * @param callback $callback PHP callback to register
     * @param boolean $cacheable if true (default) this fuction is cachable
     * @param array $cache_attr caching attributes if any
     * @throws SmartyException when the plugin tag is invalid
     */
    public function register_plugin($type, $tag, $callback, $cacheable = true, $cache_attr = null)
    {
        return $this->_smarty->registerPlugin($type, $tag, $callback, $cacheable, $cache_attr);
    }

}