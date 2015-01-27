<?php

require("config.php");

$conn=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$id = mysqli_real_escape_string($conn, $_POST['idPerfil']);
$name = mysqli_real_escape_string($conn, $_POST['nombre']);
$gender = mysqli_real_escape_string($conn, $_POST['genero']);
$bio = mysqli_real_escape_string($conn, $_POST['bio']);
$delAll = mysqli_real_escape_string($conn, $_POST['deleteAll']);

$bio = htmlentities($bio);

if ($id == '0') {
	$sql=" INSERT INTO locutores (nombre, genero, bio) VALUES ('$name', '$gender', '$bio')";
	if (mysqli_query($conn, $sql)) {
		echo "Record inserted successfully";
		$id = mysqli_insert_id($conn);
	} else {
		echo "Error inserging record: " . mysqli_error($conn);
	}
} else {
	$sql=" UPDATE locutores  SET nombre = '$name' , genero = '$gender' , bio = '$bio' WHERE id = '$id' ";
	if (mysqli_query($conn, $sql)) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}
}
if ($delAll == 'true')
	{$page= "inc/deleteAllAudios.php?idPerfil=".$id;}
//validar que el id no sea 0, si no mandar a home(hubo algun error)
elseif ($id == 0)
	{$page= "admin/admin-home.php";}
elseif ($gender != 'I')
	{$page= 'admin/adminProfile.php?id='.$id;}
else 
	{$page= 'admin/adminProfileInfantil.php?id='.$id;}

header('location: ' . BASE_URL. $page);
mysqli_close($conn);


?>