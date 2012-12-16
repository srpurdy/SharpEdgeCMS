<table class="table table-striped text-size">
<thead>
<tr>
<th>ID</th>
<th><?php echo $this->lang->line('label_name');?></th>
<th><?php echo $this->lang->line('label_controls');?></th>
</tr>
</thead>
<tbody>
<?php foreach($sets->result() as $row): ?>
<tr>
<td><?php echo $row->id?></td>
<td><?php echo $row->name?></td>
<td>
<a class="btn" href="<?php echo site_url();?>/widget_admin/manage_widget_groups/<?php echo $row->id?>"><i class="icon-th-list"></i> <?php echo $this->lang->line('manage_widgets');?></a>
<a class="btn" href="<?php echo site_url()?>/widget_admin/edit_group/<?php echo $row->id?>"><i class="icon-pencil"></i> <?php echo $this->lang->line('label_edit');?></a>
<a class="btn btn-danger" href="<?php echo site_url()?>/widget_admin/delete_group/<?php echo $row->id?>" onClick="return confirm('Are you sure you want to Delete this item?')"><i class="icon-trash icon-white"></i> <?php echo $this->lang->line('label_delete');?></a>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>