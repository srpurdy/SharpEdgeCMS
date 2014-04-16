<p>
<?php
ob_start();
phpinfo(INFO_GENERAL);
$pinfo = ob_get_contents();
ob_end_clean();
 
$pinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
$pinfo = str_replace('width="600"', 'class="table table-striped text-size"' ,$pinfo);
echo $pinfo;
?>
</p>