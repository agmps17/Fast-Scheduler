<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../../index.php?errmsg=YOU ARE UNAUTHORISED");


			include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
				if(isset($_GET['key'])){
				mysql_query("delete from sub_class_teach where `key`=".$_GET['key']."&& group_id=".$_SESSION['group_id'])or die(mysql_error());;
				

				}
				
				header("location:view_sub_class_teacher.php");




?>