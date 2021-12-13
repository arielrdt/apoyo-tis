 fetch('../backend/verificarLogeo.php',{method:'GET'})
    .then(res=>res.json())
    .then(mensaje=>{
              if(mensaje=='estudiante'){window.location.href ='./listaConvocatorias.html';}
              else{
               if(mensaje=='none'){window.location.href ='./paginaPrincipal.html';}
                 }
})
