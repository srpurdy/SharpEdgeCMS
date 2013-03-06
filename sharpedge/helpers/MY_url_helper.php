<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Alternative languages helper
*
* Returns a string with links to the content in alternative languages
*
* version 0.2
* @author Luis <luis@piezas.org.es>
* @modified by Ionut <contact@quasiperfect.eu>
*/

function alt_site_url($uri = '')
{
    $CI =& get_instance();
    $actual_lang=$CI->uri->segment(1);
    $languages=$CI->config->item('lang_desc');
    $languages_useimg=$CI->config->item('lang_useimg');
    $ignore_lang=$CI->config->item('lang_ignore');
    if (empty($actual_lang))
    {
        $uri=$ignore_lang.$CI->uri->uri_string();
        $actual_lang=$ignore_lang;
    }
    else
    {
        if (!array_key_exists($actual_lang,$languages))
        {
            $uri=$ignore_lang.$CI->uri->uri_string();
            $actual_lang=$ignore_lang;
        }
        else
        {
            $uri=$CI->uri->uri_string();
            $uri=substr_replace($uri,'',0,1);
        }
    }
    $alt_url='<ul id="lang_bg">';
    //i use ul because for me formating a list from css is easy
    foreach ($languages as $lang=>$lang_desc)
    {
         if ($actual_lang!=$lang)
         {
			//$actual_lang = htmlspecialchars($actual_lang,ENT_QUOTES,"UTF-8");
            $alt_url.='<li><a href="'.config_item('base_url');
            if ($lang==$ignore_lang)
            {
				$new_uri=preg_replace('/^'.$actual_lang.'/','/',$uri);
                $new_uri=substr_replace($new_uri,'',0,1);
            }
            else
            {
                $new_uri=preg_replace('/^'.$actual_lang.'/',$lang,$uri);
            }
            $alt_url.= $new_uri.'">';
            if ($languages_useimg){
                //change the path on u'r needs
                //in images u need to have for example en.gif and so on for every   
                //language u use
                //the language description will be used as alternative
                $alt_url.= '<img width="54" height="14" src="'.base_url().'assets/images/system_images/'.$lang.'.png" alt="'.$lang_desc.'" /></a></li>';
            }
            else
            {
                $alt_url.= $lang_desc.'</a></li>';
            }
         }
    }
    $alt_url.='</ul>';
    return $alt_url;
}

	function anchor($uri = '', $title = '', $attributes = '')
	{
		$CI =& get_instance();
		$actual_lang=$CI->config->item('language_abbr');
		$current_uri = str_replace($actual_lang.'/', '', $CI->uri->uri_string());
		$new_uri = str_replace($uri.'/', '', $current_uri);
		//$uri = str_replace($actual_lang.'/', '', $uri);
		$title = (string) $title;

		if ( ! is_array($uri))
		{
			$site_url = ( ! preg_match('!^\w+://! i', $uri)) ? site_url($uri) : $uri;
		}
		else
		{
			$site_url = site_url($uri);
		}

		if ($title == '')
		{
			$title = $site_url;
		}

		if ($attributes != '')
		{
			$attributes = _parse_attributes($attributes);
		}
		
		$site_url = str_replace($actual_lang.'/', '', $site_url) . $new_uri;

		return '<a href="'.$site_url.'"'.$attributes.'>'.$title.'</a>';
	}
?>