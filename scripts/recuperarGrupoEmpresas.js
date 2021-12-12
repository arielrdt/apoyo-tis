const recuperarGrupoEmpresas=()=>{
    fetch('../backend/consultarGrupoEmpresas.php',{method:'GET'})
    .then(res=>res.json())
    .then(data=>{
        const contenedor_tarjetas=document.getElementById('main-section');
        contenedor_tarjetas.innerHTML=data;
    })
} 

recuperarGrupoEmpresas();