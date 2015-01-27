<?php

require("config.php");

$conn=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// escape variables for security
$id = mysqli_real_escape_string($conn, $_GET['id']);

if($id != null && $id > 0) {
	$sql = "DELETE * FROM demos where id_locutor= '$id' ;";
	$sql .= "DELETE * FROM locutores WHERE id = '$id'";

	// Execute multi query
	if (mysqli_multi_query($con,$sql)){
		$message = "El perfil fue borrado exitosamente.";
		echo "Record deleted successfully";
		//borrar los archivos fisicos
	} else {
		$message = "Error al intentar borrar el perfil.";
		echo "Error deleting record: " . mysqli_error($conn);
	}
} else {
	$message =  "Error, el perfil no es valido.";
}

mysqli_close($con);

header('location: ' . BASE_URL. '/admin/admin-home.php?message='.$message);
mysqli_close($conn);