
const recuperarGruposClase=()=>{
    fetch('../backend/consultarGruposClase.php',{method:'GET'})
    .then(res=>res.json())
    .then(data=>{
    const seccionGrupos=document.getElementById('espacio-botones-seleccion-grupo');
    seccionGrupos.innerHTML=data;
   //  asignarFuncionesModal();
})
    } 
    recuperarGruposClase();
    
    
    