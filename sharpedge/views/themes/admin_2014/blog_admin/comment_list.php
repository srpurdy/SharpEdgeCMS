<table class="table table-striped text-size">

	<thead>
		<tr>
			<th>ID</th>
			<th><?php echo $this->lang->line('blog_posted_by');?></th>
			<th><?php echo $this->lang->line('label_message');?></th>
			<th><?php echo $this->lang->line('label_active');?></th>
			<th><?php echo $this->lang->line('label_controls');?></th>
		</tr>
	</thead>
	
	<tbody>
<?php $chars = '125';?>
<?php foreach($show_comments->result() as $comm):?>
		<tr>
			<td><?php echo $comm->comment_id?></td>
			<td><?php echo $comm->postedby?></td>
			<td><?php echo substr($comm->message,0,$chars);?></td>
			<td><?php echo $comm->active?></td>
			<td>
			<a class="btn btn-default" href="<?php echo site_url();?>/blog_admin/edit_comment/<?php echo $comm->comment_id?>"><span class="glyphicon glyphicon-pencil"></span> <?php echo $this->lang->line('label_edit');?></a>
			<a class="btn btn-danger" href="<?php echo site_url();?>/blog_admin/delete_comment/<?php echo $comm->comment_id?>" onClick="return confirm('Are you sure you want to Delete this item? You cannot restore it once it is deleted......')"><span class="glyphicon glyphicon-trash"></span> <?php echo $this->lang->line('label_delete');?></a>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
	
</table>