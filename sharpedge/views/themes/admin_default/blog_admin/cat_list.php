<table class="table table-striped text-size">
<thead>
<tr>
<th><?php echo $this->lang->line('label_name');?></th>
<th><?php echo $this->lang->line('label_lang');?></th>
<th><?php echo $this->lang->line('label_controls');?></th>
</tr>
</thead>
<tbody>
<?php foreach($query->result() as $id):?>
<tr>
<td><?php echo $id->blog_cat?></td>
<td><?php echo $id->lang?></td>
<td>
<a class="btn" href="<?php echo site_url();?>/blog_admin/edit_category/<?php echo $id->id?>"><i class="icon-pencil"></i> <?php echo $this->lang->line('label_edit');?></a>
<a class="btn btn-danger" href="<?php echo site_url();?>/blog_admin/delete_category/<?php echo $id->id?>" onClick="return confirm('Are you sure you want to Delete this item? You cannot restore it once it is deleted......')"><i class="icon-trash icon-white"></i> <?php echo $this->lang->line('label_delete');?></a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>