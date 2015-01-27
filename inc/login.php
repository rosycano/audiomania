<?php
// Servicios para registrarse


// Funcion para verificar usuario y contraseña 

function check_user(){
// connect to database
	require(ROOT_PATH . "inc/database.php");
	
	// Set query
	try{
		$results = $db->query("
				SELECT *  
				FROM usuarios 
				WHERE usuario = " . $_GET["user"]	
			);
	} catch(Exception $e){
		echo "Data could not be retrieved from DB.";
	}
	
	// Fetch and return results
	$usuario = $results->fetchAll(PDO::FETCH_ASSOC);		
	 if ($usuario == true) {
		if ($usuario["contraseña"] == $_GET["password"]){
			echo "Usuario y contraseña correctos";
			return true;
		}
		else {
			echo "Contraseña invalida";
			return false;
		}	 
	 } else {
		echo "Usuario invalido";
		return false;
	 }
}
?>