<?php
		mysql_connect("localhost","root","arpit") or die("first");
		mysql_select_db("timetable") or die ("second");
		
		mysql_query("insert into admin_details (name,username,password,email_id,mobilenumber,address) values('".$_REQUEST ["name"]."','".$_REQUEST ["username"]."','".$_REQUEST ["password"]."','".$_REQUEST ["email"]."','".$_REQUEST ["phoneno"]."','".$_REQUEST ["address"]."')") or die(mysql_error());

header("location:register.php");
?>

