//almacena la informacion dentro del elemento con la id espacio-login
const botonSesion=document.getElementById("espacio-login");

/*Carga el archivo php que consulta si existe una sesion activa
Si no existe una sesion activa, se muestra el boton iniciar sesion
si existe una sesion, se muestra el boton cerrar sesion*/
fetch('./backend/existeSesionActiva.php',{method:'GET'})
.then(res=>res.json())
.then(mensaje=>{
    if(!mensaje){botonSesion.innerHTML='<a class="itemNav" href="./public/login.html">iniciar sesion</a>';}
     else{botonSesion.innerHTML='<a class="itemNav" href="./public/cerrarSesion.html">cerrar sesion</a>';}
               })