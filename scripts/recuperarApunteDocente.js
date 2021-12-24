const recuperarApuentes=()=>{
    fetch('../backend/docenteObtieneApuntes.php',{method:'GET'})
    .then(res=>res.json())
    .then(data=>{
     const contenedorApuntes=document.getElementById('apuntesGrupos');
     contenedorApuntes.innerHTML=data;
    })
    } 
recuperarApuentes();






