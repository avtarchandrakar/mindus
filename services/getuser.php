<?php
	include('dbconn.php');
	$username=$_REQUEST["username"];
	$password=$_REQUEST["password"];
	$password = md5($password);
	$sql = "Select * from m_user where username='$username' and password='$password'";
	$result=mysql_query($sql);
	$events = array();									
	if(mysql_affected_rows()>0)
	{
		if($row=mysql_fetch_array($result))
		{
			$eventArray['Message'] = "Success";
			$eventArray['UserName'] = $row['username'];
			$eventArray['Name'] = $row['name'];
			$eventArray['City'] = $row['type'];
			$events[] = $eventArray;
		}
	}										
	else{
		$eventArray['Message'] = "Failed";
		$eventArray['UserName'] = "";
		$eventArray['Name'] = "";
		$eventArray['City'] = "";
		$events[] = $eventArray;
	}
	echo json_encode($events);
?>