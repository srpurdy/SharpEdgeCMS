	<ul class="nav nav-tabs remove_underline" id="tabs">
		<li class="active"><a href="#tabs-1" data-toggle="tab"><?php echo $this->lang->line('label_spam_log');?></a></li>
	</ul>
	
	<div class="tab-content">		
		<div class="tab-pane active" id="tabs-1">
		<a class="btn btn-danger" href="<?php echo site_url();?>/log_admin/delete_spam_log" onClick="return confirm('Are you sure you want to Delete this item?')"><i class="icon-trash icon-white"></i> <?php echo $this->lang->line('label_clear_log');?></a>
			<table class="table table-striped text-size">
			<thead>
			<tr>
			<th>ID</th>
			<th><?php echo $this->lang->line('label_email');?></th>
			<th><?php echo $this->lang->line('label_ip_address');?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($query->result() as $row): ?>
			<tr>
			<td><?php echo $row->id?></td>
			<td><?php echo $row->email?></td>
			<td><?php echo $row->ip_address?></td>
			</tr>
			<?php endforeach;?>
			</tbody>
			</table>
		</div>
	</div>