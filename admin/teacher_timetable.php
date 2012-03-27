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
				
						include("side_timetable.php");
				
				
					?>
				
				</div>
				
				<div id="main_panel">
				
					<?php
					
							include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
					 
					 
					if(isset($_GET['teacher_id'])){
							
						$tnq=mysql_query("select name from teacher_detail where teacher_id=".$_GET['teacher_id']);
						$tcn=mysql_fetch_array($tnq);
						$teacher=$tcn['name'];	
							
							
							
						$rp=mysql_query("select * from teacher_timetable_".$_SESSION['group_id']." where teacher_id=".$_GET['teacher_id']) or die(mysql_error());
						if(mysql_num_rows($rp)!=0){
											
						$scd=mysql_query("select * from school_detail where group_id=".$_SESSION ["group_id"])or die(mysql_error());
						$row=mysql_fetch_array($scd);

						$frequency= $row['frequency'];		
						$lectures= $row['number_lectures'];
						$break=$row['break_time'];
						echo "<div id='tableview'><table border='1' id='viewTable'>";
						echo "<tr><td colspan=".($frequency+1)."><b style='color:WHITE;text-transform: uppercase;'>".$teacher."(".$_GET['teacher_id'].")</b></td> </tr>";
						echo "<tr id='headTable'><td>PERIOD/DAY</td>";
						for($i=1;$i<=$frequency;$i++){
						echo "<td>DAY ".$i."</td>";
						}
						echo "</tr>";
						
						for($i=1;$i<=$break;$i++){
						echo "<tr><td id='headTable'> PERIOD ".$i." </td>";
						
								for($j=1;$j<=$frequency;$j++){
								$gi=mysql_query("select period".$i." period from teacher_timetable_".$_SESSION['group_id']." where teacher_id=".$_GET['teacher_id']." && day_id=".$j)or die(mysql_error());
								$ind=mysql_fetch_array($gi);
								$index=$ind['period'];
									if($index==0){
									
									echo "<td>---</td>";
									}
									else{
									
									$ad=mysql_query("select * from final_class_sub_teacher where `index`=".$index) or die(mysql_error());
									$fd=mysql_fetch_array($ad);
									$class=$fd['class_id'];
									$section=$fd['section'];
									$sub=$fd['sub_id'];
									
									$snq=mysql_query("select name,sub_type from sub_detail where group_id=".$_SESSION['group_id']." && sub_id=".$sub)  or die(mysql_error());
									$fsn=mysql_fetch_array($snq);
									$cnq=mysql_query("select name from class_detail where group_id=".$_SESSION['group_id']." && class_id=".$class)  or die(mysql_error());
									$fcn=mysql_fetch_array($cnq);
									
									if($fsn['sub_type']=='Practical')
									echo "<td><b style='text-transform:uppercase;'>".$fcn['name']."(".$section.")</b><br/>".$fsn['name']."(".$fsn['sub_type'].")</td>";
									else									
									echo "<td><a href='change_teacher_timetable.php?teacher=".$_GET['teacher_id']."&&class=".$class."&&section=".$section."&&sub=".$sub." &&period=".$i."&&dayold=".$j."' class='link'><b style='text-transform:uppercase;'>".$fcn['name']."(".$section.")</b><br/>".$fsn['name']."</a></td>";
									}
								
								}
						
							echo "</tr>";				
							}
							
							
							
							
							echo "<tr id='headTable'><td colspan=".($frequency+1).">LUNCH</td></tr>";
							
							for($i=($break+1);$i<=$lectures;$i++){
							echo "<tr><td id='headTable'> PERIOD ".$i." </td>";
						
								for($j=1;$j<=$frequency;$j++){
								$gi=mysql_query("select period".$i." period from teacher_timetable_".$_SESSION['group_id']." where teacher_id=".$_GET['teacher_id']." && day_id=".$j)or die(mysql_error());
								$ind=mysql_fetch_array($gi);
								$index=$ind['period'];
									if($index==0){
									
									echo "<td>---</td>";
									}
									else{
									
									$ad=mysql_query("select * from final_class_sub_teacher where `index`=".$index) or die(mysql_error());
									$fd=mysql_fetch_array($ad);
									$class=$fd['class_id'];
									$section=$fd['section'];
									$sub=$fd['sub_id'];
									
									$snq=mysql_query("select name,sub_type from sub_detail where group_id=".$_SESSION['group_id']." && sub_id=".$sub)  or die(mysql_error());
									$fsn=mysql_fetch_array($snq);
									$cnq=mysql_query("select name from class_detail where group_id=".$_SESSION['group_id']." && class_id=".$class)  or die(mysql_error());
									$fcn=mysql_fetch_array($cnq);
									
									if($fsn['sub_type']=='Practical')
									echo "<td><b style='text-transform:uppercase;'>".$fcn['name']."(".$section.")</b><br/>".$fsn['name']."(".$fsn['sub_type'].")</td>";
								else
									echo "<td><a href='change_teacher_timetable.php?teacher=".$_GET['teacher_id']."&&class=".$class."&&section=".$section."&&sub=".$sub." &&period=".$i."&&dayold=".$j."' class='link'><b style='text-transform:uppercase;'>".$fcn['name']."(".$section.")</b><br/>".$fsn['name']."</a></td>";
									
									}
								
								}
						
						
						
						
						
						echo "</tr>";	
						}
						
						
						
						
						
						echo "</table>";
						
						echo"<a href='print_teacher_timetable.php?teacher_id=".$_REQUEST['teacher_id']."'><button>Print Whole Details</button></a>";
						echo"</div>";
						
						}
						else{
						
						header("location:index.php?errmsg=Timetable cannot be created,data not completely inserted  ! ");
						
						}
						
						
					
					
					
					
					}
					
					
					?>
				
				
				</div>
						
			
		</div>
		
		<div id="cb"></div>
	
		<?php
	
		include("footer.php");
	
		?>
	
	
	
	</body>








</html>
