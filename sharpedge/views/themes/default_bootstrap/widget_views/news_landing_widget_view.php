<div class="news_heading news_heading_bg">
<h5><?php echo $this->lang->line('label_latest_news');?></h5>
</div>
<?php foreach($news_widget->result() as $id):?>
	<div class="col-xs-3 col-md-3">
		<div class="thumbnail min_height3">
		<img src="<?php echo base_url()?>assets/news/medium/<?php echo $id->userfile?>" alt="" /></a>
			<div class="caption">
			<h4><a href="<?php echo site_url();?>/news/comments/<?php echo $id->url_name?>"><?php echo $id->name?></a></h4>
			<p><?php $blog_str = parse_smileys($id->text, "/assets/images/system_images/smileys/");?>
			<?php $chars = $this->config->item('blog_short_char_limit');?>
			<?php echo word_limiter($blog_str,$chars);?></p>
			
			<p><a class="btn btn-primary" href="<?php echo site_url();?>/news/comments/<?php echo $id->url_name?>"><?php echo $this->lang->line('label_read_more');?></a></p>
			</div>
		</div>
	</div>
<?php endforeach;?>
<div class="pagination"><?php echo $this->pagination->create_links();?></div>
<br />
<div class="clearfix"></div>
<hr />
<br />