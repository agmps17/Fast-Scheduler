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
				
					<?php
					
						include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
						
						$vd=mysql_query("select * from practical_details where group_id=".$_SESSION['group_id']);
						
						if (!(isset($_GET['page']))) 

					 { 

					 $_GET['page'] = 1; 

					 } 
										 
					 $rows=mysql_num_rows($vd);
					 
					 $page_rows = 15; 
					 
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
					 
						
					$vd_f=mysql_query("select * from practical_details where group_id=".$_SESSION['group_id']." $max") or die(header("location:practical_details.php?errmsg=Insert Details First"));	
						
						
						
						
						
						
						
						
						
						
						
						echo "<div id='tableview'><table border='1' id='viewTable'>";
					echo "<tr id='headTable'><td>Lab Name</td><td>Subject</td><td>Duration</td></tr>";
						
						while($row=mysql_fetch_array($vd_f)){
						
						
						
						$cn=mysql_query("select name from labs where group_id=".$_SESSION['group_id']."&& lab_id='".$row['lab_id']."' ") or die(mysql_error());
						$sn=mysql_query("select name from sub_detail where group_id=".$_SESSION['group_id']."&& sub_id='".$row['sub_id']."' ") or die(mysql_error());
						$sname=mysql_fetch_array($sn);
						$cname=mysql_fetch_array($cn);
					
					
						
						
						
						echo "<tr><td><b>".$cname['name']."</b></td><td>".$sname['name']."</td><td>".$row['duration']."</td></tr>";
						
						
						
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
