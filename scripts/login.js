/*recupera los campos del formulario del login */
var formulario = document.getElementById('form');
var respuestaCorreo = document.getElementById('respuesta-correo');
var respuestaPassword = document.getElementById('respuesta-password');
//envia los datos ingresados en el formulario para confirmar su existencia
formulario.addEventListener('submit', function(e) {
    e.preventDefault();
    var datos = new FormData(formulario);
    fetch('../backend/iniciarSesion.php', {
        method: 'POST',
        body: datos
    })
        .then( res => res.json())
        .then( data => {
            console.log(data);
//si no se encontro el correo se alerta al usuario
            if (data === 'correo no registrado en el sistema') {
                respuestaCorreo.innerHTML = `
                <div class="respuesta-correo">
                    <p>Correo no registrado en el sistema</p>
                </div>
                `
            }
//en caso de que el correo exista pero la contrase;a sea incorrecta
            if (data === 'contrasena de estudiante incorrecta') {
                respuestaPassword.innerHTML = `
                <div class="respuesta-password">
                    <p>Contraseña de estudiante incorrecta</p>
                </div>
                `
            }

            if (data === 'contrasena de docente incorrecta') {
                respuestaPassword.innerHTML = `
                <div class="respuesta-password">
                    <p>Contraseña de docente incorrecta</p>
                </div>
                `
            }
            //si todo esta correcto se redirecciona a sus paginas correspondientes
            if(data === 'contrasena de estudiante correcta'){
              window.location.href = './listaConvocatorias.html';}
              
            if(data === 'contrasena de docente correcta'){
                window.location.href ='./crearClase.html';}



        })
});