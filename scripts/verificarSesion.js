 //para evitar que un docente ingrese a las opciones del estudiante
 //y que un estudiante ingrese a las opciones del docente
 fetch('../backend/verificarLogeo.php',{method:'GET'})
    .then(res=>res.json())
    .then(mensaje=>{
            //si es un estudiante se redirije a la seccion principal del estudiante
            //si es un docente se redirije a la seccion principal del docente
              if(mensaje=='estudiante'){window.location.href ='./listaConvocatorias.html';}
              else{
               if(mensaje=='Docente'){window.location.href ='./crearClase.html';}
                 }
})
