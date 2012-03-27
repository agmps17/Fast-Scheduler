<?php

session_start();

		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		
		
		$td=mysql_query("select * from school_detail where group_id=".$_SESSION ["group_id"])or die(mysql_error());
		if(mysql_num_rows($td)==0)
		die( header("location:general_details.php?errmsg=fill these detail"));
		$row=mysql_fetch_array($td);

		$frequency= $row['frequency'];		
		$lectures= $row['number_lectures'];
		$break=$row['break_time'];
		
		if($_POST['duration']>$break){
		
		$str="duration  cannot be greater than no. of lectures till break";
		header("location:../practical_details.php?errmsg=".$str);
		
		}
		
		
		
		
		
		mysql_query("replace into practical_details (sub_id,lab_id,duration,group_id) values('".$_POST['sub_id']."','".$_POST['lab_id']."','".$_POST['duration']."','".$_SESSION ["group_id"]."')") or die(mysql_error());

		header("location:../practical_details.php?submitted");





?>
