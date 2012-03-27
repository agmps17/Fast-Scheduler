			
		<div id="ct"></div>
			
			<div id="login_index">
			
				<?php
				
				if(isset($_GET['errmsg']))
				echo "<span>".$_GET['errmsg']."</span>";
				
				?>
				<form action="login.php" method="post" style="float:right;">
				User Name:<input type="text" name="username" style="width:200px;"/>
				Password: <input type="password" name="password" style="width:200px;"/>
				<input type="submit" name="" value="LogIn"/>
				</form> 
			
			</div>
		
		<div id="cb"></div>
		
		
