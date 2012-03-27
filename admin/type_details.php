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
					<form action="insert/type.php" method="post" class="cssform" id="regType">
					
						<fieldset>
							<legend>Distribution Of Teacher</legend>
							
								<?php
				
									if(isset($_GET['submitted']))
									{
									echo "<b style='color:red;margin-left:100px;font-size:20px;'>Type Detail saved successfully</b>";
				
									}
				
				
									?>
		
	
	
							<p><label for="">Type
								<span class="mand">*<span></label>
								<input type="text" id="typeName" value="" name="type" />
								<span  class="Error">REQUIRED</span>
							</p>
							
													
							<p><label for="">Minimum load in a week
								<span class="mand">*<span></label>
								<input type="text" id="minLoad" value="" name="min_load" />
								<span  class="Error">REQUIRED</span>
							</p>
							
							<p><label for="">Maximum load in a week
								<span class="mand">*<span></label>
								<input type="text" id="maxLoad" value="" name="max_load" />
								<span  class="Error">REQUIRED</span>
							</p>
							
							<p><label for="">Maximum load in a day
								<span class="mand">*<span></label>
								<input type="text" id="maxLoadDay" value="" name="max_load_day" />
								<span  class="Error">REQUIRED</span>
							</p>
							<p><label for="">Maximum continuous load 
								<span class="mand">*<span></label>
								<input type="text" id="contLoad" value="" name="cont_load" />
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
