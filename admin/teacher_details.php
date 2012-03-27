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
					<form action="insert/teacher.php" method="post" class="cssform" id="regTeacher">
					
						<fieldset>
							<legend>Teacher Detail</legend>
							
								<?php
				
									if(isset($_GET['submitted']))
									{
									echo "<b style='color:red;margin-left:100px;font-size:20px;'>Teacher  Detail saved successfully</b>";
				
									}
				
				
									?>
		
	
	
							<p class="heading" >Personal Information</p>
	
							<p><label for="txtName">Full Name
								<span class="mand">*<span></label>
								<input type="text" id="txtName" value="" name="name" />
								<span  class="Error">REQUIRED</span>
							</p>
		
							
		
							<p><label for="">Type
								<span class="mand">*<span></label>
								<select  id="teacherType" name="type">
								<?php
								mysql_connect("localhost","root","arpit") or die("first");
								mysql_select_db("timetable") or die ("second");
								$rp=mysql_query("select type from type_details where group_id=".$_SESSION['group_id']."");
								while($row=mysql_fetch_array($rp)){
		
								echo "<option>".$row['type']."</option>";
		
		
									}
								
								?>
								
								
								
								</select>
								<span  class="Error">REQUIRED</span>
							</p>
	
		
		
		
		
							<p class="heading" >Contact Information</p>
		
		
		
							<p><label for="txtEmail">Email-Id
								<span class="mand">*<span></label>
								<input type="text" id="txtEmail" value="" name="email" />
								<span  class="Error">REQUIRED</span>
							</p>
		
		
		
	
	
							<p><label for="txtUserAddress">Address
								<span class="mand">*<span></label>
								<textarea rows="10" cols="10" id="txtUserAddress" name="address">
								</textarea>
								<span  class="Error">REQUIRED</span>
							</p>
	
	
							<p><label for="txtPhoneNo">PHONE NO.
								<span class="mand">*<span></label>
								<input type="text" id="txtPhoneNo" name="phoneno" />
								<span class="Error">REQUIRED</span>
							</p>
	
							<p><label for="">Experience
								<span class="mand">*<span></label>
								<input type="text" id="" name="experience" />
								<span class="Error">REQUIRED</span>
							</p>
							
							<p><label for="">LogIn Type:
								<span class="mand">*<span></label>
								<select  id="" name="logInType" >
								<option>Admin</option>
								<option>Limited</option>
								</select>
								<span class="Error">REQUIRED</span>
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
