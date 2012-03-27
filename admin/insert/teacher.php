<?php

session_start();

	include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		
	$rs=mysql_query("select * from teacher_detail where email_id='".$_POST['email']."'")or die(mysql_error());
	



if(mysql_num_rows($rs)==0){		
		
		mysql_query("insert into teacher_detail (name,email_id,type_id,address,phonenumber,experience,password,group_id,login_type)
		values('".$_POST ["name"]."','".$_POST ["email"]."','".$_POST ["type"]."','".$_POST ["address"]."','".$_POST ["phoneno"]."','".$_POST ["experience"]."','password','".$_SESSION ["group_id"]."','".$_POST ["logInType"]."')") or die(mysql_error());
		
			
		
		$subject="activate your account";
		$body=" you are registered by a user";
		$to=$_POST ["email"];
		
		echo mail($to, $subject, $body);
		
header("location:../teacher_details.php?submitted");



}

else
header("location:../teacher_details.php?errmsg=email-id already in the record");		










?>
