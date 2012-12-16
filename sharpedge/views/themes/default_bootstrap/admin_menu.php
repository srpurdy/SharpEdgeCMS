<?php if($user_logged_in == true):?>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
				
					<a class="btn btn-navbar" data-toggle="collapse" data-target="#admin_menu">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>
					
					<div id="admin_menu" class="nav-collapse collapse">
						<ul class="nav">
<?php if($admin_logged_in == true OR $dashboard_read == 'Y'):?>
							<li><a href="<?php echo site_url();?>/dashboard"><?php echo $this->lang->line('website_manage');?></a></li>
<?php endif;?>
<?php if($user_logged_in == true):?>
							<li><a href="<?php echo site_url();?>/auth/edit_profile"><?php echo $this->lang->line('edit_profile');?></a></li>
							<li><a href="<?php echo site_url();?>/auth/logout"><?php echo $this->lang->line('logout');?></a></li>
<?php endif;?>
						</ul>
					</div>
				</div>
			</div>
		</div>
<?php endif;?>
