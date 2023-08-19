<?php
	date_default_timezone_set('Asia/Kolkata');

	include('dbconn.php');
	$json=$_REQUEST["orders"];

	if (get_magic_quotes_gpc()){
		$json = stripslashes($json);
	}
	//Decode JSON into an Array
	$data = json_decode($json);	
	for($i=0; $i<count($data) ; $i++)
	{
		$date = $data[$i]->odate;
		$time = $data[$i]->otime;
		$name = $data[$i]->name;
		$city = $data[$i]->city;
		$partyname = $data[$i]->partyname;
		$itemname = $data[$i]->itemname;
		$qty = $data[$i]->qty;
		$rate = $data[$i]->rate;
		$amount = $data[$i]->amount;
		$orderid = $data[$i]->orderid;
		$remarks = $data[$i]->remarks;
		$godown = $data[$i]->godown;
		$deldate = $data[$i]->deldate;
		$timestamp = date('Y-m-d H:i:s');
		$orderid_gen = $name . date('ymd') . str_pad($orderid, 5, "0", STR_PAD_LEFT);

		 $sql = "insert into orders (date,time,name,city,partyname,itemname,qty,rate,amount,orderid,remarks,godown,deldate,timestamp,orderid_gen) values ('$date','$time','$name','$city','$partyname','$itemname','$qty','$rate','$amount','$orderid','$remarks','$godown','$deldate','$timestamp','$orderid_gen')";
		 mysql_query($sql);	
	}	
	echo ("Success");
?>