<?php

session_start();

		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		
		
		
	
		
		mysql_query("insert into labs(name,teacher_id,group_id)values('".$_POST ["labname"]."','".$_POST['teacher_id']."','".$_SESSION ["group_id"]."')") or die(mysql_error());

header("location:../lab_details.php?submitted");













?>
