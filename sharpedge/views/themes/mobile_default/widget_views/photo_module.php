<?php foreach($page_info->result() as $pi):?>
<?$get_slide = $this->frontend_model->get_slideshow($pi->slide_id);?>
<?php endforeach;?>
<?php foreach($get_slide->result() as $gs):?>
<?php if(!$gs->images == ''):?>
		<?
		# IF DATA DOES EXIST, UNSERIALIZE
		$this->db->where('id', $gs->id);
		$new_row = $this->db->get('slideshow_group');
		$row2 = $new_row->row();
		$get_tags = $row2->images;
		$images2 = unserialize($get_tags);
		?>
			<?php foreach($images2 as $key => $value) : ?>
				<?php if($value == "" || $value == " " || is_null($value)) : ?>
				<?unset($images2[$key]); ?>
				<?php endif;?>
			<?php endforeach;?>
<?php endif;?>
<?php endforeach;?>
<div style="margin-left: 7px; width: 536px; height: 315px; padding-left: 13px; padding-top: 18px; background: transparent url('/assets/images/system_images/slide_bg.png') no-repeat;">
<div id="gallery">
	<?php for(@$i = 0; $i < count($images2); $i++) : ?>
	<?$tag_name = $images2[$i];?>
	<?$get_slide_img = $this->frontend_model->get_slideshow_images($tag_name);?>
	<?php foreach($get_slide_img->result() as $img):?>
	<div class="galleryItem" style="height: 254px; overflow:hidden;">
		<img title="" width="518" src="<?php echo base_url();?>assets/gallery/slideshow/normal/<?php echo $img->userfile?>" alt="" />
		<span style="display: none;"><?php if($this->config->item('language_abbr') == 'en'):?><?php echo parse_bbcode($img->desc_one);?><?php else:?><?php echo parse_bbcode($img->desc_two);?><?php endif;?></span>
	</div>
	<?php endforeach;?>
	<?php endfor;?>
</div>
</div>