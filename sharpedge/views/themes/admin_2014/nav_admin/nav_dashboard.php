<style type="text/css">
.pages_height{max-height:200px;overflow:auto;}
</style>
<script type="text/javascript">
$(document).ready(function()
{
	$.ajax(
	{
		url: "<?php echo site_url();?>/nav_admin/manage_menus",
		type: "GET",
		success: function(msg)
		{
			$('#load_menus').html(msg);
		}
	})
});
</script>
<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">
		<?php echo $this->lang->line('manage_nav');?>
		</div>
		
		<div class="panel-body">
			<div id="load_menus"></div>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">
		<?php echo $this->lang->line('label_new_menu');?>
		</div>
		
		<div class="panel-body">
		<?php echo form_open(site_url() . '/nav_admin/add_menu_item');?>
		<fieldset>
		<legend><?php echo $this->lang->line('label_add_menu');?></legend>
		
		<input type="hidden" id="menu_number" name="menu_number" value="" />
			
			<?php echo form_error('text');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" value="<?php echo set_value('text');?>" name="text" />
			</div>
            
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_external_link');?></span>
				<input type="text" class="form-control" name="link" value="<?php echo set_value('link');?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_page_select');?></span>
				<select name="use_page" class="form-control">
				<option value="Y" <?php echo set_select('use_page', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php echo set_select('use_page', 'N');?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_select_page');?></span>
				<select name="page_link" class="form-control">
				<option value="#" selected="selected"><?php echo $this->lang->line('label_select_page');?></option>
				<?php foreach($pages->result() as $p):?>
				<option value="/pages/view/<?php echo $p->url_name?>" <?php echo set_select('page_link', '/pages/view/'.$p->url_name);?>><?php echo $p->name?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_target');?></span>
				<select name="target" class="form-control">
				<option value="_self" <?php echo set_select('target', '_self');?>><?php echo $this->lang->line('label_same_window');?></option>
				<option value="_new" <?php echo set_select('target', '_new');?>><?php echo $this->lang->line('label_new_window');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<select name="lang" class="form-control">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php echo set_select('lang', $la->lang_short);?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_active');?></span>
				<select name="active" class="form-control">
				<option value="Y" <?php echo set_select('active', 'Y', TRUE);?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php echo set_select('active', 'N');?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>

			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
		</fieldset>
		<?php echo form_close();?>
	<div class="clearfix"></div><br />
	<div class="col-md-12 text-center"><h2><?php echo $this->lang->line('label_or');?></h2></div>
	<div class="clearfix"></div><br />
		<?php echo form_open(site_url() . '/nav_admin/add_items_by_page');?>
		<fieldset>
		<legend><?php echo $this->lang->line('label_add_menu');?></legend>
		<input type="hidden" id="menu_number2" name="menu_number2" value="" />
		
			<div class="col-md-6 well pages_height">
			<?php foreach($pages->result() as $p):?>
			<input type="checkbox" name="pages[]" value="<?php echo $p->url_name;?>"> <?php echo $p->name;?><br />
			<?php endforeach;?>
			</div>
			
			<div class="col-md-2 text-center" style="margin-top: 10%;">
			<h2><span class="glyphicon glyphicon-arrow-right"></span></h2>
			</div>
			
			<div class="col-md-2 text-center" style="margin-top: 12%;">
			<input type="submit" class="btn btn-lg btn-success" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
		</fieldset>
		<?php echo form_close();?>
		</div>
	</div>
</div>