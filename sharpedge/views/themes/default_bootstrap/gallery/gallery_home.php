<h3><?php echo $this->lang->line('label_gallery_page');?></h3><br />
<?php foreach($query->result() as $pro): ?>
<?php if($pro->parent_id == 0):?>
<figure class="col-xs-3 col-md-2">
<a href="<?php echo site_url();?>/gallery/event/<?php echo $pro->url_name?>">
<img src="<?php echo base_url();?>assets/gallery/photos/<?php echo $pro->url_name;?>/thumbs/<?php echo $pro->recent_image?>" alt="" />
</a>
<h6><?php echo word_limiter($pro->name, 3);?></h6>
</figure>
<?php endif;?>
<?php endforeach;?>