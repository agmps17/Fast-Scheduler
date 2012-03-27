<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../../index.php?errmsg=YOU ARE UNAUTHORISED");


			include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
				if(isset($_GET['key'])){
				mysql_query("delete from labs where `lab_id`=".$_GET['key']."&& group_id=".$_SESSION['group_id']);
				
				
				
					$query=mysql_query("select * from practical_details where group_id=".$_SESSION['group_id'])or die(mysql_error());
					if(mysql_num_rows($query)!=0){
					
						while($row=mysql_fetch_array($query)){

						mysql_query("delete from practical_details where `sub_id`=".$row['sub_id']."&& group_id=".$_SESSION['group_id']);
						


						}	
					
					
					}
				
				
				
				}
				
				header("location:view_lab_details.php");




?>