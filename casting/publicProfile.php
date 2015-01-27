<?php 
require_once("../inc/config.php");
include("../inc/servicios.php");

// getting filter selection from prior page
$id = (isset($_GET["perfil"]) ? $_GET["perfil"] : (isset($_POST["perfil"]) ? $_POST["perfil"] : 0));

$locutor = get_perfil($id);
$pageTitle = "Audiomania - ". $locutor[0]["nombre"] ;

if ($locutor[0]["genero"] != 'I') {
	$demos = get_demos_locutor($id);
} else {
	$demos = get_demo_infantil($id);
}

//If user has sent a message for current Locutor
$submited = 0;
if(isset($_POST["email"])) {
    $body =  
	"Talento:". $locutor[0]['nombre'] .  
	"\r\nNombre:" . $_POST['nombre'] .
    "\r\nEmail:" . $_POST['email'] .
    "\r\nTelefono:" . $_POST['telefono'] .
    "\r\nEmbresa:" . $_POST['empresa'] .
    "\r\nMensaje:" . wordwrap($_POST['acerca-del-proyecto'], 70, "\r\n");
    // Set the $submited variable to true. 	
	echo $body;
	if ( @mail("rosycano@hotmail.com", "Audiomania.mx - Contacto", $body, "From:rosycano@gmail.com\r\n" )){
		$submited = 1;
	} else {
		$submited = 2;
	}
}

include("../inc/headerCasting.php");
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">
window.twttr=(function(d,s,id){var t,js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return}js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);return window.twttr||(t={_e:[],ready:function(f){t._e.push(f)}})}(document,"script","twitter-wjs"));
</script>

	<div align="center" >
		<div class="resultsArea" style="height:730px;">
		<div style="width:960px; text-transform:none;text-align:left;">
			<div class="leftSection rounded" >
				<div class="perfil-bio">
					<h1 class="h1-perfil"><?php echo $locutor[0]['nombre'] ?> </h1>
					<p class=""><?php echo $locutor[0]['bio'] ?> </p>
				</div>
				<div class="w-form">
					<?php if($submited == 1) echo '<div><p style="color:#f9b600;">Gracias. Su mensaje fue enviado =)</p></div>';?>
					<?php if($submited == 2) echo '<div><p style="color:red">Error al enviar el mensaje, intente mas tarde.</p></div>';?>
					<form action="publicProfile.php" method="post" id="email-form" name="email-form" data-name="Email Form">
						<input hidden id="perfil" type="text" name="perfil" value="<?php echo $id ?>">
						<h3 class="h3-perfil">Contacta a <?php echo $locutor[0]['nombre'] ?></h3>
						<input class="perfil-input" id="nombre-3" type="text" placeholder="Nombre*" name="nombre" data-name="Nombre" required="required">
						<input class="perfil-input" id="email" type="email" placeholder="Email*" name="email" data-name="Email" required="required">
						<input class="perfil-input" id="telefono" type="text" placeholder="Tel&eacute;fono" name="telefono" data-name="Teléfono" required="required">
						<input class="perfil-input" id="empresa" type="text" placeholder="Empresa" name="empresa" data-name="Empresa">
						<textarea class="perfil-input" id="Acerca-del-proyecto" placeholder="Acerca del proyecto*" name="acerca-del-proyecto" data-name="Acerca del proyecto" required="required" style="height: 70;"></textarea>
						<input class="send rounded yellowBG" type="submit" value="Enviar" data-wait="..." wait="...">
					</form>
				</div>
	
			</div>
			<div class="rightSection rounded">
				<div style="margin:15px;">
					<h1 class="h1-perfil" style="display:inline;">Portafolio</h1>
					<div class="socialmedia" > 
						<a class="twitter-share-button mediaLink" data-count="none" href="https://twitter.com/share"></a>
						<!--a class="perfil-share" href="#www.facebook.com/<?php echo $locutor[0]['facebook']?>">F</a!-->
						<div class="fb-share-button " data-href="<?php echo get_current_url(); ?>" data-layout="button"></div>
						<!-- Email -->
						<a target="popup" style="float:right;text-decoration: none;" 
							onclick="window.open('', 'popup', 'width=310,height=330,titlebar=no,scrollbars=no,toolbar=no;status=no,resizable=no;menubar=no,location=no,directories=no,top=10,left=10'); window.close();" 
							href="../inc/sendMail.php?subject=Checa este talento de Audiomania.">
							<div class="perfil-share" >
								<img src="../images/perfil_send_mail.png" ></img>
								<span >Mail</span>
							
							</div>
						</a> 
					</div>
				</div>
				<div>
					<?php foreach($demos as $cntr=>$demo) {  ?>	
							<div class="player_Name" style="width:500px;height:50px;">	
								<div class="player-holder" style="position:relative;">
									<?php if ($demo["ubicacion_archivo"] != null) { ?>
									<audio preload="none" controls>
										<source src=" <?php echo HOME.URL_AUDIOS.$demo["ubicacion_archivo"] ?>" />
										<source src="http://www.html5tutorial.info/media/vincent.ogg" />
									</audio>
									<label class="playerText" style="position: absolute;"><?php echo $demo["caracter"] ?></label>							
									<?php } else {?>
									<div class="audioplayer-bar">
										<label class="playerText" ><?php echo $demo["caracter"] ?></label>
									</div>
									<?php } ?>
								</div>
							</div>				
					<?php } ?>	
				</div>
			</div>
		</div>
		</div>	
	</div>
</div>
<script>
    $( function() { $( 'audio' ).audioPlayer(); } );
</script>
</body>
</html>