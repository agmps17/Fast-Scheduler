<?php
	
		if(isset($_SESSION['userAdmin']))
		echo "<h3>WELCOME ".$_SESSION['userAdmin']."</h3>";
		else
		echo "<h3>WELCOME ".$_SESSION['username']."</h3>";


	?>
	
<p class="side_menu"><a href="general_details.php">School Details</a></p>
<p class="side_menu" class="confirm"><a href="distribution.php">Distribute Subjects to teacher </a></p>	
<p class="side_menu"><a href="view_distribution.php">View Distributed Subjects to teacher </a></p>
<p class="side_menu"><a href="view_load.php">View Teacher Total Load </a></p>	
<p class="side_menu"><a href="timetable.php">View Timetable </a></p>	