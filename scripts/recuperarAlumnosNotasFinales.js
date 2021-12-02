
const recuperarAlumnosClase=()=>{
    fetch('../backend/consultarAlumnosClase.php',{method:'GET'})
    .then(res=>res.json())
    .then(data=>{
    const seccionAlumnos=document.getElementById('espacio-listado-alumnos');
    seccionAlumnos.innerHTML=data;
      
    })
    } 
    recuperarAlumnosClase();
    
    
    