<?php
ob_start();
session_start();
if(!isset($_SESSION['username']))
	header("Location: ../index.php?errmsg=YOU ARE UNAUTHORISED");



?>



<?php
	

	
	
	
			include("config.php");
		mysql_connect($config["DB_HOST"],$config["DB_USER"],$config["DB_PASS"]);
		mysql_select_db($config["DB_NAME"]);
			mysql_query("DELETE from final_class_sub_teacher where group_id=".$_SESSION ["group_id"])	;
			mysql_query("DELETE from teacher_load where group_id=".$_SESSION['group_id']);
	
	
	class teacher{
	
		public $experience;	
		public $maxload;
		public $totalload;
		public $allotedload;
	
	
	
	
	}
	$z=0;
	
	$td=mysql_query("select teacher_id,week_max,experience from teacher_detail natural join type_details  where teacher_detail.group_id=".$_SESSION ["group_id"])or die(mysql_error());
	
	
		$teachers=array();
		
		while($row=mysql_fetch_array($td)){
			$teachers[$row['teacher_id']]=new teacher();
			$teachers[$row['teacher_id']]->experience=$row['experience'];
			$teachers[$row['teacher_id']]->maxload=$row['week_max'];
			$teachers[$row['teacher_id']]->totalload=0;
			
			$xyz=mysql_query("select sub_detail.sub_id,sub_type,sub_load,class_detail.sections from (sub_detail join sub_class_teach on sub_class_teach.sub_id=sub_detail.sub_id) join class_detail on sub_class_teach.class_id=class_detail.class_id  where teacher_id=".$row['teacher_id']."&& sub_detail.group_id=".$_SESSION ["group_id"]) or die(mysql_error());
			
			while($loadsub=mysql_fetch_array($xyz)){
			if($loadsub['sub_type']=='Lecture')
				$teachers[$row['teacher_id']]->allotedload+=$loadsub['sub_load']*$loadsub['sections'];
			else {
			$sl=mysql_query("select week_frequency from practical_combination join sub_class_teach on sub_class_teach.class_id=practical_combination.class_id where practical_combination.sub_id=".$loadsub['sub_id']." && sub_class_teach.teacher_id=".$row['teacher_id'])or die(mysql_error);
			$fetch=mysql_fetch_array($sl);
			
			$teachers[$row['teacher_id']]->allotedload+=$loadsub['sub_load']*$loadsub['sections']*$fetch['week_frequency'];
			
			
			}
			
			}
			
			
			
		}
		
		$cd= mysql_query("select class_id from class_detail where group_id=".$_SESSION ["group_id"]);
			$noc=mysql_num_rows($cd);
			while($row=mysql_fetch_array($cd)){
					$classes[]=$row['class_id'];




				}

	
		for($i=0;$i<$noc;$i++){
		
			$sub=array();

			$sd=mysql_query("select distinct sub_id from sub_class_teach where class_id=".$classes[$i]."&& group_id=".$_SESSION ["group_id"]);
			$nos=mysql_num_rows($sd);

			while($row=mysql_fetch_array($sd)){
			$sub[]=$row['sub_id'];
			
			}
			
			for ($j=0;$j<$nos;$j++){
			
				$faculty=array();
				$td=mysql_query("select teacher_id from sub_class_teach where group_id=".$_SESSION ["group_id"]."&& sub_id=".$sub[$j]."&& class_id=".$classes[$i]);
				$not=mysql_num_rows($td);
				
				while($row=mysql_fetch_array($td)){
				
				$faculty[]=$row['teacher_id'];
				
				}	
			
				$sl=mysql_query("select sub_id,sub_type,sub_load from sub_detail where sub_id=". $sub[$j]);
				$s=mysql_fetch_array($sl);
				$sload=$s['sub_load'];
				
				
				$cs=mysql_query("select sections from class_detail where class_id=". $classes[$i]);
				$sections=mysql_fetch_array($cs);
				
				
				
				for($l=0;$l<$sections['sections'];$l++){
				
					
					
					$max=0;
					$guru=0;
					$minload=$teachers[$faculty[0]]->maxload;	
					for($k=0;$k<$not;$k++){
						$availload=$teachers[$faculty[$k]]->maxload-$teachers[$faculty[$k]]->totalload;
						
						if( $availload>$sload && $availload>=$teachers[$faculty[$k]]->allotedload ){
							
							if($teachers[$faculty[$k]]->totalload<=$minload){
								if($teachers[$faculty[$k]]->experience>$max){ 
											$max=$teachers[$faculty[$k]]->experience;
											$guru=$faculty[$k];
									
											}	
								}
						
						}
										
					}
					
					if($guru!=0){
					
					if($s['sub_type']=='Practical'){
					
					$sl=mysql_query("select week_frequency from practical_combination where sub_id=".$s['sub_id']." && class_id=".$classes[$i])or die(mysql_error);
					$fetch=mysql_fetch_array($sl);
					$frequent=$fetch['week_frequency'];
					
					}
						
					
					for($k=0;$k<$not;$k++){
					
					if($s['sub_type']=='Practical'){
					
					$sl=mysql_query("select week_frequency from practical_combination where sub_id=".$s['sub_id']." && class_id=".$classes[$i])or die(mysql_error);
					$fetch=mysql_fetch_array($sl);
					$frequent=$fetch['week_frequency'];
					$teachers[$faculty[$k]]->allotedload-=$sload*$frequent;
					}
					else
					$teachers[$faculty[$k]]->allotedload-=$sload;
					
					
					
					}
					if($s['sub_type']=='Practical')
					$teachers[$guru]->totalload+=$sload*$frequent;
					else
					$teachers[$guru]->totalload+=$sload;
					
					}
					
					else{
					
							$max=0;
							
							for($k=0;$k<$not;$k++){
								
								$availload=$teachers[$faculty[$k]]->maxload-$teachers[$faculty[$k]]->totalload;
								
								if($availload>=$sload){
										
										if($teachers[$faculty[$k]]->experience>$max){ 
											$max=$teachers[$faculty[$k]]->experience;
											$guru=$faculty[$k];
											$minload=$teachers[$faculty[$k]]->totalload;
									
											}	
								
									
								}
								
								
								

							
							}
							
						if($guru!=0){
							
							
							if($s['sub_type']=='Practical')
								$teachers[$guru]->totalload+=$sload*$frequent;
							else
								$teachers[$guru]->totalload+=$sload;
							
							
							
							for($k=0;$k<$not;$k++){
							
					
								if($s['sub_type']=='Practical'){
						
									$sl=mysql_query("select week_frequency from practical_combination where sub_id=".$s['sub_id']." && class_id=".$classes[$i])or die(mysql_error);
									$fetch=mysql_fetch_array($sl);
									$frequent=$fetch['week_frequency'];
									$teachers[$faculty[$k]]->allotedload-=$sload*$frequent;
									}
									else
									$teachers[$faculty[$k]]->allotedload-=$sload;
							
							}
						}
					
					
					
					}
					
					
			
				
			mysql_query("replace into final_class_sub_teacher(group_id,teacher_id,sub_id,class_id,section) values ('".$_SESSION ["group_id"]."','".$guru."','".$sub[$j]."','".$classes[$i]."','".($l+1)."')")or die(mysql_error());
			
			if($guru!=0)
			mysql_query("replace into teacher_load values('".$guru."','".$teachers[$guru]->totalload."','".$_SESSION ["group_id"]."' )");
			
				
				
				
				}
				
			
			
			}
		
		
		
		
		}




header("location:view_distribution.php");

?>
