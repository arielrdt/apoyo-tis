//Carga el archivo php que consulta los alumnos de la clase
const recuperarAlumnosClase=()=>{
    fetch('../backend/consultarAlumnosClase.php',{method:'GET'})
    .then(res=>res.json())
    .then(data=>{
        //imprime la seleccion de alumnos dentro del elemento con la id espacio-listado-alumnos
    const seccionAlumnos=document.getElementById('espacio-listado-alumnos');
    seccionAlumnos.innerHTML=data;
      
    })
    } 
    recuperarAlumnosClase();
    
    
    