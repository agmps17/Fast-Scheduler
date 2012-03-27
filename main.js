$(document).ready(function(){
				
				
				$("#RegForm").submit(function(){
					i=0;
					$(".error").fadeOut(10);
				
                    if($.trim($("#txtName").val())==""){
					i++ ;
					$("p:has(#txtName) .Error").fadeIn();
					  
					}
					
					
					if($.trim($("#txtUserName").val())==""){
						i++; 
					$("p:has(#txtUserName) .Error").fadeIn();	
				
					}	
					
					
					if($.trim($("#txtEmail").val())==""){
						i++; 
					$("p:has(#txtEmail) .Error").fadeIn();	
				
					}	
					
					
					
					if($.trim($("#txtUserAddress").val())==""){
					i++; 	
                     $("p:has(#txtUserAddress) .Error").fadeIn();  
					}
					
					
					if($.trim($("#txtPassword").val())==""){
					i++;
					$("p:has(#txtPassword) .Error").fadeIn();	
                     
					
					}
					
					
					if($.trim($("#txtPhoneNo").val())==""){
					i++; 	
                    $("p:has(#txtPhoneNo) .Error").fadeIn();  
					}
					
					
					
					if($.trim($("#City").val())==""){
					i++; 	
                    $("p:has(#City) .Error").fadeIn();  
					}
					
					
					if($.trim($("#Country").val())==""){
					i++; 	
                    $("p:has(#Country) .Error").fadeIn();  
					}
					
					
					if(i>0)
					return false;
					else
					return true;
                });
				$("#txtName").focus(function(){
				
				$("p:has(#txtName) .Hint").fadeIn();
					
				});
				$("#txtUserName").focus(function(){
				
				$("p:has(#txtUserName) .Hint").fadeIn();
				
				});
				$("#txtUserAddress").focus(function(){
				
				$("p:has(#txtUserAddress) .Hint").fadeIn();
				
				});
				$("#txtPassword").focus(function(){
				
				$("p:has(#txtPassword) .Hint").fadeIn();
				
				});
				$("#txtPhoneNo").focus(function(){
				$("p:has(#txtPhoneNo) .Hint").fadeIn();
				
				
				});
				$("#Country").focus(function(){
				$("p:has(#Country) .Hint").fadeIn();
				
				
				});
				$("#City").focus(function(){
				
				$("p:has(#City) .Hint").fadeIn();
				
				});
				$("#txtComment").focus(function(){
				
				$("p:has(#txtComment) .Hint").fadeIn();
				
				});
				
				
				$("#txtName").blur(function(){
				
				$("p:has(#txtName) .Hint").fadeOut(100);
					
				});
				$("#txtUserName").blur(function(){
				
				$("p:has(#txtUserName) .Hint").fadeOut(100);
				
				});
				$("#txtUserAddress").blur(function(){
				
				$("p:has(#txtUserAddress) .Hint").fadeOut(100);
				
				});
				$("#txtPassword").blur(function(){
				
				$("p:has(#txtPassword) .Hint").fadeOut(100);
				
				});
				$("#txtPhoneNo").blur(function(){
				$("p:has(#txtPhoneNo) .Hint").fadeOut(100);
				
				
				});
				$("#Country").blur(function(){
				$("p:has(#Country) .Hint").fadeOut(100);
				
				
				});
				$("#City").blur(function(){
				
				$("p:has(#City) .Hint").fadeOut(100);
				
				});
				$("#txtComment").blur(function(){
				
				$("p:has(#txtComment) .Hint").fadeOut(100);
				
				});
				
				
				
							
							
				
			});
			
			
