//funcion para realizar la peticion de la variable string con el codigo html de los apuntes
const recuperarApuentes=()=>{
    //se referencia al archivo con la funcion de recuperar apuntes
    fetch('../backend/obtenerApuntesEstudiante.php',{method:'GET'})
    //se espera la promesa
    .then(res=>res.json())
    //se captura y se insertan los datos
    .then(data=>{
    //@param contenedorApuntes=div del documento para agregar los apuntes
     const contenedorApuntes=document.getElementById('apuntes');
     contenedorApuntes.innerHTML=data;
    })
    } 
recuperarApuentes();






