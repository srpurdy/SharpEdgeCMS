			<script type='text/javascript'>//<![CDATA[ 
			$(document).ready(function(){
			var fixHelperModified = function(e, tr) {
				var $originals = tr.children();
				var $helper = tr.clone();
				$helper.children().each(function(index)
				{
				  $(this).width($originals.eq(index).width())
				});
				return $helper;
			};

			$("#sort tbody").sortable({
				helper: fixHelperModified,
				update:function(event, ui) {
					var nav_sort = {
							csrf_sharpedgeV320: $("#csrf_protection").val(),
							sorts: JSON.stringify($("#sort tbody").sortable('toArray'))
						};
					$('#tabs-1').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
					$.ajax(
					{
					url: "<?php echo site_url();?>/menu_admin/nav_sort",
					type: "POST",
					data: nav_sort,
					success: function(msg)
					{
						$('#tabs-1').html(msg);
					}
					})
				}
				}
				).disableSelection();});
			//]]> 
			</script>
			<input type="hidden" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_protection" />
			<table id="sort" class="table table-striped text-size">
			<thead>
			<tr>
			<th>ID</th>
			<th><?php echo $this->lang->line('label_name');?></th>
			<th><?php echo $this->lang->line('label_parent');?></th>
			<th><?php echo $this->lang->line('label_sort');?></th>
			<th><?php echo $this->lang->line('label_hidden');?></th>
			<th><?php echo $this->lang->line('label_lang');?></th>
			<th><?php echo $this->lang->line('label_controls');?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($query->result() as $row): ?>
			<tr id="<?php echo $row->id;?>">
			<td><?php echo $row->id?></td>
			<td><?php echo $row->text?></td>
			<td><?php echo $row->parent_id?></td>
			<td><?php echo $row->orderfield?></td>
			<td><?php echo $row->hide?></td>
			<td><?php echo $row->lang?></td>
			<td>
			<a class="btn" href="<?php echo site_url();?>/menu_admin/editmenu/<?php echo $row->id?>"><i class="icon-pencil"></i> <?php echo $this->lang->line('label_edit');?></a>
			<a class="btn btn-danger" href="<?php echo site_url();?>/menu_admin/deletemenu/<?php echo $row->id?>" onClick="return confirm('Are you sure you want to Delete this item?')"><i class="icon-trash icon-white"></i> <?php echo $this->lang->line('label_delete');?></a>
			</td>
			</tr>
			<?php endforeach;?>
			</tbody>
			</table>