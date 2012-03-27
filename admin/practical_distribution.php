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
				
						include("side_insert.php");
				
				
					?>
				
				</div>
				
				<div id="main_panel">
					<form action="insert/practical_combination.php" method="post" class="cssform" id="regCombination">
					
						<fieldset>
							<legend>Combining Practical </legend>
							
								<?php
				
									if(isset($_GET['submitted']))
									{
									echo "<b style='color:red;margin-left:100px;font-size:20px;'>Class Detail saved successfully</b>";
				
									}
									if(isset($_GET['errmsg'])){
									
									
									echo "<p ><span class='errmsg'>".$_GET['errmsg']."</span></p>";
									
									}
				
				
									?>
									
						<p><label for="">Class 
								<span class="mand">*<span></label>
								<select id="className" name="class_id">
								<?php
								include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
								$rp=mysql_query("select name,class_id from class_detail where group_id=".$_SESSION['group_id']."");
								while($row=mysql_fetch_array($rp)){
		
								echo "<option value=".$row['class_id'].">".$row['name']."</option>";
		
		
									}
								
								?>
								
								
								
								</select>
								<span  class="Error">REQUIRED</span>
							</p>
		
						<div id='practicalSubject'>
							<p><label for="">Practical Subject
								<span class="mand">*<span></label>
								<select  id="subjectName" name="subject_name">
								<?php
								include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
								$rp=mysql_query("select concat(name,'(',sub_type,')') subject,sub_id from sub_detail where group_id=".$_SESSION['group_id']."&& sub_type='Practical'");
								while($row=mysql_fetch_array($rp)){
		
								echo "<option value=".$row['sub_id'].">".$row['subject']."</option>";
		
		
									}
								
								?>
								
								
								
								</select>
								<span  class="Error">REQUIRED</span>
							</p>
							
							
							
							
						</div>	
							
							<P><input type="button" id="buttonadd" value="ADD "/><input type="button" id="buttonremove" value="Remove"/></p>
							<p><label for="">Weekly Frequency
								<span class="mand">*</span></label>
								<input type='text' id="duration" name="frequency"><span style='margin-left:3px; font-size:15px;'>times per week</span>
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

					<script type="text/javascript">
						
var a=0;
					$('#buttonadd').click(function(){
					
					a++;
					
					
					<?php
					
					include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
								$rp=mysql_query("select concat(name,'(',sub_type,')') subject,sub_id from sub_detail where group_id=".$_SESSION['group_id']."&& sub_type='Practical'");
								$str="";
														
							while($row=mysql_fetch_array($rp)){
								$a=	$row['subject'];
								$b=$row['sub_id'];
								$str=$str."<option value=".$b.">".$a."</option>";
							
		
									}
					echo "var str='".$str."';";
					
					
					?>
					
				
					
					$('#practicalSubject').append("<p id='add"+a+"'><label >Practical Subject<span class='mand'>*</span></label><select id='subjectName' name='subject_name"+a+"' >"+str+"</select><span  class='Error'>REQUIRED</span></p>");
					
					
					
					
					
					
					
					
					
					
					});
					
					$("#buttonremove").click(function(){
							if(a==0)
							alert("nothing to remove");
							else{
							$("#add"+a).remove();
							a--;
							}
					});




					</script>





</html>
