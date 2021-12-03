let formularioCrearEmpresaDocente=document.getElementById('formularioCrearEmpresaDocente');
let espacioMensaje=document.getElementById('mensaje');
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

    

 formularioCrearEmpresaDocente.addEventListener('submit',(e)=>{subirDatosNuevaEmpresa(); e.preventDefault(); });
    
    
    
    
    
    
    
    