<?php 
require_once("../inc/config.php");
include("../inc/servicios.php");
// getting filter selection from prior page
$voice = $_POST["voice"];

// When voice equal Infantil, the character is emtpy
if($voice == 'I'){
	$character = "";
} else {
	$character = $_POST["character"];
}

$character_desc = "";
$voices = ($voice == 'I'? 'infantiles' : ($voice == 'F' ? 'femeninas' : 'masculinas'));
$pageTitle = "Conoce nuestros talentos";
include("../inc/headerCasting.php");
?>
	<div align="center" >
		<div class="showSelectedOp" > 
			<p>
			<?php echo '<b style="color:#BDBDBD;" >voces </b><b>' . $voices . '</b>' ?>
			<?php if ($voice != 'I') echo '<b style="color:#BDBDBD;"> con caracter </b><b>' . $character_desc . '</b>'; ?>
			</p>
		</div>	
		<div class="resultsArea" >		
			<?php 
			$demos = get_demos($voice, $character );
			$counter = 0;
			foreach($demos as $demo) { ?>	
				<div class="player_Name" style="width:700px;height:50px;display:inline-flex;">	
					<div class="player-holder" style="width:490px;position:relative;">
						<?php if ($demo["ubicacion_archivo"] != null) { ?>
						<audio preload="none" controls>
							<source src=" <?php echo HOME.URL_AUDIOS.$demo["ubicacion_archivo"] ?>" />
							<source src="http://www.html5tutorial.info/media/vincent.ogg" />
						</audio>
						<label class="playerText" style="position: absolute;"><?php echo $demo["nombre"] ?></label>							
						<?php } else {?>
						<div class="audioplayer-bar">
							<label class="playerText" ><?php echo $demo["nombre"] ?></label>
						</div>
						<?php } ?>
					</div>
					<a class="link" href="<?php echo BASE_URL . 'casting/publicProfile.php?perfil=' . $demo["id"] ?>" >
						<div class="linkDiv" style="width: 200px;padding-top: 15px;padding-bottom: 15px;"> 	
							ver perfil					
						</div>
					</a>
			</div>				
			<?php } ?>	
		</div>
		
	</div>

</div>
<script>
    $( function() { $( 'audio' ).audioPlayer(); } );
</script>
</body>
</html>



