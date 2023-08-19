<?php
	include('dbconn.php');

	$sql = "Select Company from rm_pricelist group by Company";
	$result=mysql_query($sql);
	$events = array();									
	if(mysql_affected_rows()>0)
	{
		while($row=mysql_fetch_array($result))
		{
			$eventArray['Company'] = $row['Company'];
			$events[] = $eventArray;
		}

	}										
	echo json_encode($events);
?>