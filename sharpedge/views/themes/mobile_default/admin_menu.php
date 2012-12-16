<div id="adminNav">
<?php if($admin_logged_in == true OR $dashboard_read == 'Y'):?>
	<a class="btn btn-inverse" href="<?php echo site_url();?>/dashboard"><?php echo $this->lang->line('website_manage');?></a>
<?php endif;?>
<?php if($user_logged_in == true):?>
	<div class="pull-right">
	<a class="btn btn-inverse" href="<?php echo site_url();?>/auth/edit_profile"><?php echo $this->lang->line('edit_profile');?></a>
	<a class="btn btn-inverse" href="<?php echo site_url();?>/auth/logout"><?php echo $this->lang->line('logout');?></a>
	</div>
<?php endif;?>
</div>