//funcion para realizar la peticion de la variable string con el rol del usuario que inicio sesion
fetch('../backend/verificarLogeo.php',{method:'GET'})
.then(res=>res.json())
.then(mensaje=>{
      //si es un docente se redirije a la seccion principal del docente
      //sino a la pagina principal
    if(mensaje=='Docente'){window.location.href ='./crearClase.html';}
          else{
            if(mensaje=='none'){window.location.href ='./paginaPrincipal.html';}
              }
})
