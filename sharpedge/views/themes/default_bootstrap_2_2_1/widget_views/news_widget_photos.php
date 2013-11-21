
<div class="news_heading news_heading_bg">
<h5>Latest News</h5>
</div>
<?$i = 0;?>
<ul class="thumbnails">
<?php foreach($news_widget->result() as $id):?>
	<li class="span3">
		<div class="thumbnail min_height3">
		<img src="<?=base_url()?>assets/news/medium/<?=$id->userfile?>" alt="" />
			<div class="caption">
			<h4><a href="<?=site_url();?>/news/comments/<?=$id->url_name?>"><?=$id->name?></a></h4>
			<p><?php $blog_str = parse_smileys($id->text, "/assets/images/system_images/smileys/");?>
			<?php $chars = $this->config->item('blog_short_char_limit');?>
			<?php echo word_limiter($blog_str,$chars);?></p>
			
			<p><a class="btn" href="<?=site_url();?>/news/comments/<?=$id->url_name?>"><?php echo $this->lang->line('label_read_more');?></a></p>
			</div>
		</div>
	</li>
<?php endforeach;?>
</ul>
<?php if($uri == 'News'):?>
<div class="pagination"><?php echo $this->pagination->create_links();?></div>
<br />
<div style="clear: both;"></div>
<?php endif;?>

<?php if($uri == 'News'):?>
<?php else:?>
	<div class="news_heading news_heading_bg">
	<h5>Features</h5>
	</div>
<?$i = 0;?>
<ul class="thumbnails">
<?php foreach($featured_news->result() as $fn):?>
<?$i++;?>
<?php if($i == '1'):?>
<?php endif;?>
	<li class="span4b">
		<div class="thumbnail min_height3">
		<img src="<?=base_url()?>assets/news/medium/<?=$fn->userfile?>" alt="" />
			<div class="caption">
			<h4><a href="<?=site_url();?>/news/comments/<?=$fn->url_name?>"><?=$fn->name?></a></h4>
			<p><?php $blog_str = parse_smileys($fn->text, "/assets/images/system_images/smileys/");?>
			<?php $chars = $this->config->item('blog_short_char_limit');?>
			<?php echo word_limiter($blog_str,$chars);?></p>
			
			<p><a class="btn" href="<?=site_url();?>/news/comments/<?=$fn->url_name?>"><?php echo $this->lang->line('label_read_more');?></a></p>
			</div>
		</div>
	</li>
<?php endforeach;?>
</ul>
<?php endif;?>