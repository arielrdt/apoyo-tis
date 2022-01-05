//funcion para realizar la peticion de la variable string con el codigo html los datos de perfil
const recuperarDatos=()=>{
//se referencia al archivo con la funcion de recuperar los datos de perfil
    fetch('../backend/consultaPerfil.php',{method:'GET'})
    //se espera la promesa 
    .then(res=>res.json())
    //se captura y se insertan los datos 
    .then(data=>{
    //@param seccionDatosPerfil=div del documento para agregar los datos del perfil
    const seccionDatosPerfil=document.getElementById('datos-perfil');
    seccionDatosPerfil.innerHTML=data;
    })
    } 
    recuperarDatos();
    
    
    