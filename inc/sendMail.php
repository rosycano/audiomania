<?php
require_once("../inc/config.php");

if( isset($_GET["subject"])) {
    $subject = $_GET["subject"];
    echo '
<html>
    <head>
        <title>Aviso por correo</title>
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'css/casting.css">
    </head>
    <body class="leftSection" style="height: 300;min-height: 0;">
		<div class="w-form">
		<form id="email-form" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) .'" name="email-share" method="post" >
			<input class="perfil-input" type="email" placeholder="De*" name="headers" required="required">
			<input class="perfil-input" type="email" placeholder="Para*" name="email" required="required">
			<input class="perfil-input" type="text" placeholder="Subject" name="subject" required="required" value="'. $subject .'">
			<textarea class="perfil-input" rows="5" placeholder="Mensaje*" name="message" required="required"></textarea>
			<input class="send rounded yellowBG" type="submit" value="Enviar" data-wait="..." wait="...">
		</form>		
					
    </body>
</html>';
} elseif($_POST["email"] != null and $_POST["subject"] != null and $_POST["message"] != null and $_POST["headers"] != null) {
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
	echo '
	<html>
		<head>
			<title>Aviso por correo</title>
			<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'css/casting.css">
		</head>
		<body class="leftSection" style="height: 300;min-height: 0;">
			<div  id="msgDiv" class="w-form-done"><p>Gracias! Su mensaje fue enviado =)!</p></div>	
		</body>
	</html>
	$(this).close();';
	
	//sleep 5 secs
	sleep(5);
	
} else {
    echo
	'<html>
		<head>
			<title>Aviso por correo</title>
			<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'css/casting.css">
		</head>
		<body class="leftSection" style="height: 300;min-height: 0;">

			<div  id="msgDiv" class="w-form-fail"><p>Su mensaje no se ha podido mandar, intente mas tarde.</p></div>			
						
		</body>
	 </html>
	 $(this).close();
	 ';
}


 ?>
