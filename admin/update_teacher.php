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
					<form action="update/teacher.php" method="post" class="cssform" id="regTeacher">
					
						<fieldset>
							<legend>Teacher Detail</legend>
							
								<?php
				
									if(isset($_GET['updated']))
									{
									echo "<b style='color:red;margin-left:100px;font-size:20px;'>Teacher  Detail Updated Successfully</b>";
				
									}
				
				
									?>
		
	
				<?php
						mysql_connect("localhost","root","arpit") or die("first");
								mysql_select_db("timetable") or die ("second");
							
							
							
							$rs=mysql_query("select * from teacher_detail where teacher_id='".$_GET['id']."'&& group_id=".$_SESSION['group_id']."") or die (mysql_error());
					$a=mysql_fetch_array($rs);
					$rz=mysql_query("select * from type_details where type_id='".$a['type_id']."'&& group_id=".$_SESSION['group_id']."") or die (mysql_error());
					$rz1=mysql_fetch_array($rz);
					
							echo"<p class='heading' >Personal Information</p>";
	
							echo"<p><label for='txtName'>Full Name
								<span class='mand'>*<span></label>
								<input type='text' id='txtName' value='".$a['name']."' name='name' disabled />
								<span  class='Error'>REQUIRED</span>
							</p>";
		
						echo "<p><label >Teacher-Id
								<span class='mand'>*<span></label>
								<input type='text' id='txtId' value='".$a['teacher_id']."' name='id' disabled/>
								<span  class='Error'>REQUIRED</span>
							</p>";
		
						echo "<p><label >Type
								<span class='mand'>*<span></label>
								<select  id='type' value='' name='type' disabled>";		
								
								
								
								$rp=mysql_query("select type from type_details where group_id=".$_SESSION['group_id']."");
								while($row=mysql_fetch_array($rp)){
								
								
								if($row['type']==$rz1['type'])
								echo "<option selected>".$row['type']."</option>";
								else
								echo "<option>".$row['type']."</option>";
								}
							
							echo "</select>
								<span  class='Error'>REQUIRED</span>
							</p>";
		
		
		
		
						echo	"<p class='heading' >Contact Information</p>";
		
		
		
							echo"<p><label for='txtEmail'>Email-Id
								<span class='mand'>*<span></label>
								<input type='text' id='txtEmail' value='".$a['email_id']."' name='email' disabled />
								<span  class='Error'>REQUIRED</span>
							</p>";
		
		
		
	
	
							echo"<p><label for='txtUserAddress'>Address
								<span class='mand'>*<span></label>
								<textarea rows='10' cols='10' id='txtUserAddress' name='address' disabled >
								".$a['address']."
								</textarea>
								<span  class='Error'>REQUIRED</span>
							</p>";
	
							echo"<p><label for='txtPhoneNo'>PHONE NO.
								<span class='mand'>*<span></label>
								<input type='text' id='txtPhoneNo' name='phoneno' value='".$a['phonenumber']."' disabled/>
								<span class='Error'>REQUIRED</span>
							</p>";
	
							echo"<p><label for=''>Experience
								<span class='mand'>*<span></label>
								<input type='text' id='txtExperience' name='experience' value='".$a['experience']."' disabled/>
								<span class='Error'>REQUIRED</span>
							</p>";
							
							echo"<p><label for=''>LogIn Type:
								<span class='mand'>*<span></label>
								<select  id='logInType' name='logInType' disabled >
								<option>Admin</option>
								<option>Limited</option>
								</select>
								<span class='Error'>REQUIRED</span>
							</p>";
		
							echo"<p><input type='button' id='buttonE' value='EDIT' /><input id='update' type='submit' value='UPDATE' /> <input type='reset' value='RESET' /></p>";
							
							
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
