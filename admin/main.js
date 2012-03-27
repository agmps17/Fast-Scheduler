$(document).ready(function(){
	$("#regTeacher").submit(function(){
	
		var i=0;
		$(".error").fadeOut(10);
		 if($.trim($("#txtName").val())==""){
						i++ ;
						$("p:has(#txtName) .Error").fadeIn();
						
						  
						}
					
		if($.trim($("#teacherType").val())==""){
						i++ ;
						$("p:has(#teacherType) .Error").fadeIn();
						
						  
						}	
		if($.trim($("#txtexperience").val())==""){
		
						i++ ;
						$("p:has(#txtexperience) .Error").fadeIn();
						
						  
						}						
					
					
		if($.trim($("#txtEmail").val())==""){
							i++; 
						$("p:has(#txtEmail) .Error").fadeIn();	
				
						}
					
					
					
					
		if($.trim($("#txtUserAddress").val())==""){
						i++; 	
		                $("p:has(#txtUserAddress) .Error").fadeIn();  
						}
					
					
					
		if($.trim($("#txtPhoneNo").val())==""){
						i++; 	
		               $("p:has(#txtPhoneNo) .Error").fadeIn();  
						}
		
					
					

					
					
					if(i>0)
					return false;
					else
					return true;
					
	});
	
	$("#regType").submit(function(){
	var i=0;
		
		
		
			$(".error").fadeOut(10);
							
		if($.trim($("#typeName").val())==""){
						i++ ;
						$("p:has(#typeName) .Error").fadeIn();
						  
						}
		if($.trim($("#maxLoad").val())==""){
						i++ ;
						$("p:has(#maxLoad) .Error").fadeIn();
						  
						}
		
		if($.trim($("#maxLoadDay").val())==""){
						i++ ;
						$("p:has(#maxLoadDay) .Error").fadeIn();
						  
						}
		if($.trim($("#contLoad").val())==""){
						i++ ;
						$("p:has(#contLoad) .Error").fadeIn();
						  
						}
		
						
						
					if(i>0)
					return false;
					else
					return true;
	
	
	
	
	
	});
	
	
	
	
	$("#regClass").submit(function(){
		
		var i=0;
		
			$(".error").fadeOut(10);
			
			
			if($.trim($("#className").val())==""){
						i++ ;
						$("p:has(#className) .Error").fadeIn();
						  
			}
			if($.trim($("#sections").val())==""){
						i++ ;
						$("p:has(#sections) .Error").fadeIn();
						  
						}
			
			
					if(i>0)
					return false;
					else
					return true;
	
	
			
			
			});
			
	$("#regSubject").submit(function(){
		
		var i=0;
		
			$(".error").fadeOut(10);
			
			
			if($.trim($("#subjectName").val())==""){
						i++ ;
						$("p:has(#subjectName) .Error").fadeIn();
						  
						}
						
			if($.trim($("#subjectLoad").val())==""){
						i++ ;
						$("p:has(#subjectLoad) .Error").fadeIn();
						  
						}
			
			
			
			
					if(i>0)
					return false;
					else
					return true;
	
	
			
			
			});
			
			
			
	$("#regSubTeach").submit(function(){
		
		var i=0;
		
			$(".error").fadeOut(10);
			
			
			if($.trim($("#subjectName").val())==""){
						i++ ;
						$("p:has(#subjectName) .Error").fadeIn();
						  
						}
			if($.trim($("#className").val())==""){
						i++ ;
						$("p:has(#className) .Error").fadeIn();
						  
						}
			if($.trim($("#teacherName").val())==""){
						i++ ;
						$("p:has(#teacherName) .Error").fadeIn();
						  
						}
			
			
			
					if(i>0)
					return false;
					else
					return true;
	
	
			
			
			});
			
			
			
		
	
	$('#buttonE').click(function(){
	
	$("#txtEmail")[0].disabled=false;
	$("#txtName")[0].disabled=false;
	$("#txtPhoneNo")[0].disabled=false;
	$("#txtUserAddress")[0].disabled=false;
	$("#txtexperience")[0].disabled=false;
	$("#logInType")[0].disabled=false;
	$("#teacherType")[0].disabled=false;
	$("#txtupdate")[0].disabled=false;
	
	});
	
	$("#txtupdate").click(function(){
	
	$("#txtId")[0].disabled=false;
	
	
	});
	
	$('#editType').click(function(){
	$("#maxLoad")[0].disabled=false;
	$("#maxLoadDay")[0].disabled=false;
	$("#contLoad")[0].disabled=false;
	$("#typeName")[0].disabled=false;
	$("#txtupdate")[0].disabled=false;
	});
	$('#editClass').click(function(){
	$("#className")[0].disabled=false;
	$("#sections")[0].disabled=false;
	$("#txtupdate")[0].disabled=false;
	
	});
	
	$('#editSub').click(function(){
	$("#subjectName")[0].disabled=false;
	$("#subjectType")[0].disabled=false;
	
	$("#txtupdate")[0].disabled=false;
	$("#subjectLoad")[0].disabled=false;
	
	});
	
	$('#updateTeacherButton').click(function(){
	$("#txtClass")[0].disabled=false;
	$("#txtSection")[0].disabled=false;
	
	$("#txtSubject")[0].disabled=false;
	
	
	});
	
	
	$("#regSchool").submit(function(){
	
		var i=0;
		$(".error").fadeOut(10);
		 if($.trim($("#txtName").val())==""){
						i++ ;
						$("p:has(#txtName) .Error").fadeIn();
						
						  
						}
					
					
					
		if($.trim($("#txtlectures").val())==""){
							i++; 
						$("p:has(#txtlectures) .Error").fadeIn();	
				
						}
					
					
					
					
		if($.trim($("#txtUserAddress").val())==""){
						i++; 	
		                $("p:has(#txtUserAddress) .Error").fadeIn();  
						}
					
					
					
		if($.trim($("#txtPhoneNo").val())==""){
						i++; 	
		               $("p:has(#txtPhoneNo) .Error").fadeIn();  
						}
		
		if($.trim($("#txtbreak").val())==""){
						i++; 	
		               $("p:has(#txtbreak) .Error").fadeIn();  
						}			
					
		if($.trim($("#txtfrequency").val())==""){
						i++; 	
		               $("p:has(#txtfrequency) .Error").fadeIn();  
						}	
					
					
					if(i>0)
					return false;
					else
					return true;
					
	});
	
	
	$("#regCombination").submit(function(){
	var i=0;
		
	
		
			$(".error").fadeOut(10);
							
		if($.trim($("#className").val())==""){
						i++ ;
						$("p:has(#className) .Error").fadeIn();
						  
						}
		if($.trim($("#subjectName").val())==""){
						i++ ;
						$("p:has(#subjectName) .Error").fadeIn();
						  
						}
		
		if($.trim($("#duration").val())==""){
						i++ ;
						$("p:has(#duration) .Error").fadeIn();
						  
						}
		
		
						
						
					if(i>0)
					return false;
					else
					return true;
	
	
	
	
	
	});
	$("#regPractical").submit(function(){
	var i=0;
		
	
		
			$(".error").fadeOut(10);
							
		if($.trim($("#labName").val())==""){
						i++ ;
						$("p:has(#labName) .Error").fadeIn();
						  
						}
		if($.trim($("#subjectName").val())==""){
						i++ ;
						$("p:has(#subjectName) .Error").fadeIn();
						  
						}
		
		if($.trim($("#duration").val())==""){
						i++ ;
						$("p:has(#duration) .Error").fadeIn();
						  
						}
		
		
						
						
					if(i>0)
					return false;
					else
					return true;
	
	
	
	
	
	});
	$("#regLab").submit(function(){
	var i=0;
		
	
		
			$(".error").fadeOut(10);
							
		if($.trim($("#labName").val())==""){
						i++ ;
						$("p:has(#labName) .Error").fadeIn();
						  
						}
		if($.trim($("#teacherName").val())==""){
						i++ ;
						$("p:has(#teacherName) .Error").fadeIn();
						  
						}
		
		
		
						
						
					if(i>0)
					return false;
					else
					return true;
	
	
	
	
	
	});
	$("#changePass").submit(function(){
		
		var i=0;
		
			$(".error").fadeOut(10);
			
			
			if($.trim($("#op").val())==""){
				
						i++ ;
						$("p:has(#op) .Error").fadeIn();
						  
			}
			if($.trim($("#np").val())==""){
						i++ ;
						$("p:has(#np) .Error").fadeIn();
						  
						}
			
			
					if(i>0)
					return false;
					else
					return true;
	
	
			
			
			});
	
	

	});







