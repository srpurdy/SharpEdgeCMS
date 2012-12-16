<?
function array_average($array)
{
 return array_sum($array) / count($array);
}

function graph($aData){
    
	if(!count($aData)) return;
	
	$aData = array_slice($aData,0,6);

    echo '<table>';
    foreach($aData as $sKey => $sValue){
        echo '  <tr style="font-size:10px;color:#555555">
                    <td style="padding-right:10px"><span style="cursor:help" title="'.addslashes($sKey).'">' . character_limiter($sKey,100) . '</span></td>
                    <td style="color:#252525">' . $sValue . '</td>
                </tr>';
    }
    echo '</table>';
}

?>

<div id="linechart" style="width:918px"></div>

<div class="dashboard_box dashboard_focus">
<div style="height:17px"></div>
<p style=""><span style="font-size:18px; font-weight:bold"><?php echo array_sum(array_values($visitors)); ?></span> Visits</p>
<p style=""><span style="font-size:18px; font-weight:bold"><?php echo array_sum(array_values($pageviews)); ?></span> Page views</p>
<p style=""><span style="font-size:18px; font-weight:bold"><?php echo round(array_average(array_values($visitsperhour)),2); ?></span> Pages/hour</p>
</div>



<div class="dashboard_box ">
<p style="font-weight:bold">Referrers:</p>
<?php graph($referrers); ?>
</div>

<div class="dashboard_box">
<p style="font-weight:bold">Search words:</p>
<?php graph($searchwords); ?>
</div>

<div class="dashboard_box dashboard_box_large">
<p style="font-weight:bold">Browsers:</p>
<?php graph($browsers); ?>
</div>

<div class="dashboard_box dashboard_box_small">
<p style="font-weight:bold">OS:</p>
<?php graph($os); ?>
</div>

<div class="dashboard_box">
<p style="font-weight:bold">Screen resolutions:</p>
<?php graph($screenresolutions); ?>
</div>

<?php
	$chart_data = '<chart>';
	$chart_data .= '<series>';
	
	foreach($visitors as $sKey => $sValue)
	{
		$chart_data .= '<value xid="'.$sKey.'">'.date("D j M", mktime(0, 0, 0, $month, $sKey, $year)).'</value>';
	}
	
	$chart_data .= '</series>';
	
	$chart_data .= '<graphs>';
	$chart_data .= '<graph gid="1">';
	
	foreach($visitors as $sKey => $sValue)
	{
		$chart_data .= '<value xid="'.$sKey.'">'.$sValue.'</value>';
	}
	
	$chart_data .= '</graph>';
	
	$chart_data .= '<graph gid="2">';
	
	foreach($pageviews as $sKey => $sValue)
	{
		$chart_data .= '<value xid="'.$sKey.'">'.$sValue.'</value>';
	}
	
	$chart_data .= '</graph>';
	
	$chart_data .= '</graphs>';
	
	$chart_data .= '</chart>';
?>


<script type="text/javascript">
	// <![CDATA[	
		var so = new SWFObject("<?php echo base_url()?>assets/static/swf/backend/amcharts/amline.swf", "linechart", "100%", "250", "8", "#FFFFFF");
		//so.addVariable("data_file", encodeURIComponent("<?php echo base_url()?>../assets/static/swf/backend/amcharts/amline_data.xml"));
		so.addVariable("settings_file", encodeURIComponent("<?php echo base_url()?>assets/static/swf/backend/amcharts/amline_settings.xml"));
		so.addVariable("chart_data", encodeURIComponent('<?php echo $chart_data?>'));
		so.addVariable("path", '<?php echo base_url()?>');
		so.write("linechart");		
	// ]]>
</script>