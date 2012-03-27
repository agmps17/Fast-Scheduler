<?php

session_start();

		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		
		mysql_query("insert into sub_detail (name,sub_type,group_id,sub_load)values('".$_POST ["name"]."','".$_POST ["type"]."','".$_SESSION ["group_id"]."','".$_POST ["subload"]."')") or die(mysql_error());

header("location:../subject_details.php?submitted");













?>
