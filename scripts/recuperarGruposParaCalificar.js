//funcion para realizar la peticion de la variable string con el codigo html de la tabla de grupos
const recuperarGruposClaseParaCalificar=()=>{
    //se referencia al archivo con la funcion de recuperar los grupos
    fetch('../backend/consultarGruposClaseParaCalificar.php',{method:'GET'})
    //se espera la promesa
    .then(res=>res.json())
    //se captura y se insertan los datos 
    .then(data=>{
    //@param seccionGrupos=div del documento para agregar los grupos
    const seccionGrupos=document.getElementById('espacio-listado-semanal');
    seccionGrupos.innerHTML=data;    
})
    } 
recuperarGruposClaseParaCalificar();

