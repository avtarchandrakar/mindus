<?php
	include('dbconn.php');

	$sql = "Select Category from rm_pricelist group by Category";
	$result=mysql_query($sql);
	$events = array();									
	if(mysql_affected_rows()>0)
	{
		while($row=mysql_fetch_array($result))
		{
			$eventArray['Category'] = $row['Category'];
			$events[] = $eventArray;
		}

	}										
	echo json_encode($events);
?>