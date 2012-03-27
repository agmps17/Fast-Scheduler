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
					<form action="update/class.php" method="post" class="cssform" id="regClass">
					
						<fieldset>
							<legend>Distribution Of Teacher</legend>
							
								<?php
				
									if(isset($_GET['submitted']))
									{
									echo "<b style='color:red;margin-left:100px;font-size:20px;'>Class Detail saved successfully</b>";
				
									}
				
				
									?>
		
	
	<?php
					mysql_connect("localhost","root","arpit") or die("first");
					mysql_select_db("timetable") or die ("second");
							
							
							
					$rs=mysql_query("select * from class_detail where class_id='".$_GET['id']."'&& group_id=".$_SESSION['group_id']."") or die (mysql_error());
					$a=mysql_fetch_array($rs);
				
							
							
							
							
							
							echo "<p><label for=''>Class Name:
								<span class='mand'>*<span></label>
								<input type='text' id='className' value='".$a['name']."' name='name' disabled />
								<span  class='Error'>REQUIRED</span>
							</p>
							
							
							
							<p><label for=''>no. of section in a class
								<span class='mand'>*<span></label>
								<input type='text' id='sections' value='".$a['sections']."' name='sections' disabled/>
								<span  class='Error'>REQUIRED</span>
							</p>
							
							<p style='display:none'>
								<span class='mand'>*<span></label>
								<input type='text' id='txtId' value='".$a['class_id']."' name='class_id' disabled/>
								<span  class='Error'>REQUIRED</span>
							</p>	
							
							
							
							<p><input type='button'id='editClass' value='EDIT' /><input id='update' type='submit' value='UPDATE' /> <input type='reset' value='RESET' /></p>";
							
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
