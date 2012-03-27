<?php

session_start();

		mysql_connect("localhost","root","arpit") or die("first");
		mysql_select_db("timetable") or die ("second");
		
		$rs=mysql_query("select * from teacher_detail where (email_id='".$_REQUEST['email']."'&& teacher_id!=".$_REQUEST ["id"]." )&&group_id=".$_SESSION ["group_id"]."")or die(mysql_error());
	
	
	



	if(mysql_num_rows($rs)==0){		
		
		$as=mysql_query("select * from teacher_detail where email_id='".$_SESSION['usernameLimited']."'&&group_id=".$_SESSION ["group_id"])or die(mysql_error());
		$c=mysql_fetch_array($as);
		
				
		mysql_query("replace into teacher_detail values('".$_REQUEST ["name"]."','".$_REQUEST ["id"]."','".$_REQUEST ["email"]."','".$c ["type_id"]."','".$_REQUEST ["address"]."','".$_REQUEST ["phoneno"]."','".$c ["experience"]."','$_REQUEST ["password"]','".$_SESSION ["group_id"]."','".$c ["logInType"]."')") or die(mysql_error());
		
			
		

header("location:profile.php");


}

else
header("location:profile.php?errmsg=email-id already in the record");		

	


}







?>
