<?php

session_start();

		include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
		$check=mysql_query("select * from labs where group_id=".$_SESSION['group_id']);
								if(mysql_num_rows($check)!=0){
								
									while($row=mysql_fetch_array($check)){
									
									if($row['teacher_id']==$_POST['teacher_id'])
										die(header("location:../sub_teach_class.php?errmsg=labassistant cannot be given a subject"));
									
									}
								
								}
		
		
		$rr=mysql_query("select * from sub_class_teach where ((class_id=".$_POST['class_id']."&&teacher_id=".$_POST['teacher_id'].")&&sub_id=".$_POST['sub_id'].")&& group_id='".$_SESSION ["group_id"]."'")or die(mysql_error());
		
		if(mysql_num_rows($rr)==0){
		mysql_query("insert into sub_class_teach (teacher_id,class_id,sub_id,group_id) values('".$_POST['teacher_id']."','".$_POST['class_id']."','".$_POST['sub_id']."','".$_SESSION ["group_id"]."')") or die(mysql_error());

header("location:../sub_teach_class.php?submitted");


}

else

header("location:../sub_teach_class.php?data already submitted");


?>
