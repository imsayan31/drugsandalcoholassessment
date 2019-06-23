<?php
mail("sayantadey123@gmail.com","My Drugs Subject",'I am very much drug addicted. Please help me out to get rid of this addiction.');
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "it@sbr-technologies.com";
    $to = "sayantadey123@gmail.com ";
    $subject = "PHP Mail Test script";
    $message = "This is a test to check the PHP Mail functionality";
    $headers = "From:" . $from;
	$headers .= "Reply-To: $to";
    var_dump(mail($to,$subject,$message,$headers));