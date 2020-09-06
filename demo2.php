<!--

 
        if(isset($_POST['submit'])){
            $select = $_POST['time'];
        
        switch($select){
            case 1:
                 echo"<script>
                   function time(){
                    var text = document.getElementById('private');
                    if(text.style.display !== 'none'){
                    text.style.display = 'none';
                            }
                    else {
                       text.style.display = 'block';

                    }        
                        } 
                    setTimeout(time, 1*60*1000);

                    </script>
                ";  
                break;
            case 2:
                 echo"<script>
                   function time(){
                    var text = document.getElementById('private');
                    if(text.style.display !== 'none'){
                    text.style.display = 'none';
                            }
                    else {
                       text.style.display = 'block';

                    }        
                    
                        } 
                    setTimeout(time, 2*60*1000);

                    </script>
                ";  
                break;
            case 3:
                 echo"<script>
                   function time(){
                    var text = document.getElementById('private');
                    if(text.style.display !== 'none'){
                    text.style.display = 'none';
                            }
                    else {
                       text.style.display = 'block';

                    }        
                    
                        } 
                    setTimeout(time, 3*60*1000);

                    </script>
                ";  
                break;
    

            }
        }
    
-->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MyHome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.2.0/bootstrap-slider.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.2.0/css/bootstrap-slider.min.css" />


    <style>
        #ex1slider.slider-selection {
            background: #bababa;
        }

        .container {
            padding-top: 40px;
            text-align: center;
        }

    </style>

</head>

<body>
<!--
    <div id="private">
        how are uuu.
    </div>
-->
    
      <h1>Select time</h1>
       <form action="" method="post">
       <select name="time">
           <option value="">Select...</option>
           <option value="1">1 min</option>
           <option value="2">2 min</option>
           <option value="3">3 min</option>
       </select>
       <input type="submit" name="submit" value="submit">
        </form>


       
    

   
</body>

</html>
