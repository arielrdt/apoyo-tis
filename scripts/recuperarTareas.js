const recuperarTareas=()=>{
    fetch('../backend/consultarTareas.php',{method:'GET'})
    .then(res=>res.json())
    .then(data=>{
    const contenedorTareas=document.getElementById('cards-container');
    contenedorTareas.innerHTML=data;
    })
    } 

recuperarTareas();