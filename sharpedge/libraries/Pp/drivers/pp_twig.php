<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name Twig
* @package Plenty Parser
* @subpackage Driver
* @copyright 2011
* @author Dwayne Charrington
* @license http://philsturgeon.co.uk/code/dbad-license
* @version 1.0
*/

class Pp_twig extends CI_Driver {
    
    protected $ci;

    protected $_twig;
    
    protected $_template;
    
    protected $_template_dir;
    protected $_cache_dir;
    protected $_debug;
    
    public function __construct()
    {
        $this->ci = get_instance();
        
        ini_set('include_path',
        ini_get('include_path') . PATH_SEPARATOR . APPPATH . 'third_party/Twig');

        require_once (string) "Autoloader" . EXT;

        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem($this->_template_dir);

        $this->_twig = new Twig_Environment($loader, array(
            'cache' => $this->_cache_dir,
            'debug' => $this->_debug,
        ));
        
        // Check if a theme has been set and if there is, check it exists and add it to the path
             
    }
    
    /**
    * Override the default template location
    * 
    * @param mixed $location
    * @returns void
    */
    public function set_location($location)
    {
        $this->_template_dir = $location;
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
    * Load the template and return the data
    * 
    * @param mixed $template
    * @param mixed $data
    * @returns string
    */
	public function parse($template, $data = array(), $return = false)
    {
        // If we do not have a template extension, use the default
        if (stripos($template, '.') === false)
        {
            $template . config_item('parser.twig.extension');
        }

        // Load the template
        $template = $this->_twig->loadTemplate($template);

        // If data supplied is an array
        if ( is_array($data) )
        {
            $data = array_merge($data, $this->ci->load->get_vars());
        }
        
        if ( $return === true )
        {
            return $template->render($data);   
        }
        else
        {
            return $template->display($data); 
        }
    }
    
    /**
    * Parse String
    * Parse a string and return it as a string or display it
    * 
    * @param mixed $string
    * @param mixed $data
    * @param mixed $return
    * @returns void
    */
    public function parse_string($string, $data = array(), $return = false)
    {
        $string = $this->_twig->loadTemplate($string);
        
        if ( is_array($data) )
        {
            $data = array_merge($data, $this->ci->load->get_vars());
        }
        
        if ($return === true)
        {
            return $string->render($data);
        }
        else
        {
            return $string->display($data);
        }
        
    }

    /**
     * Register Plugin
     * Registers a plugin for use in a Twig template.
     * @param $name
     */
    public function register_plugin($name)
    {
        $this->_twig->addFunction($name, new Twig_Function_Function($name));
    }

}