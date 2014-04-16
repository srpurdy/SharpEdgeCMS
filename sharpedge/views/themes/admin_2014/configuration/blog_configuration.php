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
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_per_page');?></span>
				<input type="text" class="form-control" name="blog_per_page" value="<?php echo $blog_per_page;?>" />
			</div>
            
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_char_limit');?></span>
				<input type="text" class="form-control" name="blog_short_char_limit" value="<?php echo $blog_short_char_limit;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_allow_comments');?></span>
				<select name="allow_comments" class="form-control">
				<option value="true"<?php if($allow_comments == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($allow_comments == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_security_image');?></span>
				<select name="image_security" class="form-control">
				<option value="true"<?php if($image_security == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($image_security == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_normal_maxwidth');?></span>
				<input type="text" class="form-control" name="blog_normal_maxwidth" value="<?php echo $normal_maxwidth;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_normal_maxheight');?></span>
				<input type="text" class="form-control" name="blog_normal_maxheight" value="<?php echo $normal_maxheight;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_normal_quality');?></span>
				<input type="text" class="form-control" name="blog_normal_quality" value="<?php echo $normal_quality;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_small_maxwidth');?></span>
				<input type="text" class="form-control" name="blog_small_maxwidth" value="<?php echo $small_maxwidth;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_small_maxheight');?></span>
				<input type="text" class="form-control" name="blog_small_maxheight" value="<?php echo $small_maxheight;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_small_quality');?></span>
				<input type="text" class="form-control" name="blog_small_quality" value="<?php echo $small_quality;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_medium_maxwidth');?></span>
				<input type="text" class="form-control" name="blog_medium_maxwidth" value="<?php echo $medium_maxwidth;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_medium_maxheight');?></span>
				<input type="text" class="form-control" name="blog_medium_maxheight" value="<?php echo $medium_maxheight;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_medium_quality');?></span>
				<input type="text" class="form-control" name="blog_medium_quality" value="<?php echo $medium_quality;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_thumbnail_maxwidth');?></span>
				<input type="text" class="form-control" name="blog_thumbnail_maxwidth" value="<?php echo $thumbnail_maxwidth;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_thumbnail_maxheight');?></span>
				<input type="text" class="form-control" name="blog_thumbnail_maxheight" value="<?php echo $thumbnail_maxheight;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_thumbnail_quality');?></span>
				<input type="text" class="form-control" name="blog_thumbnail_quality" value="<?php echo $thumbnail_quality;?>" />
			</div>
			
			<input class="btn btn-primary" type="submit" value="Submit" />
</fieldset>
<?php echo form_close();?>
</div>