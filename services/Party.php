<?php
	include('dbconn.php');
	$city=$_REQUEST["city"];

	$sql = "Select id,name,district as city,mobilenosms as mobileno,address from m_ledger order by id";
	$result=mysql_query($sql);
	$events = array();									
	if(mysql_affected_rows()>0)
	{
		while($row=mysql_fetch_array($result))
		{
			$eventArray['id'] = $row['id'];
			$eventArray['name'] = $row['name'];
			$eventArray['city'] = $row['city'];
			$eventArray['mobileno'] = $row['mobileno'];
			$eventArray['address'] = $row['address'];
			$events[] = $eventArray;
		}

	}										
	echo json_encode($events);
?>