<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../index.php?errmsg=YOU ARE UNAUTHORISED");



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
				$("#className").change(function(){
					location.href="?class&&class_id="+$("#className").val();
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
						if(isset($_GET['class'])){
						unset($_GET['teachers']);
						unset($_GET['lab']);
						
						echo "<form action='class_timetable.php' method='GET' class='cssform'><fieldset><legend>CLASS TIMETABLE</legend>";
						echo "<p><label for=''>Class Name
									<span class='mand'>*<span></label>
									<select id='className' name='class_id'>";
						include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
						$rp=mysql_query("select name,class_id from class_detail where group_id=".$_SESSION['group_id']."");
						echo "<option>----------------SELECT-----------------</option>";
						
						
						while($row=mysql_fetch_array($rp)){
						$sel=($_GET["class_id"]==$row['class_id'])?"selected":"";
						echo "<option value=".$row['class_id']." $sel>".$row['name']."</option>";


						}			
					echo "
								</select>
								<span  class='Error'>REQUIRED</span>
							</p>";
							
						if(isset($_GET['class_id'])){
							echo"<p><label for='section'>Section</label><select name='section'>";	
						$query=mysql_query("select sections from class_detail where class_id=".$_GET['class_id']);
						$fetch=mysql_fetch_array($query);
						echo "hello  ".$fetch['sections'];
						
							for($j=1;$j<=$fetch['sections'];$j++){
									echo "<option>$j</option>";
							
							
							
							}
							echo "</select></p>";
							
							echo "<p><input type='submit' value='VIEW'/></p>";
						
						
						}	
							
						echo"</feildset></form>";
					
					
					
					}
				?>
				<?php
					if(isset($_GET['teachers'])){
					unset($_GET['lab']);
					
					echo "<form action='teacher_timetable.php' method='GET' class='cssform'><fieldset><legend>CLASS TIMETABLE</legend>";
						echo "<p><label for=''>Teacher Name
									<span class='mand'>*<span></label>
									<select id='teacherName' name='teacher_id'>";
						
						$rp=mysql_query("select name,teacher_id from teacher_detail where group_id=".$_SESSION['group_id']."");
						echo "<option>----------------SELECT-----------------</option>";
						
						
						while($row=mysql_fetch_array($rp)){
						
						echo "<option value=".$row['teacher_id']." $sel>".$row['name']."</option>";


						}			
					echo "
								</select>
								<span  class='Error'>REQUIRED</span>
							</p>";
					
					echo "<p><input type='submit' value='VIEW'/></p>";
					echo"</feildset></form>";
					
					
					
					}
				?>
				<?php
					if(isset($_GET['lab'])){
					
					echo "<form action='lab_timetable.php' method='GET' class='cssform'><fieldset><legend>CLASS TIMETABLE</legend>";
						echo "<p><label for=''>Lab Name
									<span class='mand'>*<span></label>
									<select id='labName' name='lab_id'>";
						
						$rp=mysql_query("select name,lab_id from labs where group_id=".$_SESSION['group_id']."");
						echo "<option>----------------SELECT-----------------</option>";
						
						
						while($row=mysql_fetch_array($rp)){
						
						echo "<option value=".$row['lab_id']." $sel>".$row['name']."</option>";


						}			
					echo "
								</select>
								<span  class='Error'>REQUIRED</span>
							</p>";
					
					echo "<p><input type='submit' value='VIEW'/></p>";
					echo"</feildset></form>";
					
					
					
					}
				?>
				</div>
				
				
				

			</div>
						
			
		</div>
		
		<div id="cb"></div>
	
		<?php
	
		include("footer.php");
	
		?>
	
	
	
	</body>








</html>
