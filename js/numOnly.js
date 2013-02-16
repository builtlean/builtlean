$(document).ready(function(){
						   
						   
			$("#qty").keydown(function(event){
											
                            if(event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 9 || event.keyCode == 32)				
				            {
												
		       				}
							else
						    if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 ))
					        {
								
					         return false;	
							 
					         }
			
							  });	
});