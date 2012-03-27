<?php
session_start();


		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		$rs=mysql_query("select * from class_detail where (name='".$_REQUEST['name']."'&& class_id!=".$_REQUEST ["class_id"]." ) && group_id=".$_SESSION ["group_id"]."")or die(mysql_error());
		
		
		
		if(mysql_num_rows($rs)==0){
		
		mysql_query("replace into class_detail (name,sections,group_id,class_id) values('".$_REQUEST ["name"]."','".$_REQUEST ["sections"]."','".$_SESSION ["group_id"]."','".$_REQUEST ["class_id"]."')") or die(mysql_error());

header("location:../class_details.php?submitted");



}
else
header("location:../class_details.php?errmsg=class already registered in the record");		








?>
