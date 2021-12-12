 fetch('../backend/verificarLogeo.php',{method:'GET'})
    .then(res=>res.json())
    .then(mensaje=>{
              if(mensaje=='estudiante'){window.location.href ='./listaConvocatorias.html';}
              else{
               if(mensaje=='Docente'){window.location.href ='./crearClase.html';}
                 }
})
