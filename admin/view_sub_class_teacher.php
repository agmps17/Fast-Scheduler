<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../../index.php?errmsg=YOU ARE UNAUTHORISED");



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
					 $rp=mysql_query("select * from sub_class_teach where group_id=".$_SESSION['group_id']." ") or die(mysql_error());
					 
					 
					 
					 
					 
					echo "<table border='1' id='viewTable'>";
					echo "<tr id='headTable'><td>Teacher Name(ID)</td><td>Class</td><td>Subject(Type)</td></tr>";
					
					while($row=mysql_fetch_array($rp)){
					$sa=mysql_query("select concat(name,'(',sub_type,')') subject from sub_detail where group_id=".$_SESSION['group_id']."&& sub_id=".$row['sub_id']);
					$sb=mysql_query("select concat(name,'(',teacher_id,')') teacher from teacher_detail where group_id=".$_SESSION['group_id']."&& teacher_id=".$row['teacher_id']);	
					$sc=mysql_query("select name from class_detail where group_id=".$_SESSION['group_id']."&& class_id=".$row['class_id']);		
					
					$d=mysql_fetch_array($sa);
					$e=mysql_fetch_array($sb);
					$f=mysql_fetch_array($sc);
					
					
		
						echo "<tr><td>".$e['teacher']."</td><td>".$f['name']."</td><td>".$d['subject']."</td></tr>";
		
		
									}
					echo "</table>";
					
					
					?>
				
				
				</div>
						
			
		</div>
		
		<div id="cb"></div>
	
		<?php
	
		include("footer.php");
	
		?>
	
	
	
	</body>








</html>
