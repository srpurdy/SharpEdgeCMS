<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Ad extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }
    
    public function run($params = array())
		{
        $ca = isset($params['ca']) ? $params['ca'] : '0';
		$pub = isset($params['pub']) ? $params['pub'] : '0';
		$slot = isset($params['slot']) ? $params['slot'] : '0';
		$width = isset($params['width']) ? $params['width'] : '0';
		$height = isset($params['height']) ? $params['height'] : '0';
		$left = isset($params['left']) ? $params['left'] : '0';
		$right = isset($params['right']) ? $params['right'] : '0';
		$top = isset($params['top']) ? $params['top'] : '0';
		$bottom = isset($params['bottom']) ? $params['bottom'] : '0';
		
		$str = '<div style="margin-left: '.$left.';margin-right: '.$right.';margin-top: '.$top.';margin-bottom: '.$bottom.';"><script type="text/javascript"><!--
google_ad_client = "'.$ca.'";
google_ad_host = "'.$pub.'";
/* Flat ad */
google_ad_slot = "'.$slot.'";
google_ad_width = '.$width.';
google_ad_height = '.$height.';
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>';
		return $str;
		}
    }