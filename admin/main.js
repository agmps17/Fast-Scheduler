$(document).ready(function(){
	$("#regTeacher").submit(function(){
	
		var i=0;
		$(".error").fadeOut(10);
		 if($.trim($("#txtName").val())==""){
						i++ ;
						$("p:has(#txtName) .Error").fadeIn();
						
						  
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
		if($.trim($("#minLoad").val())==""){
						i++ ;
						$("p:has(#minLoad) .Error").fadeIn();
						  
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
	$("#txtExperience")[0].disabled=false;
	$("#logInType")[0].disabled=false;
	$("#type")[0].disabled=false;
	
	
	});
	
	$("#update").click(function(){
	
	$("#txtId")[0].disabled=false;
	
	
	});
	
	$('#editType').click(function(){
	$("#maxLoad")[0].disabled=false;
	$("#minLoad")[0].disabled=false;
	$("#maxLoadDay")[0].disabled=false;
	$("#contLoad")[0].disabled=false;
	$("#typeName")[0].disabled=false;
	
	});
	$('#editClass').click(function(){
	$("#className")[0].disabled=false;
	$("#sections")[0].disabled=false;
	
	
	});
	
	$('#editSub').click(function(){
	$("#subjectName")[0].disabled=false;
	$("#subjectType")[0].disabled=false;
	});
	
	
	
	
	});







