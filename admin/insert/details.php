<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../index.php?errmsg=YOU ARE UNAUTHORISED");



?>




<?php
session_start();


		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		
		
		
		
		
			
		mysql_query("replace into school_detail (name,address,phonenumber,frequency,number_lectures,break_time,group_id) values('".$_POST ["name"]."','".$_POST ["address"]."','".$_POST ["phoneno"]."','".$_POST ["frequency"]."','".$_POST ["lectures"]."','".$_POST ["break"]."','".$_SESSION ["group_id"]."')") or die(mysql_error());
header("location:../general_details.php?submitted");		

		
		
		$name1="class_timetable_".$_SESSION ["group_id"];
		$name2="teacher_timetable_".$_SESSION ["group_id"];
		$name3="lab_timetable_".$_SESSION ["group_id"];
		
		mysql_query("drop table ".$name1);
		mysql_query("drop table ".$name2);
		mysql_query("drop table ".$name3);
		
		$str="";
		for($i=1;$i<=$_POST ["lectures"];$i++){
		
		$str=$str."`period".$i."` int(11) Null, ";
		
		}
		
		
		
		
		
		$s1="CREATE TABLE ".$name1."(class_id int(11) NOT NULL,section_id int(11) NOT NULL,".$str."day_id int(11) NOT NULL,primary key(class_id,day_id,section_id))";
		
		$s2="CREATE TABLE ".$name2."(teacher_id int(11) NOT NULL,".$str."day_id int(11) NOT NULL,primary key(teacher_id,day_id))";
		$s3="CREATE TABLE ".$name3."(lab_id int(11) NOT NULL,".$str."day_id int(11) NOT NULL,primary key(lab_id,day_id))";
		
		mysql_query($s1);
		mysql_query($s2);
		mysql_query($s3); 














?>
