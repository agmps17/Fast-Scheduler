<?php
ob_start();
session_start();
				if(isset($_SESSION['username']))
				unset($_SESSION['username']);
				
				if(isset($_SESSION['usernameLimited']))
				unset($_SESSION['usernameLimited']);
	
				
				header("Location: index.php");
			

?>




