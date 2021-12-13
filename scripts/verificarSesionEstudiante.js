fetch('../backend/verificarLogeo.php',{method:'GET'})
.then(res=>res.json())
.then(mensaje=>{
    if(mensaje=='Docente'){window.location.href ='./crearClase.html';}
          else{
            if(mensaje=='none'){window.location.href ='./paginaPrincipal.html';}
              }
})
