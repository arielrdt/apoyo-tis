const botonSesion=document.getElementById("espacio-login");

fetch('./backend/existeSesionActiva.php',{method:'GET'})
.then(res=>res.json())
.then(mensaje=>{
    if(!mensaje){botonSesion.innerHTML='<a class="itemNav" href="./public/login.html">iniciar sesion</a>';}
     else{botonSesion.innerHTML='<a class="itemNav" href="./public/cerrarSesion.html">cerrar sesion</a>';}
               })