<?php
	include "connection/connection.php";
	$sql = "select * from company_master";
	$rec = mysql_query($sql);
	while($res = mysql_fetch_assoc($rec))
	echo $res['company_name'];
?>