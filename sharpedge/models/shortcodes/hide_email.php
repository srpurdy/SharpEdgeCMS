<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Hide_email extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }
    
    public function run($params = array())
		{
        $name = isset($params['name']) ? $params['name'] : '';
		$domain = isset($params['domain']) ? $params['domain'] : '';
		$linktype = isset($params['linktype']) ? $params['linktype'] : 'link';
		if($linktype == 'link')
			{
			$str = '<script type="text/javascript">
	var string1 = "'.$name.'";
	var string2 = "&#x0040";
	var string3 = "'.$domain.'";
	var string6 = string1 + string2 + string3;
	document.write("<a href=" + "mail" + "to:" + string1 + string2 + string3 + ">" + string6 + "</a>");
	</script>';
			}
		else
			{
			$str = '<script type="text/javascript">
	var string1 = "'.$name.'";
	var string2 = "&#x0040";
	var string3 = "'.$domain.'";
	var string6 = string1 + string2 + string3;
	document.write("<span>" + string1 + string2 + string3 + "</span>");
	</script>';
			}
		return $str;
		}
	}