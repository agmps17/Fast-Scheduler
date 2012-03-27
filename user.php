<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: index.php?errmsg=YOU ARE UNAUTHORISED");



?>



<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	
	
	
	</head>
	
	
	<body>
		
		
		<?php
		
		include("loggedin.php");
		include("header.php");
	
		?>
		
			<div id="ct"></div>
			
			<div id="content">
			
			
			
			</div>
		
			<div id="cb"></div>
	
	
	
	
		<?php
	
		include("footer.php");
	
		?>
	
		
	</body>


</html>
