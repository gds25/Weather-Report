	var ptrLocation = document.getElementById("B"); 

    var ptrPress = document.getElementById("press"); 
        //ptrPress.addEventListener("click", getLocation());
        
   	var ptrBtn = document.getElementById("btn"); 
    
    var ptrStateCode = document.getElementById("state");
    var ptrCityCode = document.getElementById("city");
    
    var celsius;
    var fahrenheit;

        function getLocation() {
            if (navigator.geolocation) {
                 
               navigator.geolocation.getCurrentPosition(F);
               
            } 
            else {
                ptrLocation.innerHTML = "Geolocation not supported by this browser.";
            }  
        }
    
        var lat;
        var lon;
        function F(position) { //JSON object returned in result by getCurrentPosition 
            lat = position.coords.latitude; 
            lon = position.coords.longitude;
            
            getWeather("weather_coord.php", {data1: lat, data2: lon});
        }

    
    function getWeather(url, data) {
    	//$(document.body).append(data1);
    	//$(document.body).append(data2);
        $.ajax({
         type: 		"GET",
         url: 		url,
         contentType: "application/json",
         dataType: 'json',
         data: 		data,
         
	     beforeSend: function(){ 		
		    //$("#B").html("<div class='box'><br></div>");
         },
        
        error: 	 function(xhr, status, error) {  
			alert( "Error Mesaage:  \r\nNumeric code is: "  + xhr.status + " \r\nError is " + error);   },
        
        success: 	 function(result){
            
			r = result;
                 
            sunrise = r.sys.sunrise //epoch seconds 
            //Date needs milliseconds, roughly 1000*seconds 
            var myDate = new Date( (sunrise + r.timezone) * 1000 ); 
            rdRise = myDate.toLocaleTimeString("en-US", {timeZone: "UTC"}); 

            sunset = r.sys.sunset //epoch seconds 
            //Date needs milliseconds, roughly 1000*seconds 
            var myDate2 = new Date( (sunset + r.timezone) * 1000 ); 
            rdSet = myDate2.toLocaleTimeString("en-US", {timeZone: "UTC"}); 
            
            var currDate = new Date( (r.dt + r.timezone) * 1000 ); 
			rdCurr = currDate.toLocaleString("en-US", {timeZone: "UTC"});
			
			
            celsius = Math.round(r.main.temp);
            fahrenheit = Math.round(celsius * 1.8 + 32);
            
			$("#location").html(r.name + ", " + r.sys.country);
			$("#date-time").html(rdCurr);
			$("#description").html(r.weather[0].main + "/" + r.weather[0].description);
			$("#temperature").html(celsius);

			
			$(".windspeed").html(r.wind.speed +  "km/h");
			$(".humidity").html(r.main.humidity +  "%");
			$(".pressure").html(r.main.pressure +  "hPa");
			$(".sunrise").html(rdRise);
			$(".sunset").html(rdSet);
			

        }	
    });
   };
    
    
$(document).ready(function(){
    getLocation();
    
    $("#cty").load("country_codes.html"); 
    $("#state").load("state_codes.html");
    
    $(document.body).append($("#cty").val());
   
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
  	
  	$("#state").change(function(){
		var state = $("#state").val();
			
		if (state == "") {
        	ptrCityCode.style.display = "none";
        	ptrCityCode.value = "";
        } 
		else {
			ptrCityCode.style.display = "block";
		}

    });
 
    $("#btn").click(function(){ 
    	window.location.href = 'addCity.php';
    	return false;
     });   
    
    $("#press").click(function(){ 
    	getLocation();
    });
    
    
    $("#celsius").click(function(){ 
		$("#temperature").html(celsius);
		$("#fahrenheit").css("color", "#b0bec5");
		$("#celsius").css("color", "white");
    }); 
    
    $("#fahrenheit").click(function(){ 
		$("#temperature").html(fahrenheit);
		$("#celsius").css("color", "#b0bec5");
		$("#fahrenheit").css("color", "white");
    }); 
    
});		
