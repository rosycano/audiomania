<?php 
require_once("../inc/config.php");
include("../inc/servicios.php");

$id = ($_GET["id"]);
$locutor = get_perfil($id);
$pageTitle= $locutor[0]["nombre"]. " - Perfil";

//validar si el locutor es infantil, mandarlo al profile infantil.
if ($locutor[0]["genero"] == 'I'){
	header('location: ' . BASE_URL. 'admin/adminProfileInfantil.php?id='.$id);
} 
$demos = get_demos_admin($id);
$miss_demos = get_missing_demos($id);
$charList = '';
foreach($miss_demos as $miss_demo){
	$charList .= $miss_demo["codigo"].','.$miss_demo["caracter"].'|';
}
$charList = substr($charList, 0, -1);

include("../inc/headerAdmin.php");
?>
<script> 
$('body').css({'cursor':'default'});
</script>
	<input type="text" hidden id="charsList" value="<?php echo $charList; ?>">
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
			<a href="<?php echo BASE_URL . 'inc/deleteProfile.php?id=' . $id ?>" onclick=" return verifyDeleteProfile('<?php echo $id; ?>','<?php echo $locutor[0]["nombre"]; ?>')" class="">
				<img class="imgDelProfile" src="../images/perfil_delete_audio.png"></img>
			</a>
		</div>
		<div hidden id="formId">
		<form id="uploadForm" action="../inc/uploadAudios.php" method="post" enctype="multipart/form-data" style="border-bottom: 3px solid #ecf0f1;width:600px;min-height:80px;float:center;margin-bottom:20px;">
			<p class="">Selecciona los caracteres de los archivos a subir: </p>			
			<br>
			<div id="list" ></div>
			<input type="text" hidden name="idPerfil" value="<?php echo $id; ?>">
			<input type="submit" value="Upload file(s)" name="submit" class="search rounded yellowBG btnAdmin" onclick="javascript:copyFiles();">
			<input type="button" value="Cancelar" class="search rounded yellowBG btnAdmin" onclick="javascript:cancelUploads();" >
			<input type="text" hidden name="filesArray" id="filesArray" >
		</form>
		</div>
		
		<?php if (count($miss_demos) > 0 ) { ?>
		<div id="btnMultiUpload" class="divRow">
		<div style="width:540px;height:50px;display:flex;border-bottom:1px solid #ccc;" ></div>
		<div class="imgUploadDiv" style="position:relative;">
			<img class="imgUpload" src="../images/perfil_upload_audio.png" style="height:50px;width:60px;position:absolute;" >
				<input class="imgUploadInpt" type="file" id="files" name="filesToUpload[]" accept="audio/mpeg,audio/ogg"  multiple="multiple" style="z-index:2;opacity:0;height:50px;width:60px;" />
			</div>
		</div>
		<?php } ?>
		<?php foreach($demos as $cntr=>$demo) { ?>
			<div id="caracterRow" class="divRow" >
				<div class="player_Name" style="width:540px;height:50px;" >	
					<div class="player-holder"  style="position:relative;">
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
				<?php if ($demo["ubicacion_archivo"] != null) { ?>
				<img class="imgDelete" onclick="javascript:confirmDelete('<?php echo $id . '\',\'' . $demo["ubicacion_archivo"] .'\',\''. $demo["codigo"]; ?>');" src="../images/perfil_delete_audio.png" >
				<?php } else {  ?>
				<div class="imgUploadDiv" style="position:relative;">
					<img class="imgUpload" src="../images/perfil_upload_audio.png" style="height:50px;width:60px;position:absolute;" >
					<input class="imgUploadInpt" type="file" id="files<?php echo $demo["codigo"]; ?>" name="filesToUpload[]" accept="audio/mpeg,audio/ogg"  style="z-index:2;opacity:0;height:50px;width:60px;" />
				</div>
				<?php } ?>
			</div>	
		<?php } ?>
	</div>
</div>
<script>
	$( function() { $( 'audio' ).audioPlayer(); } );
</script>
</body>
</html>