<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
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
					<form action="insert/class.php" method="post" class="cssform" id="regClass">
					
						<fieldset>
							<legend>Distribution Of Teacher</legend>
							
								<?php
				
									if(isset($_GET['submitted']))
									{
									echo "<b style='color:red;margin-left:100px;font-size:20px;'>Class Detail saved successfully</b>";
				
									}
				
				
									?>
		
	
	
							<p><label for="">Class Name:
								<span class="mand">*<span></label>
								<input type="text" id="className" value="" name="name" />
								<span  class="Error">REQUIRED</span>
							</p>
							
							
							
							<p><label for="">no. of section in a class
								<span class="mand">*<span></label>
								<input type="text" id="sections" value="" name="sections" />
								<span  class="Error">REQUIRED</span>
							</p>
							
							
							
							
							
							<p><input type="submit" value="SUBMIT" /> <input type="reset" value="RESET" /></p>
						</fieldset>
					</form>
				
				
				</div>
				
				
				

			</div>
						
			
		</div>
		
		<div id="cb"></div>
	
		<?php
	
		include("footer.php");
	
		?>
	
	
	
	</body>








</html>
