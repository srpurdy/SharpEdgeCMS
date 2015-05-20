<div class="clearfix"></div>
<ul class="breadcrumb se_breadcrumb">  
	<li>
	<a href="<?php echo site_url();?>">Home</a> <span class="divider">></span>
	</li>
<?php $i = 0;?>
<?php $total_bc = count($breadcrumbs->result());?>
<?php foreach($breadcrumbs->result() as $bc):?>
<?php $i++;?>
<?php if($total_bc == $i):?>
<?php break;?>
<?php else:?>
<?php if($this->config->item('short_url') == 1)
	{
	$page_link = str_replace('pages/view/', '', $bc->page_link);
	}
else
	{
	$page_link = $bc->page_link;
	}
?>
<li>
<a href="<?php echo site_url();?>/<?php echo $page_link;?>"><?php echo $bc->text;?></a> <span class="divider">></span>
</li>
<?php endif;?>
<?php endforeach;?>
<?php if($breadcrumbs->result()):?>
<?php if ($bc === end($breadcrumbs->result())):?>
<li class="active"><?php echo $bc->text;?></li>
<?php endif;?>
<?php endif;?>
</ul>