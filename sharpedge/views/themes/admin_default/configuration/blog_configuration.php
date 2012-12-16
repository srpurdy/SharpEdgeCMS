<?php $stats = $this->config->load('blog_config');?>
<?php $blog_per_page = $stats . $this->config->item('blog_per_page');?>
<?php $blog_short_char_limit = $stats . $this->config->item('blog_short_char_limit');?>
<?php $allow_comments = $stats . $this->config->item('allow_comments');?>
<?php $image_security = $stats . $this->config->item('image_security');?>
<?php $normal_maxwidth = $stats . $this->config->item('blog_normal_maxwidth');?>
<?php $normal_maxheight = $stats . $this->config->item('blog_normal_maxheight');?>
<?php $normal_quality = $stats . $this->config->item('blog_normal_quality');?>
<?php $small_maxwidth = $stats . $this->config->item('blog_small_maxwidth');?>
<?php $small_maxheight = $stats . $this->config->item('blog_small_maxheight');?>
<?php $small_quality = $stats . $this->config->item('blog_small_quality');?>
<?php $medium_maxwidth = $stats . $this->config->item('blog_medium_maxwidth');?>
<?php $medium_maxheight = $stats . $this->config->item('blog_medium_maxheight');?>
<?php $medium_quality = $stats . $this->config->item('blog_medium_quality');?>
<?php $thumbnail_maxwidth = $stats . $this->config->item('blog_thumbnail_maxwidth');?>
<?php $thumbnail_maxheight = $stats . $this->config->item('blog_thumbnail_maxheight');?>
<?php $thumbnail_quality = $stats . $this->config->item('blog_thumbnail_quality');?>
<div class="form-horizontal">
<?php echo form_open('configuration/blog_config/');?>
		<fieldset>
			<legend><?php echo $this->lang->line('blog_configuration');?></legend>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_per_page');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_per_page" value="<?php echo $blog_per_page;?>" />
				</div>
			</div>
            
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_char_limit');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_short_char_limit" value="<?php echo $blog_short_char_limit;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_allow_comments');?></label>
				<div class="controls">
				<select name="allow_comments">
				<option value="true"<?php if($allow_comments == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($allow_comments == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_security_image');?></label>
				<div class="controls">
				<select name="image_security">
				<option value="true"<?php if($image_security == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($image_security == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_normal_maxwidth');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_normal_maxwidth" value="<?php echo $normal_maxwidth;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_normal_maxheight');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_normal_maxheight" value="<?php echo $normal_maxheight;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_normal_quality');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_normal_quality" value="<?php echo $normal_quality;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_small_maxwidth');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_small_maxwidth" value="<?php echo $small_maxwidth;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_small_maxheight');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_small_maxheight" value="<?php echo $small_maxheight;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_small_quality');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_small_quality" value="<?php echo $small_quality;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_medium_maxwidth');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_medium_maxwidth" value="<?php echo $medium_maxwidth;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_medium_maxheight');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_medium_maxheight" value="<?php echo $medium_maxheight;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_medium_quality');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_medium_quality" value="<?php echo $medium_quality;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_thumbnail_maxwidth');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_thumbnail_maxwidth" value="<?php echo $thumbnail_maxwidth;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_thumbnail_maxheight');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_thumbnail_maxheight" value="<?php echo $thumbnail_maxheight;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_thumbnail_quality');?></label>
				<div class="controls">
				<input type="text" class="field" name="blog_thumbnail_quality" value="<?php echo $thumbnail_quality;?>" />
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
</div>