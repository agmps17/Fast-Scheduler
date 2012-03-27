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
	
	
	</head>
	
	
	
	
	<body>
	
		<?php
			
			include("header.php");
			
		
		?>
		
		
		<div id="ct"></div>
			
			<div id="content">
				
				<div id="side_panel">
					<?php
				
						include("home.php");
				
				
					?>
				
				</div>
				
				<div id="main_panel">
					<form action="insert/sub_class_teach.php" method="post" class="cssform" id="regSubTeach">
					
						<fieldset>
							<legend>Distribution Of Subject to Teacher and Class</legend>
							
								<?php
				
									if(isset($_GET['submitted']))
									{
									echo "<b style='color:red;margin-left:100px;font-size:20px;'>Class Detail saved successfully</b>";
				
									}
				
				
									?>
		
	
							<p><label for="">Subject Name
								<span class="mand">*<span></label>
								<select  id="subjectName" name="subject_name">
								<?php
								mysql_connect("localhost","root","arpit") or die("first");
								mysql_select_db("timetable") or die ("second");
								$rp=mysql_query("select concat(name,'(',sub_type,')') subject from sub_detail where group_id=".$_SESSION['group_id']."");
								while($row=mysql_fetch_array($rp)){
		
								echo "<option>".$row['subject']."</option>";
		
		
									}
								
								?>
								
								
								
								</select>
								<span  class="Error">REQUIRED</span>
							</p>
							<p><label for="">Teacher Name
								<span class="mand">*<span></label>
								<select id="teacherName" name="teacher_name">
								<?php
								mysql_connect("localhost","root","arpit") or die("first");
								mysql_select_db("timetable") or die ("second");
								$rp=mysql_query("select concat(name,'(',teacher_id,')') teacher from teacher_detail where group_id=".$_SESSION['group_id']."");
								while($row=mysql_fetch_array($rp)){
		
								echo "<option>".$row['teacher']."</option>";
		
		
									}
								
								?>
								
								
								
								</select>
								<span  class="Error">REQUIRED</span>
							</p>
							
							<p><label for="">Class Name
								<span class="mand">*<span></label>
								<select id="className" name="class_name">
								<?php
								mysql_connect("localhost","root","arpit") or die("first");
								mysql_select_db("timetable") or die ("second");
								$rp=mysql_query("select name from class_detail where group_id=".$_SESSION['group_id']."");
								while($row=mysql_fetch_array($rp)){
		
								echo "<option>".$row['name']."</option>";
		
		
									}
								
								?>
								
								
								
								</select>
								<span  class="Error">REQUIRED</span>
							</p>
							
							
							
							<p><input type="submit" value="SUBMIT" /> <input type="reset" value="RESET" /></p>
						</fieldset>
					</form>
				
				
				</div>
				
				
				

			</div>
						
			
		</div>
		
		<div id="cb"></div>
	
		<?php
	
		include("footer.php");
	
		?>
	
	
	
	</body>








</html>
