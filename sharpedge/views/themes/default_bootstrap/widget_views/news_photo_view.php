<script type="text/javascript" src="<?php echo base_url();?>assets/js/flex_slider/jquery.flexslider-min.js"></script>
<section class="slider">
	<div class="flexslider flexslider_news">
		<ul class="slides">
<?php foreach($news_images->result() as $ni):?>
<?php $blog_str = parse_smileys($ni->text, "/assets/images/system_images/smileys/");?>
<?php $chars = $this->config->item('blog_short_char_limit');?>
			<li data-thumb="<?php echo base_url();?>assets/news/small/<?php echo $ni->userfile?>">
			<img src="<?php echo base_url();?>assets/news/normal/<?php echo $ni->userfile?>" alt="" />
			<p class="flex-caption"><strong><?php echo $ni->name?></strong>
			<a class="btn btn-primary" href="<?php echo site_url();?>/news/comments/<?php echo $ni->url_name?>"><?php echo $this->lang->line('label_read_more');?></a></p>
			</li>
<?php endforeach;?>
		</ul>
	</div>
</section>
<script type="text/javascript">
    $(window).load(function(){
      $('.flexslider_news').flexslider({
        animation: "fade",
		controlNav: "thumbnails",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
</script>