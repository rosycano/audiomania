function formhash(form, password) {
    // Crea una entrada de elemento nuevo, esta ser� nuestro campo de contrase�a con hash.
    var p = document.createElement("input");
 
    // Agrega el elemento nuevo a nuestro formulario.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Se asegura de que la contrase�a en texto simple no se env�e.
    password.value = "";
 
    // Finalmente env�a el formulario.
    form.submit();
}
 
function regformhash(form, uid, email, password, conf) {
     // Verifica que cada campo tenga un valor.
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert("Deber� brindar toda la informaci�n solicitada. Por favor, intente de nuevo.");
        return false;
    }
 
    // Verifica el nombre de usuario
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("El nombre de usuario deber� contener solo letras, n�meros y guiones bajos. Por favor, int�ntelo de nuevo."); 
        form.username.focus();
        return false; 
    }
 
    // Verifica que la contrase�a tenga la extensi�n correcta (m�n. 6 caracteres)
    // La verificaci�n se duplica a continuaci�n, pero se incluye para que el
    // usuario tenga una gu�a m�s espec�fica.  
    if (password.value.length < 6) {
        alert("La contrase�a deber� tener al menos 6 caracteres. Por favor, int�ntelo de nuevo.");
        form.password.focus();
        return false;
    }
 
    // Por lo menos un n�mero, una letra min�scula y una may�scula
    // Al menos 6 caracteres 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert("La contrase�a deber� contener al menos un n�mero, una letra min�scula y una may�scula. Por favor, int�ntelo de nuevo.");
        return false;
    }
 
    // Verifica que la contrase�a y la confirmaci�n sean iguales. 
    if (password.value != conf.value) {
        alert("La contrase�a y la confirmaci�n no coinciden. Por favor, int�ntelo de nuevo.");
        form.password.focus();
        return false;
    }
 
    // Crea una entrada de elemento nuevo, esta ser� nuestro campo de contrase�a con hash.
    var p = document.createElement("input");
 
    // Agrega el elemento nuevo a nuestro formulario.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Se asegura de que la contrase�a en texto simple no se env�e. 
    password.value = "";
    conf.value = "";
 
    // Finalmente env�a el formulario.
    form.submit();
    return true;
}