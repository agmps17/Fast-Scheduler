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
		
		if($_REQUEST ["max_load"]>=($frequency*$lectures))
		die( header("location:../type_details.php?errmsg=max week load cannot exceed maximum limit"));
		
		if(($_REQUEST ["max_load_day"]*$frequency)<$_REQUEST ["max_load"])
		die( header("location:../type_details.php?errmsg=day max load is less than wat should be"));
		
		if(($_REQUEST ["cont_load"]>$break)or($_REQUEST ["cont_load"]>$_REQUEST ["max_load_day"]))
		die( header("location:../type_details.php?errmsg=continuous load cannot exceed maximum limit"));
		
		
		$rs=mysql_query("select * from type_details where (type='".$_REQUEST['type']."'&& type_id!=".$_REQUEST ["type_id"].") && group_id=".$_SESSION ["group_id"]."")or die(mysql_error());
		
		
		if(mysql_num_rows($rs)==0){		
		mysql_query("replace into type_details (type,week_max,day_max,cont,group_id,type_id) values('".$_REQUEST ["type"]."','".$_REQUEST ["max_load"]."','".$_REQUEST ["max_load_day"]."','".$_REQUEST ["cont_load"]."','".$_SESSION ["group_id"]."','".$_REQUEST ["type_id"]."')") or die(mysql_error());
header("location:../type_details.php?submitted");		




}
else
header("location:../type_details.php?errmsg=type already in the record");		

?>
