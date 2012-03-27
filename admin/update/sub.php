<?php

session_start();

		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		
		
		$rs=mysql_query("select * from sub_detail where ((name='".$_REQUEST['name']."'&&sub_type='".$_REQUEST['type']."')&& sub_id!=".$_REQUEST ["sub_id"]." ) && group_id=".$_SESSION ["group_id"]."")or die(mysql_error());

if(mysql_num_rows($rs)==0){
		
		mysql_query("replace into sub_detail (name,sub_id,sub_type,group_id,sub_load)values('".$_REQUEST ["name"]."','".$_REQUEST ["sub_id"]."','".$_REQUEST ["type"]."','".$_SESSION ["group_id"]."','".$_REQUEST ["subload"]."')") or die("third");

header("location:../subject_details.php?submitted");



}
else
header("location:../subject_details.php?errmsg=subject already registered in the record");	










?>
