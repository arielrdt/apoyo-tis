const recuperarIntegranteGrupo=()=>{
    fetch('../backend/consultarIntegranteGrupo.php',{method:'GET'})
    .then(res=>res.json())
    .then(data=>{
        const contenedor_tarjetas=document.getElementById('main-section-list');
        contenedor_tarjetas.innerHTML=data;
    })
} 

recuperarIntegranteGrupo();