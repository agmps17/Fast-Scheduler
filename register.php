<?php
ob_start();
session_start();
?>

<html>
	<head>
		<link rel="stylesheet" href="form.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<script type="text/javascript" src="jquery.js" language="javascript" charset="utf-8">
		</script>
		<script type="text/javascript" src="main.js" language="javascript" charset="utf-8">
		</script>
		
		
		<style type="text/css">
		
			.cssform p{
			
			width:600px;
			
			
			}
		
		
		</style>
	</head>
	
	
	
	<body>
		<?php
		
		if(!isset($_SESSION['username']))
		include("top.php");
		else
		include("loggedin.php");
		include("header.php");
	
		?>
	
		<div id="ct"></div>
		
		
		
		<div id="content">
			<form  action="reg.php" method="post" class="cssform" id="RegForm" >
					<fieldset style="width:600px;" >
						<legend>REGISTER</legend>
						<p class="heading" >Personal Information</p>
						
						
						<p><label for="txtName">Full Name
						<span class="mand">*<span></label>
						<input type="text" id="txtName" value="" name="name"  />
						<span class="Hint">Enter your name here.</span>
						<span  class="Error">This Field cannot be left blank</span></p>
						
						<p><label for="txtEmail">Email-Id
						<span class="mand">*<span></label>
						<input type="text" id="txtEmail" value="" name="email" />
						<span  class="Error">This Field cannot be left blank</span></p>
						
						
						
						<p><label for="txtUserName">User Name<span class="mand">*<span></label>
						<input  type="text" id="txtUserName"  value="" name="username" />
						<span  class="Hint">Enter the required user name</span>
						<span  class="Error">This Field cannot be left blank</span></p>
						
						<p><label for="txtPassword">Password
						<span class="mand">*<span></label>
						<input type="password" id="txtPassword" name="password" />
						<span  class="Hint">Enter the required password</span>
						<span  class="Error">This Field cannot be left blank</span></p>
						
						<p class="heading" align="left">Contact Information</p>
						
						
						<p><label for="txtUserAddress">Address
						<span class="mand">*<span></label>
						<textarea rows="10" cols="10" id="txtUserAddress" name="address">
						</textarea>
						<span 	class="Hint">Enter Your Address</span>
						<span  class="Error">This Field cannot be left blank</span></p>
						
						
						
						<p><label for="City">City
						<span class="mand">*<span></label>
						<select id="City" name="city" >
						<option ></option><option >Jaipur</option>
						</select>
						<span  class="Hint">Select Your City Name</span>
						<span class="Error">This Field cannot be left blank</span></p>
						
						
						
						<p><label for="Country" >Country
						<span class="mand">*<span></label>
						<select id="Country" name="country" ><option ></option>
						<option >India</option></select>
						<span  class="Hint">Select Your Country Name</span>
						<span class="Error">This Field cannot be left blank</span></p>
						
						
						
						
						
						
						
						
						<p><label for="txtPhoneNo">PHONE NO.
						<span class="mand">*<span></label>
						<input type="text" id="txtPhoneNo" name="phoneno" />
						<span  class="Hint">Enter Your Phone Name</span>
						<span class="Error">This Field cannot be left blank</span></p>
						
						
						<p class="heading" align="left">Comment:</p>
						<p><label for="txtComment">Comment:</label>
						<textarea rows="10" cols="10" id="txtComment" name="comment">
						</textarea><span  class="Hint">Write Your Review on our site</span></p>
						
						<p class="heading" align="left">Submission:</p>
						<p><input type="submit" value="SUBMIT" /> <input type="reset" value="RESET" /></p>
						
					</fieldset>	
					</form>
		
		
		
		</div>
		<div id="cb"></div>
		<?php
	
		include("footer.php");
	
		?>

	
	</body>

</html>
