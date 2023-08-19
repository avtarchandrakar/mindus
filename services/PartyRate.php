<?php
	include('dbconn.php');
	$city=$_REQUEST["city"];

	$sql = "SELECT l.name AS partyname,l.city, m.name AS groupname, p.amount, p.per FROM tbl_partyrate p, m_ledger l, m_master m WHERE (p.ledger_id=l.id) AND (p.item_id=m.id) and l.city='$city'";
	$result=mysql_query($sql);
	$events = array();									
	if(mysql_affected_rows()>0)
	{
		while($row=mysql_fetch_array($result))
		{
			$eventArray['partyname'] = $row['partyname'];
			$eventArray['city'] = $row['city'];
			$eventArray['groupname'] = $row['groupname'];
			$eventArray['amount'] = $row['amount'];
			$eventArray['per'] = $row['per'];
			$events[] = $eventArray;
		}

	}										
	echo json_encode($events);
?>