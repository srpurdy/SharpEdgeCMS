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
<?php if($ama->name == 'ckfinder_ci'):?>
<?php else:?>
<?php $this->load->config($ama->name.'_config');?>
<?php
$module_name[$m_i] = $ama->name;
$module_lang[$m_i] = $this->lang->line('module_'.$ama->name);
$m_i++;
?>
<?php endif;?>
<?php endforeach;?>
			
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner" style="padding:5px">
					<div class="container">
					 <a class="brand" href="<?php echo base_url();?>">SharpEdge</a>
					
						<a class="btn btn-navbar" data-toggle="collapse" data-target="#main_menu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</a>
						
						<div id="main_menu" class="nav-collapse collapse">
							<ul class="nav">
							<?php for($i = 0; $i <= count($module_name) -1; $i++):?>
							<?php if($module_name[$i] == 'dashboard'):?>
							<li><a class="btn-inverse" href="<?php echo site_url();?>/<?php echo $module_name[$i];?>"><?php echo $module_lang[$i];?></a></li>
							<?php endif;?>
							<?php endfor;?>
							<li class="dropdown"><a class="btn-inverse" href="#">Content <b class="caret"></b></a>
								<ul class="dropdown-menu">
								<?php for($i = 0; $i <= count($module_name) -1; $i++):?>
								<?php if($module_name[$i] == 'widget_admin' OR $module_name[$i] == 'page_admin' OR $module_name[$i] == 'blog_admin' OR $module_name[$i] == 'gallery_admin' OR $module_name[$i] == 'slideshow_admin' OR $module_name[$i] == 'contact_admin' OR $module_name[$i] == 'product_admin' OR $module_name[$i] == 'download_admin' OR $module_name[$i] == 'user_admin'):?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>"><?php echo $module_lang[$i];?></a></li>
								<?php endif;?>
								<?php endfor;?>

								<li class="divider"></li>
								
								<?php for($i = 0; $i <= count($module_name) -1; $i++):?>
								<?php if($module_name[$i] == 'dashboard' OR $module_name[$i] == 'widget_admin' OR $module_name[$i] == 'page_admin' OR $module_name[$i] == 'blog_admin' OR $module_name[$i] == 'gallery_admin' OR $module_name[$i] == 'slideshow_admin' OR $module_name[$i] == 'contact_admin' OR $module_name[$i] == 'product_admin' OR $module_name[$i] == 'download_admin' OR $module_name[$i] == 'user_admin' OR $module_name[$i] == 'menu_admin' OR $module_name[$i] == 'module_admin' OR $module_name[$i] == 'template' OR $module_name[$i] == 'gateway_admin' OR $module_name[$i] == 'languages' OR $module_name[$i] == 'configuration' OR $module_name[$i] == 'updater' OR $module_name[$i] == 'log_admin'):?>
								<?php else:?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>"><?php echo $module_lang[$i];?></a></li>
								<?php endif;?>
								<?php endfor;?>
								</ul>
								<!--level_2-->
							</li>
							
							<li class="dropdown"><a class="btn-inverse" href="#">Design <b class="caret"></b></a>
								<ul class="dropdown-menu">
								<?php for($i = 0; $i <= count($module_name) -1; $i++):?>
								<?php if($module_name[$i] == 'menu_admin' OR $module_name[$i] == 'template' OR $module_name[$i] == 'module_admin'):?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>"><?php echo $module_lang[$i];?></a></li>
								<?php endif;?>
								<?php endfor;?>
								</ul>
							</li>
							
							<li class="dropdown"><a class="btn-inverse" href="#">Utilites <b class="caret"></b></a>
								<ul class="dropdown-menu">
								<?php for($i = 0; $i <= count($module_name) -1; $i++):?>
								<?php if($module_name[$i] == 'license' OR $module_name[$i] == 'updater'):?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>"><?php echo $module_lang[$i];?></a></li>
								<?php endif;?>
								<?php if($module_name[$i] == 'log_admin'):?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>/spam_log"><?php echo $module_lang[$i];?></a></li>
								<?php endif;?>
								<?php endfor;?>
								</ul>
							</li>
							
							<li class="dropdown"><a class="btn-inverse" href="#">Settings <b class="caret"></b></a>
								<ul class="dropdown-menu">
								<?php for($i = 0; $i <= count($module_name) -1; $i++):?>
								<?php if($module_name[$i] == 'configuration' OR $module_name[$i] == 'languages' OR $module_name[$i] == 'gateway_admin'):?>
								<li><a href="<?php echo site_url();?>/<?php echo $module_name[$i];?>"><?php echo $module_lang[$i];?></a></li>
								<?php endif;?>
								<?php endfor;?>
								</ul>
							</li>
							</ul>
							<!--level_1-->
							
							<ul class="nav pull-right" style="padding-top:4px;">
							<div id="alternative_languages">
							<?php echo alt_site_url();?>
							</div>
							<div class="se_version pull-left" style="margin-right:10px;">Version: <span id="se_version"></span>
							</div>
							<div class="pull-right">
							<a class="btn btn-inverse" style="margin-top:0px" href="<?php echo base_url();?>updater">Check For Updates</a>
							</div>
							</ul>
						</div>
					</div>
				</div>
			</div>