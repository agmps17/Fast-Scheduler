<?php
ob_start();
session_start();
if(!isset($_SESSION['usernameLimited']))
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
	<style type="text/css">
		
			
			#timetable{
		position: relative;
	color: #ffffff;
	background: url(../images/templatemo_menu_button_right.png) bottom right no-repeat;
		
		
		
		
		
		}
			
			
		</style>
	
	</head>
	
	
	
	
	<body>
	
		<?php
			
			include("header.php");
			
		
		?>
		
		
		<div id="ct"></div>
			
			<div id="content">
				
				<div id="side_panel">
					<?php
				
						include("side.php");
				
				
					?>
				
				</div>
				
				<div id="main_panel">
				
					<?php
					
						include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
						
						$arbit=mysql_query("select teacher_id from teacher_detail where email_id='".$_SESSION['usernameLimited']."' && group_id=".$_SESSION['group_id'])or die(mysql_error());
						$id=mysql_fetch_array($arbit);	
					 
					if(isset($id['teacher_id'])){
							
						$tnq=mysql_query("select name from teacher_detail where teacher_id=".$id['teacher_id']);
						$tcn=mysql_fetch_array($tnq);
						$teacher=$tcn['name'];	
							
							
							
						$rp=mysql_query("select * from teacher_timetable_".$_SESSION['group_id']." where teacher_id=".$id['teacher_id']) or die(mysql_error());
						if(mysql_num_rows($rp)!=0){
											
						$scd=mysql_query("select * from school_detail where group_id=".$_SESSION ["group_id"])or die(mysql_error());
						$row=mysql_fetch_array($scd);

						$frequency= $row['frequency'];		
						$lectures= $row['number_lectures'];
						$break=$row['break_time'];
						echo "<div id='tableview'><table border='1' id='viewTable'>";
						echo "<tr><td colspan=".($frequency+1)."><b style='color:WHITE;text-transform: uppercase;'>".$teacher."(".$id['teacher_id'].")</b></td> </tr>";
						echo "<tr id='headTable'><td>PERIOD/DAY</td>";
						for($i=1;$i<=$frequency;$i++){
						echo "<td>DAY ".$i."</td>";
						}
						echo "</tr>";
						
						for($i=1;$i<=$break;$i++){
						echo "<tr><td id='headTable'> PERIOD ".$i." </td>";
						
								for($j=1;$j<=$frequency;$j++){
								$gi=mysql_query("select period".$i." period from teacher_timetable_".$_SESSION['group_id']." where teacher_id=".$id['teacher_id']." && day_id=".$j)or die(mysql_error());
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
									echo "<td><b style='text-transform:uppercase;'>".$fcn['name']."(".$section.")</b><br/>".$fsn['name']."</td>";
									
									}
								
								}
						
							echo "</tr>";				
							}
							
							
							
							
							echo "<tr id='headTable'><td colspan=".($frequency+1).">LUNCH</td></tr>";
							
							for($i=($break+1);$i<=$lectures;$i++){
							echo "<tr><td id='headTable'> PERIOD ".$i." </td>";
						
								for($j=1;$j<=$frequency;$j++){
								$gi=mysql_query("select period".$i." period from teacher_timetable_".$_SESSION['group_id']." where teacher_id=".$id['teacher_id']." && day_id=".$j)or die(mysql_error());
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
									echo "<td><b style='text-transform:uppercase;'>".$fcn['name']."(".$section.")</b><br/>".$fsn['name']."</td>";
									
									}
								
								}
						
						
						
						
						
						echo "</tr>";	
						}
						
						
						
						
						
						echo "</table></div>";
						
						}
						else{
						
						header("location:index.php?errmsg=timetable not set yet");
						
						
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
