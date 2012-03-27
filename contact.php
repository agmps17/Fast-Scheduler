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
			
				<p><h2 style>Arpit Goyal</h2></p>
				<p><address>B 203 B 10 B SCHEME </address>
				<address>Jaipur, Rajasthan   </address></p>
				<p><span>Mobile No.:  </span>
				<span style="color:white">941780006</span></p>
				<p>E-MAIL ID: <a href="# "style="color:white ;text-decoration:none;">agmps17@gmail.com </p>
			
			</div>
			
			
		
			<div id="cb"></div>
	
	
	
	
		<?php
	
		include("footer.php");
	
		?>
	
	
	</body>



</html>
