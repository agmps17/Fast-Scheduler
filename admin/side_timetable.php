<?php
	
		if(isset($_SESSION['userAdmin']))
		echo "<h3>WELCOME ".$_SESSION['userAdmin']."</h3>";
	else
	echo "<h3>WELCOME ".$_SESSION['username']."</h3>";


	?>
<p class="side_menu"><a href="query_timetable.php?teachers">Teachers TimeTable</a></p>
<p class="side_menu"><a href="query_timetable.php?lab">Lab TimeTable</a></p>
<p class="side_menu"><a href="query_timetable.php?class">Class TimeTable</a></p>
	