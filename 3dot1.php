<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>3 dots</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
    <link rel="stylesheet" href="3dot.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>




</head>

<body>
    <div class="dropdown">
        <!-- three dots -->
        <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown()">
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <!-- menu -->
        <div id="myDropdown" class="dropdown-content">
           <form action="delete,php" method="post">
            <a href="#home" id="delete" name="delete">Private chat</a>
            <a href="delete.php" name="allchat">Delete all chat</a>
            <a href="#" name="block">Block</a>
          
            </form>
              <a href="#" name="about">About</a>
            <a href="#" name="profile">Profile</a>
        </div>
    </div>


    <script>
        //        function changeLanguage(language) {
        //                    var element = document.getElementById("url");
        //                    element.value = language;
        //                    element.innerHTML = language;
        //                }

        function showDropdown() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

                        // Close the dropdown if the user clicks outside of it
                        window.onclick = function(event) {
                            if (!event.target.matches('.dropbtn')) {
                                var dropdowns = document.getElementsByClassName("dropdown-content");
                                var i;
                                for (i = 0; i < dropdowns.length; i++) {
                                    var openDropdown = dropdowns[i];
                                    if (openDropdown.classList.contains('show')) {
                                        openDropdown.classList.remove('show');
                                    }
                                }
                            }
                        }
//        $(document).ready(function() {
//            window.onclick = function(event) {
//                if (event.target.id! = "delete") {
//                    $("#myDropdown").hide();
//                }
//            }
//        });

    </script>
</body>

</html>
