<?php
require("config.php");
$conn=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$id = mysqli_real_escape_string($conn, $_GET['idPerfil']);
$typeChar = "";

//delete server file;
$qry="SELECT ubicacion_archivo FROM demos WHERE id_locutor = '$id'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	unlink('../'.HOME . $row["ubicacion_archivo"]);
mysqli_free_result($result);
 
//delete from table
$qry2="DELETE FROM demos WHERE id_locutor = '$id' ";
if (mysqli_query($conn, $qry2)) {
	echo "All records delete successfully";
} else {
	echo "Error deleting records from selected locutor: " . mysqli_error($conn);
}

$qry3="SELECT genero FROM locutores WHERE id = " . $id . " LIMIT 1 ";
if ($result3 = mysqli_query($conn, $qry3)) {
    /* fetch associative array */
    if( $row = mysqli_fetch_assoc($result3)) {
       $typeChar =  $row["genero"];
    }
    mysqli_free_result($result3);
}

$page = 'admin/adminProfile.php?id='.$id;
if ($typeChar == 'I') {
	$page = 'admin/adminProfileInfantil.php?id='.$id;
}

header('location: ' . BASE_URL. $page);
mysqli_close($conn);
?>