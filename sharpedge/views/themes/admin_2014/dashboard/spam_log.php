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