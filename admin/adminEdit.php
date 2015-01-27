<?php 
require_once("../inc/config.php");
include("../inc/servicios.php");

$id = $_GET["id"];
;
if ($id != '0') {
	$pageTitle="Editar Perfil - Administrador";
	$locutor = get_perfil($id);
} else {
	$pageTitle="Nuevo Perfil - Administraci&oacute;n";
}
include("../inc/headerAdmin.php");
?>
	<div align="center" class="container">
		<form class="info" id="formUpd" action="../inc/insertUpdateProfile.php" method="post">
			<input  hidden name="idPerfil" value="<?php echo $id ?>" />
			<div class="divInfo">
				<label class="">voz</label>
				<select name="genero" id="voiceAdmSelector" class="search rounded edit" size=1 >
					<option selected disabled value="" >Escoger voz..</option>
					<option value="F">Femenina</option> 
					<option value="M">Masculina</option> 
					<option value="I">Infantil</option> 
				</select>
			</div>
			<div class="divInfo">
				<label class="">nombre</label>
				<input class="search rounded edit" style="text-transform: none" name="nombre" value="<?php if ($id != '0') { echo $locutor[0]["nombre"]; } ?>" />
			</div>
			<div class="divInfo">
				<label class="">bio</label>
				<textarea class="search rounded edit" style="height:60px;text-transform: none" name="bio" rows="3" placeholder="Perfil, experiencia y comentarios adicionales." ><?php if ($id != '0') { echo $locutor[0]["bio"]; } ?></textarea>
			</div>
			<input type="button" id="searchButton" class="search rounded yellowBG btnAdmin" value="<?php if($id == '0') { echo 'crear';} else { echo 'actualizar';} ?>" onclick="javascript:verifyGender('<?php echo $id; ?>','<?php echo $locutor[0]["genero"]; ?>');" />
			<input hidden type="text" name="deleteAll"/>
			<input hidden type="submit"/>
			<input type="button" id="regresar" class="search rounded yellowBG btnAdmin" value="Regresar" onclick="javascript:regresarPerfil('<?php echo $id; ?>','<?php echo $locutor[0]["genero"]; ?>');" />
		</form>
	</div>


</div>
</body>
<?php if ($id != '0') { echo "<script>$('#voiceAdmSelector').val('" .$locutor[0]["genero"] . "').prop('selected', true); </script>"; } ?>
</html>