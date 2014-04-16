<table class="table table-striped text-size">
<thead>
<tr>
<th>ID</th>
<th><?php echo $this->lang->line('label_name');?></th>
<th><?php echo $this->lang->line('label_url_title');?></th>
<th><?php echo $this->lang->line('label_lang');?></th>
<th><?php echo $this->lang->line('label_controls');?></th>
</tr>
</thead>
<tbody>
<?php foreach($query->result() as $row): ?>
<tr>
<td><?php echo $row->id?></td>
<td><?php echo $row->name?><?php foreach($has_page->result() as $hp):?><?php if($row->url_name == $hp->url_name AND $row->lang == $hp->lang):?><span class="label label-success"><?php echo $this->lang->line('label_has_page');?></span><?php endif;?><?php endforeach;?></td>
<td><?php echo $row->url_name?></td>
<td><?php echo $row->lang?></td>
<td>
<a class="btn btn-default" href="<?php echo site_url();?>/page_admin/edit_draft/<?php echo $row->id?>"><span class="glyphicon glyphicon-pencil"></span> <?php echo $this->lang->line('label_edit');?></a>
<a class="btn btn-danger" href="<?php echo site_url();?>/page_admin/delete_draft/<?php echo $row->id?>" onClick="return confirm('Are you sure you want to Delete this item?')"><span class="glyphicon glyphicon-trash"></span> <?php echo $this->lang->line('label_delete');?></a>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>