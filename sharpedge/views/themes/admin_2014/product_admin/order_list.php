<table class="table table-striped text-size">
<thead>
<tr>
<th><?php echo $this->lang->line('label_name');?></th>
<th><?php echo $this->lang->line('label_order_num');?></th>
<th><?php echo $this->lang->line('label_total_amount');?></th>
<th><?php echo $this->lang->line('label_paid');?></th>
<th><?php echo $this->lang->line('label_status');?></th>
<th><?php echo $this->lang->line('label_controls');?></th>
</tr>
</thead>
<tbody>
<?php foreach($query->result() as $id):?>
<tr>
<td><?php echo $id->first_name;?></td>
<td><?php echo $id->last_name;?></td>
<td><?php echo $id->order_number?></td>
<td><?php echo $id->total_amount?></td>
<td><?php echo $id->paid?></td>
<td><?php echo $id->invoice_status?></td>
<td>
<a class="btn btn-default" href="<?php echo site_url();?>/product_admin/edit_order/<?php echo $id->id?>"><span class="glyphicon glyphicon-pencil"></span> View / <?php echo $this->lang->line('label_edit');?></a>
<a class="btn btn-danger" href="<?php echo site_url();?>/product_admin/delete_order/<?php echo $id->id?>" onClick="return confirm('Are you sure you want to Delete this item? You cannot restore it once it is deleted......')"><span class="glyphicon glyphicon-trash"></span> <?php echo $this->lang->line('label_delete');?></a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>