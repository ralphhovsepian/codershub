# codershub
A new social network for all coders around the world

This is a Beta Version. You should always check for updates.


# Changes that you must do

In the Classes/User.class.php you should change the settings of the PHPMailer to yours.

$mail->Host = 'the smtp server that you are using';
$mail->Username = 'youremail';            
$mail->Password = 'yourpassword'; 

$mail->setFrom('youremail', 'CodersHub');

Here is the link of PHPMailer. PHPMailer wasn't coded by me. All rights reserved to the coder. https://github.com/PHPMailer/PHPMailer


You must add the codershub.sql database to your phpmyadmin so it can work normally.

And of course you should change the settings of the mySQL connection to yours in Classes/connection.php
