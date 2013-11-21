<?php if($user_logged_in == true):?>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
				
					<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target="#admin_menu" type="button">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					</div>
					
					<nav id="admin_menu" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
<?php if($admin_logged_in == true OR $dashboard_read == 'Y'):?>
							<li><a href="<?php echo site_url();?>/dashboard"><?php echo $this->lang->line('website_manage');?></a></li>
<?php endif;?>
<?php if($user_logged_in == true):?>
							<li><a href="<?php echo site_url();?>/auth/edit_profile"><?php echo $this->lang->line('edit_profile');?></a></li>
							<li><a href="<?php echo site_url();?>/auth/logout"><?php echo $this->lang->line('logout');?></a></li>
<?php endif;?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
<?php endif;?>
