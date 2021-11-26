let formularioCrearEmpresaDocente=document.getElementById('formularioCrearEmpresaDocente');

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
    
    
    
    
    
    
    
    