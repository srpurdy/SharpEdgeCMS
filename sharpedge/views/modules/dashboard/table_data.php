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


<div class="clear"></div>