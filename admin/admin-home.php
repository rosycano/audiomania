<?php 
require_once("../inc/config.php");
include("../inc/servicios.php");

$pageTitle="Home - Administrci&oacute;n";
include("../inc/headerAdmin.php");
$locutores = get_locutores('','');
?>
		<div >
			<select class="admin search rounded" id="voiceAdmSelector" size=1 >
				<option selected disabled value="" >Filtrar por voz..</option>
				<option value="F">Femenina</option> 
				<option value="M">Masculina</option> 
				<option value="I">Infantil</option> 
			</select>
			
			<input class="admin search rounded" id="filtro_nombre" type="text" />
			<a href="<?php echo BASE_URL . 'admin/adminEdit.php?id=0' ?>">
				<img class="imgNuevo" src="../images/admin_nuevo_usuario.png" href=""></img>
			</a>
		</div>
		<?php		
		foreach($locutores as $locutor) { ?>
			<a href="<?php echo BASE_URL . 'admin/adminProfile'. ($locutor["genero"]=='I' ? 'Infantil' : '') .'.php?id=' . $locutor["id"] ?>" class="link">
			<div id="talentoRow" class="divRow">
				<label name="id" style="display:none;"><?php echo $locutor["id"] ?></label>
				<span class="divNombre"><?php echo $locutor["nombre"] ?>
					<label style="display:none;" id="genero" ><?php echo $locutor["genero"] ?></label>
				</span>
				<img class="imgSetting" src="../images/perfil_settings.png">		
			</div>	
			</a>
<?php } ?>	
	
</div>
</div>
</body>
</html>
	
	