<?php
	$conn = mysql_connect("jasmine.arvixe.com","atul_entp","Atul@987");

	if( $conn ) {
		mysql_select_db("atul_entp");
	}else{
	     echo "Connection could not be established.<br />";
	     die( print_r( sqlsrv_errors(), true));
	}
?>