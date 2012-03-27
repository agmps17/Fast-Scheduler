<?php

session_start();

		mysql_connect("localhost","root","arpit") or die("first");
		mysql_select_db("timetable") or die ("second");
		
		$rs=mysql_query("select * from teacher_detail where (email_id='".$_REQUEST['email']."'&& teacher_id!=".$_REQUEST ["id"]." )&&group_id=".$_SESSION ["group_id"]."")or die(mysql_error());
	
	$ty=mysql_query("select type_id from type_details where type='".$_REQUEST['type']."'&& group_id=".$_SESSION ["group_id"]."")or die(mysql_error());
	$c=mysql_fetch_array($ty);



	if(mysql_num_rows($rs)==0){		
		
		mysql_query("replace into teacher_detail values('".$_REQUEST ["name"]."','".$_REQUEST ["id"]."','".$_REQUEST ["email"]."','".$c ["type_id"]."','".$_REQUEST ["address"]."','".$_REQUEST ["phoneno"]."','".$_REQUEST ["experience"]."','password','".$_SESSION ["group_id"]."','".$_REQUEST ["logInType"]."')") or die(mysql_error());
		
			
		

header("location:../teacher_details.php?submitted");


}

else
header("location:../teacher_details.php?errmsg=email-id already in the record");		

	










?>
