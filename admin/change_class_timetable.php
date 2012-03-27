<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../../index.php?errmsg=YOU ARE UNAUTHORISED");
 if(!(isset($_GET['teacher'])&&isset($_GET['class'])&&isset($_GET['section'])&&isset($_GET['sub'])&&isset($_GET['period'])&&isset($_GET['dayold'])))
	 // header("location:timetable.php");

?>





<html>
	
	
	<head>
		
		<link rel="stylesheet" type="text/css" href="../style.css"/>
		<link rel="stylesheet" type="text/css" href="../form.css"/>
		<script type="text/javascript" src="../jquery.js" language="javascript" charset="utf-8">
		</script>
		<script type="text/javascript" src="main.js" language="javascript" charset="utf-8">
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#dayChange").change(function(){
				<?php
				echo "var a=".$_GET['teacher'].";";
				echo "var b=".$_GET['class'].";";
				echo "var c=".$_GET['section'].";";
				echo "var d=".$_GET['sub'].";";
				echo "var e=".$_GET['period'].";";
				echo "var f=".$_GET['dayold'].";";
				
				
				?>
					location.href="?dayChange="+$("#dayChange").val()+"&& teacher="+a+"&& class="+b+"&& section="+c+"&& sub="+d+"&& period="+e+"&& dayold="+f+"";
				});
			});
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
					 
						
						$rp=mysql_query("select * from final_class_sub_teacher where teacher_id=".$_GET['teacher']."&&class_id=".$_GET['class']."&&sub_id=".$_GET['sub']."&& `section`=".$_GET['section']." && group_id=".$_SESSION['group_id'])or die(mysql_error());
					
					if(mysql_num_rows($rp)==0)
					 header("location:timetable.php");
					 
					
					 
					
						$rp=mysql_query("select frequency,number_lectures from school_detail where group_id=".$_SESSION['group_id']."");
						$row=mysql_fetch_array($rp);
						$lectures=$row['number_lectures'];
						$frequency=$row['frequency'];
						
						 echo "<form action='change_class_timetable.php?section=".$_GET['section']."&&class=".$_GET['class']."&& sub=".$_GET['sub']."&& teacher=".$_GET['teacher']." && period=".$_GET['period']."&&dayold=".$_GET['dayold']."' method='POST' class='cssform'><fieldset><legend>CLASS TIMETABLE</legend>";
													
							?>
							<p><label for="dayChange">Day</label><select name="dayChange" id="dayChange">
												<option>--select--</option>
								<?php

										for($i=1;$i<=$frequency;$i++){
											$sel=($_GET["dayChange"]==($i))?"selected":"";
											echo "<option value='".($i)."' $sel>".$i."</option>";
										}

								?>
											</select></p>
								<?php	
									
									
							
							if(isset($_REQUEST['dayold'])&&isset($_REQUEST['dayChange'])){
							
							
							
							
							
							$t=mysql_query("select * from teacher_timetable_".$_SESSION['group_id']." where day_id=".$_REQUEST['dayChange']."&&teacher_id=".$_GET['teacher']);
							$teacherinfo=mysql_fetch_array($t);
									
							
							$periodarr=array();
							
							
							class periodin{
							public $teacher_id=0;
							public $index=0;
												
							}
							
							$periodinfo=array();
							
							for($period=1;$period<=$lectures;$period++){
							$str="period$period";
							
							
							
							if($teacherinfo[$str]==0){
							
								$ar=mysql_query("select $str period from class_timetable_".$_SESSION['group_id']." where day_id=".$_REQUEST['dayChange']."&&class_id=".$_GET['class']." && section_id=".$_GET['section']." ");
								$new=mysql_fetch_array($ar);
								$index=$new['period'];	
								if($index==0){
								$periodarr[]=$period;
								$periodinfo[$period]=new periodin();
								
								
								}
								else{
								
								$getT=mysql_query("select teacher_id from final_class_sub_teacher where `index`=".$index);
								$fetchT=mysql_fetch_array($getT);
								$newTeacher=$fetchT['teacher_id'];
								$str2="period".$_GET['period'];
								
								$t=mysql_query("select $str2 period from teacher_timetable_".$_SESSION['group_id']." where day_id=".$_REQUEST['dayold']."&&teacher_id=".$newTeacher);
								$newTeacherinfo=mysql_fetch_array($t);
								$ind=$newTeacherinfo['period'];
								if($ind==0){
								$periodarr[]=$period;
								$periodinfo[$period]=new periodin();
								$periodinfo[$period]->teacher_id=$newTeacher;
								$periodinfo[$period]->index=$index;
								
								}
								
									
								
								
								}
							}
							
							}
							
								
								if(count($periodarr)==0)
								echo "<p align='center'><span class='mand' >No Period Available</span></label>";
								else{
									
									echo "<p><label>Period Which Can be Altered</label><select name='periodChange'>";

												
												for($n=0;$n<count($periodarr);$n++){
													
													

														
													 echo "<option value=".$periodarr[$n].">".$periodarr[$n]."</option>";
								
												
												}
												
												echo "</select></p>";
												
												echo "<p><input type='submit' value='CHANGE'/></p>";
												
												echo"</feildset></form>";
								
											
											if(isset($_POST['periodChange'])){
											
											$str="period".$_REQUEST['period'];
											$ar=mysql_query("select $str period from class_timetable_".$_SESSION['group_id']." where day_id=".$_REQUEST['dayold']."&&class_id=".$_GET['class']." && section_id=".$_GET['section']." ");
											$new=mysql_fetch_array($ar);
											$index=$new['period'];
											
										 if($periodinfo[$_POST['periodChange']]->index==0){
										 	mysql_query("update teacher_timetable_".$_SESSION['group_id']." SET period".$_POST['periodChange']."=$index where (day_id=".$_REQUEST['dayChange']."&&teacher_id=".$_GET['teacher'].")");
											mysql_query("update teacher_timetable_".$_SESSION['group_id']." SET period".$_GET['period']."=0 where (day_id=".$_GET['dayold']."&&teacher_id=".$_GET['teacher'].")");
											mysql_query("update class_timetable_".$_SESSION['group_id']." SET period".$_POST['periodChange']."=$index where ( day_id=".$_REQUEST['dayChange']."&&class_id=".$_GET['class']."&& section_id=".$_GET['section']." )");
											mysql_query("update class_timetable_".$_SESSION['group_id']." SET period".$_GET['period']."=0 where (day_id=".$_GET['dayold']."&&class_id=".$_GET['class']." && section_id=".$_GET['section'].")");	
													
											
										}
										else{
											$ind=$periodinfo[$_POST['periodChange']]->index;
											$teachers=$periodinfo[$_POST['periodChange']]->teacher_id;
											mysql_query("update teacher_timetable_".$_SESSION['group_id']." SET period".$_POST['periodChange']."=$index where (day_id=".$_POST['dayChange']."&&teacher_id=".$_GET['teacher'].")");
											mysql_query("update teacher_timetable_".$_SESSION['group_id']." SET period".$_GET['period']."=0 where (day_id=".$_GET['dayold']."&&teacher_id=".$_GET['teacher'].")");
											mysql_query("update class_timetable_".$_SESSION['group_id']." SET period".$_POST['periodChange']."=$index where ( day_id=".$_POST['dayChange']."&&class_id=".$_GET['class']."&& section_id=".$_GET['section']." )");
											mysql_query("update class_timetable_".$_SESSION['group_id']." SET period".$_GET['period']."=$ind where (day_id=".$_GET['dayold']."&&class_id=".$_GET['class']." && section_id=".$_GET['section'].")");	
											mysql_query("update teacher_timetable_".$_SESSION['group_id']." SET period".$_POST['periodChange']."=0 where (day_id=".$_POST['dayChange']."&&teacher_id=".$teachers.")");
											mysql_query("update teacher_timetable_".$_SESSION['group_id']." SET period".$_GET['period']."=$index where (day_id=".$_GET['dayold']."&&teacher_id=".$teachers.")");
													
										
										
										
										
										
										}
											
											
											
										header("location:class_timetable.php?class_id=".$_GET['class']."&& section=".$_GET['section']);	
											
											
											
											
											
											
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
