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
					 
					 
					if(isset($_GET['class_id'])&& isset($_GET['section'])){
							
						$cnq=mysql_query("select name from class_detail where class_id=".$_GET['class_id']);
						$fcn=mysql_fetch_array($cnq);
						$class=$fcn['name'];	
							
							
							
						$rp=mysql_query("select * from class_timetable_".$_SESSION['group_id']." where class_id=".$_GET['class_id']." && section_id=".$_GET['section']) or die(mysql_error());
						if(mysql_num_rows($rp)!=0){
											
						$scd=mysql_query("select * from school_detail where group_id=".$_SESSION ["group_id"])or die(mysql_error());
						$row=mysql_fetch_array($scd);

						$frequency= $row['frequency'];		
						$lectures= $row['number_lectures'];
						$break=$row['break_time'];
						echo "<div id='tableview'><table border='1' id='viewTable'>";
						echo "<tr><td colspan=".($frequency+1)."><b style='color:WHITE;text-transform: uppercase;'>".$class."</b>         <span style='color:red;'> SECTION  ".$_GET['section']."</span> </td> </tr>";
						echo "<tr id='headTable'><td>PERIOD/DAY</td>";
						for($i=1;$i<=$frequency;$i++){
						echo "<td>DAY ".$i."</td>";
						}
						echo "</tr>";
						
						for($i=1;$i<=$break;$i++){
						echo "<tr><td id='headTable'> PERIOD ".$i." </td>";
						
								for($j=1;$j<=$frequency;$j++){
								$gi=mysql_query("select period".$i." period from class_timetable_".$_SESSION['group_id']." where class_id=".$_GET['class_id']." && section_id=".$_GET['section']."&& day_id=".$j)or die(mysql_error());
								$ind=mysql_fetch_array($gi);
								$index=$ind['period'];
									if($index==0){
									
									echo "<td>---</td>";
									}
									else{
									
									$ad=mysql_query("select * from final_class_sub_teacher where `index`=".$index) or die(mysql_error());
									$fd=mysql_fetch_array($ad);
									$teacher=$fd['teacher_id'];
									$sub=$fd['sub_id'];
									
									$snq=mysql_query("select name,sub_type from sub_detail where group_id=".$_SESSION['group_id']." && sub_id=".$sub)  or die(mysql_error());
									$fsn=mysql_fetch_array($snq);
									$tnq=mysql_query("select concat(name,'(',teacher_id,')') teacher from teacher_detail where group_id=".$_SESSION['group_id']." && teacher_id=".$teacher)  or die(mysql_error());
									$ftn=mysql_fetch_array($tnq);
										if($fsn['sub_type']=='Practical')
									echo "<td>".$fsn['name']."(".$fsn['sub_type'].")<br/>".$ftn['teacher']."</td>";
									else
									echo "<td><a href='change_class_timetable.php?class=".$_GET['class_id']."&&section=".$_GET['section']."&&teacher=$teacher&&sub=$sub &&period=$i &&dayold=$j' class='link'>".$fsn['name']."<br/>".$ftn['teacher']."</a></td>";
									
									}
								
								}
						
						echo "</tr>";				
						}
						
						
						
						
						echo "<tr id='headTable'><td colspan=".($frequency+1).">LUNCH</td></tr>";
						
						for($i=($break+1);$i<=$lectures;$i++){
						echo "<tr><td id='headTable'> PERIOD ".$i." </td>";
						
								for($j=1;$j<=$frequency;$j++){
								$gi=mysql_query("select period".$i." period from class_timetable_".$_SESSION['group_id']." where class_id=".$_GET['class_id']." && section_id=".$_GET['section']."&& day_id=".$j)or die(mysql_error());
								$ind=mysql_fetch_array($gi);
								$index=$ind['period'];
									if($index==0){
									
									echo "<td>---</td>";
									}
									else{
									
									$ad=mysql_query("select * from final_class_sub_teacher where `index`=".$index) or die(mysql_error());
									$fd=mysql_fetch_array($ad);
									$teacher=$fd['teacher_id'];
									$sub=$fd['sub_id'];
									
									$snq=mysql_query("select name,sub_type from sub_detail where group_id=".$_SESSION['group_id']." && sub_id=".$sub)  or die(mysql_error());
									$fsn=mysql_fetch_array($snq);
									$tnq=mysql_query("select concat(name,'(',teacher_id,')') teacher from teacher_detail where group_id=".$_SESSION['group_id']." && teacher_id=".$teacher)  or die(mysql_error());
									$ftn=mysql_fetch_array($tnq);
										if($fsn['sub_type']=='Practical')
									echo "<td>".$fsn['name']."(".$fsn['sub_type'].")<br/>".$ftn['teacher']."</td>";
									else
									echo "<td><a href='change_class_timetable.php?class=".$_GET['class_id']."&&section=".$_GET['section']."&&teacher=$teacher&&sub=$sub &&period=$i &&dayold=$j' class='link'>".$fsn['name']."<br/>".$ftn['teacher']."</a></td>";
									
									}
								
								}
						
						
						
						
						
						echo "</tr>";	
						}
						
						
						
						
						
						echo "</table>";
						
						echo"<a href='print_class_timetable.php?class_id=".$_REQUEST['class_id']."&&section=".$_REQUEST['section']."'><button>Print Whole Details</button></a>";
						echo"</div>";
						
						}
						else{
						
							header("location:index.php?errmsg=generate timetable first");
						
						
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
