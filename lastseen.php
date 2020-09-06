<html>

<body>
    <div id="lastseen_report_pan"></div>
    <div id="numonline_report_pan"></div>


    <?php
    session_start();
          $con = mysqli_connect("localhost", "root", "", "mychat");

          $user = $_SESSION['user_email'];
          $get_user = "select * from my_users1 where user_email='$user'";
          $run_user = mysqli_query($con, $get_user);
          $row2 = mysqli_fetch_array($run_user);
       
          $user_name = $row2['user_name'];
//          $user_profile = $row2['user_profile'];
          $user_country = $row2['user_country'];
          $user_gender = $row2['user_gender'];
          $user_email = $row2['user_email'];
          $user_id = $row2['user_id'];
        
    ?>
    

<script>
    
			function lastSeen()
			{
				i = getXMLHttpRequestObject();
				if(i != false)
				{
                    
				    url = "<?php echo' lastseen1.php?last_seen&id= $user_id'; ?>"//id is the UserID for the user whose last seen is to be checked
					i.open("POST", url, true);
					i.onreadystatechange=function()
									{
										if(i.readyState==4)
										{
											document.getElementById("lastseen_report_pan").innerHTML = i.responseText;
										}
									}										
					i.send();
				}
				else
				{
					alert("Cant create XMLHttpRequest");
				}
			}
    
			
			function numOnline()
			{
				j = getXMLHttpRequestObject();
				if(j != false)
				{
					url = "<?php echo 'lastseen1.php?num_online'; ?>"
					j.open("POST", url, true);
					j.onreadystatechange=function()
									{
										if(j.readyState==4)
										{
											var jsonResp = eval("(" + j.responseText + ")");//This is a JSON response from the server
											document.getElementById("numonline_report_pan").innerHTML = jsonResp.users + " user(s) currently online";
											document.getElementById("online_today").innerHTML = jsonResp.today + " user(s) online today";
										}
									}										
					j.send();
				}
				else
				{
					alert("Cant create XMLHttpRequest");
				}
			}


            function doReport()
			{
				k = getXMLHttpRequestObject();
				if(k != false)
				{
					url = "<?php echo 'lastseen1.php?report&id= $user_id'; ?>"
					k.open("POST", url, true);
					k.onreadystatechange=function()
									{
										if(k.readyState==4)
										{
											//...Do nothing...
										}
									}										
					k.send();
				}
				else
				{
					alert("Cant create XMLHttpRequest");
				}
			}
			
			
			//Getting the right XMLHttpRequest object 
			function getXMLHttpRequestObject()
			{
				xmlhttp = 0;
				try 
				{
					// Try to create object for Chrome, Firefox, Safari, IE7+, etc.      
					xmlhttp = new XMLHttpRequest();
				}
				catch(e)
				{      
					try
					{
						// Try to create object for later versions of IE.
						xmlhttp = new ActiveXObject('MSXML2.XMLHTTP');
					}      
					catch(e)
					{        
						try
						{          
							// Try to create object for early versions of IE.
							xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
						}        
						catch(e)
						{
							// Could not create an XMLHttpRequest object.
							return false;        
						}      
					}    
				}
				return xmlhttp;
			} 
			
			//Call the functions
			doReport();
			numOnline();
			lastSeen();
			// highestOnlineEver();
			
			//... then set the interval
			setInterval(doReport, 30000);// Report user presence every 30sec
			setInterval(numOnline, 30000);//Get number of user online every 30sec
			setInterval(lastSeen, 30000);//Get the last seen time of a user every 30sec
			// setInterval(highestOnlineEver, 30000);//Get the highest online every 30sec
		</script>
            </body>
	</html>	
            
