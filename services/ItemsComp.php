<?php
	include('dbconn.php');
	$company=$_REQUEST["Company"];
	$mobileno=$_REQUEST["MobileNo"];
	$grade="A";
	$sql = "Select Grade from rm_customer where MobileNo='$mobileno'";
	$result=mysql_query($sql);
	if(mysql_affected_rows()>0)
	{
		if($row=mysql_fetch_array($result))
		{
			$grade=$row["Grade"];
		}
	}


	$pdate='';
	$sql = "Select pDate from rm_pricelist order by pDate desc";
	$result=mysql_query($sql);
	if(mysql_affected_rows()>0)
	{
		if($row=mysql_fetch_array($result))
		{
			$pdate=$row["pDate"];
		}
	}

	$sql = "Select Item,RateA,RateB,RateC,RateD,RateE from rm_pricelist where Company='$company' and pDate='$pdate' Group By Item,RateA,RateB,RateC,RateD,RateE order by Item";
	$result=mysql_query($sql);
	$events = array();									
	if(mysql_affected_rows()>0)
	{
		while($row=mysql_fetch_array($result))
		{
			$eventArray['Item'] = $row['Item'];
			if($grade=="A")
			{
				$eventArray['Rate'] = $row['RateA'];
			}
			if($grade=="B")
			{
				$eventArray['Rate'] = $row['RateB'];
			}
			if($grade=="C")
			{
				$eventArray['Rate'] = $row['RateC'];
			}
			if($grade=="D")
			{
				$eventArray['Rate'] = $row['RateD'];
			}
			if($grade=="E")
			{
				$eventArray['Rate'] = $row['RateE'];
			}
			$events[] = $eventArray;
		}

	}										
	echo json_encode($events);
?>