<?php
session_start();


		mysql_connect("localhost","root","arpit") or die("first");
		mysql_select_db("timetable") or die ("second");
		$rs=mysql_query("select * from class_detail where name='".$_REQUEST['name']."' && group_id=".$_SESSION ["group_id"]."")or die(mysql_error());
		
		
		
		if(mysql_num_rows($rs)==0){
		
		mysql_query("insert into class_detail (name,sections,group_id) values('".$_REQUEST ["name"]."','".$_REQUEST ["sections"]."','".$_SESSION ["group_id"]."')") or die(mysql_error());

header("location:../class_details.php?submitted");



}
else
header("location:../class_details.php?errmsg=class already registered in the record");		








?>
