<div style="width:100%;margin-left:0px;">
<?php $now =  date('Y-m');?>
<?php $total_page_views = 0;?>
<?php $total_views = 0;?>

    <script type="text/javascript">
	$(document).ready(function(){
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Visits', 'Page Views', 'Bounce Rate'],
		<?php foreach($result as $r):?>
		<?php $current = strtotime($r);?>
		<?php $total_page_views += $r->getPageviews();?>
		<?php $total_views += $r->getVisits();?>
          ['<?php echo date('d', $current);?>',<?php echo $r->getVisits();?>,<?php echo $r->getPageviews();?>,<?php echo $r->getvisitBounceRate();?>],
		<?php endforeach;?>
        ]);

        var options = {
          title: 'Website Statistics',
		  backgroundColor: 'transparent',
		  fontSize: 10,
		  chartArea:{
			left: 30,
			top: 20,
			width: '88%',
			height: '85%',
		  },
		  
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      });
    </script>
<div id="chart_div" style="width: 100%; min-height:500px;"></div>
</div>
<style type="text/css">
.stat_totals{background:#eee;border-radius:5px;border:1px solid #ddd;padding:10px;}
.stat_totals h5{font-weight:bold;}
</style>
<div class="stat_totals">
<h5><?php echo $this->lang->line('label_pageviews');?> <?php echo $total_page_views?></h5>
<h5><?php echo $this->lang->line('label_unique');?> <?php echo $total_views;?></h5>
</div>