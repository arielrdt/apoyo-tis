//funcion para realizar la peticion de la variable string con el rol del usuario que inicio sesion

fetch('../backend/verificarLogeo.php',{method:'GET'})
    .then(res=>res.json())
    .then(mensaje=>{
      //si es un estudiante se redirije a la seccion principal del estudiante
      //sino a la pagina principal
              if(mensaje=='estudiante'){window.location.href ='./listaConvocatorias.html';}
              else{
               if(mensaje=='none'){window.location.href ='./paginaPrincipal.html';}
                 }
})
