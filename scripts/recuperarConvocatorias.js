//funcion para realizar la peticion de la variable string con el codigo html de las inivitaciones y pliego
const recuperarConvocatorias=()=>{
    //se referencia al archivo con la funcion de recuperar las inivitaciones y pliegos
    fetch('../backend/consultarConvocatorias.php',{method:'GET'})
   //se espera la promesa
    .then(res=>res.json())
    //se captura y se insertan los datos 
    .then(data=>{
    //@param contenedor_tarjetas=div del documento para agregar las tarjetas de pliego e invitaciones  
    const contenedor_tarjetas=document.getElementById('contenedor-tarjetas');
    contenedor_tarjetas.innerHTML=data;
    })
    } 
    recuperarConvocatorias();
    
    
    