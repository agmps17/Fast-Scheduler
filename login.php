<?php

		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		 session_start();
		foreach($_REQUEST as $key => $value){
		
		$_REQUEST [$key]=mysql_real_escape_string($_REQUEST [$key]);
				
		}
		
		$rs=mysql_query("select * from admin_details where username='".$_REQUEST ['username']."'&& password='".$_REQUEST ['password']."'");
		
		$rs1=mysql_query("select * from teacher_detail where email_id='".$_REQUEST ['username']."'&& password='".$_REQUEST ['password']."'");
		
		$row=mysql_fetch_array($rs);
		
		$rowa=mysql_fetch_array($rs1);
		
		
		if(mysql_num_rows($rs)==1)
		{
		
		session_register("username");
		session_register("group_id");
		$_SESSION["username"]=$_REQUEST ['username'];
		$_SESSION["group_id"]=$row['group_id'];
		
		header("location:admin/index.php");
		
		}
		
		elseif(mysql_num_rows($rs1)==1){
		
		
		if($rowa['login_type']=='Admin'){
		session_register("userAdimn");
		session_register("group_id");
		$_SESSION["userAdmin"]=$_REQUEST ['username'];
		$_SESSION["group_id"]=$rowa['group_id'];
		
		header("location:admin/index.php");
		
		
		}
		else{
		session_register("usernameLimited");
		session_register("group_id");
		$_SESSION["usernameLimited"]=$_REQUEST ['username'];
		$_SESSION["group_id"]=$rowa['group_id'];
		header("location:user/index.php");
		
		}
		}
		
		else
		header("location:index.php?errmsg=wrong username or password");
		
		
		
		



?>
