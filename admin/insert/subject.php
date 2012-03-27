<?php

session_start();

		mysql_connect("localhost","root","arpit") or die("first");
		mysql_select_db("timetable") or die ("second");
		
		mysql_query("insert into sub_detail (name,sub_type,group_id)values('".$_REQUEST ["name"]."','".$_REQUEST ["type"]."','".$_SESSION ["group_id"]."')") or die("third");

header("location:../subject_details.php?submitted");













?>
