<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../../index.php?errmsg=YOU ARE UNAUTHORISED");



?>





<html>
	
	
	<head>
		
		
		
		
	
	
	</head>
	
	
	
	
	<body>
	
		
		
		
		
			
			
				
							
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
						
						
					 
					 
					echo "<div id='tableview'><table border='1' id='viewTable'>";
					echo "<tr id='headTable'><td>Teacher(DAY".$_REQUEST['day']." Period ".$_REQUEST['period'].") Free Teachers</td><td>Subjects Taken By Them</td></tr>";
					
					for($i=0;$i<$count;$i++){
		
							
						$tn=mysql_query("select concat(name,'(',teacher_id,')') teacher from teacher_detail where group_id=".$_SESSION['group_id']."&& teacher_id='".$teacherarr[$i]."' ") or die(mysql_error());
						
						$tname=mysql_fetch_array($tn);
						
						$sd=mysql_query("select Distinct sub_detail.name from sub_detail join final_class_sub_teacher on sub_detail.sub_id=final_class_sub_teacher.sub_id where teacher_id=".$teacherarr[$i])or die(mysql_error());
						$sname=mysql_fetch_array($sd);
						
					
						
		
						echo "<tr><td>".$tname['teacher']."</td><td>".$sname['name']."</td></tr>";
		
		
									}
					echo "</table>";
					
					
					 
					
					
					echo "</div>";

						
					
					
					
					
					
					
					
					
					 
					
					
					
					
					
					?>
				
				
				</div>
						
			    <a HREF="javascript:window.print()">Click to Print This Page</a>
		
		
		
		
	
		
	
	</body>








</html>
