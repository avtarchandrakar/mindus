<?php
	include('dbconn.php');

	$sql = "Select * from mis_suyash order by SortNo,Particular";
	$result=mysql_query($sql);
	$events = array();									
	if(mysql_affected_rows()>0)
	{
		while($row=mysql_fetch_array($result))
		{
			$eventArray['SortNo'] = $row['SortNo'];
			$eventArray['Particular'] =  $row['Particular'];
			$eventArray['Name'] = $row['Name'];
			$eventArray['NOS'] = $row['NOS'];
			$eventArray['Amount'] = $row['Amount'];
			$eventArray['Paid'] = $row['Paid'];
			$eventArray['Balance'] = $row['Balance'];
			$eventArray['uDateTime'] = $row['uDateTime'];
			$events[] = $eventArray;
		}

	}										
	echo json_encode($events);
?>