<?php $stats = $this->config->load('gallery_config');?>
<?php $gal_normal_maxwidth = $stats . $this->config->item('normal_maxwidth');?>
<?php $gal_normal_maxheight = $stats . $this->config->item('normal_maxheight');?>
<?php $gal_normal_quality = $stats . $this->config->item('normal_quality');?>
<?php $gal_thumbnail_maxwidth = $stats . $this->config->item('thumbnail_maxwidth');?>
<?php $gal_thumbnail_maxheight = $stats . $this->config->item('thumbnail_maxheight');?>
<?php $gal_thumbnail_quality = $stats . $this->config->item('thumbnail_quality');?>
<?php $gal_slideshow_maxwidth = $stats . $this->config->item('slideshow_maxwidth');?>
<?php $gal_slideshow_maxheight = $stats . $this->config->item('slideshow_maxheight');?>
<?php $gal_slideshow_quality = $stats . $this->config->item('slideshow_quality');?>
<div class="form-horizontal">
<?php echo form_open('configuration/gallery_config/');?>
		<fieldset>
			<legend><?php echo $this->lang->line('gallery_config');?></legend>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('gallery_normal_maxwidth');?></span>
				<input type="text" class="form-control" name="normal_maxwidth" value="<?php echo $gal_normal_maxwidth;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('gallery_normal_maxheight');?></span>
				<input type="text" class="form-control" name="normal_maxheight" value="<?php echo $gal_normal_maxheight;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('gallery_normal_quality');?></span>
				<input type="text" class="form-control" name="normal_quality" value="<?php echo $gal_normal_quality;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('gallery_slideshow_maxwidth');?></span>
				<input type="text" class="form-control" name="slideshow_maxwidth" value="<?php echo $gal_slideshow_maxwidth;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('gallery_slideshow_maxheight');?></span>
				<input type="text" class="form-control" name="slideshow_maxheight" value="<?php echo $gal_slideshow_maxheight;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('gallery_slideshow_quality');?></span>
				<input type="text" class="form-control" name="slideshow_quality" value="<?php echo $gal_slideshow_quality;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('gallery_thumbnail_maxwidth');?></span>
				<input type="text" class="form-control" name="thumbnail_maxwidth" value="<?php echo $gal_thumbnail_maxwidth;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('gallery_thumbnail_maxheight');?></span>
				<input type="text" class="form-control" name="thumbnail_maxheight" value="<?php echo $gal_thumbnail_maxheight;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('gallery_thumbnail_quality');?></span>
				<input type="text" class="form-control" name="thumbnail_quality" value="<?php echo $gal_thumbnail_quality;?>" />
			</div>
			
			<input class="btn btn-primary" type="submit" value="Submit" />

</fieldset>
<?php echo form_close();?>
</div>