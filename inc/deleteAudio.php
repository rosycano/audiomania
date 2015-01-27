<?php
require("config.php");
$conn=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$id = mysqli_real_escape_string($conn, $_POST['idPerfil']);
$path = mysqli_real_escape_string($conn, $_POST['path']);
$char = mysqli_real_escape_string($conn, $_POST['char']);
//delete from db
$sql="DELETE FROM demos WHERE id_locutor = '$id' AND ubicacion_archivo= '$path' ";
if (mysqli_query($conn, $sql)) {
	echo "Record delete successfully";
		//delete server file
		unlink('../' . $path);
} else {
	echo "Error deleting record from database: " . mysqli_error($conn);
}
$page = 'admin/adminProfile.php?id='.$id;
if ($char == 'INF') {
	$page = 'admin/adminProfileInfantil.php?id='.$id;
}

header('location: ' . BASE_URL. $page);
mysqli_close($conn);
?>