<?php
session_start();
/* Set e-mail recipient */
$myemail  = "dietacud.pl@gmail.com";


$_SESSION['$yourname'] = $_POST['yourname'];
$_SESSION['$subject']  = $_POST['subject'];
$_SESSION['$email2']    = $_POST['email'];
$_SESSION['$website']  = $_POST['website'];
$_SESSION['$comments'] = $_POST['comments'];


/* Let's prepare the message for the e-mail */
$message = "Hello!

Your contact form has been submitted by:

Name:       $yourname
E-mail:     $email2
URL:        $website
Comments:   $comments

End of message
";

/* Send the message using mail() function */
mail($myemail, $subject, $message);

header("location: wiadomosc-wyslana");
exit();


?>