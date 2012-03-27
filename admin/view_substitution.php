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
					
					$str="period".$_REQUEST['period'];
					$tl=mysql_query("select $str period,teacher_id from teacher_timetable_".$_SESSION['group_id']." where day_id=".$_REQUEST['day']) or die(mysql_error());
					$teacherarr=array();
						while($row=mysql_fetch_array($tl)){
						
							if($row['period']==0)
							$teacherarr[]=$row['teacher_id'];
						
						
						
						
						}
						
						
						$count=count($teacherarr);
						
						if (!(isset($_GET['page']))) 

					 { 

					 $_GET['page'] = 1; 

					 } 
										 
					
					 
					 
					 
					 $last = ceil($count/12); 
					 if ($_GET['page'] < 1) 

					 { 

					 $_GET['page'] = 1; 

					 } 

					 elseif ($_GET['page'] > $last) 

					 { 

					 $_GET['page'] = $last; 

					 } 
					 $start=($_GET['page']-1)*12;
					 $end=min($start+12,$count);
					
					 echo "<br/>";
					
					 
					 
					echo "<div id='tableview'><table border='1' id='viewTable'>";
					echo "<tr id='headTable'><td>Teacher(DAY".$_REQUEST['day']." Period ".$_REQUEST['period'].") Free Teachers</td><td>Subjects Taken By Them</td></tr>";
					
					for($i=$start;$i<$end;$i++){
		
							
						$tn=mysql_query("select concat(name,'(',teacher_id,')') teacher from teacher_detail where group_id=".$_SESSION['group_id']."&& teacher_id='".$teacherarr[$i]."' ") or die(mysql_error());
						
						$tname=mysql_fetch_array($tn);
						
						$sd=mysql_query("select Distinct sub_detail.name from sub_detail join final_class_sub_teacher on sub_detail.sub_id=final_class_sub_teacher.sub_id where teacher_id=".$teacherarr[$i])or die(mysql_error());
						$sname=mysql_fetch_array($sd);
						
					
						
		
						echo "<tr><td>".$tname['teacher']."</td><td>".$sname['name']."</td></tr>";
		
		
									}
					echo "</table>";
					echo " <p><b>--Page ".$_GET['page']." of $last--</b> </p>";
					if($last!=1){
						
								if ($_GET['page'] == 1 ) 

					 {
						$next = $_GET['page']+1;

						echo " <a href='{$_SERVER['PHP_SELF']}?day=".$_REQUEST['day']." && period=".$_REQUEST['period']."&&page=$next' class='navigatePage'><b>Next ->></b></a> ";
						echo " <a href='{$_SERVER['PHP_SELF']}?day=".$_REQUEST['day']." && period=".$_REQUEST['period']."&&page=$last' class='navigatePage'>Last ->></a> ";
					 } 

					   
					
					 else if ($_GET['page'] == $last) 

					 {
					 echo " <a href='{$_SERVER['PHP_SELF']}?day=".$_REQUEST['day']." && period=".$_REQUEST['period']."&&page=1' class='navigatePage'> <<-First</a> ";

					$next = $_GET['page']+1;

					
					$previous = $_GET['page']-1;
					echo " <a href='{$_SERVER['PHP_SELF']}?day=".$_REQUEST['day']." && period=".$_REQUEST['period']."&&page=$previous' class='navigatePage'><<-Previous</a> ";

					 } 
					else 

					 {

					 echo " <a href='{$_SERVER['PHP_SELF']}?day=".$_REQUEST['day']." && period=".$_REQUEST['period']."&&page=1' class='navigatePage'><<- First</a> ";

					$next = $_GET['page']+1;

					echo " <a href='{$_SERVER['PHP_SELF']}?day=".$_REQUEST['day']." && period=".$_REQUEST['period']."&&page=$next' class='navigatePage'><b>Next ->></b></a> ";

					$previous = $_GET['page']-1;

					echo " <a href='{$_SERVER['PHP_SELF']}?day=".$_REQUEST['day']." && period=".$_REQUEST['period']."&&page=$previous' class='navigatePage'><<-Previous</a> ";
					
					echo " <a href='{$_SERVER['PHP_SELF']}?day=".$_REQUEST['day']." && period=".$_REQUEST['period']."&&pagenum=$last' class='navigatePage'>Last ->></a> ";		
					 }
					
					
					
					
					}
					 
					
					echo"<a href='print_substitution_details.php?day=".$_REQUEST['day']."&&period=".$_REQUEST['period']."'><button>Print Whole Details</button></a>";
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
