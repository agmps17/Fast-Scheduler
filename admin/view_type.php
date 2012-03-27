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
						
						
						
					 $rp=mysql_query("select * from type_details where group_id=".$_SESSION['group_id']." ") or die(mysql_error());
					
					
					
					echo "<table border='1' id='viewTable'>";
					echo "<tr id='headTable'><td>Type</td><td>Week Max Load</td><td>Week Min Load</td><td>Day Max Load</td><td>Continuous Load</td></tr>";
					
					while($row=mysql_fetch_array($rp)){
		
						echo "<tr><td><a href='update_type.php?id=".$row['type_id']."'>".$row['type']."</a></td><td>".$row['week_min']."</td><td>".$row['week_max']."</td><td>".$row['day_max']."</td><td>".$row['cont']."</td></tr>";
		
		
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
