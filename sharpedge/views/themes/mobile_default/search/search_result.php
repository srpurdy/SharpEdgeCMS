<h4><?php echo $this->lang->line('label_search_page');?></h4>
<?php if(!$do_search->result()):?>
<p><?php echo $this->lang->line('label_no_results');?></p>
<p><?php echo $this->lang->line('label_you_searched');?> <b><?php echo $string_search;?></b> <?php echo $this->lang->line('label_refine_search');?></p>
<?php else:?>
<p><?php echo $this->lang->line('label_you_searched');?> <b><?php echo $string_search;?></b> <?php echo $this->lang->line('label_search_result_page');?></p>
<?php if($string_search == ''):?>
<p><?php echo $this->lang->line('label_no_text');?></p>
<?php else:?>
<?php foreach($do_search->result() as $id):?>
<a href="<?php if($this->config->item('short_url') == true):?><?php echo site_url();?>/<?php echo $id->url_name?><?php else:?><?php echo site_url();?>/pages/view/<?php echo $id->url_name?><?php endif;?>"><?php echo $id->name?></a><br />
<?php echo $this->lang->line('label_page_lang');?> <?php echo $id->lang?><br />
<br />
<?php endforeach;?>
<?php endif;?>
<?php endif;?>
<hr>
<br />
<h4><?php echo $this->lang->line('label_search_news');?></h4>
<?php if(!$do_search_news->result()):?>
<p><?php echo $this->lang->line('label_no_results');?></p>
<p><?php echo $this->lang->line('label_you_searched');?> <b><?php echo $string_search;?></b> <?php echo $this->lang->line('label_refine_search');?></p>
<?php else:?>
<p><?php echo $this->lang->line('label_you_searched');?> <b><?php echo $string_search;?></b> <?php echo $this->lang->line('label_search_result_news');?></p>
<?php if($string_search == ''):?>
<p><?php echo $this->lang->line('label_no_text');?></p>
<?php else:?>
<?php foreach($do_search_news->result() as $id):?>
<a href="<?php echo site_url();?>/news/comments/<?php echo $id->url_name?>"><?php echo $id->name?></a><br />
<?php echo $this->lang->line('label_news_lang');?> <?php echo $id->lang?><br />
<br />
<?php endforeach;?>
<?php endif;?>
<?php endif;?>
<hr>