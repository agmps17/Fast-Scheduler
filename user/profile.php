<?php
ob_start();
session_start();
if(!isset($_SESSION['usernameLimited']))
	header("Location: ../index.php?errmsg=YOU ARE UNAUTHORISED");



?>





<html>
	
	
	<head>
		
		<link rel="stylesheet" type="text/css" href="../style.css"/>
		<link rel="stylesheet" type="text/css" href="../form.css"/>
		<script type="text/javascript" src="../jquery.js" language="javascript" charset="utf-8">
		</script>
		<script type="text/javascript" src="main.js" language="javascript" charset="utf-8">
		
			
		
			
	
		</script>
	
	
	</head>
	
	
	
	
	<body>
	
		<?php
			
			include("header.php");
			
		
		?>
		
		
		<div id="ct"></div>
			
			<div id="content">
				
				<div id="side_panel">
					<?php
				
						include("home.php");
				
				
					?>
				
				</div>
				
				<div id="main_panel">
				<?php
					
						mysql_connect("localhost","root","arpit") or die("first");
						mysql_select_db("timetable") or die ("second");
					 	$rs=mysql_query("select * from teacher_detail where email_id='".$_SESSION['usernameLimited']."'" ) or die(mysql_error());
					 	
					 	
					 	$row=mysql_fetch_array($rs);
					 	
					 		
		$rq=mysql_query("select type from type_details where type_id=".$row['type_id']."&& group_id=".$_SESSION['group_id']."") or die(mysql_error());
					
					 $p=mysql_fetch_array($rq);
			
		
		
		
		echo "<table border='1' id='viewTable'><tr><td>Name:</td><td>".$row['name']."</td></tr><tr><td>id:</td><td>".$row['teacher_id']."</td></tr><tr><td>Email Id:</td><td>".$row['email_id']."</td></tr><tr><td>Designation:</td><td>".$p['type']."</td></tr><tr><td>Address:</td><td>".$row['address']."</td></tr><tr><td>Contact No.:</td><td>".$row['phonenumber']."</td></tr></table>"
							
					
					
					?>
				
				</div>
						
			
		</div>
		
		<div id="cb"></div>
	
		<?php
	
		include("footer.php");
	
		?>
	
	
	
	</body>








</html>
