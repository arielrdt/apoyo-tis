//Registro de una empresa 

//Selecciona y almacena los datos del formulario formularioCrearEmpresaDocente
let formularioCrearEmpresaDocente=document.getElementById('formularioCrearEmpresaDocente');
/*convierte los datos del fomulario en un formData para mejor uso y los envia al archivo 
php para que sean almacenados en la base de datos
en caso de que existiera un error, el mensaje se mostrara en la consola*/
const subirDatosNuevaEmpresa=()=>{
    let datosFormulario=new FormData(formularioCrearEmpresaDocente);
    let validoParaSubir=true;
     
    if(validoParaSubir){
    fetch('../backend/EstudianteRegistrarEmpresa.php',{
            method:'POST',
            body:datosFormulario})
                .then(res=>res.json())
                .then(data=>{
                     if(data){console.log("registro de empresa exitoso");}
                    else{console.log("nombre de empresa repetido, porfavor elija otro");}
 
                })
                         }
 }

    

 formularioCrearEmpresaDocente.addEventListener('submit',(e)=>{subirDatosNuevaEmpresa(); e.preventDefault(); });
    
    
    
    
    
    
    
    