<?php
if($_POST["email"] != null and $_POST["subject"] != null and $_POST["message"] != null and $_POST["headers"] != null) {
    // to:
    $mail = $_POST["email"];
    // subejct:
    $subject = $_POST["subject"];
    // message:
    $message = $_POST["message"];
    // headers ("From:".$from):
    $headers = $_POST["headers"];
    // sendMail
    mail($mail, $subject, $message, $headers);
	
	//make visible div with success
	echo '<script> $("#w-form-done").css(display) = "block"; </script>'
} else {
    echo '<script> $("#w-form-fail").css(display) = "block"; </script>'
} ?>