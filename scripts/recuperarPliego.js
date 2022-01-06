//funcion para realizar la peticion de la variable string con el codigo html del pliego actual
const recuperarPliego=()=>{
    //se referencia al archivo con la funcion de recuperar los datos del pliego actual
    fetch('../backend/consultarPliego.php',{method:'GET'})
    //se espera la promesa
    .then(res=>res.json())
    //se captura y se insertan los datos 
    .then(data=>{
    //@param contenedor_tarjetas=div del documento para agregar los datos del pliego actual
    const contenedor_tarjetas=document.getElementById('contenedor-tarjetas');
    contenedor_tarjetas.innerHTML=data;
    })
    } 
    recuperarPliego();