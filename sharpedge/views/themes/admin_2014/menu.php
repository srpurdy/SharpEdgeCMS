<script type="text/javascript">
$(document).ready(function()
{
	$.ajax(
	{
		url: "/updater/check_version_ajax",
		type: "GET",
		success: function(msg)
		{
			$('#se_version').html(msg);
		}
	})
	return false;
});
</script>
<?php $m_i = 0;?>
<?php foreach($admin_module_array->result() as $ama):?>
<?php
$module_name[$m_i] = $ama->name;
$module_lang[$m_i] = $this->lang->line('module_'.$ama->name);
$m_i++;
?>
<?php endforeach;?>
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		<a class="navbar-brand" href="<?php echo base_url();?>">SharpEdge</a>
		</div>
		
		<ul class="nav navbar-top-links navbar-right">
			<div class="nav navbar-right" id="alternative_languages">
			<?php echo alt_site_url();?>
			</div>
			
			<div class="version pull-left"><p><?php echo $this->lang->line('label_admin_menu_version');?> : <span id="se_version"></span></p>
			</div>
			
			<div class="version-btn pull-right">
			<a class="btn btn-success" style="margin-top:0px" href="<?php echo base_url();?>updater"><?php echo $this->lang->line('label_admin_menu_checkforupdates');?> </a>
			</div>
		</ul>
	</nav>
	<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
							<?php for($i = 0; $i <= count($module_name) -1; $i++):?>
							<?php if($module_name[$i] == 'dashboard'):?>
							<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>"><i class="fa fa-dashboard fa-fw"></i> <?php echo $module_lang[$i];?></a></li>
							<?php endif;?>
							<?php endfor;?>
							<li><a href="#"><i class="fa fa-edit fa-fw"></i> <?php echo $this->lang->line('label_admin_menu_content');?> <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
								<?php for($i = 0; $i <= count($module_name) -1; $i++):?>
								<?php if($module_name[$i] == 'widget_admin' OR $module_name[$i] == 'page_admin' OR $module_name[$i] == 'blog_admin' OR $module_name[$i] == 'gallery_admin' OR $module_name[$i] == 'slideshow_admin' OR $module_name[$i] == 'contact_admin' OR $module_name[$i] == 'product_admin' OR $module_name[$i] == 'download_admin' OR $module_name[$i] == 'user_admin'):?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>"><?php echo $module_lang[$i];?></a></li>
								<?php endif;?>
								<?php endfor;?>

								<li class="divider"></li>
								
								<?php for($i = 0; $i <= count($module_name) -1; $i++):?>
								<?php if($module_name[$i] == 'dashboard' OR $module_name[$i] == 'widget_admin' OR $module_name[$i] == 'page_admin' OR $module_name[$i] == 'blog_admin' OR $module_name[$i] == 'gallery_admin' OR $module_name[$i] == 'slideshow_admin' OR $module_name[$i] == 'contact_admin' OR $module_name[$i] == 'product_admin' OR $module_name[$i] == 'download_admin' OR $module_name[$i] == 'user_admin' OR $module_name[$i] == 'menu_admin' OR $module_name[$i] == 'module_admin' OR $module_name[$i] == 'template' OR $module_name[$i] == 'gateway_admin' OR $module_name[$i] == 'languages' OR $module_name[$i] == 'configuration' OR $module_name[$i] == 'updater' OR $module_name[$i] == 'log_admin' OR $module_name[$i] == 'tools_admin' OR $module_name[$i] == 'nav_admin'):?>
								<?php else:?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>"><?php echo $module_lang[$i];?></a></li>
								<?php endif;?>
								<?php endfor;?>
								</ul>
								<!--level_2-->
							</li>
							
							<li><a href="#"><i class="fa fa-files-o fa-fw"></i> <?php echo $this->lang->line('label_admin_menu_design');?> <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
								<?php for($i = 0; $i <= count($module_name) -1; $i++):?>
								<?php if($module_name[$i] == 'menu_admin' OR $module_name[$i] == 'template' OR $module_name[$i] == 'module_admin' OR $module_name[$i] == 'nav_admin'):?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>"><?php echo $module_lang[$i];?></a></li>
								<?php endif;?>
								<?php endfor;?>
								</ul>
							</li>
							
							<li><a href="#"><i class="fa fa-wrench fa-fw"></i> <?php echo $this->lang->line('label_admin_menu_utilites');?> <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
								<?php for($i = 0; $i <= count($module_name) -1; $i++):?>
								<?php if($module_name[$i] == 'tools_admin' OR $module_name[$i] == 'updater'):?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>"><?php echo $module_lang[$i];?></a></li>
								<?php endif;?>
								<?php if($module_name[$i] == 'log_admin'):?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>/spam_log"><?php echo $module_lang[$i];?></a></li>
								<?php endif;?>
								<?php if($module_name[$i] == 'dashboard'):?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>/updates">Change Log</a></li>
								<?php endif;?>
								<?php endfor;?>
								</ul>
							</li>
							
							<li><a href="#"><i class="fa fa-cog fa-fw"></i> <?php echo $this->lang->line('label_admin_menu_settings');?> <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
								<?php for($i = 0; $i <= count($module_name) -1; $i++):?>
								<?php if($module_name[$i] == 'configuration' OR $module_name[$i] == 'languages' OR $module_name[$i] == 'gateway_admin'):?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>"><?php echo $module_lang[$i];?></a></li>
								<?php endif;?>
								<?php endfor;?>
								</ul>
							</li>
				</ul>
							<!--level_1-->
			</div>
	</nav>