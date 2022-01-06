//funcion para realizar la peticion de la variable string con el codigo html de 
//los datos del miembro del grupo
const recuperarIntegranteGrupo=()=>{
    //se referencia al archivo con la funcion de recuperar los datos del miembro
    fetch('../backend/consultarIntegranteGrupo.php',{method:'GET'})
   //se espera la promesa
    .then(res=>res.json())
//se captura y se insertan los datos 
    .then(data=>{
        //@param contenedor_tarjetas=div del documento para agregar los datos del miembro
        const contenedor_tarjetas=document.getElementById('main-section-list');
        contenedor_tarjetas.innerHTML=data;
    })
} 

recuperarIntegranteGrupo();