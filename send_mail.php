<?php

$to_email = "prateekbhardwaj24@gmail.com";
$subject  = "Simple mail";
$body     = "This test mail get from paras jha";
$header   = "From: parasjhapr@gmail.com";


if(mail($to_email, $subject, $body, $header)){
    echo "Email successfully send to $to_email";
}
else{
    echo "Email sending fail";
}



?>