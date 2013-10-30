<input type="hidden" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_protection" />
	<div class="tab-content">
		<div class="tab-pane active" id="tabs-1">
			
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
			<?php foreach($search_pages->result() as $row): ?>
			<tr>
			<td><?php echo $row->id?></td>
			<td><?php echo $row->name?><?php foreach($has_draft->result() as $hd):?><?php if($row->url_name == $hd->url_name AND $row->lang == $hd->lang):?><span class="label label-important"><?php echo $this->lang->line('label_has_draft');?></span><?php endif;?><?php endforeach;?></td>
			<td><?php echo $row->url_name?></td>
			<td><?php echo $row->lang?></td>
			<td>
			<a class="btn" href="<?php echo site_url();?>/page_admin/editpage/<?php echo $row->id?>"><i class="icon-pencil"></i> <?php echo $this->lang->line('label_edit');?></a>
			<a class="btn btn-danger" href="<?php echo site_url();?>/page_admin/deletepage/<?php echo $row->id?>" onClick="return confirm('Are you sure you want to Delete this item?')"><i class="icon-trash icon-white"></i> <?php echo $this->lang->line('label_delete');?></a>
			</td>
			</tr>
			<?php endforeach;?>
			</tbody>
			</table>
		</div>
	</div>