const recuperarApuentes=()=>{
    fetch('../backend/obtenerApuntesEstudiante.php',{method:'GET'})
    .then(res=>res.json())
    .then(data=>{
     const contenedorApuntes=document.getElementById('apuntes');
     contenedorApuntes.innerHTML=data;
    })
    } 
recuperarApuentes();






