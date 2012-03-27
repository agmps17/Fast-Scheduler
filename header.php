
	
			
	
	
	
	
			
		
			<div id='top_panel'>
					  
			    	<div id='top_panel_ls'>
					  <div id='templatemo_site_title' style='line-height:25px;position:relative;top:-10px;left:-15px;font-family:"freestyle script";'>FAST SCHEDULER-- THE Time Table Generator</div>
				   </div>

				 <div id='top_panel_rs'>
					  <div id='templatemo_menu'>
					  
					 <?php
					 if(!(isset($_SESSION['username']) or isset($_SESSION['usernameLimited']))){
		
				
								echo "<form action='login.php' method='post' style='float:right;position:relative;top:20px;left:-50px'>
							User Name:<input type='text' name='username' style='width:200px;'/>
							Password: <input type='password' name='password' style='width:200px;'/>
							<input type='submit' name='' value='LogIn'/>
							</form>"; 
				
						}
						else{
						if(isset($_SESSION["username"]))
					 echo "<p style='height:0px;margin-top:33px;'>Welcome  ".$_SESSION["username"]."<a href='logout.php' class='link' style='margin-left:400px;'>LogOut</a></p>";
				
				if(isset($_SESSION["userAdmin"]))
					 echo "<p style='height:0px;margin-top:33px;'>Welcome  ".$_SESSION["userAdmin"]."<a href='logout.php' class='link' style='margin-left:400px;'>LogOut</a></p>";
				
				
					if(isset($_SESSION["usernameLimited"]))
						 echo "<p style='height:0px;margin-top:35px;'>Welcome  ".$_SESSION["usernameLimited"]."<a href='logout.php' class='link' style='margin-left:400px;'>LogOut</a></p>";
					}
				?>
						 <ul style='position:relative;top:20px;'>
						     <li><a href='index.php'  id='home'><span></span>Home</a></li>
						     <li><a href='features.php' id='feature'><span></span>Features</a></li>
						     <li><a href='register.php' id='register'><span></span>Register</a></li>
						     <li><a href='contact.php' id='contact'><span></span>Contact Us</a></li>
						     <li><a href='about.php' id='about'><span></span>About Us</a></li>
						 </ul>   
						
						 <div class='cleaner'></div> 	
					  </div> <!-- end of menu -->

					  <div class='cleaner'></div>
					  
					  
				  </div> 
				
			    </div> <!-- end of top _panel -->
				
				<div id='ct'></div>
			
			<div id='content' style=' height:270px;width:900px;overflow:visible;'>
				<img src='title.jpg' style='position:relative;left:-20px;top:-15px;'/>
						
			
			</div>
		
			<div id='cb'></div>
	
