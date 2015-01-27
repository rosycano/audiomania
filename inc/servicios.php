<?php

/*****************************************************OK*/
function get_caracteres(){
	// connect to database
	require(ROOT_PATH . "inc/database.php");
	
	// Set query
	try{
		$results = $db->query("
				SELECT DISTINCT id, codigo, caracter
				FROM caracteres  
				ORDER BY caracter ASC "
			);
	} catch(Exception $e){
		echo "Error al intentar mostrar los caracteres.";
	}
	
	// Fetch and return results
	$caracteres = $results->fetchAll(PDO::FETCH_ASSOC);		
	return $caracteres;

}

/*****************************************************OK
 Retrive all the demos for the given criteria
************************************************************/
function get_demos($gender, $character){
	// connect to database
	require(ROOT_PATH . "inc/database.php");
	
	$cond = "";
	$inner = "";	
	if ($gender != 'I') {
		$cond = " AND demos.codigo = '". $character . "'" ;
		$inner =" INNER JOIN caracteres on caracteres.codigo = demos.codigo "; 
	}	
	// Set query	
	try{
		$qry = "SELECT 	locutores.id, 
				locutores.nombre, 
				locutores.genero, 
				demos.ubicacion_archivo
		FROM demos
		INNER JOIN locutores on locutores.id = demos.id_locutor"
		. $inner .		
		" WHERE locutores.genero = '" . $gender ."' "
		. $cond .
		" ORDER BY locutores.nombre ASC ";
		
		$results = $db->query($qry);
	} catch(Exception $e){
			echo "Error al intentar mostrar los demos.\n" .$e .'<br>' . mysqli_error($db);
		exit;
	}
	$demos = $results->fetchAll(PDO::FETCH_ASSOC);	
	if (count($demos) <= 0 ) {
		echo "<br><div style='font-size:20px;'> No hubo resultados con los parametros seleccionados.</div><br>";
	}
	return $demos;
}

/****************************************************OK*/
function get_perfil($id){
	// connect to database
	require(ROOT_PATH . "inc/database.php");
	
	// Set query
	try{
		$results = $db->query("
		SELECT 	id, nombre, genero, bio
		FROM locutores 
 		WHERE id = '$id' "
		);
	} catch(Exception $e){
		echo "Error al intentar mostar el perfil seleccionado. ";
	}
	
	$perfil = $results->fetchALL(PDO::FETCH_ASSOC);
//var_dump($perfil);	
	return $perfil;
}

function get_demos_locutor($id){
	// connect to database
	require(ROOT_PATH . "inc/database.php");
	
	// Set query	
	try{
		$qry = "SELECT 	  
				caracteres.caracter, 
				demos.ubicacion_archivo
		FROM demos
		INNER JOIN caracteres on caracteres.codigo = demos.codigo
		WHERE 	demos.id_locutor = ". $id .
		" ORDER BY caracteres.caracter ASC ";
		
		$results = $db->query($qry);
	} catch(Exception $e){
		echo "Error al intentar mostar los demos del talento seleccionado.";
		exit;
	}
	
	$demos = $results->fetchAll(PDO::FETCH_ASSOC);		
	return $demos;
}

function get_demos_admin($id){
	// connect to database
	require(ROOT_PATH . "inc/database.php");
	
	// Set query	
	try{
		$qry = "SELECT 1, c.codigo, c.caracter, d.ubicacion_archivo 
			FROM caracteres c LEFT JOIN demos d ON c.codigo = d.codigo
			WHERE  id_locutor = ". $id . "
			UNION
			SELECT 2 , codigo, caracter, null
			FROM caracteres 
			WHERE codigo NOT IN (
				SELECT DISTINCT c.codigo 
				FROM caracteres c LEFT JOIN demos d ON c.codigo = d.codigo
				WHERE  id_locutor = ". $id . "
				)
			ORDER BY 1, 3 ASC ";
		
		$results = $db->query($qry);
	} catch(Exception $e){
		echo "Error al intentar mostar los demos del talento seleccionado.";
		exit;
	}
	
	$demos = $results->fetchAll(PDO::FETCH_ASSOC);		
	return $demos;
}

//-->admin, casting
function get_demo_infantil($id){
	// connect to database
	require(ROOT_PATH . "inc/database.php");
	
	// Set query	
	try{
	// on table demos there should be only one row for each locutor-Infantil
		$qry = "SELECT 1, 'Infantil' as caracter, 'INF' as codigo, 
			(select ubicacion_archivo from demos where id_locutor = ". $id .") as ubicacion_archivo 
			FROM locutores l WHERE id = ". $id ;
		
		$results = $db->query($qry);
	} catch(Exception $e){
		echo "Error al intentar mostar los demos del talento seleccionado.";
		exit;
	}
	
	$demos = $results->fetchAll(PDO::FETCH_ASSOC);
	return $demos;
}


/***********************************************************
 Retirve all the distinct Locutors givien the criteria
************************************************************/

function get_locutores($gender, $name){
	// connect to database
	require(ROOT_PATH . "inc/database.php");

	$conditions = " 1 ";
	if ($gender != ''){
		$conditions = "genero = '" . $gender ."'";
		if ($name != ''){
			$conditions = "AND nombre like CONCAT('%', '". $name ."', '%')";
		}
	} elseif ($name != ''){
			$conditions = " nombre like CONCAT('%', '". $name ."', '%')";
	}
	
	// Set query
	try{
		$results = $db->query("
		SELECT 	locutores.id, locutores.nombre, locutores.genero
		FROM locutores WHERE ". $conditions ." 		
		ORDER BY locutores.nombre ASC"
		);
	} catch(Exception $e){
		echo "Error al intentar mostrar los Locutores";
	}
	
	$locutores = $results->fetchAll(PDO::FETCH_ASSOC);		
	return $locutores;
}

function get_missing_demos($id){
// connect to database
	require(ROOT_PATH . "inc/database.php");
	
	// Set query	
	try{
		$qry = "SELECT codigo, caracter, null as ubicacion_archivo
			FROM caracteres 
			WHERE codigo NOT IN (
				SELECT DISTINCT c.codigo 
				FROM caracteres c LEFT JOIN demos d ON c.codigo = d.codigo
				WHERE  id_locutor = ". $id . "
			)
			ORDER BY  2 ASC ";
		
		$results = $db->query($qry);
	} catch(Exception $e){
		echo "Error al intentar mostar los demos faltantes del talento seleccionado.";
		exit;
	}
	
	$demos = $results->fetchAll(PDO::FETCH_ASSOC);		
	return $demos;
}

//TODO: verificar si se usa este o la pagina de insert_locutor
function save_locutor($name, $gender){
	// Validate if locutor isn't alredy on table
	$locutor = get_locutor($name, $gender);
	//var_dump($locutor);
	
	if($locutor == false) {
		// connect to database
		require(ROOT_PATH . "inc/database.php");
		
		// Set query
		try{
			$results = $db->query("
			INSERT INTO	locutores (nombre, genero)
			VALUES ('". $name."', '". $gender. "')");
		} catch(Exception $e){
			echo "Data could not be retrieved from LOCUTORES.";
		}
		
		$locutores = $results->fetchAll(PDO::FETCH_ASSOC);		
		return $locutores;
	} else {
		echo $name. " ya estaba en la lista.";
		return $locutor;
	}
}

function get_current_url($strip = true) {
    // filter function
    $filter = function($input, $strip) {
        $input = urldecode($input);
        $input = str_ireplace(array("\0", '%00', "\x0a", '%0a', "\x1a", '%1a'), '', $input);
        if ($strip) {
            $input = strip_tags($input);
        }
        $input = htmlentities($input, ENT_QUOTES, 'UTF-8'); // or whatever encoding you use...
        return trim($input);
    };

    $url = array();
    // set protocol
    $url['protocol'] = 'http://';
    if (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) === 'on' || $_SERVER['HTTPS'] == 1)) {
        $url['protocol'] = 'https://';
    } elseif (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) {
        $url['protocol'] = 'https://';
    }
    // set host
    $url['host'] = $_SERVER['HTTP_HOST'];
    // set request uri in a secure way
    $url['request_uri'] = $filter($_SERVER['REQUEST_URI'], $strip);
    return join('', $url);
}
