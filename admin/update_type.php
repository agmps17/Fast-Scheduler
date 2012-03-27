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
					<form action="update/type.php" method="post" class="cssform" id="regType">
					
						<fieldset>
							<legend>Distribution Of Teacher</legend>
							
								<?php
				
									if(isset($_GET['submitted']))
									{
									echo "<b style='color:red;margin-left:100px;font-size:20px;'>Type Detail saved successfully</b>";
				
									}
				
				
									?>
		
	
	
		<?php					
		mysql_connect("localhost","root","arpit") or die("first");
		mysql_select_db("timetable") or die ("second");
							
							
							
		$rs=mysql_query("select * from type_details where type_id='".$_GET['id']."'&& group_id=".$_SESSION['group_id']."") or die (mysql_error());
					$a=mysql_fetch_array($rs);
		
		
		
		
		
		
		
		
		echo "<p><label for=''>Type
								<span class='mand'>*<span></label>
								<input type='text' id='typeName' value='".$a['type']."' name='type' disabled/>
								<span  class='Error'>REQUIRED</span>
							</p>
							
													
							<p><label for=''>Minimum load in a week
								<span class='mand'>*<span></label>
								<input type='text' id='minLoad' value='".$a['week_max']."' name='min_load' disabled/>
								<span  class='Error'>REQUIRED</span>
							</p>
							
							<p><label for=''>Maximum load in a week
								<span class='mand'>*<span></label>
								<input type='text' id='maxLoad' value='".$a['week_min']."' name='max_load' disabled />
								<span  class='Error'>REQUIRED</span>
							</p>
							
							<p><label for=''>Maximum load in a day
								<span class='mand'>*<span></label>
								<input type='text' id='maxLoadDay' value='".$a['day_max']."' name='max_load_day' disabled />
								<span  class='Error'>REQUIRED</span>
							</p>
							<p><label for=''>Maximum continuous load 
								<span class='mand'>*<span></label>
								<input type='text' id='contLoad' value='".$a['cont']."' name='cont_load' disabled />
								<span  class='Error'>REQUIRED</span>
							</p>
							<p style='display:none;'><label for=''> 
								<span class='mand'>*<span></label>
								<input type='text' id='txtId' value='".$a['type_id']."' name='type_id' disabled/>
								<span  class='Error'>REQUIRED</span>
							</p>
							
							
							
							<p><input type='button' id='editType' value='EDIT' /><input id='update' type='submit' value='UPDATE' /> <input type='reset' value='RESET' /></p>";
			
			
			?>
			
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
