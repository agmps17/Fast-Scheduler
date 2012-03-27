<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../../index.php?errmsg=YOU ARE UNAUTHORISED");



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
			<p style='color:rgb(156,194,234);'>Clicking the heading of the tables you can update the data</p>
				
					<?php
					
						include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
					 $rp=mysql_query("select * from class_detail where group_id=".$_SESSION['group_id']."") or die(mysql_error());
					if (!(isset($_GET['page']))) 

					 { 

					 $_GET['page'] = 1; 

					 } 
										 
					 $rows=mysql_num_rows($rp);
					 
					 $page_rows = 10; 
					 
					 $last = ceil($rows/$page_rows); 
					 if ($_GET['page'] < 1) 

					 { 

					 $_GET['page'] = 1; 

					 } 

					 elseif ($_GET['page'] > $last) 

					 { 

					 $_GET['page'] = $last; 

					 } 
					 
					 $max = 'limit ' .($_GET['page']- 1) * $page_rows .',' .$page_rows; 
					 
						

					
					
					 $rp_f=mysql_query("select * from class_detail where group_id=".$_SESSION['group_id']." $max") or die(header("location:class_details.php?errmsg=Insert Class Details First"));
					
					
					
					
					
					
					
					
					echo "<div id='tableview'><table border='1' id='viewTable'>";
					echo "<tr id='headTable'><td>Class</td><td>No. of sections</td></tr>";
					
					while($row=mysql_fetch_array($rp_f)){
		
						echo "<tr><td><a href='update_class.php?id=".$row['class_id']."' class='link'>".$row['name']."</a></td><td>".$row['sections']."</td></tr>";
		
		
									}
					echo "</table>";
					
					echo " <p><b>--Page ".$_GET['page']." of $last--</b> </p>";
					if($last!=1){
						
								if ($_GET['page'] == 1 ) 

					 {
						$next = $_GET['page']+1;

						echo " <a href='{$_SERVER['PHP_SELF']}?page=$next' class='navigatePage'><b>Next ->></b></a> ";
						echo " <a href='{$_SERVER['PHP_SELF']}?page=$last' class='navigatePage'>Last ->></a> ";
					 } 

					   
					
					 else if ($_GET['page'] == $last) 

					 {
					 echo " <a href='{$_SERVER['PHP_SELF']}?page=1' class='navigatePage'> <<-First</a> ";

					$next = $_GET['page']+1;

					
					$previous = $_GET['page']-1;
					echo " <a href='{$_SERVER['PHP_SELF']}?page=$previous' class='navigatePage'><<-Previous</a> ";

					 } 
					else 

					 {

					 echo " <a href='{$_SERVER['PHP_SELF']}?page=1' class='navigatePage'><<- First</a> ";

					$next = $_GET['page']+1;

					echo " <a href='{$_SERVER['PHP_SELF']}?page=$next' class='navigatePage'><b>Next ->></b></a> ";

					$previous = $_GET['page']-1;

					echo " <a href='{$_SERVER['PHP_SELF']}?page=$previous' class='navigatePage'><<-Previous</a> ";
					
					echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$last' class='navigatePage'>Last ->></a> ";		
					 }
					
					
					
					
					}
					 
					
					
					echo "</div>";
					
					
					?>
				
				
				</div>
						
			
		</div>
		
		<div id="cb"></div>
	
		<?php
	
		include("footer.php");
	
		?>
	
	
	
	</body>








</html>
