<?php

session_start();

		mysql_connect("localhost","root","arpit") or die("first");
		mysql_select_db("timetable") or die ("second");
		
		$a=strlen($_REQUEST['teacher_name']);
		$b=stripos($_REQUEST['teacher_name'],'(');
		$c=$a-$b-2;
		$d=substr($_REQUEST['teacher_name'],$b+1,$c);
		
		
		$a=strlen($_REQUEST['subject_name']);
		$b=stripos($_REQUEST['subject_name'],'(');
		$c=substr($_REQUEST['subject_name'],0,$b);
		$f=$a-$b-2;
		$e=substr($_REQUEST['subject_name'],$b+1,$f);
		
		$rs=mysql_query("select sub_id from sub_detail where name='".$c."'&&sub_type='".$e."'&& group_id=".$_SESSION ["group_id"]);
		$r=mysql_fetch_array($rs);
	
		
		$rp=mysql_query("select class_id from class_detail where name='".$_REQUEST['class_name']."'&& group_id=".$_SESSION ["group_id"])or die(mysql_error());
		$p=mysql_fetch_array($rp);
		
		
		mysql_query("insert into sub_class_teach (teacher_id,class_id,sub_id,group_id) values('".$d."','".$p['class_id']."','".$r['sub_id']."','".$_SESSION ["group_id"]."')") or die(mysql_error());






header("location:../sub_teach_class.php?submitted");








?>
