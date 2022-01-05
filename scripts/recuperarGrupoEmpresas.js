//funcion para realizar la peticion de la variable string con el codigo html de la tabla de grupos
  const recuperarGrupoEmpresas=()=>{
    //se referencia al archivo con la funcion de recuperar los grupos
    fetch('../backend/consultarGrupoEmpresas.php',{method:'GET'})
    //se espera la promesa 
    .then(res=>res.json())
    //se captura y se insertan los datos 
    .then(data=>{
        //@param contenedor_tarjetas=div del documento para agregar los grupos
        const contenedor_tarjetas=document.getElementById('main-section');
        contenedor_tarjetas.innerHTML=data;
    })
} 

recuperarGrupoEmpresas();