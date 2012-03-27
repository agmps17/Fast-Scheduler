<?php
	if(isset($_SESSION['userAdmin']))
		echo "<h3>WELCOME ".$_SESSION['userAdmin']."</h3>";
	else
	echo "<h3>WELCOME ".$_SESSION['username']."</h3>";

	?>
	<p class="side_menu"><a href="lab_details.php">Lab Details</a></p>
<p class="side_menu"><a href="practical_details.php">Practical Details</a></p>
<p class="side_menu"><a href="practical_distribution.php">Practical Distribution</a></p>
<p class="side_menu"><a href="type_details.php">Teacher Distribution</a></p>
<p class="side_menu"><a href="teacher_details.php">Teacher Detail</a></p>
<p class="side_menu"><a href="class_details.php">Class Detail</a></p>
<p class="side_menu"><a href="subject_details.php">Subject Detail</a></p>
<p class="side_menu"><a href="sub_teach_class.php">Subject Class And Teacher Detail</a></p>		