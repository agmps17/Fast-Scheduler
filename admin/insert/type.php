<?php
session_start();


		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		
		$td=mysql_query("select * from school_detail where group_id=".$_SESSION ["group_id"])or die(mysql_error());
			if(mysql_num_rows($td)==0)
			die( header("location:../general_details.php?errmsg=fill these detail"));
		
		$row=mysql_fetch_array($td);
		$frequency= $row['frequency'];		
		$lectures= $row['number_lectures'];
		$break=$row['break_time'];
		
		if($_POST ["max_load"]>=($frequency*$lectures))
		die( header("location:../type_details.php?errmsg=max week load cannot exceed maximum limit"));
		
		if(($_POST ["max_load_day"]*$frequency)<$_POST ["max_load"])
		die( header("location:../type_details.php?errmsg=day max load is less than wat should be"));
		
		if(($_POST ["cont_load"]>$break)or($_POST ["cont_load"]>$_POST ["max_load_day"]))
		die( header("location:../type_details.php?errmsg=continuous load cannot exceed maximum limit"));
		
		$rs=mysql_query("select * from type_details where type='".$_POST['type']."' && group_id=".$_SESSION ["group_id"]."")or die(mysql_error());
		
		
		if(mysql_num_rows($rs)==0){		
		mysql_query("insert into type_details (type,week_max,day_max,cont,group_id) values('".$_POST ["type"]."','".$_POST ["max_load"]."','".$_POST ["max_load_day"]."','".$_POST ["cont_load"]."','".$_SESSION ["group_id"]."')") or die(mysql_error());
header("location:../type_details.php?submitted");		}
else
header("location:../type_details.php?errmsg=type already in the record");		















?>
