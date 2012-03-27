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
				
						include("side_home.php");
				
				
					?>
				
				</div>
				
				<div id="main_panel">
					<form action="insert/details.php" method="post" class="cssform" id="regSchool">
					
						<fieldset>
							<legend>School Detail</legend>
							
								<?php
				
									if(isset($_GET['submitted']))
									{
									echo "<b style='color:red;margin-left:100px;font-size:20px;'>School  Detail saved successfully</b>";
				
									}
									if(isset($_GET['errmsg'])){
									
									
									echo "<p ><span class='errmsg'>".$_GET['errmsg']."</span></p>";
									
									}
				
				
									?>
									
		<?php
		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		$gd=mysql_query("select * from school_detail where group_id=".$_SESSION['group_id'])or die(mysql_error());
		$fd=mysql_num_rows($gd);
		$det=mysql_fetch_array($gd);
		?>
	
	
							<p class="heading" >General Information</p>
	
							<p><label for="txtName">School Name
								<span class="mand">*<span></label>
								<input type="text" id="txtName" <?php 
								if($fd==1)
								echo "value=".$det['name'];
								?> name="name" />
								<span  class="Error">REQUIRED</span>
							</p>
		
							
					
							<p class="heading" >Contact Information</p>
		
		
		
							<p><label for="txtUserAddress">Address
								<span class="mand">*<span></label>
								<textarea rows="10" cols="10" id="txtUserAddress" name="address">
								<?php 
								if($fd==1)
								echo "value=".$det['address'];
								?> 
								</textarea>
								<span  class="Error">REQUIRED</span>
							</p>
	
	
							<p><label for="txtPhoneNo">PHONE NO.
								<span class="mand">*<span></label>
								<input type="text" id="txtPhoneNo" name="phoneno" <?php 
								if($fd==1)
								echo "value=".$det['phonenumber'];
								?>  />
								<span class="Error">REQUIRED</span>
							</p>
							
							<p class="heading" >Duration Information</p>
	
							<p><label for="txtfrequency">NO. of Working days
								<span class="mand">*<span></label>
								<input type="text" id="txtfrequency" name="frequency" <?php 
								if($fd==1)
								echo "value=".$det['frequency'];
								?> />
								<span class="Error">REQUIRED</span>
							</p>
							
							<p><label for="txtlectures">NO. of Lecture in a day
								<span class="mand">*<span></label>
								<input type="text" id="txtlectures" name="lectures" <?php 
								if($fd==1)
								echo "value=".$det['number_lectures'];
								?> />
								<span class="Error">REQUIRED</span>
							</p>
							
							<p><label for="txtbreak">Break after how many lectures
								<span class="mand">*<span></label>
								<input type="text" id="txtbreak" name="break" <?php 
								if($fd==1)
								echo "value=".$det['break_time'];
								?>  />
								<span class="Error">REQUIRED</span>
							</p>
							
		
							<p><input type="submit" value="SUBMIT/UPDATE" /> <input type="reset" value="RESET" /></p>
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
