<?php
require("config.php");
$conn=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$id = mysqli_real_escape_string($conn, $_POST['idPerfil']);
$filesArray = explode(',', $_POST['filesArray']);
//$target_dir = "../audios/";
$typeChar = ""; 

if(isset($_FILES['filesToUpload'])){
	foreach($_FILES['filesToUpload']['tmp_name'] as $key => $tmp_name) {
	
		$file_name = $_FILES['filesToUpload']['name'][$key];
		$file_size =$_FILES['filesToUpload']['size'][$key];
		$file_tmp =$_FILES['filesToUpload']['tmp_name'][$key];
		$file_type=$_FILES['filesToUpload']['type'][$key];  
		$typeChar = ""; 
		
		foreach($filesArray as $child) {		
			if (substr($child,0,strpos($child, '|')) == $file_name ){
				$typeChar = substr($child,strpos($child, '|')+1,3);
				break;
			}
		}
		//validate if file was cancel to upload. Have to do this validation bc input:file can't be manipulated
		if ($typeChar != "" && $typeChar !='INV'){
		
			$target_file = HOME.URL_AUDIOS . basename($file_name);
			$uploadOk = 1;
			$audioFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					
			// Check if audio file is a actual audio or fake audio
			if(isset($_POST["submit"])) {
				$check = filesize($file_tmp);
				echo "File size: " . $check . '<br>';
				if($check != false) {
					echo "File is an audio - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an audio.";
					$uploadOk = 0;
				}
			}
			//Check if file already exists
			echo "File exists: " . $target_file . '<br>';
			if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			echo "File type: " . $audioFileType . '<br>';
			if($audioFileType != "mp3" && $audioFileType != "ogg" ) {
				echo "Sorry, only mp3 or ogg";
				$uploadOk = 0;
			}
			// Check file size
			echo "File size to large (>15728640) : " . $file_size . '<br>';
			if ($file_size > 15728640) { //15Mb
				echo "Sorry, your file is too large." . $file_size;
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "<br> Sorry, your file was not uploaded. <br> ";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($file_tmp,'../'.URL_AUDIOS.$file_name)) {
					$sql="INSERT INTO demos (id_locutor, codigo, ubicacion_archivo) VALUES ('$id', '$typeChar', '$file_name')";
					if (mysqli_query($conn, $sql)) {
						echo "Record updated/inserted successfully <br>";
					} else {
						echo "Error updating/inserging record: " . mysqli_error($conn);
					}		
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}			
		}// != INV	
	}
} else {
	echo 'Error al localizar los archivos seleccionados';
}	

if($typeChar == 'INF') {
	$page = "admin/adminProfileInfantil.php?id="  . $id;
} else {
	$page = "admin/adminProfile.php?id=" . $id;
}
//echo '<br> typeChar: ' . $typeChar;
//echo '<br> page: ' . $page;
header('location: ' . BASE_URL. $page);
mysqli_close($conn);


?>