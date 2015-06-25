<div class="well">
<?php echo form_open(site_url() . '/nav_admin/edit_menu_item');?>
<?php foreach($edit_menu_item->result() as $emi):?>
<input type="hidden" name="item_id" value="<?php echo $emi->id;?>" />

<div class="input-group">
	<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
	<input type="text" class="form-control" value="<?php echo $emi->text;?>" name="text" />
</div>

<div class="input-group">
	<span class="input-group-addon"><?php echo $this->lang->line('label_external_link');?></span>
	<input type="text" class="form-control" name="link" value="<?php echo $emi->link;?>" />
</div>

<div class="input-group">
	<span class="input-group-addon"><?php echo $this->lang->line('label_page_select');?></span>
	<select name="use_page" class="form-control">
	<option value="Y" <?php if($emi->use_page == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
	<option value="N" <?php if($emi->use_page == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
	</select>
</div>

<div class="input-group">
	<span class="input-group-addon"><?php echo $this->lang->line('label_select_page');?></span>
	<select name="page_link" class="form-control">
	<option value="#" selected="selected"><?php echo $this->lang->line('label_select_page');?></option>
	<?php foreach($pages->result() as $p):?>
	<option value="/pages/view/<?php echo $p->url_name?>" <?php if($emi->page_link == '/pages/view/'.$p->url_name):?>selected="selected"<?php endif;?>><?php echo $p->name?></option>
	<?php endforeach; ?>
	</select>
</div>

<div class="input-group">
	<span class="input-group-addon"><?php echo $this->lang->line('label_target');?></span>
	<select name="target" class="form-control">
	<option value="_self" <?php if($emi->target == '_self'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_same_window');?></option>
	<option value="_new" <?php if($emi->target == '_new'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_new_window');?></option>
	</select>
</div>

<div class="input-group">
	<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
	<select name="lang" class="form-control">
	<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
	<?php foreach($langs->result() as $la):?>
	<option value="<?php echo $la->lang_short?>" <?php if($emi->lang == $la->lang_short):?>selected="selected"<?php endif;?>><?php echo $la->lang?></option>
	<?php endforeach; ?>
	</select>
</div>

<div class="input-group">
	<span class="input-group-addon"><?php echo $this->lang->line('label_active');?></span>
	<select name="active" class="form-control">
	<option value="Y" <?php if($emi->active == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
	<option value="N" <?php if($emi->active == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
	</select>
</div>

<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
<?php endforeach;?>
</div>
<?php echo form_close();?>