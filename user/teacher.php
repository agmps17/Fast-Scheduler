<?php

session_start();

		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		
		$rs=mysql_query("select * from teacher_detail where (email_id='".$_REQUEST['email']."'&& teacher_id!=".$_REQUEST ["id"]." )&&group_id=".$_SESSION ["group_id"]."")or die(mysql_error());
	
	
	



	if(mysql_num_rows($rs)==0){		
		
		$as=mysql_query("select * from teacher_detail where email_id='".$_SESSION['usernameLimited']."'&&group_id=".$_SESSION ["group_id"])or die(mysql_error());
		$c=mysql_fetch_array($as);
		print_r($c);
		
				
		mysql_query("replace into teacher_detail(name,teacher_id,email_id,type_id,address,phonenumber,experience,password,group_id,login_type ) values('".$_REQUEST ["name"]."','".$_REQUEST ["id"]."','".$_REQUEST ["email"]."','".$c ["type_id"]."','".$_REQUEST ["address"]."','".$_REQUEST ["phoneno"]."','".$c ["experience"]."','".$_REQUEST ["password"]."','".$_SESSION ["group_id"]."','".$c ["login_type"]."')") or die(mysql_error());
		
			
		

header("location:profile.php");


}

else
header("location:profile.php?errmsg=email-id already in the record");		

	










?>
