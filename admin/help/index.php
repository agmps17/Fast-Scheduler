<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../index.php?errmsg=YOU ARE UNAUTHORISED");



?>





<html>
	
	
	<head>
		
		<link rel="stylesheet" type="text/css" href="../../style.css"/>
	
	
	</head>
	
	
	
	
	<body>
	
		<?php
			
			include("header.php");
			
		
		?>
		
		
		<div id="ct"></div>
			
			<div id="content" style='font-size:20px;line-height:23px;font-family:monotype corsiva;'>
				
				<div id="side_panel" style='line-height:20px;font-size:17px;'>
					<?php
				
						include("side_help.php");
				
				
					?>
				
				</div>
				
				<div id="main_panel">
				
				<?php
				if(isset($_GET['page'])){
						if($_GET['page']==1){
						
						
					echo "<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>School Details </h1>
						
						<p> School details include general information of school and the working information.
							you just have to fill it .
							it should be filled before all entry as thses details are ecessary to design an ouline of the timetable.</p>";
						
					echo	"<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>Insert Lab Details </h1>
						<p> This include general information of the lab and the lab assistant.This is neccesary becuase practical subject has to be given a lab in which practical is to be performed . </p>";
				
					echo	"<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>Practical Details </h1>
								<p>This is another need of a practical as differnt practical has different duration ,this is an assumption that there is only one practical of any subject in a week for a batch of a class ,so you shoul enter here the duration same as the subject load otherwise it will not accept the entry.Another constraint is to be kept in mind that it cannot exceed the no. of periods between start and break as practical can not take place at the time of break.</p>";
				
					echo "	<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>Practical Distribution </h1>
						<p>This is little tricky but a awesome feature.
						In school class having practical subject lab has less space to adapt so class is divided into equal batches and each batch is given a differnt practical subject.
						So click add to add practical subject you want to gat performed together</p>
						<p>
						Week frequency ask you about in a week how many such practical period of the above added practical is to be performed
						For Ex. you add two subjects and you want that rotatuon of batches is weekly that is let the batche be A & B ,so A will perform practical 1 first week and practical 2 next week,
							but if you want it batch A gets to do both the practical change week frequency to 2(as there are two subjects so 2 will complete the rotation),similarly if you add 3 subject than change week frequency to 3 if you want all three practical to be performed by one batch in same week</p>";
					
						}
						
					if($_GET['page']==2){

							
					echo	"<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>Teacher Distribution </h1>

						<p>This feature group teacher in the define type name. this is necessary to define every individual loads so that software can take care of loads while distributing and genrating timetable</p>";


					echo "<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>Teacher Detail </h1>
							<p>Just add the information of the teacher
							include him in the group defined,he will be alloted the same loads as defined of the group.
							</p>
							<p>Login type:As every teacher inserted has his own profile created,this is the type of right you want to give him
							<li>Limited :Can view Only his profile  </li><li>Admin:Can view,alter,access every detail of school  </li></ul></p>";

					echo "<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>Class Detail </h1>
					<p>Name of the calss is unique,no. of section tell you about in how many section class is diistributed</p>
					<p>For special classes in which half section study other subject and half study other define new classes
					For ex. In 10+2 half section is science ,half is of commerce then give two classes  the name 11th(science)and no. of science section
					11th(commerce)and no. of commerce sections.</p>	";			
						
					echo "<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>Subject Detail </h1>
							<p>Add subject  name( unique),its type,and no. of periods in a week</p>";
						
					}
					if($_GET['page']==3){
					
					echo "<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>Distribution of teacher,subject,class </h1>
						<p>This is the most necessary part of whole generation of timetable.It ask you to just add subjects to be taught in a class and all teachers who are eligible to teach in that class</p>
						<p>The Distribution process is whole dependent on this declaration,only those teachers will be assigned classes and subject who are enterd in this</p>
<p>You can't give lab assistant the subjects </p>";						
					
				echo"	<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>View Details of Teacher,Subject,Class,Type </h1>
						<p>You can view the dat you entered by clicking these links.by clicking the heading of the tables yoc can update the data</p>";
					
					echo"	<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>View Details of Distribution Teacher,Subject,Class </h1>
					
							<p>Clicking on remove button will remove that allotment</p>";
					echo"	<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>View Lab details </h1>
					
							<p>Clicking on remove button will remove that allotment of lab and its related allotment of practical</p>";
					
					}
					
					
					if($_GET['page']==4){
					
					echo"	<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>Distribute Subjects to teacher </h1>
							<p>It will distribute all the subjects,class entered in link distribution of teacher,class,subjects on the basis of experience of teacher and its maximum load</p>	
							<p>Most important feature of this is no teacher is given zero load every teacher is given a sum of a mimimum load </p>";
					
					echo"	<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>View Distribute Subjects to teacher and Teacher load </h1>
							<p>These links show the distribution done by the software and it can be changed by clicking on the heading</p>";	
					echo"	<h1 style='color:rgb(190,157,62);font-size:40px;font-family:freestyle script;'>View timetable </h1>
								<p>Select the domain whose timetable you want to see . it will be displayed ,click on the heading to change it,practical subject allocation cannot change,but any lecture subject allocation can be changed.</p>";
					
					
					
					}
						
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
