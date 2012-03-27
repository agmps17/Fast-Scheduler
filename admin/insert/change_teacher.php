<?php
ob_start();
session_start();

include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);

mysql_query("update  final_class_sub_teacher SET teacher_id=".$_POST['teacher']."  where group_id=".$_SESSION ["group_id"]."&& sub_id=".$_POST['sub']."&&class_id=".$_POST['class']."&&section=".$_POST['section'])or die(mysql_error());


header("location:../view_distribution.php");
?>