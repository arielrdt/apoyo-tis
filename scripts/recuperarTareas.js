//funcion para realizar la peticion de la variable string con el codigo html de las tareas de la clase
const recuperarTareas=()=>{
    //se referencia al archivo con la funcion de recuperar las tareas de la clase
    fetch('../backend/consultarTareas.php',{method:'GET'})
    //se espera la promesa
    .then(res=>res.json())
    //se captura y se insertan los datos 
    .then(data=>{
    //@param contenedorTareas=div del documento para agregar las tareas de la clase
    const contenedorTareas=document.getElementById('cards-container');
    contenedorTareas.innerHTML=data;
    })
    } 

recuperarTareas();