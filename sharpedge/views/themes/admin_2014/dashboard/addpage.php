<?php echo form_open('dashboard/add_page/');?>
	<fieldset>
			<input type="hidden" id="id" name="draft" value="N">
			<input type="hidden" id="id" name="hide" value="N">
			
			<?php echo form_error('name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_page_title');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo set_value('name');?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_select_container');?></span>
				<select name="container_name" class="form-control">
				<option value="/container" selected="selected"><?php echo $this->lang->line('label_select_container');?></option>
				<?php foreach($containers->result() as $ct):?>
				<option value="<?php echo $ct->container_name?>" <?php echo set_select('container_name', $ct->container_name);?>><?php echo $ct->container_name?></option>
				<?php endforeach; ?>
				</select>
				<?php echo set_select('container_name');?>
			</div>
			
			<?php echo form_error('text'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_page_content');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: set_value('text');
				echo @form_ckeditor('text2', $textareaContent);?>
			</div>
		
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_meta_description');?></span>
				<textarea class="form-control" name="meta_desc" rows="3" cols="60"><?php echo set_value('meta_desc');?></textarea>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_meta_keywords');?></span>
				<textarea class="form-control" name="meta_keywords" rows="3" cols="60"><?php echo set_value('meta_keywords');?></textarea>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_slide_group');?></span>
				<select name="slide_id" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_select_slide');?></option>
				<?php foreach($get_slideshow->result() as $ss):?>
				<option value="<?php echo $ss->id?>" <?php echo set_select('slide_id', $ss->id, FALSE);?>><?php echo $ss->name?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_side_top');?></span>
				<select name="side_top" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php echo set_select('side_top', $set->id, FALSE);?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_side_bottom');?></span>
				<select name="side_bottom" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php echo set_select('side_bottom', $set->id, FALSE);?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_content_top');?></span>
				<select name="content_top" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php echo set_select('content_top', $set->id, FALSE);?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_content_bottom');?></span>
				<select name="content_bottom" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php echo set_select('content_bottom', $set->id, FALSE);?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<select name="lang" class="form-control">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php echo set_select('lang', $la->lang_short, FALSE);?>><?php echo $la->lang?></option>
				<?php endforeach;?>
				</select>
			</div>

			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			
	</fieldset>
<?php echo form_close();?>