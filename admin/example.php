<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../../index.php?errmsg=YOU ARE UNAUTHORISED");



?>





<html>
	
	
	<head>
		
		<link rel="stylesheet" type="text/css" href="../../style.css"/>
		<link rel="stylesheet" type="text/css" href="../../form.css"/>
		<script type="text/javascript" src="../jquery.js" language="javascript" charset="utf-8">
		</script>
		<script type="text/javascript" src="main.js" language="javascript" charset="utf-8">
		
			
		
			
	
		</script>
	
	
	</head>
	
	
	
	
	<body>
	
		<?php
			
			include("../header.php");
			
		
		?>
		
		
		<div id="ct"></div>
			
			<div id="content">
				
				<div id="side_panel">
					<?php
				
						include("../home.php");
				
				
					?>
				
				</div>
				
				<div id="main_panel">
				
				<input type="button" id="button"/>
				
					<?php
					
						mysql_connect("localhost","root","arpit") or die("first");
						mysql_select_db("timetable") or die ("second");
					 $rp=mysql_query("select name,sub_id from sub_detail ") or die(mysql_error());
					echo "<script> $('button')";	
					
					
					
					?>
				
				
				</div>
						
			
		</div>
		
		<div id="cb"></div>
	
		<?php
	
		include("../footer.php");
	
		?>
	
	
	
	</body>








</html>
