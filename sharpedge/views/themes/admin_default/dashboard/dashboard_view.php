<h3><?php echo $this->lang->line('label_analytics');?></h3>
<p>Disabled Until New API Availability.<?/*<iframe src="<?php echo site_url();?>/dashboard/main" width="100%" height="600" frameborder="0" border="0" cellspacing="0"></iframe>*/?></p>

<h3><?php echo $this->lang->line('label_change_log');?></h3>
<?php echo modules::run('dashboard/updates');?>