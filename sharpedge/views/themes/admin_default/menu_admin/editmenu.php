<div class="form-horizontal">
<?php echo form_open('menu_admin/editmenu/');?>
<?php foreach($query->result() as $id) : ?>
<input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>">
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_menu');?></legend>
            
			<?php echo form_error('text');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="span5" value="<?php echo $id->text;?>" name="text" />
				</div>
			</div>
            
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_external_link');?></label>
				<div class="controls">
				<input type="text" class="span5" name="link" value="<?php echo $id->link?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_page_select');?></label>
				<div class="controls">
				<select name="use_page">
				<option value="Y"<?php if ($id->use_page == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if ($id->use_page == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_select_page');?></label>
				<div class="controls">
				<select name="page_link">
				<option value="#" selected="selected"><?php echo $this->lang->line('label_select_page');?></option>
				<?php foreach($get_pages->result() as $p):?>
				<option value="/pages/view/<?php echo $p->url_name?>" <?php if ('/pages/view/'. $p->url_name == $id->page_link):?>selected="selected"<?php endif;?>><?php echo $p->name?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_child_of');?></label>
				<div class="controls">
				<select name="parent_id">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_parent');?></option>
				<?php foreach($menu_items->result() as $mi):?>
				<?php if($mi->parent_id == '0'):?>
				<option value="<?php echo $mi->id?>" <?php if($id->parent_id == $mi->id):?>selected="selected"<?php endif;?>><?php echo $mi->text?></option>
				<?php endif;?>
					<?php if($mi->has_child == 'Y'):?>
					<?php foreach($menu_items->result() as $smi):?>
					<?php if($smi->parent_id == $mi->id AND $smi->child_id == '0'):?>
					<option value="<?php echo $smi->id?>" <?php if($id->parent_id == $smi->id):?>selected="selected"<?php endif;?>>--- <?php echo $smi->text?></option>
					<?php endif;?>
						<?php if($smi->has_sub_child == 'Y'):?>
						<?php foreach($menu_items->result() as $scmi):?>
						<?php if($scmi->child_id == $smi->id AND $scmi->parent_id == $mi->id):?>
						<option value="<?php echo $scmi->id?>" <?php if($id->parent_id == $scmi->id):?>selected="selected"<?php endif;?>>>------ <?php echo $scmi->text?></option>
						<?php endif;?>
						<?php endforeach;?>
						<?php endif;?>
					<?php endforeach;?>
					<?php endif;?>
				<?php endforeach;?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sub_child_of');?></label>
				<div class="controls">
				<select name="child_id">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_parent');?></option>
				<?php foreach($menu_items->result() as $mi):?>
				<?php if($mi->parent_id == '0'):?>
				<option value="<?php echo $mi->id?>" <?php if($id->child_id == $mi->id):?>selected="selected"<?php endif;?>><?php echo $mi->text?></option>
				<?php endif;?>
					<?php if($mi->has_child == 'Y'):?>
					<?php foreach($menu_items->result() as $smi):?>
					<?php if($smi->parent_id == $mi->id AND $smi->child_id == '0'):?>
					<option value="<?php echo $smi->id?>" <?php if($id->child_id == $smi->id):?>selected="selected"<?php endif;?>>--- <?php echo $smi->text?></option>
					<?php endif;?>
						<?php if($smi->has_sub_child == 'Y'):?>
						<?php foreach($menu_items->result() as $scmi):?>
						<?php if($scmi->child_id == $smi->id AND $scmi->parent_id == $mi->id):?>
						<option value="<?php echo $scmi->id?>" <?php if($id->child_id == $scmi->id):?>selected="selected"<?php endif;?>>>------ <?php echo $scmi->text?></option>
						<?php endif;?>
						<?php endforeach;?>
						<?php endif;?>
					<?php endforeach;?>
					<?php endif;?>
				<?php endforeach;?>
				</select>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_has_child');?></label>
				<div class="controls">
				<select name="has_child">
				<option value="Y"<?php if ($id->has_child == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if ($id->has_child == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_has_sub_child');?></label>
				<div class="controls">
				<select name="has_sub_child">
				<option value="Y"<?php if ($id->has_sub_child == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if ($id->has_sub_child == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_language');?></label>
				<div class="controls">
				<select name="lang">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php if($id->lang == $la->lang_short):?>selected="selected"<?php endif;?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text" class="span1" name="Orderfield" value="<?php echo $id->orderfield?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_hide');?></label>
				<div class="controls">
				<select name="hide">
				<option value="Y"<?php if ($id->hide == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if ($id->hide == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>

			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>