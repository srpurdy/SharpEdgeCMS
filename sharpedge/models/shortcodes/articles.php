<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }
    
    public function run($params = array()){
    
        $tag = isset($params['tag']) ? $params['tag'] : '0';
		$subtag = isset($params['subtag']) ? $params['subtag'] : '0';
		$limit = isset($params['limit']) ? $params['limit'] : '0';
		$title = isset($params['title']) ? $params['title'] : '0';
		$exclude = isset($params['exclude']) ? $params['exclude'] : '0';
		$array = $this->frontend_model->get_short_articles($tag, $subtag, $limit, $exclude);
		$articles = $array[0];
		$excluded = $array[1];
		$str = '<h1>'. $title .'</h1><div class="article_bg">';
		
		if($articles->result())
			{
			foreach($articles->result() as $a)
				{
				if($excluded == null)
					{
					$str .= '<div class="col-xs-6 col-sm-6 col-md-6 hover_effect col-lg-4 tsp-padd"><div class="view view-first"><a href="'. site_url() .'/news/comments/'. $a->url_name .'"><img src="'. $this->config->item('assets_url') .'assets/news/medium/'. $a->userfile .'" alt="'.$a->name.'" /><div class="mask"><h2>'. $a->name .'</h2><div class="tsp_comments"><span class="label label-dark tcomm">Comments '.$a->comment_total.'</span></div></div></a></div></div>';
					}
				else
					{
					if(in_array($a->blog_id, $excluded))
						{
						//print_r($excluded);
						}
					else
						{
						$str .= '<div class="col-xs-6 col-sm-6 col-md-6 hover_effect col-lg-4 tsp-padd"><div class="view view-first"><a href="'. site_url() .'/news/comments/'. $a->url_name .'"><img src="'. $this->config->item('assets_url') .'assets/news/medium/'. $a->userfile .'" alt="'.$a->name.'" /><div class="mask"><h2>'. $a->name .'</h2><div class="tsp_comments"><span class="label label-dark tcomm">Comments '.$a->comment_total.'</span></div></div></a></div></div>';
						}
					}
				}
			$str .= '</div><div class="clearfix"></div>';
			return $str;
			}
    }
}