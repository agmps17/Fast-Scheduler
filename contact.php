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
		<style type='text/css'>
		#contact{
		position: relative;
	color: #ffffff;
	background: url(images/templatemo_menu_button_right.png) bottom right no-repeat;
		
		
		
		
		
		}
	</style>
	</head>
	
	
	<body>
		<?php
		
		include("header.php");
	
		?>
		
			<div id="ct"></div>
			
			<div id="content">
			<form action='contact.php' method='post' class='cssform' id='suggestion' >
			<fieldset style="width:600px;" >
						<legend>Suggestion</legend>
			<p> <label><span class='title'>Name</span></label><input type='text' name='name' id='name'><span  class="Error">Required</span></p>
			<p> <label><span class='title'>Email:</label></span><input type='text' name='email' id='email'><span  class="Error">required</span></p>
			<p> <label><span class='title'>Place</label></span><input type='text' name='place'></p>
			<p> <label><span class='title'>Suggestion</span></label><textarea rows='10' cols='10' name='suggestion' ></textarea><span  class="Error">This Field cannot be left blank</span></p>
			<p class="heading" align="left">Submit:</p>
						<p><input type="submit" value="SUBMIT" /> <input type="reset" value="RESET" /></p>
			</fieldset>
			</form>
			
				
			</div>
			
			
		
			<div id="cb"></div>
	
	
	
	
		<?php
	
		include("footer.php");
	
		?>
		
		<?php
			if(isset($_POST['name'])){
			
			$name=$_POST['name'];
			$email=$_POST['email'];
			$place=$_POST['place'];
			$suggestion=$_POST['suggestion'];
			$str="Feedbak form filled by ".$name." with email_id:".$email."  lives at  ".$place."  suggested -  ".$suggestion;
			
			mail("agmps17@gmail.com","FeedBack",$str );
			}
			
		
		
		
		
		?>
	
	
	</body>



</html>
