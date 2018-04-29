<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href ="style.css" rel =" stylesheet" type = "text/css"/>
        <title>AJAX: Sign Up Page</title>

        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
        
            function validateForm() {
                
                return false;
           
            }
            
        </script>
        
        <script>
            
            $(document).ready( function(){
                var name =true;
                var last = true;
                var passMatch = true;
                $("#re-password").change(function(){
                    if($("#password").val() != $("#re-password").val()){
                        $("#matching").html("Passwords do not match!");
                        $("#matching").css("color","red");
                        passMatch = false;
                    }
                    else{
                        $("#matching").html("Matching Passwords!");
                        $("#matching").css("color","green");
                    }
                });
                $("#submitB").click(function(){
                    if($("#fName").val()==""){
                        $("#Fname").html("Cannot Leave this empty!")
                        $("#Fname").css("color","red")
                        name = false;
                    }
                    else if($("#fName").val()!=""){
                         $("#Fname").html("")
                        $("#Fname").css("color","green")
                        name = false;
                    }
                    if($("#lName").val() == ""){
                        $("#Lname").html("Cannot Leave this empty!")
                        $("#Lname").css("color","red")
                        last = false;
                    }
                    else if(!$("#lName").val()!= ""){
                         $("#Lname").html("")
                        $("#Lname").css("color","green")
                        name = false;
                    }
                    if($("#password").val() == ""||$("#re-password").val() == ""){
                        $("#matching").html("Enter a Password");
                        $("#matching").css("color","red");
                        passMatch = false;
                    }
                    if(name&&passMatch&&last){
                        $.ajax({
                            
                        })
                    }
                });
                
                $("#username").change(function()
                {
                    //alert(  $("#username").val() );
                    $.ajax({

                        type: "GET",
                        url: "checkUsername.php",
                        dataType: "json",
                        data: { "username": $("#username").val() },
                        success: function(data,status) {
                        
                            //alert(data.password);
                            
                            if (!data) {  //data == false
                                $("#available").html("Username is Available");
                                $("#available").css("color","green");
                                
                            } else {
                                 $("#available").html("Username is not Available");
                                $("#available").css("color","red");
                                
                            }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                    
                });
                
                $("#state").change(function() {
                    //alert($("#state").val());
                    
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
                        dataType: "json",
                        data: { "state": $("#state").val()},
                        success: function(data,status) {
                          
                        //   alert(data[0].county);
                        $("#county").html("<option> - Select One -</option>");
                        for(var i = 0; i < data.length; i++){
                             $("#county").append("<option>" + data[i].county + "</option>");
                        }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    
                    });//ajax
                    
                    
                    
                });
                
                $("#zipCode").change( function(){  
                    
                    //alert( $("#zipCode").val() );  
                    
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php?",
                        dataType: "json",
                        data: { "zip": $("#zipCode").val()   },
                        success: function(data,status) {
                          
                          if(data){
                              $("#Zcode").html("")
                          $("#city").html(data.city);
                          $("#lat").html(data.latitude)
                          $("#long").html(data.longitude)
                          }
                          else{
                            $("#Zcode").html("Zip code not found")
                            $("#Zcode").css("color","red");
                            $("#city").html("");
                            $("#lat").html("")
                            $("#long").html("")
                              
                          }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                    
                    
                } );
                
            }   ); //documentReady
            
            
            
        </script>

    </head>

    <body>
    
       <h1 id = "title"> Sign Up Form </h1>
    
        <form onsubmit="return validateForm()">
            <fieldset id = "border1">
               <legend id ="border">Sign Up</legend>
                First Name:  <input type="text" id = "fName"><span id="Fname"></span><br> 
                Last Name:   <input type="text" id = "lName"><span id = "Lname"></span><br> 
                Email:       <input type="text" id = "email"><br> 
                Phone Number:<input type="text" id = "phone"><br><br>
                Zip Code:    <input type="text" id="zipCode"><span id= "Zcode"></span><br>
                City:        <span id="city"></span>
                <br>
                Latitude: <span id ="lat"></span>
                <br>
                Longitude: <span id = "long"></span>
                <br><br>
                State: 
                <select id="state">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />
                
                Select a County: <select id="county"></select><br>
                
                
                Desired Username: <input type="text" id = "username"><span id ="available"></span><br>
                
                Password: <input type="password" id = "password"><br>
                
                Type Password Again: <input type="password" id = "re-password"><span id = "matching"></span><br>
                
                <input type="submit" value="Sign up!" id="submitB">
                <br />
            </fieldset>
        </form>
      
    </body>
    <footer id="fter">
            <hr>
            CST 336. 2018&copy; Gopar<br />
            <strong>Disclaimer:</strong> This website is used for academic purposes only.<br />
            <img src="https://csumb.edu/sites/default/files/styles/profile_large/public/photo_1_6.jpg?itok=N4I4g9Wl" id ="img">
        </footer>
</html>