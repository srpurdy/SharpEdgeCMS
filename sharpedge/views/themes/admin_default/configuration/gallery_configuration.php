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
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('gallery_normal_maxwidth');?></label>
				<div class="controls">
				<input type="text" class="field" name="normal_maxwidth" value="<?php echo $gal_normal_maxwidth;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('gallery_normal_maxheight');?></label>
				<div class="controls">
				<input type="text" class="field" name="normal_maxheight" value="<?php echo $gal_normal_maxheight;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('gallery_normal_quality');?></label>
				<div class="controls">
				<input type="text" class="field" name="normal_quality" value="<?php echo $gal_normal_quality;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('gallery_slideshow_maxwidth');?></label>
				<div class="controls">
				<input type="text" class="field" name="slideshow_maxwidth" value="<?php echo $gal_slideshow_maxwidth;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('gallery_slideshow_maxheight');?></label>
				<div class="controls">
				<input type="text" class="field" name="slideshow_maxheight" value="<?php echo $gal_slideshow_maxheight;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('gallery_slideshow_quality');?></label>
				<div class="controls">
				<input type="text" class="field" name="slideshow_quality" value="<?php echo $gal_slideshow_quality;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('gallery_thumbnail_maxwidth');?></label>
				<div class="controls">
				<input type="text" class="field" name="thumbnail_maxwidth" value="<?php echo $gal_thumbnail_maxwidth;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('gallery_thumbnail_maxheight');?></label>
				<div class="controls">
				<input type="text" class="field" name="thumbnail_maxheight" value="<?php echo $gal_thumbnail_maxheight;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('gallery_thumbnail_quality');?></label>
				<div class="controls">
				<input type="text" class="field" name="thumbnail_quality" value="<?php echo $gal_thumbnail_quality;?>" />
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
</div>