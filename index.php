<?php
ob_start();
session_start();
?>




<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	
	
	</head>
	
	
	<body>
		<?php
		if(!isset($_SESSION['username']))
		include("top.php");
		else
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
