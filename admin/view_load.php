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
				
						include("side_home.php");
				
				
					?>
				
				</div>
				
				<div id="main_panel">
				
					<?php
					
						include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
					 $tl=mysql_query("select * from teacher_load where group_id=".$_SESSION['group_id']."") or die(mysql_error());
					
					if (!(isset($_GET['page']))) 

					 { 

					 $_GET['page'] = 1; 

					 } 
										 
					 $rows=mysql_num_rows($tl);
					 
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
					
					
					
					$tl_p=mysql_query("select * from teacher_load where group_id=".$_SESSION['group_id']." $max") or die(header("location:index.php?errmsg=first declare sub,class and teacher"));

					
					
					
					
					echo "<div id='tableview'><table border='1' id='viewTable'>";
					echo "<tr id='headTable'><td>Teacher</td><td>Load</td></tr>";
					
					while($row=mysql_fetch_array($tl_p)){
		
							if($row['teacher_id']!=0){
						$tn=mysql_query("select concat(name,'(',teacher_id,')') teacher from teacher_detail where group_id=".$_SESSION['group_id']."&& teacher_id='".$row['teacher_id']."' ") or die(mysql_error());
						
						$tname=mysql_fetch_array($tn);
						
						}
					else
					$tname['teacher']='No Teacher';	
		
						echo "<tr><td>".$tname['teacher']."</td><td>".$row['load']."</td></tr>";
		
		
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
