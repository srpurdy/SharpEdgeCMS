<div class="form-horizontal">
<?php echo form_open('menu_admin/editmenu/');?>
<?php foreach($query->result() as $id) : ?>
<input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>">
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_menu');?></legend>
            
			<?php echo form_error('text');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" value="<?php echo $id->text;?>" name="text" />
			</div>
            
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_external_link');?></span>
				<input type="text" class="form-control" name="link" value="<?php echo $id->link?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_page_select');?></span>
				<select name="use_page" class="form-control">
				<option value="Y"<?php if ($id->use_page == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if ($id->use_page == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_select_page');?></span>
				<select name="page_link" class="form-control">
				<option value="#" selected="selected"><?php echo $this->lang->line('label_select_page');?></option>
				<?php foreach($get_pages->result() as $p):?>
				<option value="/pages/view/<?php echo $p->url_name?>" <?php if ('/pages/view/'. $p->url_name == $id->page_link):?>selected="selected"<?php endif;?>><?php echo $p->name?></option>
				<?php endforeach;?>
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_child_of');?></span>
				<select name="parent_id" class="form-control">
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
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sub_child_of');?></span>
				<select name="child_id" class="form-control">
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

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_has_child');?></span>
				<select name="has_child" class="form-control">
				<option value="Y"<?php if ($id->has_child == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if ($id->has_child == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_has_sub_child');?></span>
				<select name="has_sub_child" class="form-control">
				<option value="Y"<?php if ($id->has_sub_child == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if ($id->has_sub_child == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<select name="lang" class="form-control">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php if($id->lang == $la->lang_short):?>selected="selected"<?php endif;?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" name="Orderfield" value="<?php echo $id->orderfield?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_hide');?></span>
				<select name="hide" class="form-control">
				<option value="Y"<?php if ($id->hide == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if ($id->hide == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>

			<input class="btn btn-primary" type="submit" value="Submit" />
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>