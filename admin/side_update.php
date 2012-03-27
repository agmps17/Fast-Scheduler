<?php
		
		if(isset($_SESSION['userAdmin']))
		echo "<h3>WELCOME ".$_SESSION['userAdmin']."</h3>";
	else
	echo "<h3>WELCOME ".$_SESSION['username']."</h3>";


	?>
<p class="side_menu"><a href="view_teacher.php">View Details Of Teacher</a></p>	
<p class="side_menu"><a href="view_lab_details.php">View Lab Details</a></p>	
<p class="side_menu"><a href="view_practical_details.php">View Practical Details</a></p>	
<p class="side_menu"><a href="view_class.php">View Details Of Class</a></p>	
<p class="side_menu"><a href="view_type.php">View Details Of Type Of Teacher</a></p>	
<p class="side_menu"><a href="view_subject.php">View Details Of Subject</a></p>	
<p class="side_menu"><a href="view_sub_class_teacher.php">View Details Of Subject ,teacher and class</a></p>	