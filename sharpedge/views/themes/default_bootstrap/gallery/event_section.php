<h3><?php echo $heading?></h3>
<?php foreach($gallery->result() as $img): ?>
<div class="col-xs-3 col-md-2">
	<a class="thumbnail lytebox" href="<?php echo base_url();?>assets/gallery/photos/<?php echo url_title($heading);?>/normal/<?php echo $img->userfile?>" data-lyte-options="group:<?php echo $heading?>" date-title="<?php if($this->config->item('language_abbr') == 'en'):?><?php echo $img->desc_one?><?php else:?><?php echo $img->desc_two?><?php endif;?>">
		<img src="<?php echo base_url();?>assets/gallery/photos/<?php echo url_title($heading);?>/thumbs/<?php echo $img->userfile?>" alt="" />
	</a>
</div>
<?php endforeach;?>