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
			
		$td=mysql_query("select * from school_detail where group_id=".$_SESSION ["group_id"])or die(mysql_error());
			if(mysql_num_rows($td)==0)
			die( header("location:general_details.php?errmsg=fill these detail"));
		$row=mysql_fetch_array($td);

		$frequency= $row['frequency'];		
		$lectures= $row['number_lectures'];
		$break=$row['break_time'];
		
		
	
		
		
		
		class period_teacher{
				public $cont_forward=0;
				public $cont_backward=0;
				public $class_id=0;
				public $sub_id=0;
				public $section=0;
				public $day_availablity=array();
				function __construct($frequency,$lectures){
					for($i=0;$i<$frequency;$i++){
					
						$this->day_availablity[($i+1)] =1;
					}



				}	
			}
		
		class day_teacher{
			public $dayLoad=0;
			public $period=array();
			
			
			
			function __construct($frequency,$lectures) {
							
				for($i=0;$i<$lectures;$i++){
				$this->period[($i)+1]=new period_teacher($frequency,$lectures);
			
				}
			}
		}
		
		class teacher{
				public $day=array();
				public $week_free_period_slot=array();
				
				function __construct($frequency,$lectures) {
							
				for($i=0;$i<$frequency;$i++){
				$this->day[($i)+1]=new day_teacher($frequency,$lectures);
				
				}
				for($i=0;$i<$lectures;$i++){
								$this->week_free_period_slot[($i)+1]=$frequency;
										
							}
				
				
			}
		
		
		}
		
		class period_class{
	
			public $day_availablity=array();
			public $sub_id =0;
			public $teacher_id=0;
			function __construct($frequency,$lectures){
				for($i=0;$i<$frequency;$i++){
					
						$this->day_availablity[($i+1)] =1;
					}
			
			
			
			}
		
		
		
		}
		
		
		class day_class{
		
					public $period =array();
					
					function __construct($frequency,$lectures){
					
					for($i=0;$i<$lectures;$i++){
							$this->period[($i)+1]=new period_class($frequency,$lectures);
					
					
						}
					}	
		
				}
				
		
				
		class section{

			public $day_availablity=array();
			public $week_free_period_slot=array();
			public $day=array();
			
			function __construct($frequency,$lectures){
					
						for($i=0;$i<$lectures;$i++){
								$this->week_free_period_slot[($i)+1]=$frequency;
										
							}
						for($i=0;$i<$frequency;$i++){
						$this->day[($i)+1]=new day_class($frequency,$lectures);
						$this->day_availablity[($i)+1]=1;
						
						}
					}
				}
				
			class classes{
			
			public $sectioninfo=array();
			
			function __construct($frequency,$lectures,$sections){
			
				for($a=0;$a<$sections;$a++){
				$this->sectioninfo[($a+1)]=new section($frequency,$lectures);
				
				
				
				}
			
			
			}
			
			
			}
			
			
			class practical_period{
			
			public $free_num_period;
			public $sub_id=0;
			public $class_id=0;
			public $section=0;
			
			}
			
			
			class day_practical{
			
				public $period=array();
				public $free_periods;
				
				function __construct($break,$lectures){
						
							
						for($i=1;$i<=$lectures;$i++){
								$this->period[$i]=new practical_period();
								
								if($i<=$break){
								
								$this->period[$i]->free_num_period=$break-$i+1;
								
								}
								else{
								$this->period[$i]->free_num_period=$lectures-$i+1;
								
								}
							}

				
				
				
				}
			}
			class lab{
				public $teacher_id;
				public $day=array();
				function __construct($break,$lectures,$frequency){
				
				for($i=1;$i<=$frequency;$i++){
						$this->day[$i]=new day_practical($break,$lectures);
						
						
						}
				
				
				
				
				}
			
			
			
			
			
			
			}
			
			class practical_subject{
			
				public $week_frequency;
				public $duration;
				public $load;
				public $status=0;
			
			
			
			
			}
			
		$pracsub=array();
		$labs=array();	
		$teachers=array();
		$classa=array();
		$practicals=array();
		$teacherarray=array();
		$labarray=array();
		
		
		
		$ld=mysql_query("select * from labs where group_id=".$_SESSION ["group_id"])or die(mysql_error());
		$nol=mysql_num_rows($ld);
		
		while($row=mysql_fetch_array($ld)){
		
		$labs[$row['lab_id']]=new lab($break,$lectures,$frequency);
		$labs[$row['lab_id']]->teacher_id=$row['teacher_id'];
		
		$labarray[]=$row['lab_id'];
		
		}
		
		
		
		
		
		
		$td=mysql_query("select teacher_id from teacher_detail where group_id=".$_SESSION ["group_id"])or die(mysql_error());
		
		$not=mysql_num_rows($td);
		
		while($row=mysql_fetch_array($td)){
		$teacherarray[]=$row['teacher_id'];
		$teachers[$row['teacher_id']]=new teacher($frequency,$lectures);
		
		
		}
		
				
		$cd= mysql_query("select class_id,sections from class_detail where group_id=".$_SESSION ["group_id"]);
		$noc=mysql_num_rows($cd);
		while($row=mysql_fetch_array($cd)){
		$classis[]=$row['class_id'];
		}
	
				
		for($i=0;$i<$noc;$i++){
			
			#no. of sections
			$cs=mysql_query("select sections from class_detail where class_id=". $classis[$i]."&& group_id=".$_SESSION ["group_id"]);
			$section=mysql_fetch_array($cs);
			$sections=$section['sections'];
			

			$classa[$classis[$i]]=new classes($frequency,$lectures,$sections);
			
			
			
			
			
			
			
			
			
			
			
			for($k=1;$k<=$sections;$k++){
						#subjects(practical)
					$pd=mysql_query("select distinct sub_detail.sub_id,sub_load,duration,lab_id  from (sub_class_teach natural join sub_detail ) join practical_details on practical_details.sub_id=sub_detail.sub_id  where (class_id=".$classis[$i]."&& sub_detail.group_id=".$_SESSION ["group_id"].")&& sub_type='Practical'") or die(mysql_error());
					$nop=mysql_num_rows($pd);
					
					while($row=mysql_fetch_array($pd)){
					$subprac[]=$row['sub_id'];
					$pracsub[$row['sub_id']]=new practical_subject();
					$pracsub[$row['sub_id']]->load=$row['sub_load'];
					$pracsub[$row['sub_id']]->duration=$row['duration'];
					
						}
						
						#subjects(lecture)
							$sd=mysql_query("select distinct sub_id,sub_load from sub_class_teach natural join sub_detail  where (class_id=".$classis[$i]."&& group_id=".$_SESSION ["group_id"].")&& sub_type='Lecture'") or die(mysql_error());
							$nos=mysql_num_rows($sd);
							while($row=mysql_fetch_array($sd)){
							$subjectid[]=$row['sub_id'];
							$sub[$row['sub_id']]=$row['sub_load'];
							}
				
					
				
												/*
												
												Distribution of Practical subject---
												It is done primarily because generally its duration is more than one lecture and conduct continously.
												So to Ensure it is contiuos it is framed so.
												Distribution will prefer a active use of lab so to ensure optimised lab utilisation.
												
														
												*/
												
												for($l=0;$l<$nop;$l++){
												
												
													$faculties=array();	
													$subjects=array();
													$labb=array();
													if($pracsub[$subprac[$l]]->status==0){

														$pcd=mysql_query("select `set`,week_frequency from practical_combination where sub_id=".$subprac[$l]." &&class_id=".$classis[$i]." && group_id=".$_SESSION ['group_id'])or die(mysql_error());
														if(mysql_num_rows($pcd)==0)
															die(header("location:practical_distribution.php?errmsg=Add Details before generating timetable"));
														
														$arbit=mysql_fetch_array($pcd);
														
														
														$pcd=mysql_query("select sub_id from practical_combination where `set`=".$arbit['set']." &&class_id=".$classis[$i]." && group_id=".$_SESSION ["group_id"]);
														$ncos=mysql_num_rows($pcd);
														
														
													
														while($row=mysql_fetch_array($pcd)){
														$subjects[]=$row['sub_id'];
														$pracsub[$row['sub_id']]->week_frequency=$arbit['week_frequency'];
														$query=mysql_query("select teacher_id from final_class_sub_teacher where sub_id=".$row['sub_id']."&&class_id=".$classis[$i]."&& section=".($k)."&& group_id=".$_SESSION ["group_id"]);
														#echo mysql_num_rows($query)." <br/> ";
														$arb=mysql_fetch_array($query);
														$faculties[]=$arb['teacher_id'];
														$query=mysql_query("select lab_id from practical_details where sub_id=".$row['sub_id']."&& group_id=".$_SESSION ['group_id']);
														$arb1=mysql_fetch_array($query);
														$labb[]=$arb1['lab_id'];
														}
														$duration=$pracsub[$subjects[0]]->duration;
														for($days=1;$days<=$frequency;$days++){
													
															if($pracsub[$subprac[$l]]->week_frequency!=0){
															
																for($perioda=1;$perioda<=$lectures;$perioda++){
																	$string="";
																	$ask=0;
																	
																	for($m=0;$m<$ncos;$m++){
																	
																	if($labs[$labb[$m]]->day[$days]->period[$perioda]->free_num_period >= $pracsub[$subjects[$m]]->duration)
																	$ask++;
																	
																	}
																		if($ask==$ncos){
																			
																			$teach=0;
																				for($m=0;$m<$ncos;$m++){
																					$querya=mysql_query("select cont from teacher_detail join type_details on teacher_detail.type_id=type_details.type_id where teacher_detail.group_id=".$_SESSION ["group_id"]." &&teacher_id=".$faculties[$m]."")or die (mysql_error());
																					$fetcha=mysql_fetch_array($querya);
																					$cont=$fetcha['cont'];
																					
																					$dur=0;
																					for($zc=0;$zc<$duration;$zc++){
																					
																					if($teachers[$faculties[$m]]->day[$days]->period[$perioda+$zc]->sub_id==0 && $teachers[$faculties[$m]]->day[$days]->period[$perioda+$zc]->cont_forward + $teachers[$faculties[$m]]->day[$days]->period[$perioda+$zc]->cont_backward+$duration<$cont )
																					$dur++;
																					
																					}
																					if($dur==$duration){
																					$teach++;
																					
																					
																					}
																					
																					else {
																					#echo "here<br/>";
																					break;
																					
																					}
																				
																				}
																				
																				if($teach==$ncos){
																					
																						
																						for($b=0;$b<$ncos;$b++){
																							for($zc=0;$zc<$duration;$zc++){	
																								$teachers[$faculties[$b]]->day[$days]->dayLoad+=$duration;
																								$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc]->day_availablity[$days]=0;
																								$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc]->sub_id=$subjects[$b];
																								$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc]->class_id=$classis[$i];
																								$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc]->section=$k;
																								

																												
																									if($perioda+$zc!=$lectures && $perioda+$zc!=1) {
																												$factor=0;
																												while($teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc+$factor]->cont_forward!=0){
																												
																												$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc+$factor+1]->cont_backward+=1;
																												$factor++;
																												}
																												
																												if($perioda+$zc+$factor+1<$lectures){
																													$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc+$factor+1]->cont_backward=1+$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc+$factor]->cont_backward;
																												
																												}
																												$factor=0;
																												while($teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc-$factor]->cont_backward!=0){
																												
																												$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc-$factor-1]->cont_forward+=1;
																												$factor++;
																												}
																												
																												if($perioda+$zc-$factor-1>0)
																												$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc-$factor-1]->cont_forward=1+$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc-$factor]->cont_forward;
																												
																											
																											}
																										
																												if($perioda+$zc==$lectures){
																													$factor=0;
																													while($teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc-$factor]->cont_backward!=0){
																													
																													$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc-$factor-1]->cont_forward+=1;
																													$factor++;
																													}
																													
																													if($perioda+$zc-$factor-1>0)
																													$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc-$factor-1]->cont_forward=1+$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc-$factor]->cont_forward;
																																	
																												
																												}
																												
																												if($perioda+$zc==1){
																													$factor=0;
																													while($teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc+$factor]->cont_forward!=0){
																													
																													$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc+$factor+1]->cont_backward+=1;
																													$factor++;
																													}
																													if($perioda+$zc+$factor+1<$lectures)
																													$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc+$factor+1]->cont_backward=1+$teachers[$faculties[$b]]->day[$days]->period[$perioda+$zc+$factor]->cont_backward;
																													
																												
																												}
																							
																										
																									$labs[$labb[$b]]->day[$days]->period[$perioda+$zc]->sub_id=$subjects[$b];
																									$labs[$labb[$b]]->day[$days]->period[$perioda+$zc]->class_id=$classis[$i];
																									$labs[$labb[$b]]->day[$days]->period[$perioda+$zc]->section=$k;
																									$teachers[$labs[$labb[$b]]->teacher_id]->day[$days]->period[$perioda+$zc]->sub_id=$subjects[$b];
																									$teachers[$labs[$labb[$b]]->teacher_id]->day[$days]->period[$perioda+$zc]->class_id=$classis[$i];
																									$teachers[$labs[$labb[$b]]->teacher_id]->day[$days]->period[$perioda+$zc]->section=$k;
																									// echo $labs[$labb[$b]]->teacher_id."  day".$days." period".($perioda+$zc)."<br/>";
																									
																									
																									if($perioda+$zc>$break){
																										$break=1;
																										$any=1;
																										while($perioda+$zc-$any>$break or $labs[$labb[$b]]->day[$days]->period[$perioda+$zc-$any]->free_num_period!=0  ){
																										$labs[$labb[$b]]->day[$days]->period[$perioda+$zc-$any]->free_num_period=$any;
																										$any++;
																										}
																									$labs[$labb[$b]]->day[$days]->period[$perioda+$zc]->free_num_period=0;
																									}
																									
																									else{
																									$any=1;
																									while($perioda+$zc-$any>0){
																										
																										
																											if($labs[$labb[$b]]->day[$days]->period[$perioda+$zc-$any]->free_num_period!=0 ){
																											$labs[$labb[$b]]->day[$days]->period[$perioda+$zc-$any]->free_num_period=$any;
																											$any++;
																											}
																											else
																											break;
																										}
																									$labs[$labb[$b]]->day[$days]->period[$perioda+$zc]->free_num_period=0;
																							
																									}
																									
																									
																							
																							}
																						
																						
																						$pracsub[$subjects[$b]]->week_frequency-=1;
																						if($pracsub[$subjects[$b]]->week_frequency==0)
																							$pracsub[$subjects[$b]]->status=1;
																						
																						
																						
																						}
																							#echo "class ".$classis[$i]." section ".$k."day".$days." period ".$perioda."<br/>";
																						for($zc=0;$zc<$duration;$zc++){
																							
																							$classa[$classis[$i]]->sectioninfo[$k]->day[$days]->period[$perioda+$zc]->teacher_id=$faculties[0];
																							$classa[$classis[$i]]->sectioninfo[$k]->day[$days]->period[$perioda+$zc]->day_availablity[$days]=0;
																							$classa[$classis[$i]]->sectioninfo[$k]->day[$days]->period[$perioda+$zc]->sub_id=$subjects[0];
																							$classa[$classis[$i]]->sectioninfo[$k]->week_free_period_slot[$perioda+$zc]-=1;
																					
																						}
																						
																				
																					break ;
																				
																				}
																		}
															
														
														
														
														
														
															}
															
															
															
															
															
															}
																
													
													
													
													
														}
													
													
													
													
													
													
													}
													
													
													
													
												
												}
												
												
													
												
												
												
												
												
												
												
												
												/*
												end of practical distribution
												
												
												*/
												
												
												
												
												/*distribution of lectures
												In a way such that idaentical lectures are placed same period on any day if its load is less than no. of working days.
												
												*/
												for($l=0;$l<$nos;$l++){
														

														
													
														
														
														$query=mysql_query("select teacher_id from final_class_sub_teacher where class_id=".$classis[$i]." && sub_id=".$subjectid[$l]." && section=".($k)." && group_id=".$_SESSION ["group_id"]."");
														$fetch=mysql_fetch_array($query);	
														$teacher_id=$fetch['teacher_id'];
														
														$query=mysql_query("select cont,day_max from teacher_detail join type_details on teacher_detail.type_id=type_details.type_id where teacher_detail.group_id=".$_SESSION ["group_id"]." &&teacher_id=".$teacher_id."");
														$fetch=mysql_fetch_array($query);
														$cont=$fetch['cont'];
														$loadday=$fetch['day_max'];
														
													if($sub[$subjectid[$l]]>=$frequency){
														
														#start of ist condition	
														$periods=1;
														while($classa[$classis[$i]]->sectioninfo[$k]->week_free_period_slot[$periods]!=$frequency OR ($teachers[$teacher_id]->week_free_period_slot[$periods]!=$frequency OR ($teachers[$teacher_id]->day[1]->period[$periods]->cont_forward + $teachers[$teacher_id]->day[1]->period[$periods]->cont_backward >=$cont))){
														
														if($periods<$lectures)
														$periods++;
														else
														break;
														
														
														}
														
														if($periods<=$lectures){
																	$sub[$subjectid[$l]]=$sub[$subjectid[$l]]-$frequency;
																$classa[$classis[$i]]->sectioninfo[$k]->week_free_period_slot[$periods]=0;
																$teachers[$teacher_id]->week_free_period_slot[$periods]=0;
														
													for($dist=1;$dist<=$frequency;$dist++){
															$teachers[$teacher_id]->day[$dist]->dayLoad+=1;
															$classa[$classis[$i]]->sectioninfo[$k]->day[$dist]->period[$periods]->day_availablity[$dist]=0;
															$teachers[$teacher_id]->day[$dist]->period[$periods]->day_availablity[$dist]=0;
															$classa[$classis[$i]]->sectioninfo[$k]->day[$dist]->period[$periods]->sub_id=$subjectid[$l];
															$teachers[$teacher_id]->day[$dist]->period[$periods]->sub_id=$subjectid[$l];
															$teachers[$teacher_id]->day[$dist]->period[$periods]->class_id=$classis[$i];
															$teachers[$teacher_id]->day[$dist]->period[$periods]->section=$k;
															$classa[$classis[$i]]->sectioninfo[$k]->day[$dist]->period[$periods]->teacher_id=$teacher_id;
															
															if($periods!=$lectures && $periods!=1) {
																$factor=0;
																while($teachers[$teacher_id]->day[$dist]->period[$periods+$factor]->cont_forward!=0){
																
																$teachers[$teacher_id]->day[$dist]->period[$periods+$factor+1]->cont_backward+=1;
																$factor++;
																}
																
																if($periods+$factor+1<$lectures){
																	$teachers[$teacher_id]->day[$dist]->period[$periods+$factor+1]->cont_backward=1+$teachers[$teacher_id]->day[$dist]->period[$periods+$factor]->cont_backward;
																
																}
																$factor=0;
																while($teachers[$teacher_id]->day[$dist]->period[$periods-$factor]->cont_backward!=0){
																
																$teachers[$teacher_id]->day[$dist]->period[$periods-$factor-1]->cont_forward+=1;
																$factor++;
																}
																
																if($periods-$factor-1>0)
																$teachers[$teacher_id]->day[$dist]->period[$periods-$factor-1]->cont_forward=1+$teachers[$teacher_id]->day[$dist]->period[$periods-$factor]->cont_forward;
																
																
															}
															
															if($periods==$lectures){
																$factor=0;
																while($teachers[$teacher_id]->day[$dist]->period[$periods-$factor]->cont_backward!=0){
																
																$teachers[$teacher_id]->day[$dist]->period[$periods-$factor-1]->cont_forward+=1;
																$factor++;
																}
																
																if($periods-$factor-1>0)
																$teachers[$teacher_id]->day[$dist]->period[$periods-$factor-1]->cont_forward=1+$teachers[$teacher_id]->day[$dist]->period[$periods-$factor]->cont_forward;
																				
															
															}
															
															if($periods==1){
																$factor=0;
																while($teachers[$teacher_id]->day[$dist]->period[$periods+$factor]->cont_forward!=0){
																
																$teachers[$teacher_id]->day[$dist]->period[$periods+$factor+1]->cont_backward+=1;
																$factor++;
																}
																if($periods+$factor+1<$lectures)
																$teachers[$teacher_id]->day[$dist]->period[$periods+$factor+1]->cont_backward=1+$teachers[$teacher_id]->day[$dist]->period[$periods+$factor]->cont_backward;
																
															
															}
															
															
															
													}
														
															
															
														}
														
														#echo "period ".$periods." subject". $subjectid[$l]." class ".$classis[$i]." section   ".$k."   teacher  ".$teacher_id ."<br/>";
													
														#End of First Condition 
													
													
													
													
													}
													



													#start of 2nd condition
													if($sub[$subjectid[$l]]<$frequency && $sub[$subjectid[$l]]>0){
													
													
														
														
															for($periods=1;$periods<=$lectures;$periods++){
																
																if($classa[$classis[$i]]->sectioninfo[$k]->week_free_period_slot[$periods]>=$sub[$subjectid[$l]] && $teachers[$teacher_id]->week_free_period_slot[$periods]>=$sub[$subjectid[$l]] ){
																		
																		
																		$count=0;
																		$dayallot=array();
																		
																	for($dayss=1;$dayss<=$frequency;$dayss++){
																	
																		
																		if($classa[$classis[$i]]->sectioninfo[$k]->day[$dayss]->period[$periods]->day_availablity[$dayss]==1 && $teachers[$teacher_id]->day[$dayss]->period[$periods]->day_availablity[$dayss]==1){
																			
																			
																				if(($teachers[$teacher_id]->day[$dayss]->period[$periods]->cont_forward + $teachers[$teacher_id]->day[$dayss]->period[$periods]->cont_backward<$cont) && $teachers[$teacher_id]->day[$dayss]->dayLoad<$loadday){
																				
																				$count++;
																				$dayallot[]=$dayss;
																				
																				}
																			
																	
																	
																	
																		}	
																		
																		
																		
																		
																		
																	}	
																	
																	
																	
																	if($count>=$sub[$subjectid[$l]]){
																		
																			for($next=0;$next<$sub[$subjectid[$l]];$next++){
																				$teachers[$teacher_id]->day[$dayallot[$next]]->dayLoad+=1;
																				$classa[$classis[$i]]->sectioninfo[$k]->day[$dayallot[$next]]->period[$periods]->day_availablity[$dayallot[$next]]=0;
																				$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods]->day_availablity[$dayallot[$next]]=0;
																				$classa[$classis[$i]]->sectioninfo[$k]->day[$dayallot[$next]]->period[$periods]->sub_id=$subjectid[$l];
																				$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods]->sub_id=$subjectid[$l];
																				$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods]->class_id=$classis[$i];
																				$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods]->section=$k;
																				$classa[$classis[$i]]->sectioninfo[$k]->day[$dayallot[$next]]->period[$periods]->teacher_id=$teacher_id;
																				if($periods!=$lectures && $periods!=1) {
																					$factor=0;
																					while($teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods+$factor]->cont_forward!=0){
																					
																					$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods+$factor+1]->cont_backward+=1;
																					$factor++;
																					}
																					if($periods+$factor+1<$lectures)
																					$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods+$factor+1]->cont_backward=1+$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods+$factor]->cont_backward;
																					
																					
																					$factor=0;
																					while($teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods-$factor]->cont_backward!=0){
																					
																					$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods-$factor-1]->cont_forward+=1;
																					$factor++;
																					}
																					
																					if($periods-$factor-1>0)
																					$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods-$factor-1]->cont_forward=1+$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods-$factor]->cont_forward;
																					
																					
																				}
																				
																				if($periods==$lectures){
																					$factor=0;
																					while($teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods-$factor]->cont_backward!=0){
																					
																					$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods-$factor-1]->cont_forward+=1;
																					$factor++;
																					}
																					
																					if($periods-$factor-1>0)
																					$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods-$factor-1]->cont_forward=1+$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods-$factor]->cont_forward;
																									
																				
																				}
																				
																				if($periods==1){
																					$factor=0;
																					while($teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods+$factor]->cont_forward!=0){
																					
																					$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods+$factor+1]->cont_backward+=1;
																					$factor++;
																					}
																					if($periods+$factor+1<$lectures)
																					$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods+$factor+1]->cont_backward=1+$teachers[$teacher_id]->day[$dayallot[$next]]->period[$periods+$factor]->cont_backward;
																					
																				
																				}
																				
																				
																			}
																			$classa[$classis[$i]]->sectioninfo[$k]->week_free_period_slot[$periods]-=$sub[$subjectid[$l]];
																			$teachers[$teacher_id]->week_free_period_slot[$periods]-=$sub[$subjectid[$l]];
																			$sub[$subjectid[$l]]=0;
																			
																			
																			
																			break;
																		}
															
																}
															
															}
														
														
																		
														#echo "period ".$periods." subject". $subjectid[$l]." class ".$classis[$i]." section   ".$k."   teacher  ".$teacher_id ."<br/>";
														
													
													
													
													}
													


														#end of 2nd condition		
													
													
														# start of most critical 3rd condition
													
														if($sub[$subjectid[$l]]<$frequency && $sub[$subjectid[$l]]>0){
													
															$dayinfo=array();
															for($z=1;$z<=$frequency;$z++){
															$dayinfo[$z]=0;
															}	
															
															
															
															$periods=1;
															while($classa[$classis[$i]]->sectioninfo[$k]->week_free_period_slot[$periods]!=0 && $teachers[$teacher_id]->week_free_period_slot[$periods]!=0 ){
																for($dayss=1;$dayss<=$frequency;$dayss++){
															
																	
																	if($sub[$subjectid[$l]]!=0){
																			
																		if($classa[$classis[$i]]->sectioninfo[$k]->day[$dayss]->period[$periods]->day_availablity[$dayss]==1 && $teachers[$teacher_id]->day[$dayss]->period[$periods]->day_availablity[$dayss]==1){
																					
																				
																												
																					if(($teachers[$teacher_id]->day[$dayss]->period[$periods]->cont_forward + $teachers[$teacher_id]->day[$dayss]->period[$periods]->cont_backward<$cont) && $teachers[$teacher_id]->day[$dayss]->dayLoad<$loadday){
																				
																						if($dayinfo[$dayss]==0){
																							
																							$teachers[$teacher_id]->day[$dayss]->dayLoad+=1;
																							$classa[$classis[$i]]->sectioninfo[$k]->day[$dayss]->period[$periods]->day_availablity[$dayss]=0;
																							$teachers[$teacher_id]->day[$dayss]->period[$periods]->day_availablity[$dayss]=0;
																							$classa[$classis[$i]]->sectioninfo[$k]->day[$dayss]->period[$periods]->sub_id=$subjectid[$l];
																							$teachers[$teacher_id]->day[$dayss]->period[$periods]->sub_id=$subjectid[$l];
																							$teachers[$teacher_id]->day[$dayss]->period[$periods]->class_id=$classis[$i];
																							$teachers[$teacher_id]->day[$dayss]->period[$periods]->section=$k;
																							$classa[$classis[$i]]->sectioninfo[$k]->week_free_period_slot[$periods]-=1;
																							$teachers[$teacher_id]->week_free_period_slot[$periods]-=1;
																							$classa[$classis[$i]]->sectioninfo[$k]->day[$dayss]->period[$periods]->teacher_id=$teacher_id;
																							$dayinfo[$dayss]=1;
																							$sub[$subjectid[$l]]-=1;
																							if($periods!=$lectures && $periods!=1) {
																								$factor=0;
																								while($teachers[$teacher_id]->day[$dayss]->period[$periods+$factor]->cont_forward!=0){
																								
																								$teachers[$teacher_id]->day[$dayss]->period[$periods+$factor+1]->cont_backward+=1;
																								$factor++;
																								}
																								if($periods+$factor+1<$lectures)
																								$teachers[$teacher_id]->day[$dayss]->period[$periods+$factor+1]->cont_backward=1+$teachers[$teacher_id]->day[$dayss]->period[$periods+$factor]->cont_backward;
																								
																								
																								$factor=0;
																								while($teachers[$teacher_id]->day[$dayss]->period[$periods-$factor]->cont_backward!=0){
																								
																								$teachers[$teacher_id]->day[$dayss]->period[$periods-$factor-1]->cont_forward+=1;
																								$factor++;
																								}
																								
																								if($periods-$factor-1>0)
																								$teachers[$teacher_id]->day[$dayss]->period[$periods-$factor-1]->cont_forward=1+$teachers[$teacher_id]->day[$dayss]->period[$periods-$factor]->cont_forward;
																								
																								
																							}
																							
																							if($periods==$lectures){
																								$factor=0;
																								while($teachers[$teacher_id]->day[$dayss]->period[$periods-$factor]->cont_backward!=0){
																								
																								$teachers[$teacher_id]->day[$dayss]->period[$periods-$factor-1]->cont_forward+=1;
																								$factor++;
																								}
																								
																								if($periods-$factor-1>0)
																								$teachers[$teacher_id]->day[$dayss]->period[$periods-$factor-1]->cont_forward=1+$teachers[$teacher_id]->day[$dayss]->period[$periods-$factor]->cont_forward;
																												
																							
																							}
																							
																							if($periods==1){
																								$factor=0;
																								while($teachers[$teacher_id]->day[$dayss]->period[$periods+$factor]->cont_forward!=0){
																								
																								$teachers[$teacher_id]->day[$dayss]->period[$periods+$factor+1]->cont_backward+=1;
																								$factor++;
																								}
																								if($periods+$factor+1<$lectures)
																								$teachers[$teacher_id]->day[$dayss]->period[$periods+$factor+1]->cont_backward=1+$teachers[$teacher_id]->day[$dayss]->period[$periods+$factor]->cont_backward;
																								
																							
																							}
																							
																							
																						}
																						
																						#now the most typical and final condition
																					else {
																							for($change=1;$change<=$frequency;$change++){
																							if($sub[$subjectid[$l]]!=0){
																								
										
																									if($change!=$dayss){
																										if($dayinfo[$change]==0){
																																
																											if($teachers[$teacher_id]->day[$change]->period[$periods]->day_availablity[$change]==1 &&($teachers[$teacher_id]->day[$change]->period[$periods]->cont_forward + $teachers[$teacher_id]->day[$change]->period[$periods]->cont_backward<$cont)){

																														
																													$sub_id=$classa[$classis[$i]]->sectioninfo[$k]->day[$change]->period[$periods]->sub_id;
																													$query=mysql_query("select teacher_id from final_class_sub_teacher where class_id=".$classis[$i]." && sub_id=".$sub_id." && section=".($k)."");
																																$fetch=mysql_fetch_array($query);	
																																$teacher_id_change=$fetch['teacher_id'];
																																
																													if($teachers[$teacher_id_change]->day[$dayss]->period[$periods]->day_availablity[$dayss]==1 &&($teachers[$teacher_id_change]->day[$dayss]->period[$periods]->cont_forward + $teachers[$teacher_id_change]->day[$dayss]->period[$periods]->cont_backward<$cont)){
																													
																													
																														
										
																														$teachers[$teacher_id]->day[$change]->dayLoad+=1;
																														$teachers[$teacher_id_change]->day[$change]->dayLoad-=1;
																														$teachers[$teacher_id_change]->day[$dayss]->dayLoad-=1;
																														$teachers[$teacher_id_change]->day[$change]->period[$periods]->day_availablity[$change]=1;
																														$teachers[$teacher_id_change]->day[$change]->period[$periods]->sub_id=0;
																														$teachers[$teacher_id_change]->day[$change]->period[$periods]->class_id=0;
																														$teachers[$teacher_id_change]->day[$change]->period[$periods]->section=0;
																														$teachers[$teacher_id_change]->day[$dayss]->period[$periods]->sub_id=$sub_id;
																														$teachers[$teacher_id_change]->day[$dayss]->period[$periods]->class_id=$classis[$i];
																														$teachers[$teacher_id_change]->day[$dayss]->period[$periods]->section=$k;
																														$classa[$classis[$i]]->sectioninfo[$k]->day[$dayss]->period[$periods]->sub_id=$sub_id;
																														$classa[$classis[$i]]->sectioninfo[$k]->day[$dayss]->period[$periods]->teacher_id=$teacher_id_change;
																														$classa[$classis[$i]]->sectioninfo[$k]->day[$change]->period[$periods]->day_availablity[$change]=0;
																														$teachers[$teacher_id]->day[$change]->period[$periods]->day_availablity[$change]=0;
																														$classa[$classis[$i]]->sectioninfo[$k]->day[$change]->period[$periods]->sub_id=$subjectid[$l];
																														$teachers[$teacher_id]->day[$change]->period[$periods]->sub_id=$subjectid[$l];
																														$teachers[$teacher_id]->day[$change]->period[$periods]->class_id=$classis[$i];
																														$teachers[$teacher_id]->day[$change]->period[$periods]->section=$k;
																														$classa[$classis[$i]]->sectioninfo[$k]->day[$change]->period[$periods]->teacher_id=$teacher_id;
																														$classa[$classis[$i]]->sectioninfo[$k]->week_free_period_slot[$periods]-=1;
																														$teachers[$teacher_id]->week_free_period_slot[$periods]-=1;
																														$dayinfo[$change]=1;
																														$sub[$subjectid[$l]]-=1;
																														
																														
																														
																														if($periods!=$lectures && $periods!=1) {
																															$factor=0;
																															while($teachers[$teacher_id]->day[$change]->period[$periods+$factor]->cont_forward!=0){
																															
																															$teachers[$teacher_id]->day[$change]->period[$periods+$factor+1]->cont_backward+=1;
																															$teachers[$teacher_id]->day[$change]->period[$periods+$factor+1]->cont_backward-=1;
																															$teachers[$teacher_id]->day[$dayss]->period[$periods+$factor+1]->cont_backward+=1;
																															$factor++;
																															}
																															if($periods+$factor+1<$lectures){
																																$teachers[$teacher_id]->day[$change]->period[$periods+$factor+1]->cont_backward=1+$teachers[$teacher_id]->day[$change]->period[$periods+$factor]->cont_backward;
																																$teachers[$teacher_id]->day[$change]->period[$periods+$factor+1]->cont_backward=$teachers[$teacher_id]->day[$change]->period[$periods+$factor]->cont_backward-1;
																																$teachers[$teacher_id]->day[$dayss]->period[$periods+$factor+1]->cont_backward=1+$teachers[$teacher_id]->day[$dayss]->period[$periods+$factor]->cont_backward;
																															}
																															
																															
																															
																															$factor=0;
																															while($teachers[$teacher_id]->day[$change]->period[$periods-$factor]->cont_backward!=0){
																															
																															$teachers[$teacher_id]->day[$change]->period[$periods-$factor-1]->cont_forward+=1;
																															$teachers[$teacher_id]->day[$change]->period[$periods-$factor-1]->cont_forward-=1;
																															$teachers[$teacher_id]->day[$dayss]->period[$periods-$factor-1]->cont_forward+=1;
																															$factor++;
																															}
																															
																															if($periods-$factor-1>0){
																																
																																$teachers[$teacher_id]->day[$change]->period[$periods-$factor-1]->cont_forward=1+$teachers[$teacher_id]->day[$change]->period[$periods-$factor]->cont_forward;
																																$teachers[$teacher_id]->day[$change]->period[$periods-$factor-1]->cont_forward=$teachers[$teacher_id]->day[$change]->period[$periods-$factor]->cont_forward-1;
																																$teachers[$teacher_id]->day[$dayss]->period[$periods-$factor-1]->cont_forward=1+$teachers[$teacher_id]->day[$dayss]->period[$periods-$factor]->cont_forward;
																															
																																
																																
																																
																																
																																}
																															
																														}
																														
																														if($periods==$lectures){
																															$factor=0;
																															while($teachers[$teacher_id]->day[$change]->period[$periods-$factor]->cont_backward!=0){
																															
																															$teachers[$teacher_id]->day[$change]->period[$periods-$factor-1]->cont_forward+=1;
																															$teachers[$teacher_id]->day[$change]->period[$periods-$factor-1]->cont_forward-=1;
																															$teachers[$teacher_id]->day[$dayss]->period[$periods-$factor-1]->cont_forward+=1;
																															$factor++;
																															}
																															
																															if($periods-$factor-1>0){
																																
																																$teachers[$teacher_id]->day[$change]->period[$periods-$factor-1]->cont_forward=1+$teachers[$teacher_id]->day[$change]->period[$periods-$factor]->cont_forward;
																																$teachers[$teacher_id]->day[$change]->period[$periods-$factor-1]->cont_forward=$teachers[$teacher_id]->day[$change]->period[$periods-$factor]->cont_forward-1;
																																$teachers[$teacher_id]->day[$dayss]->period[$periods-$factor-1]->cont_forward=1+$teachers[$teacher_id]->day[$dayss]->period[$periods-$factor]->cont_forward;
																															
																																
																																
																																
																																
																																}			
																														
																														}
																														
																														if($periods==1){
																															$factor=0;
																															while($teachers[$teacher_id]->day[$change]->period[$periods+$factor]->cont_forward!=0){
																															
																															$teachers[$teacher_id]->day[$change]->period[$periods+$factor+1]->cont_backward+=1;
																															$teachers[$teacher_id]->day[$change]->period[$periods+$factor+1]->cont_backward-=1;
																															$teachers[$teacher_id]->day[$dayss]->period[$periods+$factor+1]->cont_backward+=1;
																															$factor++;
																															}
																															if($periods+$factor+1<$lectures){
																																$teachers[$teacher_id]->day[$change]->period[$periods+$factor+1]->cont_backward=1+$teachers[$teacher_id]->day[$change]->period[$periods+$factor]->cont_backward;
																																$teachers[$teacher_id]->day[$change]->period[$periods+$factor+1]->cont_backward=$teachers[$teacher_id]->day[$change]->period[$periods+$factor]->cont_backward-1;
																																$teachers[$teacher_id]->day[$dayss]->period[$periods+$factor+1]->cont_backward=1+$teachers[$teacher_id]->day[$dayss]->period[$periods+$factor]->cont_backward;
																															
																																
																																
																																
																																
																																}
																														
																														}
																				
																														$classa[$classis[$i]]->sectioninfo[$k]->day[$dayss]->period[$periods]->sub_id=$sub_id;
																														$teachers[$teacher_id_change]->day[$dayss]->period[$periods]->day_availablity[$dayss]==0;
																														$teachers[$teacher_id_change]->day[$change]->period[$periods]->day_availablity[$dayss]==1;
																														
																													
																													break;
																													
																													}
																														
																														
																													
																													

																												}
																											}
																											
																										}
																								}				
																												
																							}




																						}
																					
																					
																					
																					
																					
																					
																					
																					}
																				
																				}
																			
																	
																	
																	
																	}
															
																
															
																	
																}
																if($periods<$lectures)
																$periods++;
																else
																break;
															}
															
														
														
														
														
														
														
														}
													
													
													
													
													
													
													
													
													
													
													}
												
											
				}	
				
						
						
			
			
			
			
			
			
			
			
			
			}
			
			
			for($class=0;$class<$noc;$class++){
				
				for($section=1;$section<=$sections;$section++){
					
					
					for($day=1;$day<=$frequency;$day++){
						$str="";
						$str1="";
					
						for($period=1;$period<=$lectures;$period++){
						
						
								$z=$classa[$classis[$class]]->sectioninfo[$section]->day[$day]->period[$period]->teacher_id;
								$x=$classa[$classis[$class]]->sectioninfo[$section]->day[$day]->period[$period]->sub_id ;
								$sq=mysql_query("select * from final_class_sub_teacher where class_id=".$classis[$class]." && sub_id=".$x." &&teacher_id=".$z."&& section=".($section)." && group_id=".$_SESSION['group_id']."");
								$fe=mysql_fetch_array($sq);
								
								$str=$str."period".$period.",";
								$str1=$str1."'".$fe['index']."',";
				
				
				
						}
					
						
						mysql_query("replace into class_timetable_".$_SESSION['group_id']." (".$str."day_id,class_id,section_id) values(".$str1."'".$day."','".$classis[$class]."','".$section."')") or die (mysql_error());
						
						// echo "replace into class_timetable_".$_SESSION['group_id']." (".$str."day_id,class_id,section_id) values(".$str1."'".$day."','".$classis[$class]."','".$section."')<br/>";









					}
				
				
				
				
				}
						
			}
			for($teacher=0;$teacher<$not;$teacher++){

				for($day=1;$day<=$frequency;$day++){
				
				$str="";
				$str1="";
			
				for($period=1;$period<=$lectures;$period++){
				
					$z=$teachers[$teacherarray[$teacher]]->day[$day]->period[$period]->sub_id;
					$x=$teachers[$teacherarray[$teacher]]->day[$day]->period[$period]->class_id ;
					$c=$teachers[$teacherarray[$teacher]]->day[$day]->period[$period]->section;
					
					$sq=mysql_query("select * from final_class_sub_teacher where class_id=".$x." && sub_id=".$z."&& section=".($c)." && group_id=".$_SESSION['group_id']."")or die(mysql_error());
					
					
					$fe=mysql_fetch_array($sq);
					
					
					$str=$str."period".$period.",";
					$str1=$str1."'".$fe['index']."',";
				
						}
				mysql_query("replace into teacher_timetable_".$_SESSION['group_id']." (".$str." teacher_id,day_id ) values(".$str1."'".$teacherarray[$teacher]."','".$day."')") or die(mysql_error());
			
				}

			}	
			
			for($labb=0;$labb<$nol;$labb++){
				
				for($day=1;$day<=$frequency;$day++){
				
				$str="";
				$str1="";
			
				for($period=1;$period<=$lectures;$period++){
				
					$z=$labs[$labarray[$labb]]->day[$day]->period[$period]->sub_id;
					$x=$labs[$labarray[$labb]]->day[$day]->period[$period]->class_id ;
					$c=$labs[$labarray[$labb]]->day[$day]->period[$period]->section;
					$sq=mysql_query("select * from final_class_sub_teacher where class_id=".$x." && sub_id=".$z."&& section=".($c)." && group_id=".$_SESSION['group_id']."");
					
					
					
					$fe=mysql_fetch_array($sq);
					
					
				
					
					$str=$str."period".$period.",";
					$str1=$str1."'".$fe['index']."',";
				
						}
						
				mysql_query("replace into lab_timetable_".$_SESSION['group_id']." (".$str." lab_id,day_id ) values(".$str1."'".$labarray[$labb]."','".$day."')") or die(mysql_error());
			
				}

			}	
	header("location:timetable.php");			
		
?>