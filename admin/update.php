<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../index.php?errmsg=YOU ARE UNAUTHORISED");



?>





<html>
	
	
	<head>
		
		<link rel="stylesheet" type="text/css" href="../style.css"/>
		<style type='text/css'>
		#update{
		position: relative;
		color: #ffffff;
		background: url(../images/templatemo_menu_button_right.png) bottom right no-repeat;
		
		
		
		
		
		}
		
		
		</style>
	
	</head>
	
	
	
	
	<body>
	
		<?php
			
			include("header.php");
			
		
		?>
		
		
		<div id="ct"></div>
			
			<div id="content">
				
				<div id="side_panel">
					<?php
				
						include("side_update.php");
				
				
					?>
				
				</div>
				
				<div id="main_panel">
				
				
				</div>
				

			</div>
						
			
		</div>
		
		<div id="cb"></div>
	
		<?php
	
		include("footer.php");
	
		?>
	
	
	
	</body>








</html>
