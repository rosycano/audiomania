<?php 
require_once("../inc/config.php");
include("../inc/servicios.php");

$pageTitle = "Casting";
$section = "home";
?>

<html>
<head>
<!DOCTYPE html>
<meta charset="UTF-8">
<title><?php echo $pageTitle; ?></title>
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://daks2k3a4ib2z.cloudfront.net/54765cd96a330d0152aec831/js/webflow.js?a7d7d0faae8d68741c895a7d70f24bc4"></script>
<!--[if lte IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
<link rel="shortcut icon" href="<?php echo BASE_URL; ?>favicon.ico">	
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/casting.css">
<link rel="stylesheet" type="text/css" href="http://nexumdigital.com/audiomania/v2/oswald/css/audioplayer.css">
<script type="text/javascript" src="http://nexumdigital.com/audiomania/v2/oswald/js/audioplayer.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>js/functions.js"></script>
</head>

<body class="castingTheme" >
<div align="center" >
	<div class="wrapper" align="center">
		<div class="div-welcome" style="margin-top:80px;">
			<div class="logo">
				<img src="<?php echo BASE_URL; ?>images/logo_casting.png">
			</div>
			<br/>
			<span class="header-casting">CASTING DE VOCES ONLINE</span>
		</div>	
	</div>

	<div class="div-welcome" >
		<h2 class="h2-casting">Hallar la voz ideal</h2>
		<h2 class="h2-casting">nunca fue tan simple</h2>
	</div>
	<?php include(ROOT_PATH . "inc/dropdownSearch.php"); ?>
	
	<a class="link-audiomania-home" href="#">audiomania.mx</a>	
</div>
</body>
</html>