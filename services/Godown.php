<?php
	include('dbconn.php');

	$sql = "Select i.id, i.name from m_master i  where i.type='SOURCE' order by i.id";
	$result=mysql_query($sql);
	$events = array();									
	if(mysql_affected_rows()>0)
	{
		while($row=mysql_fetch_array($result))
		{
			$eventArray['id'] = $row['id'];
			$eventArray['name'] = $row['name'];
			$events[] = $eventArray;
		}

	}										
	echo json_encode($events);
?>