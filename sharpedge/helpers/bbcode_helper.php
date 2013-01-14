<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* CodeIgniter BBCode Helpers
*
* @package  CodeIgniter
* @subpackage Helpers
* @category Helpers
* @author  Philip Sturgeon
* @changes  MpaK http://mrak7.com
* @changes Shawn Purdy
* @link  http://codeigniter.com/wiki/BBCode_Helper/
*/

// ------------------------------------------------------------------------

/**
* parse_bbcode
*
* Converts BBCode style tags into basic HTML
*
* @access public
* @param string unparsed string
* @param int max image width
* @return string
*/

function parse_bbcode($str = '', $max_images = 0, $parse_smileys = FALSE){
// Max image size eh? Better shrink that pic!
if($max_images > 0):
   $str_max = "style=\"max-width:".$max_images."px; width: [removed]this.width > ".$max_images." ? ".$max_images.": true);\"";
endif;

$brackets = array('[', ']');
//$brackets_html = array('|','|');
$brackets_html = array('&#91;','&#93;');

$find = array(
  "'\[b\](.*?)\[/b\]'is",
  "'\[i\](.*?)\[/i\]'is",
  "'\[u\](.*?)\[/u\]'is",
  "'\[s\](.*?)\[/s\]'is",
  "'\[quote\](.*?)\[/quote\]'is",
  "'\[youtube\](.*?)\[/youtube\]'is",
  "'\[code\](.*?)\[/code\]'is",
  "'\[img\](.*?)\[/img\]'i",
  "'\[url\](.*?)\[/url\]'i",
  "'\[url=(.*?)\](.*?)\[/url\]'i",
  "'\[lytebox=(.*?)\](.*?)\[/lytebox\]'i",
  "'\[link\](.*?)\[/link\]'i",
  "'\[link=(.*?)\](.*?)\[/link\]'i",
  "'\[p\](.*?)\[/p\]'is",
  "'\[h1\](.*?)\[/h1\]'i",
  "'\[h2\](.*?)\[/h2\]'i",
  "'\[h3\](.*?)\[/h3\]'i",
  "'\[h4\](.*?)\[/h4\]'i",
  "'\[h5\](.*?)\[/h5\]'i",
  "'\[hr\](.*?)\[/hr\]'i",
  "'\[aname=(.*?)\](.*?)\[/aname\]'is",
  "'\[numlist\](.*?)\[/numlist\]'is",
  "'\[bulletlist\](.*?)\[/bulletlist\]'is",
  "'\[li\](.*?)\[/li\]'is",
  "'\[br\](.*?)\[/br\]'is",
);

$replace = array(
  '<strong>\\1</strong>',
  '<em>\\1</em>',
  '<u>\\1</u>',
  '<s>\\1</s>',
  '<blockquote>\\1</blockquote>',
  '<iframe width="400" height="225" src="http://www.youtube.com/embed/\\1?&amp;wmode=opaque" frameborder="0" allowfullscreen></iframe>',
  '<pre>code: \\1</pre>',
  '<img src="\\1" alt="" />',
  '<a href="\\1">\\1</a>',
  '<a href="\\1">\\2</a>',
  '<a href="\\1" rel="lytebox">\\2</a>',
  '<a href="\\1">\\1</a>',
  '<a href="\\1">\\2</a>',
  '<p>\\1</p>',
  '<h1>\\1</h1>',
  '<h2>\\1</h2>',
  '<h3>\\1</h3>',
  '<h4>\\1</h4>',
  '<h5>\\1</h5>',
  '<hr />',
  '<a name="\\1">\\2</a>',
  '<ol>\\1</ol>',
  '<ul>\\1</ul>',
  '<li>\\1</li>',
  '<br />',
);

//Look for code blocks
preg_match_all("'\[code\](.*?)\[/code\]'is", $str, $code_blocks, PREG_PATTERN_ORDER);

//parse smileys only if the block is not a code block.
if($parse_smileys)
	{
	$block_num = 0;	
	foreach ($code_blocks[0] as $block)
		{
		$str = str_replace($block, "{block_$block_num}", $str);
		$block_num++;
		}
		
	$str = parse_smileys($str, "/assets/images/system_images/smileys/");
		
	$block_num = 0;	
	foreach ($code_blocks[0] as $block)
		{
		$str = str_replace("{block_$block_num}", $block, $str);
		$block_num++;
		}
	}
	
//disable bbcode in code blocks
$block_num = 0;
foreach($code_blocks[0] as $block)
	{
	$new_str = str_replace($brackets, $brackets_html, $block);
	$new_str = preg_replace("'\&#91;code\&#93;(.*?)\&#91;/code\&#93;'s", "<pre>code: \\1</pre>", $new_str);
	$str = preg_replace("'\[code\](.*?)\[/code\]'s", $new_str, $str);
	$block_num++;
	}
	
//look for http:// in img blocks
preg_match_all("'\[img\](.*?)\[/img\]'is", $str, $img_blocks, PREG_PATTERN_ORDER);
$img_num = 0;
foreach($img_blocks[0] as $img)
	{
	if(strpos($img, 'http://'))
		{
		}
	else
		{
		$imgcur = str_replace("[IMG]", "[img]", $img);
		$imgcur = str_replace("[/IMG]", "[/img]", $imgcur);
		$img_new = explode('[img]', $imgcur);
		$img_str = '[img]http://' . $img_new[1];
		$str = str_replace($img, $img_str, $str);
		$img_num++;
		}
	}
	
//look for http:// in url blocks
preg_match_all("'\[url\](.*?)\[/url\]'is", $str, $url_blocks, PREG_PATTERN_ORDER);
$url_num = 0;
foreach($url_blocks[0] as $url)
	{
	if(strpos($url, 'http://'))
		{
		}
	else
		{
		$urlcur = str_replace("[URL]", "[url]", $url);
		$urlcur = str_replace("[/URL]", "[/url]", $urlcur);
		$url_new = explode('[url]', $urlcur);
		$url_str = '[url]http://' . $url_new[1];
		$str = str_replace($url, $url_str, $str);
		$url_num++;
		}
	}
	
//look for http:// in url blocks with string.
preg_match_all("'\[url=(.*?)\](.*?)\[/url\]'i", $str, $url_blocks, PREG_PATTERN_ORDER);
$url_num = 0;
foreach($url_blocks[0] as $url)
	{
	if(strpos($url, 'http://'))
		{
		}
	else
		{
		$urlcur = str_replace("[URL=", "[url=", $url);
		$urlcur = str_replace("[/URL]", "[/url]", $urlcur);
		$url_new = explode('[url=', $urlcur);
		$url_str = '[url=http://' . $url_new[1];
		$str = str_replace($url, $url_str, $str);
		$url_num++;
		}
	}
	
// no point proceeding if there are no bb code tags for QUOTE  
if(preg_match_all("'\[quote\](.*?)\[/quote\]'is", $str, $quote_blocks, PREG_PATTERN_ORDER))
	{
	foreach($quote_blocks[0] as $quote)
		{
		$len      = strlen( $str );
		// some flags
		$pos      = 0;
		$new_str  = null;
		$tag      = null;
		$in_quote = false;
		$nested   = array();
		while( $pos<$len )
			{
			$c = $str{$pos}; // get the current character
			if( $tag )
				{
				$tag .= $c;
				if( $c==']' )
					{
					if( $tag=='[quote]' or $tag=='[QUOTE]' )
						{
						if( $in_quote )
							{
							$nested[] = true;
							$in_quote .= '<blockquote>';
							}
						else
						$in_quote = '<blockquote title="Quoted Text">';
						}
						  
					elseif( $tag=='[/quote]' or $tag=='[/QUOTE]' )
						{
						if( $nested )
							{
							array_pop( $nested );
							$in_quote .= '</blockquote>';
							}
						else
							{
							$new_str .= $in_quote . '</blockquote>';
							$in_quote = null;
							}
						}
					else
						{
						// this is some other tag, let it go
						if( $in_quote )
							$in_quote .= $tag;
						else
							$new_str .= $tag;    
						}
						
					$tag = null;    
					}
				}
			elseif( $in_quote )
				{
				if( $c=='[' )
					{
					$tag = $c;    
					}
					
				else
					$in_quote .= $c;
				}
			
			elseif( $c=='[' )
				$tag .= $c;
			else
				$new_str .= $c;
				++$pos;
			}
		}
		$str = &$new_str;
	}
	
return preg_replace($find, $replace, $str);

}

?>