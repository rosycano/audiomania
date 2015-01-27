//--> casting
function goSearch(){
	if( !$("select[name*='voice']").val() || ($("select[name*='voice']").val() != 'I' && !$("select[name*='character']").val())) {
		$("#lblMessage").text("Debes seleccionar un caracter para voces femeninas y masculinas.");
		$("#lblMessage").show();
		return false;
	}
	else {
	$("#lblMessage").attr('hidden', 'hidden');
		return true;
	}
}

//-->casting
//Disabled character dropdown when Infantil voice is selected
$(function() {
	$("select[name*='voice']").change(function() {
		// validar opcion Infatil-> deshabilitar caracter
		if ($("select[name*='voice']").val() == 'I')	{
			$('select option:contains("CON UN CARACTER")').prop('selected',true);
			$('#searchButton').focus();
			($("select[name*='character']")).prop('disabled', true);
		} else {
			($("select[name*='character']")).prop('disabled', false);
		}
	});
});

//-->admin
function copyFiles(){
	//verificar si todos los archivos tienen un caracter seleccionado
	$('body').css({'cursor':'progress'})
	var allSelected = 1;
	if( $(".selUpldFile") > 0){
		$(".selUpldFile").each( function(){
			if($(this).val() == null){
				allSelected = 0;
			}
//agregar cada valor en un array y compararlo con la iteracion para ver si ya esta seleecionado anteriormente		
// allSelected = 2
		});	
	}
	// si ya no faltan caracteres x seleccinar
	if (allSelected == 1){
		$(".selectAllMsg").prop('hidden', 'hidden');		
		//Validar que elemento clonar:  files para multiples files+selChar para solitario
		var filesId = "#files" + gSelChar;	
		var $clone = $(filesId).clone();
		$(filesId).after($clone).appendTo('#uploadForm');
		return true;
	} else {
		$(".selectAllMsg").prop('hidden', '');
		return false;
	}	
	//if allselected ==2
	//mensaje: hoy un caracter repetido.
}

//-->admin
function cancelUploads(){
	$("#list").html("");
	$("#formId").prop('hidden','hidden');
}

//-->admin
//gSelChar: variable global para checar cual input:file fue seleccionado y poder clonarlo desp.
var gSelChar = "";

//-->admin: muestra la lista de archivos seleccinados con su selector de caracter
$(function() {
	$("input[name*='filesToUpload']").change(function() {
	
		var vfiles = $(this).get(0).files;
		var selChar = $(this).get(0).id.substr(5);
		gSelChar = selChar;
		if($("#charsList").length > 0){
			var charList = ($("#charsList").val()).split('|');
			var	 opts = "";
			$.each(charList, function(index, value){
				opts += '<option value="' + value.split(',')[0] + '"' 
						+ (value.split(',')[0] == selChar ? " selected " : "" ) 
						+ '>' + value.split(',')[1] + '</option>';
			});
		
			// files is a FileList of File objects. List some properties.
			var output = '<div class="selectAllMsg" hidden style="color:red;">Favor de seleccionar un caracter para todos los archivos a subir.</div>';
			for (var i = 0, f; f = vfiles[i]; i++) {
				output += 
				'<div id="newFileRow'+ i +'" class="divRow" style="width:600px;">' + 	
					'<div class="audioplayer-bar-loaded" id="nameDiv'+i+'" style="overflow:hidden;color:white;width:350px;text-align:left;padding:15px;text-shadow:none;background: rgba(0,0,0,.45);">' + f.name +'  </div>' +
					'<div class="div-search" style="padding:0; width:">' +
					'	<select name="missing_characters"  id="selChar' + i + '"  onchange="updateFileCharArray(\''+ f.name +'\',\'' + i + '\',true)" class="search rounded admin selUpldFile" size=1 >' +
					'		<option selected disabled value="" >SELECCIONA UN CARACTER...</option>' + opts +
					'	</select> </div>' +
					'<div> <input type="button" value="borrar" class="sideBtn" onclick="javascript:deleteUploadRow('+i+');"></div>' +
				'</div>' ;
					
			}
			$('#list').html(output);	
			// validar selChar, si no esta vacio, actualizar el fileArray
			if (selChar != "") {
				// siempre el id va a ser 0, porque viene de algun boton de solo 1 archivo
				updateFileCharArray(vfiles[0].name ,'0', true);
			}
			$("#formId").prop('hidden','');
			//$('#formId').css('display','block');	
		} else {
			gSelChar = "INF";
			updateFileCharArray($("input[name*='filesToUpload']").get(0).files[0].name, 0, true);
			$("input[name*='submit']").trigger('click');
		}
	});
 });
 
//-->admin
function deleteUploadRow(rowId){
	var row2delete= "#newFileRow" + rowId;	
	//mark value from input:file so in the server validate if is still a valid file or was deleted
	updateFileCharArray($("#nameDiv" + rowId).text().trim(),rowId,false);
	$(row2delete).remove();
	//contar los id newFileRow, si 0, oprimir cancelar
	if ($("[id^=newFileRow]").length <= 0){
		cancelUploads();
	}
}
  
//-->admin 
 function updateFileCharArray(name, id, isValid) {
	//update hidden array with file+char
	selId = "#selChar" + id;
	var arr = ($('#filesArray').val() == '' ? [] : $('#filesArray').val().split(','));
	//loop arr y verificar si existe un index con text = '*,id'
	if(isValid) {
		arr[id] = name + '|' + ($(selId).length > 0 ? $(selId).val() : 'INF');
	} else {
		arr[id] = name + '|' + "INV"; //invalido
	}
	$('#filesArray').val(arr.toString());
}
 
 //-->admin
 function confirmDelete(id, path, charType){
  var resp= confirm("Desea borrar el archivo: " + path + " ? ");
  if (resp == true){
		var redirect = function(id, path, charater) {
		    var inpt1 = document.createElement("input");
			inpt1.name ="idPerfil";
			inpt1.value = id;
			var inpt2 = document.createElement("input"); 
			inpt2.name= "path";
			inpt2.value= path;			
			var inpt3 = document.createElement("input"); 
			inpt3.name= "char";
			inpt3.value= charater;			
			var form = document.createElement('form');
			form.method = "post";
			form.action = "../inc/deleteAudio.php";
			form.appendChild(inpt1);
			form.appendChild(inpt2);
			form.appendChild(inpt3);
			form.submit();
		};
		redirect(id, path,charType);
  } else {
		return false;
  }
 }
 
 //-->admin
 function verifyGender(id, generoOriginal){
  //validar para Edit: si cambio de 'f' o 'm' a 'infantil' o vc => borrar los demos;
  //mandar alerta de que serán borrados los demos con el cambio si aplica.
  var generoNew = $("#voiceAdmSelector").val(); 
  if (id != 0 && generoNew != generoOriginal){
	if ((/^(F|M)$/.exec(generoOriginal) && generoNew == 'I' )||  
		(/^(F|M)$/.exec(generoNew) && generoOriginal == 'I') ){
			var resp = confirm("Al cambiar el género de <Femenino o Masculino> a <Infantil> o viceversa se borrarán los audios existentes.\nDesea continuar con el cambio?" );
			if (resp){
				//variable borrar todos los demos del id en pagina de update	
				$("input[name*='deleteAll']").val("true");
				//actualizar perfil
				$("#formUpd").submit();
			  } else {
					$("input[name*='deleteAll']").val("");
					return false;
			  }
		} 
	} else {
		$("#formUpd").submit();
	}
}  
 
//-->admin
function regresarPerfil(id, gender) {
	var inpt1 = document.createElement("input");
	inpt1.name ="id";
	inpt1.value = id;
	var formReturn = document.createElement('form');
	formReturn.method = "get";
	if (gender == 'I'){
		formReturn.action = "adminProfileInfantil.php?id=" + id;
	} else {
		formReturn.action = "adminProfile.php?id=" + id;
	}
	formReturn.appendChild(inpt1);
	formReturn.submit();
}
 
//-->admin
function verifyDeleteProfile(id, nombre){
resp =  confirm("Desea eliminar el perfil de " + nombre);
 if(resp == true) { 
	alert("aceptó");
	return true;
 }  else {
	alert("canceló");
	return false;
 }

}
 
/* 
Functions to fill the demos info depending on the selected Locutor
Start->
*/
/*
var container;
// handles the click event for link 1, sends the query
function getOutput(url,divName) {
  container = document.getElementById(divName);
  container.innerHTML = "";
  getRequest(url);
  return false;
}  
// handles drawing an error message
function drawError(error) {
    //var container = document.getElementById(divName);
    container.innerHTML = error + '\n There was an error\n!';
}
// handles the response, adds the html
function drawOutput(responseText) {
    //var container = document.getElementById(divName);
    container.innerHTML = responseText;
}
// helper function for cross-browser request object
function getRequest(url) {
    var req = false;
	//valid url
	var parameters = url.substr(url.indexOf('?'),url.length-1).trim();
	var url = url.substr(0, url.indexOf('?')) + parameters.replace(' ', '%20');
    try{
        // most browsers
        req = new XMLHttpRequest();
    } catch (e){
        // IE
        try{
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            // try an older version
            try{
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
                return false;
            }
        }
    }
    if (!req) return false;
	
    //if (typeof success != 'function') success = function () {};
    //if (typeof error!= 'function') error = function () {};
    req.onreadystatechange = function(){
        if(req.readyState == 4){
            return req.status === 200 ? drawOutput(req.responseText) : drawError(req.status);
        }
    }
    req.open("GET", url, true);
    req.send(null);
    return req;
}
*/
//Functions for filter list by name
$(function() {
  $('#talentoRow').filterByText($('#filtro_nombre'), $('#voiceAdmSelector'));
}); 

jQuery.fn.filterByText = function(textbox, filter) {
  return this.each(function() {
    var options = [];
    
	$(filter).bind('change',  function() {
		var options = $(".divNombre");
		var search = $.trim($(textbox).val());
		var regex = new RegExp(search,'mgi');

		$.each(options, function(i) {
			var option = options[i];
			genero = option.firstElementChild.innerText;
			if( (option.innerText.trim().match(regex) !== null) && (genero == '' || genero == filter.val())) {
			  $(option.parentElement).css('display','flex');             
			} else {
			  $(option.parentElement).css('display','none');
			}
		});
	  });
	
    $(textbox).bind('change keyup', function() {
      var options = $(".divNombre");
      var search = $.trim($(textbox).val());
      var regex = new RegExp(search,'mgi');

      $.each(options, function(i) {
        var option = options[i];
		genero = option.firstElementChild.innerText;
        if( (option.innerText.trim().match(regex) !== null) && (filter.val() == null || genero == filter.val())) {
          $(option.parentElement).css('display','flex');             
        } else {
		  $(option.parentElement).css('display','none');
		 }
      });
    });
  });
};