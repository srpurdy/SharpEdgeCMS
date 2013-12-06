<script type="text/javascript" src="<?php echo base_url();?>assets/js/flex_slider/jquery.flexslider-min.js"></script>
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

	<section class="slider">
		<div class="flexslider">
			<ul class="slides">
<?php for(@$i = 0; $i < count($images2); $i++) : ?>
<?$tag_name = $images2[$i];?>
<?$get_slide_img = $this->frontend_model->get_slideshow_images($tag_name);?>
<?php foreach($get_slide_img->result() as $img):?>
				<li>
				<img src="<?php echo base_url();?>assets/gallery/slideshow/normal/<?php echo $img->userfile?>" />
				</li>
<?php endforeach;?>
<?php endfor;?>
			</ul>
		</div>
	</section>
  <script type="text/javascript">
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>