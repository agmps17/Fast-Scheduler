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
				
						include("side_update.php");
				
				
					?>
				
				</div>
				
				<div id="main_panel">
					<form action="update/sub.php" method="post" class="cssform" id="regSubject">
					
						<fieldset>
							<legend>Distribution Of Teacher</legend>
							
								<?php
				
									if(isset($_GET['submitted']))
									{
									echo "<b style='color:red;margin-left:100px;font-size:20px;'>Subject Detail saved successfully</b>";
									
				
									}
				
				
									?>
		
	
	<?php
	
		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
							
							
							
							$rs=mysql_query("select * from sub_detail where sub_id='".$_GET['id']."'&& group_id=".$_SESSION['group_id']."") or die (mysql_error());
					$a=mysql_fetch_array($rs);
	
						echo"<p><label for=''>Subject Name:
								<span class='mand'>*<span></label>
								<input type='text' id='subjectName' value='".$a['name']."' name='name' disabled/>
								<span  class='Error'>REQUIRED</span>
							</p>
							
							<p style='display:none;'><label for=''>Subject ID
								<span class='mand'>*<span></label>
								<input type='text' id='txtId' value='".$a['sub_id']."' name='sub_id' disabled/>
								<span  class='Error'>REQUIRED</span>
							</p>
							
							<p><label for=''>Subject Type
								<span class='mand'>*<span></label>
								<select id='subjectType' name='type' disabled >
								";
								
								if($a['sub_type']=='Lecture'){
								echo "<option selected>Lecture</option>
								<option>Practical</option>";
								}
								else{
								echo "<option>Lecture</option>
								<option selected>Practical</option>";
								
								}
								
								echo "</select>
								<span  class='Error'>REQUIRED</span>
							</p>";
							
							
							
							echo "<p><label >Subject Weekly Load
								<span class='mand'>*<span></label>
								<input type='text' id='subjectLoad' name='subload' value='".$a['sub_load']."' disabled />
								
								<span  class='Error'>REQUIRED</span>
							</p> ";
							
							
			?>				
							
							
							
							
							<p><input type='button'id='editSub' value='EDIT' /><input id='txtupdate' type='submit' value='UPDATE' disabled /> <input type='reset' value='RESET' /></p>
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
