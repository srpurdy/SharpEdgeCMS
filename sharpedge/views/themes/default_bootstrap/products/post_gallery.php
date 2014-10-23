<?php foreach($post_gallery->result() as $img):?>
	<figure class="col-xs-3 col-md-3">
		<a class="thumbnail lytebox" href="<?=base_url();?>assets/gallery/photos/<?=url_title($heading);?>/normal/<?=$img->userfile?>" data-lyte-options="group:<?=$heading?>" date-title="<?php if($this->config->item('language_abbr') == 'en'):?><?=$img->desc_one?><?php else:?><?=$img->desc_two?><?php endif;?>">
		<img src="<?=base_url();?>assets/gallery/photos/<?=url_title($heading);?>/thumbs/<?=$img->userfile?>" alt="" width="200" height="114" />
		</a>
	</figure>
<?php endforeach;?>