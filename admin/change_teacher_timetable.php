<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../../index.php?errmsg=YOU ARE UNAUTHORISED");
if(!(isset($_GET['teacher'])&&isset($_GET['class'])&&isset($_GET['section'])&&isset($_GET['sub'])&&isset($_GET['period'])&&isset($_GET['dayold'])))
	header("location:timetable.php");

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
					 
					 $rp=mysql_query("select * from final_class_sub_teacher where teacher_id=".$_GET['teacher']."&&class_id=".$_GET['class']."&&sub_id=".$_GET['sub']."&&section=".$_GET['section'])or die(header("location:timetable.php"));
					 if(mysql_num_rows($rp)==0)
					 header("location:timetable.php");
					 
					 
					 
					
						
						$rp=mysql_query("select frequency,number_lectures from school_detail where group_id=".$_SESSION['group_id']."");
						$row=mysql_fetch_array($rp);
						$lectures=$row['number_lectures'];
						
						 echo "<form action='change_teacher_timetable.php?teacher=".$_GET['teacher']."&&class=".$_GET['class']."&&sub=".$_GET['sub']."&&section=".$_GET['section']."&&period=".$_GET['period']."&&dayold=".$_GET['dayold']."' method='POST' class='cssform'><fieldset><legend>CLASS TIMETABLE</legend>";
													
							
							if(isset($_REQUEST['dayold'])){
							
							
							$subquery=mysql_query("select sub_type from sub_detail where sub_id=".$_GET['sub']."&& group_id=".$_SESSION['group_id']);
							$sub=mysql_fetch_array($subquery);
							$r=mysql_query("select * from class_timetable_".$_SESSION['group_id']." where day_id=".$_REQUEST['dayold']."&&class_id=".$_GET['class']." && section_id=".$_GET['section']);
							$classarr=mysql_fetch_array($r);
							$t=mysql_query("select * from teacher_timetable_".$_SESSION['group_id']." where day_id=".$_REQUEST['dayold']."&&teacher_id=".$_GET['teacher']);
							$teacherarr=mysql_fetch_array($t);
							
							
							
							$periodarr=array();
							for($period=1;$period<=$lectures;$period++){
							$str="period$period";
							
							if($classarr[$str]==0&&$teacherarr[$str]==0){
								$periodarr[]=$period;
								
							}
							
							}
								if(count($periodarr)==0)
								echo "<p align='center'><span class='mand' >No Period Available</span></label>";
								else{
										
										if($sub['sub_type']=='Practical'){
							
											header("location:teacher_timetable.php?teacher_id=".$_GET['teacher']."&&errmsg=practial subject timetable has to be changed by changing class timetable ");
							
							
							
										}
										else{
											echo "<p><label>Period</label><select name='changePeriod'>";

												
												for($n=0;$n<count($periodarr);$n++){
													
												

													
													echo "<option value=".$periodarr[$n].">".$periodarr[$n]."</option>";
								
												
												}
												
												echo "</select></p>";
												
												echo "<p><input type='submit' value='CHANGE'/></p>";
												
												echo"</feildset></form>";
												
												if(isset($_POST['changePeriod'])){
														$qufin=mysql_query("select period".$_GET['period']." ind from teacher_timetable_".$_SESSION['group_id']." where (day_id =".$_GET['dayold']." && teacher_id =".$_GET['teacher'].")") or die(mysql_error());
													$index=	mysql_fetch_array($qufin);
													 
													mysql_query("update teacher_timetable_".$_SESSION['group_id']." SET period".$_GET['period']."=0 where (day_id=".$_GET['dayold']."&&teacher_id=".$_GET['teacher'].")");
													mysql_query("update teacher_timetable_".$_SESSION['group_id']." SET period".$_POST['changePeriod']."=".$index['ind']." where ( day_id=".$_GET['dayold']."&&teacher_id=".$_GET['teacher'].")");	
													mysql_query("update class_timetable_".$_SESSION['group_id']." SET period".$_POST['changePeriod']."=".$index['ind']." where ( day_id=".$_GET['dayold']."&&class_id=".$_GET['class']."&& section_id=".$_GET['section']." )");
													mysql_query("update class_timetable_".$_SESSION['group_id']." SET period".$_GET['period']."=0 where (day_id=".$_GET['dayold']."&&class_id=".$_GET['class']." && section_id=".$_GET['section'].")");	
													header("location:teacher_timetable.php?teacher_id=".$_GET['teacher']);
												}
												
												
												
										}
													
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
