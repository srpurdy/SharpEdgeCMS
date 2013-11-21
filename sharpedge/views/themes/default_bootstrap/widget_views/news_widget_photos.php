
<div class="news_heading news_heading_bg">
<h5><?php echo $this->lang->line('label_latest_news');?></h5>
</div>
<?$i = 0;?>
<?php foreach($news_widget->result() as $id):?>
	<div class="col-md-3">
		<div class="thumbnail min_height3">
		<img src="<?php echo base_url()?>assets/news/medium/<?php echo $id->userfile?>" alt="" />
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
<?php if($uri == 'News'):?>
<div class="pagination"><?php echo $this->pagination->create_links();?></div>
<br />
<?php endif;?>
<div class="clearfix"></div>
<?php if($uri == 'News'):?>
<?php else:?>
	<div class="news_heading news_heading_bg">
	<h5><?php echo $this->lang->line('label_features');?></h5>
	</div>
<?$i = 0;?>
<?php foreach($featured_news->result() as $fn):?>
<?$i++;?>
<?php if($i == '1'):?>
<?php endif;?>
	<div class="col-md-4">
		<div class="thumbnail min_height3">
		<img src="<?php echo base_url()?>assets/news/medium/<?php echo $fn->userfile?>" alt="" />
			<div class="caption">
			<h4><a href="<?php echo site_url();?>/news/comments/<?php echo $fn->url_name?>"><?php echo $fn->name?></a></h4>
			<p><?php $blog_str = parse_smileys($fn->text, "/assets/images/system_images/smileys/");?>
			<?php $chars = $this->config->item('blog_short_char_limit');?>
			<?php echo word_limiter($blog_str,$chars);?></p>
			
			<p><a class="btn btn-primary" href="<?php echo site_url();?>/news/comments/<?php echo $fn->url_name?>"><?php echo $this->lang->line('label_read_more');?></a></p>
			</div>
		</div>
	</div>
<?php endforeach;?>
<?php endif;?>