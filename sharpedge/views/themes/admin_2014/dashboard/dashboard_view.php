<?php if($this->config->item('profile_id') == ''):?>
<?php else:?>
<div class="col-lg-12 remove_margin">
    <div class="panel panel-default">
		<div class="panel-heading">
<?php echo $this->lang->line('label_analytics');?>
		</div>
		<div class="panel-body">
<?php echo modules::run('dashboard/analytics');?>
		</div>
    </div>
</div>
<?php endif;?>

<div class="col-lg-7 remove_margin">
	<div class="panel panel-default">
		<div class="panel-heading">
<?php echo $this->lang->line('label_quick_post');?>
		</div>
		<div class="panel-body">
<?php echo modules::run('dashboard/add_news');?>
		</div>
    </div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
<?php echo $this->lang->line('label_add_a_page');?>
		</div>
		<div class="panel-body">
<?php echo modules::run('dashboard/add_page');?>
		</div>
	</div>
</div>


<div class="col-lg-5 remove_margin pull-right">

    <div class="panel panel-default">
		<div class="panel-heading">
<?php echo $this->lang->line('label_latest_comments');?>
		</div>
		<div class="panel-body">
<?php echo modules::run('dashboard/latest_comments');?>
		</div>
    </div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
		<?php echo $this->lang->line('label_spam_log');?>
		</div>
		<div class="panel-body">
<?php echo modules::run('dashboard/spam_log');?>
		</div>
    </div>
</diV>