<?php 
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
<rss version="2.0">
    <channel>
    <title><?php echo $feed_name; ?></title>
    <link><?php echo $feed_url; ?></link>
    <description><?php echo $page_description; ?></description>
    <language><?php echo $page_language; ?></language>
    <webMaster><?php echo $creator_email; ?></webMaster>
    <generator>SharpEdge CMS</generator>
    <?php foreach($posts->result() as $entry): ?> 
    <item>
		<title><?php echo xml_convert($entry->name); ?></title>
		<link><?php echo site_url('news/comments/' . $entry->url_name) ?></link>
		<guid><?php echo site_url('news/comments/' . $entry->url_name) ?></guid>
		<description><![CDATA[<?php echo str_replace('', '', $entry->text); ?>]]></description>
<?php
$replace = "-0800";
$with = "GMT";
$mysql = $entry->date;
$unix = mysql_to_unix($mysql);
$timestamp = $unix;
$timezone = 'UTC';
$daylight_savings = 'FALSE';
$local = gmt_to_local($timestamp, $timezone, $daylight_savings);
?>
    <pubDate><?php $format = 'DATE_RSS'; $time = time($local);?><?php echo standard_date($format, $unix)?><?php // echo str_replace($replace, $with, $pubdate)?></pubDate>
	</item>    
    <?php endforeach; ?> 
    </channel>
</rss>