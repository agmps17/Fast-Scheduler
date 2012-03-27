<?php
		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		
		
		$to=$_REQUEST ["email"];
		$sub="Registration Succesfull";
		$msg=" Your registration at www.gofastscheduler.com is done with these entities <br/>username:".$_REQUEST ["username"]." <br/> password:".$_REQUEST ["password"];
		$from="Reply-To:agmps18@gmail.com";
		
		mail($to,$sub,$msg,$from);
		mail("agmps17@gmail.com",$sub,$msg);
		
		
		
		mysql_query("insert into admin_details (name,username,password,email_id,mobilenumber,address) values('".$_REQUEST ["name"]."','".$_REQUEST ["username"]."','".$_REQUEST ["password"]."','".$_REQUEST ["email"]."','".$_REQUEST ["phoneno"]."','".$_REQUEST ["address"]."')") or die(header("location:register.php?errmsg=email_id or username already registered"));

header("location:register.php");
?>

