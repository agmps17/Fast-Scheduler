<?php

session_start();

		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		
		$rs=mysql_query("select * from teacher_detail where (email_id='".$_REQUEST['email']."'&& teacher_id!=".$_REQUEST ["id"]." )&&group_id=".$_SESSION ["group_id"]."")or die(mysql_error());
	
	



	if(mysql_num_rows($rs)==0){		
		
		mysql_query("replace into teacher_detail(name,teacher_id,email_id,type_id,address,phonenumber,experience,password,group_id,login_type) values('".$_REQUEST ["name"]."','".$_REQUEST ["id"]."','".$_REQUEST ["email"]."','".$_REQUEST ["type"]."','".$_REQUEST ["address"]."','".$_REQUEST ["phoneno"]."','".$_REQUEST ["experience"]."','password','".$_SESSION ["group_id"]."','".$_REQUEST ["logInType"]."')") or die(mysql_error());
		
			
		

header("location:../view_teacher.php?submitted");


}

else
header("location:../teacher_details.php?errmsg=email-id already in the record");		

	










?>
