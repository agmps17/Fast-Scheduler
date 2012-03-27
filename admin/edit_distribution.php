<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../../index.php?errmsg=YOU ARE UNAUTHORISED");

if(!(isset($_GET['sub']) && isset($_GET['class']) && isset($_GET['section'])))
	header("Location:view_distribution.php");
	
	
	
	
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
				
				
				<form action="insert/change_teacher.php" method="post" class="cssform" id="updateTeacher">
					
						<fieldset>
							<legend>Change Teacher</legend>
					
						
					
					<?php
					
						include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
					$check=	mysql_query("select * from final_class_sub_teacher where class_id=".$_GET['class']." &&section=".$_GET['section']." &&sub_id=".$_GET['sub']);
						if(mysql_num_rows($check)==0)
						header("location:view_distribution.php");
						
						$cn=mysql_query("select name from class_detail where group_id=".$_SESSION['group_id']."&& class_id='".$_GET['class']."' ") or die(mysql_error());
						$sn=mysql_query("select concat(name,'(',sub_type,')') name from sub_detail where group_id=".$_SESSION['group_id']."&& sub_id='".$_GET['sub']."' ") or die(mysql_error());
						if(mysql_num_rows($cn)==0 or mysql_num_rows($sn)==0 )
						header("location:view_distribution.php");
						
						$cname=mysql_fetch_array($cn);
						$sname=mysql_fetch_array($sn);
						
						echo "<p><label for='txtClass'>Class
								<span class='mand'>*<span></label>
								<select  id='txtClass'  name='class' disabled >
								<option value=".$_GET['class'].">".$cname['name']."</option>
								</select>
								<span  class='Error'>REQUIRED</span>
						</p>
						
						<p><label for='txtSection'>Section
								</label>
								<input type='text' id='txtSection' value=".$_GET['section']." name='section' disabled />
								
						</p>
						<p><label for='txtsub'>Subject
								</label>
								<select  id='txtSubject'  name='sub' disabled >
								<option value=".$_GET['sub'].">".$sname['name']."</option>
								</select>
								
						</p>";
						
						
						echo "<p><label >Teacher
								<span class='mand'>*<span></label>
								<select  id='teacher'  name='teacher' >";		
								
								
								
								$rp=mysql_query("select teacher_detail.teacher_id id,concat(name,'(',teacher_detail.teacher_id,')') teacher from sub_class_teach join teacher_detail on teacher_detail.teacher_id=sub_class_teach.teacher_id  where class_id=".$_GET['class']." && teacher_detail.group_id=".$_SESSION['group_id']."")or die(mysql_error());
								
								if(mysql_num_rows($rp)==0)
								header("location:view_distribution.php");
								
								while($row=mysql_fetch_array($rp)){
																		
								echo "<option value=". $row['id']. ">".$row['teacher']."</option>";
								}
							
							echo "</select>
								<span  class='Error'>REQUIRED</span>
							</p>
							<p><input type='submit' id='updateTeacherButton' value='EDIT' />
							
							
							
							";
						
					 ?>
				
				</div>
						
			
		</div>
		
		<div id="cb"></div>
	
		<?php
	
		include("footer.php");
	
		?>
	
	
	
	</body>








</html>
