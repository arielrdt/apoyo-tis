/*Creacion de una empresa por parte del docente

Almecena los datos del formulario crear empresa del docente*/
let formularioCrearEmpresaDocente=document.getElementById('formularioCrearEmpresaDocente');
//Busca el espacio del mensaje y lo almacena en una variable
let espacioMensaje=document.getElementById('mensaje');
//almacena los datos del formulario en un formData para un uso mas facil
//Envia los datos al archivo php para ser registrados en la base de datos
const subirDatosNuevaEmpresa=()=>{
    let datosFormulario=new FormData(formularioCrearEmpresaDocente);
    let validoParaSubir=true;
     
    if(validoParaSubir){
    fetch('../backend/DocenteRegistrarEmpresa.php',{
            method:'POST',
            body:datosFormulario})
                .then(res=>res.json())
                .then(data=>{espacioMensaje.innerHTML=data;})
                         }
 }

    
//agrega el evento al formulario para que se envien los datos del mismo
 formularioCrearEmpresaDocente.addEventListener('submit',(e)=>{subirDatosNuevaEmpresa(); e.preventDefault(); });
    
    
    
    
    
    
    
    