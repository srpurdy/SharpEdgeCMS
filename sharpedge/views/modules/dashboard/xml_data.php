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
<?php echo $chart_data ?>