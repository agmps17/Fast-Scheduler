<?php
ob_start();
session_start();
if(!isset($_SESSION['usernameLimited']))
	header("Location: ../index.php?errmsg=YOU ARE UNAUTHORISED");



?>





<html>
	
	
	<head>
		
		<link rel="stylesheet" href="../form.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../style.css"/>
		<script type="text/javascript" src="../jquery.js" language="javascript" charset="utf-8">
		</script>
		<script type="text/javascript" src="../admin/main.js" language="javascript" charset="utf-8">
		</script>
		<style type='text/css'>
		#home{
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
				
						include("side.php");
				
				
					?>
				
				</div>
				
				<div id="main_panel">
				
					<?php
					
					if(isset($_GET['errmsg'])){
									
									
									echo "<p ><span class='errmsg'>".$_GET['errmsg']."</span></p>";
									
									}
									
									
					
					?>
					
					<form  action='index.php' method='post'class='cssform' id='changePass'>
					<fieldset><legend>Change Password</legend>
					<p><label>old password<span class="mand">*<span></label><input type='password' id='op' name='opass'/><span  class="Error">Required</span></p></p>
					<p><label>new password<span class="mand">*<span></label><input type='password' id='np' name='npass'/><span  class="Error">Required</span></p></p>
					
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
		
		<?php
		
		if(isset($_POST['opass'])){
		
						include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
			
			
		
			 if(isset($_SESSION['usernameLimited'])){
			
		
			
					$opq=mysql_query(" select password from teacher_detail where email_id='".$_SESSION['usernameLimited']."'") or die(mysql_error());
					$op=mysql_fetch_array($opq);
					 if($op['password']==$_POST['opass']){
						
					 mysql_query(" update teacher_detail SET password='".$_POST['npass']."' where email_id='".$_SESSION['usernameLimited']."'" )or die(mysql_error());
					 header("location:index.php?errmsg=password successfully changed");

					 }		
			
			
			}
		 else 
		 header("location:index.php?errmsg=password wrong");
		
		
		
		}
		
		
		
		
		
		
		
		
		
		
		
		?>
	
	
	</body>








</html>

				
				</div>
				

			</div>
						
			
		</div>
		
		<div id="cb"></div>
	
		<?php
	
		include("footer.php");
	
		?>
	
	
	
	</body>








</html>
