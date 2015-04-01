<div class="clearfix"></div><br />
	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
			<span class="sr-only">50% Complete</span>
		</div>
	</div>
	
<h3>Checking Server Software</h3>
<p>Please confirm below that you can safely run SharpEdge on your server.</p>

<h4>PHP Settings</h4>
<p>SharpEdge requires PHP <?php echo $php_min_version;?> or higher.</p>
<p class="result <?php echo ($php_acceptable) ? 'pass' : 'fail'; ?>">
	PHP Version: <strong><?php echo $php_version; ?></strong>.
	<?php if (!$php_acceptable): ?>
		<p>SharpEdge requires PHP <?php echo $php_min_version;?> or higher! Your version may not be supported!</p>
	<?php endif; ?>
</p>

<h4>MYSQL Settings</h4>
<p>Sharpedge requires MySQL 5.0 or higher.</p>

<!-- Server -->
<p class="result <?php echo ($mysql->server_version_acceptable) ? 'pass' : 'fail'; ?>">
	Server Version:<strong><?php echo $mysql->server_version; ?></strong>.
	<?php echo ($mysql->server_version_acceptable) ? '' : 'Your MySQL Version is not supported. SharpEdge requires MYSQL 5.0 or higher!'; ?>
</p>

<!-- Client -->
<p class="result <?php echo ($mysql->client_version_acceptable) ? 'pass' : 'fail'; ?>">
	Client Version:<strong><?php echo $mysql->client_version; ?></strong>.
	<?php echo ($mysql->client_version_acceptable) ? '' : 'Your MySQL version is not supported. SharpEdge requires MYSQL 5.0 or higher!' ; ?>
</p>

<h4>GD Settings</h4>
<p>SharpEdge requires GD Version 1.0 or higher.</p>

<p class="result <?php echo ($gd_acceptable) ? 'pass' : 'fail'; ?>">
	GD Version:<strong><?php echo $gd_version; ?></strong>.
	<?php if (!$gd_acceptable): ?>
		<p>GD may not be installed on your server, or isn't configured to run. SharpEdge required GD to modified uploaded images. Although you can use our software without GD it is suggested that this software is installed.</p>
	<?php endif; ?>
</p>

<h2>Summary</h2>
<?php if($step_passed === TRUE): ?>
	<span class="label label-success">
		Your server meets all the requirements to run SharpEdge, Go to the next step by pushing the button below.
	</span>
	<div class="clearfix"></div><br />
	<a class="btn btn-primary" id="next_step" href="user_info">User Information (Step 3)</a>
	
<?php elseif($step_passed == 'partial'): ?>
	<span class="label label-warning">
		Your server is missing the GD Library, it is suggested to install this library. You can proceed without it though.
	</span>
	<div class="clearfix"></div><br />
	<a class="btn btn-warning" id="next_step" href="user_info">User Information (Step 3)</a>
	
<?php else: ?>
	<span class="label label-danger">
		Sorry but your server does not meet the requirements to run SharpEdge. If you have root access to your server you can upgrade your software. Or contact your web host.
	</span>
	<div class="clearfix"></div><br />
		<a class="btn btn-danger" id="next_step" href="software_check">Retry</a>
<?php endif; ?>