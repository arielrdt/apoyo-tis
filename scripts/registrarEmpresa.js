let formulario=document.getElementById('formulario');
// const validarNombre=(nombreEmpresa)=>{
//     let patron = new RegExp("^[a-z||A-Z|][a-zA-Z_.,:;]+$");
//     return !!patron.test(nombreEmpresa);}

// const validarTamanioNombre=(nombreEmpresa)=>{return (nombreEmpresa.length>1 && nombreEmpresa.length<40);}

// const validarSociedad=(sociedad)=>{
//     let patron = new RegExp("^[a-zA-Zñáéíóú ]+$ ?");
//     return !!patron.test(sociedad);}

// const validarTamanioSociedad=(sociedad)=>{return (sociedad.length>1 && sociedad.length<25);}

// const validarDireccion=(direccionEmpresa)=>{
//     let patron = new RegExp("^[a-z||A-Z||0-9][a-zA-Z_.,:;]+$");
//     return !!patron.test(direccionEmpresa);}

// const validarTelefono=(telefonoEmpresa)=>{
//     let patron = new RegExp("^[0-9]+$ ?");
//     return !!patron.test(telefonoEmpresa);}
const subirDatos=()=>{
    let datosFormulario=new FormData(formulario);
    let validoParaSubir=true;
    // espacioMensaje.innerHTML="";

    // if(datosFormulario.get('nombreEmpresa')=='')
    // {validoParaSubir=false;
    // console.log(validoParaSubir);
    // espacioMensaje.innerHTML+='<p class=mensaje-rojo>*Llenar nombre de la empresa</p>';
    // }

    // if(datosFormulario.get('sociedad')=='')
    // {validoParaSubir=false;
    // console.log(validoParaSubir);
    // espacioMensaje.innerHTML+='<p class=mensaje-rojo>*Llenar el tipo de sociedad</p>';
    // }

    // if(!validarNombre(datosFormulario.get('nombreEmpresa')))
    // {validoParaSubir=false; 
    // espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El nombre no puede contener numeros</p>' }    

    // if(!validarTamanioNombre(datosFormulario.get('nombreEmpresa')))
    // {validoParaSubir=false; 
    // espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El nombre no puede tener mas de 20 caracteres</p>' }  

    // if(!validarSociedad(datosFormulario.get('sociedad')))
    // {validoParaSubir=false; 
    // espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El tipo de sociedad no es valido</p>' }    

    // if(!validarTamanioSociedad(datosFormulario.get('sociedad')))
    // {validoParaSubir=false; 
    // espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El tipo de sociedad debe maximo 25 caracteres</p>' }    

    if(validoParaSubir){
    fetch('../backend/RegistrarEmpresa.php',{
            method:'POST',
            body:datosFormulario})
                .then(res=>res.json())
                .then(data=>{
                     if(data){console.log("registro de empresa exitoso");}
                    else{console.log("nombre de empresa repetido, porfavor elija otro");}
 
                })
                         }
 }

    

formulario.addEventListener('submit',(e)=>{subirDatos(); e.preventDefault(); });
    
    
    
    
    
    
    
    