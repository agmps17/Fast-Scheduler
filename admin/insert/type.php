<?php
session_start();


		mysql_connect("localhost","root","arpit") or die("first");
		mysql_select_db("timetable") or die ("second");
		
		
		$rs=mysql_query("select * from type_details where type='".$_REQUEST['type']."' && group_id=".$_SESSION ["group_id"]."")or die(mysql_error());
		
		
		if(mysql_num_rows($rs)==0){		
		mysql_query("insert into type_details (type,week_max,week_min,day_max,cont,group_id) values('".$_REQUEST ["type"]."','".$_REQUEST ["max_load"]."','".$_REQUEST ["min_load"]."','".$_REQUEST ["max_load_day"]."','".$_REQUEST ["cont_load"]."','".$_SESSION ["group_id"]."')") or die(mysql_error());
header("location:../type_details.php?submitted");		}
else
header("location:../type_details.php?errmsg=type already in the record");		















?>
