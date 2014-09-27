<div class="news_heading news_heading_bg">
<h5>Related Articles</h5>
</div>
<?php foreach($related->result() as $r):?>
	<div class="col-xs-3 col-md-3">
		<div class="thumbnail min_height3">
		<img src="<?php echo base_url()?>assets/news/normal/<?php echo $r->userfile?>" alt="" />
			<div class="caption">
			<p class="vvv-comments-small"><?php echo $r->comment_total?> <?php echo $this->lang->line('label_comments');?></p>
			<h4>
			<a href="<?php echo site_url();?>/news/comments/<?php echo $r->url_name?>"><?php echo $r->name?></a>
			</h4>
			<p><?php $blog_str = parse_smileys($r->text, "/assets/images/system_images/smileys/");?>
			<?php $chars = $this->config->item('blog_short_char_limit');?>
			<?php echo truncateHtml($blog_str,$chars);?></p>
			</div>
		</div>
	</div>
<?php endforeach;?>
<div class="clearfix"></div>