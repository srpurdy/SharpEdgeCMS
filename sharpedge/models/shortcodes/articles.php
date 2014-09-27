<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }
    
    public function run($params = array()){
		$ci =& get_instance();
		$this->load->library('pagination');
        $tag = isset($params['tag']) ? $params['tag'] : '0';
		$subtag = isset($params['subtag']) ? $params['subtag'] : '0';
		$limit = isset($params['limit']) ? $params['limit'] : '0';
		$title = isset($params['title']) ? $params['title'] : '0';
		$exclude = isset($params['exclude']) ? $params['exclude'] : '0';
		$ex = explode('.', $exclude);
		//print_r($ex);
		$config['base_url'] = site_url(). '/' . $this->uri->segment(1);
		$config['per_page'] = '6';
		$config['uri_segment'] = '2';
		$config['num_links'] = '4';
		$config['cur_tag_open'] = '<a class="disabled" href="#">';
		$config['cur_tag_close'] = '</a>';
		if($this->uri->segment(2) == '')
			{
			$array = $this->frontend_model->get_short_articles_main($tag, $subtag, $limit, $ex);
			}
		else
			{
			$array = $this->frontend_model->get_short_articles($tag, $subtag, $limit, $ex, $config['per_page'], $this->uri->segment(2));
			}
		$articles = $array[0];
		$excluded = $array[1];
		$count_posts = $this->frontend_model->short_count_results($tag, $subtag, $limit, $ex);
		$totals = $count_posts[0];
		$ex_total = $count_posts[1];
		$e_a = 0;
		if($totals->result())
			{
			foreach($totals->result_array() as $t)
				{
				if($ex_total == null)
					{
					$config['total_rows'] = count($totals->result());
					}
				else
					{
					if(@in_array($t->blog_id, $ex_total))
						{
						unset($totals[$e_a]);
						$config['total_rows'] = count($totals->result());
						}
					else
						{
						$config['total_rows'] = count($totals->result());
						}
					}
				$e_a++;
				}
			}
		$this->pagination->initialize($config);
		//print_r($array[1]);
		$str = '<h1>'. $title .'</h1><div class="article_bg">';
		
		if($articles->result())
			{
			foreach($articles->result() as $a)
				{
				if($excluded == null)
					{
					$str .= '<div class="col-xs-6 col-sm-6 col-md-6 hover_effect col-lg-4 tsp-padd"><div class="view view-first"><a href="'. site_url() .'/news/comments/'. $a->url_name .'"><img width="277" height="100%" class="lazy" data-original=="'. $this->config->item('assets_url') .'assets/news/medium/'. $a->userfile .'" alt="'.$a->name.'" /><div class="mask"><h2>'. $a->name .'</h2><div class="tsp_comments"><span class="label label-dark tcomm">Comments '.$a->comment_total.'</span></div></div></a></div></div>';
					}
				else
					{
					if(in_array($a->blog_id, $excluded))
						{
						//print_r($excluded);
						}
					else
						{
						$str .= '<div class="col-xs-6 col-sm-6 col-md-6 hover_effect col-lg-4 tsp-padd"><div class="view view-first"><a href="'. site_url() .'/news/comments/'. $a->url_name .'"><img width="277" height="100%" class="lazy" data-original=="'. $this->config->item('assets_url') .'assets/news/medium/'. $a->userfile .'" alt="'.$a->name.'" /><div class="mask"><h2>'. $a->name .'</h2><div class="tsp_comments"><span class="label label-dark tcomm">Comments '.$a->comment_total.'</span></div></div></a></div></div>';
						}
					}
				}
			$str .= '</div><div class="clearfix"></div><br /><div class="pagination">'.$this->pagination->create_links().'</div>';
			return $str;
			}
    }
}