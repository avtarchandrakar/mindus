<?php
	include('dbconn.php');

	$sql = "Select i.id, i.name, i.mrp as rate_a from m_item i, m_master m where i.group_id=m.id order by i.id";
	$result=mysql_query($sql);
	$events = array();									
	if(mysql_affected_rows()>0)
	{
		while($row=mysql_fetch_array($result))
		{
			$eventArray['id'] = $row['id'];
			$eventArray['name'] = $row['name'];
			$eventArray['rate_a'] = $row['rate_a'];
			$eventArray['groupname'] = 'ALL';
			$events[] = $eventArray;
		}

	}										
	echo json_encode($events);
?>