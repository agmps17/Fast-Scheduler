<?php

		mysql_connect("localhost","root","arpit") or die("first");
		mysql_select_db("timetable") or die ("second");
		
		foreach($_REQUEST as $key => $value){
		
		$_REQUEST [$key]=mysql_real_escape_string($_REQUEST [$key]);
				
		}
		
		$rs=mysql_query("select * from admin_details where username='".$_REQUEST ['username']."'&& password='".$_REQUEST ['password']."'");
		
		$rs1=mysql_query("select * from teacher_detail where email_id='".$_REQUEST ['username']."'&& password='".$_REQUEST ['password']."'");
		
		$row=mysql_fetch_array($rs);
		
		$rowa=mysql_fetch_array($rs1);
		echo $rowa['login_type'];
		
		if(mysql_num_rows($rs)==1)
		{
		session_start();
		session_register("username");
		session_register("group_id");
		$_SESSION["username"]=$_REQUEST ['username'];
		$_SESSION["group_id"]=$row['group_id'];
		
		header("location:admin/admin.php");
		
		}
		
		elseif(mysql_num_rows($rs1)==1){
		 session_start();
		
		if($rowa['login_type']=='Admin'){
		session_register("username");
		session_register("group_id");
		$_SESSION["username"]=$_REQUEST ['username'];
		$_SESSION["group_id"]=$rowa['group_id'];
		
		header("location:admin/admin.php");
		
		
		}
		else{
		session_register("usernameLimited");
		session_register("group_id");
		$_SESSION["usernameLimited"]=$_REQUEST ['username'];
		$_SESSION["group_id"]=$rowa['group_id'];
		header("location:user/user.php");
		
		}
		}
		
		else
		header("location:index.php?errmsg=wrong username or password");
		
		
		
		



?>
