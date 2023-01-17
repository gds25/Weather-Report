var ptrStateCode;
var ptrCityCode;

$(document).ready(function(){
    ptrStateCode = document.getElementById('state');
    ptrCityCode = document.getElementById('city');
	
    $("#cty").load("country_codes.html"); 
    $("#state").load("state_codes.html");
    
   // $(document.body).append("12345");
   
  	$("#cty").change(function(){
			
  			var cty = $("#cty").val();
			if (cty == "") {
            	ptrCityCode.style.display = "none";
            	ptrCityCode.value = "";
            } 
			else if (cty != "US"){
            	ptrStateCode.style.display = "none";
            	ptrStateCode.value = "";
				ptrCityCode.style.display = "block";
			}
			else {
            	ptrCityCode.style.display = "none";
            	ptrCityCode.value = "";
            	ptrStateCode.style.display = "block";
             }        
        });
  	
  	$("#state").on('input', function(){
	
		
		var state = $("#state").val();
			
		if (state == "") {
        	ptrCityCode.style.display = "none";
        	ptrCityCode.value = "";
        } 
		else {
			ptrCityCode.style.display = "block";
		}

    });
 
});		
