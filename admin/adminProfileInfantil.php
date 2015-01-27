<?php 
require_once("../inc/config.php");
include("../inc/servicios.php");

$id = ($_GET["id"]);
$locutor = get_perfil($id);
$pageTitle= $locutor[0]["nombre"]. " - Perfil";

//validar si el locutor NO es infantil, mandarlo al profile normal.
if ($locutor[0]["genero"] != 'I'){
	header('location: ' . BASE_URL. 'admin/adminProfile.php?id='.$id);
}
$demos = get_demo_infantil($id);
include("../inc/headerAdmin.php");
?>
<script> 
$('body').css({'cursor':'default'});
</script>
	<br>
	<div align="center" class="container">
		<div style="border-bottom: 3px solid #ecf0f1;width:600px;min-height:80px;float:center;display: flex;margin-bottom:20px;">
			<div class="" style="width: 550px;text-align:left;">
				<h1 class="h1-admin "><?php echo $locutor[0]["nombre"]; ?></h1>
				<p><?php echo $locutor[0]["bio"]; ?></p>
			</div>
			<a href="<?php echo BASE_URL . 'admin/adminEdit.php?id=' . $id ?>" class="">
				<img class="imgEdit" src="../images/perfil_editar_info.png"></img>
			</a>
		</div>
		<div  hidden id="formId">
		<form id="uploadForm" action="../inc/uploadAudios.php" method="post" enctype="multipart/form-data" style="border-bottom: 3px solid #ecf0f1;width:600px;min-height:80px;float:center;margin-bottom:20px;">		
			<br>
			<input type="text" name="idPerfil" value="<?php echo $id; ?>">
			<input type="submit" value="Upload file(s)" name="submit" class="search rounded yellowBG btnAdmin" onclick="javascript:copyFiles();">
			<input type="text" name="filesArray" id="filesArray" >
		</form>
		</div>		
		
		<div id="caracterRow" class="divRow" >	
			<div class="player_Name" style="width:540px;height:50px;" >
				<div class="player-holder"  style="position:relative;">
					<?php if ($demos[0]["ubicacion_archivo"] != null) { ?>
					<audio preload="none" controls>
						<source src=" <?php echo HOME.URL_AUDIOS.$demos[0]["ubicacion_archivo"] ?>" />
					</audio>
					<label class="playerText" style="position: absolute;"><?php echo $demos[0]["caracter"] ?></label>							
					<?php } else {?>
					<div class="audioplayer-bar">
						<label class="playerText" ><?php echo $demos[0]["caracter"] ?></label>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php if ($demos[0]["ubicacion_archivo"] != null) { ?>
			<img class="imgDelete" onclick="javascript:confirmDelete('<?php echo $id . '\',\'' . $demos[0]['ubicacion_archivo'] . '\',\'INF' ?>');" src="../images/perfil_delete_audio.png" >
			<?php } else {  ?>
			<div class="imgUploadDiv" style="position:relative;">
				<img class="imgUpload" src="../images/perfil_upload_audio.png" style="height:50px;width:60px;position:absolute;" >
				<input class="imgUploadInpt" type="file" id="filesINF" name="filesToUpload[]" accept="audio/mpeg,audio/ogg"  style="z-index:2;opacity:0;height:50px;width:60px;" />
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