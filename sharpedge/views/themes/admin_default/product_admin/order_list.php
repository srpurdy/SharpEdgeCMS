<table class="ui-state-default" id="admintb">
<thead>
<tr>
<th>Order#</th>
<th>Total</th>
<th>Paid?</th>
<th>Controls</th>
</tr>
</thead>
<tbody>
<?php foreach($query->result() as $id):?>
<tr>
<td><?=$id->order_number?></td>
<td><?=$id->total_amount?></td>
<td><?=$id->paid?></td>
<td><ul id="icons" class="ui-widget ui-helper-clearfix">
<li class="ui-state-default ui-corner-all" title="Edit"><a href="<?=site_url();?>/product_admin/edit_order/<?=$id->id?>"><span class="ui-icon ui-icon-pencil"></span></a></li>
<li title="Delete" class="ui-state-default ui-corner-all"><a href="<?=site_url();?>/product_admin/delete_order/<?=$id->id?>" onClick="return confirm('Are you sure you want to Delete this item? You cannot restore it once it is deleted......')"><span class="ui-icon ui-icon-trash"></span></a></li>
</ul></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>