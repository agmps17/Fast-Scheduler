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
		
		
	if($_POST['frequency']<$frequency){

		
		
		
		
		
		mysql_query("replace into practical_combination (sub_id,class_id,week_frequency,group_id) values('".$_POST['subject_name']."','".$_POST['class_id']."','".$_POST['frequency']."','".$_SESSION ["group_id"]."')") or die(mysql_error());

		
		$sq=mysql_query("select *  from practical_combination where sub_id=".$_POST['subject_name']." && class_id=".$_POST['class_id']." && group_id=".$_SESSION ["group_id"]."")or die (mysql_error());
		$gq=mysql_fetch_array($sq);
		
		$index= $gq['set'];
		
		
		$i=0;
		while(true)
		{
		$i++;
		$k="subject_name".$i;
		
		if(isset($_POST[$k])){
		
		
			mysql_query("replace into practical_combination (sub_id,class_id,week_frequency,group_id,`set`) values('".$_POST[$k]."','".$_POST['class_id']."','".$_POST['frequency']."','".$_SESSION ["group_id"]."','".$index."')") or die(mysql_error());	
				
				}
		else
			break;
		
		
		
		}
		
		
		
		
		
		header("location:../practical_distribution.php?submitted");
		
	}
	else{
	$str="week frequency cannot be greater than working days";
	header("location:../practical_distribution.php?errmsg=".$str);
		}


?>