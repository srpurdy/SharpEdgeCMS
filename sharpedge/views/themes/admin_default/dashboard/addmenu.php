<div style="width:90%;margin-left:25px;">
<?php echo form_open('dashboard/add_menu/');?>
	<fieldset>
			
			<?php echo form_error('text');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="span4" value="<?php echo set_value('text');?>" name="text" />
				</div>
			</div>
            
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_external_link');?></label>
				<div class="controls">
				<input type="text" class="span4" name="link" value="<?php echo set_value('link');?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_page_select');?></label>
				<div class="controls">
				<select name="use_page" class="span4">
				<option value="Y" <?php echo set_select('use_page', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php echo set_select('use_page', 'N');?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_select_page');?></label>
				<div class="controls">
				<select name="page_link" class="span4">
				<option value="#" selected="selected"><?php echo $this->lang->line('label_select_page');?></option>
				<?php foreach($get_pages->result() as $p):?>
				<option value="/pages/view/<?php echo $p->url_name?>" <?php echo set_select('page_link', '/pages/view/'.$p->url_name);?>><?php echo $p->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_child_of');?></label>
				<div class="controls">
				<select name="parent_id" class="span4">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_parent');?></option>
				<?php foreach($menu_items->result() as $mi):?>
				<option value="<?php echo $mi->id?>" <?php echo set_select('parent_id', $mi->id);?>><?php echo $mi->text?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sub_child_of');?></label>
				<div class="controls">
				<select name="child_id" class="span4">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_parent');?></option>
				<?php foreach($menu_items->result() as $mi):?>
				<option value="<?php echo $mi->id?>" <?php echo set_select('child_id', $mi->id);?>><?php echo $mi->text?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_has_child');?></label>
				<div class="controls">
				<select name="has_child" class="span4">
				<option value="Y" <?php echo set_select('has_child', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php echo set_select('has_child', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_has_sub_child');?></label>
				<div class="controls">
				<select name="has_sub_child" class="span4">
				<option value="Y" <?php echo set_select('has_sub_child', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php echo set_select('has_sub_child', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_language');?></label>
				<div class="controls">
				<select name="lang" class="span4">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php echo set_select('lang', $la->lang_short);?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text"  class="span4" name="Orderfield" value="<?php echo set_value('Orderfield');?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_hide');?></label>
				<div class="controls">
				<select name="hide" class="span4">
				<option value="Y" <?php echo set_select('hide', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php echo set_select('hide', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>

			<input class="btn" type="submit" value="Submit" />
			
	</fieldset>
<?php echo form_close();?>
</div>