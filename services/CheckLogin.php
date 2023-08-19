<?php
	include('dbconn.php');

	$mobileno = $_REQUEST["mobileno"];

	$sql = "Select * from rm_customer where MobileNo='$mobileno'";
	$result=mysql_query($sql);
	$events = array();									
	if(mysql_affected_rows()>0)
	{
		while($row=mysql_fetch_array($result))
		{
			$eventArray['Message'] = "Success";
			$eventArray['Name'] =  $row['Name'];
			$events[] = $eventArray;
		}

	}										
	else{
			$eventArray['Message'] = "Failed";
			$eventArray['Name'] =  "";
			$events[] = $eventArray;

	}
	echo json_encode($events);
?>