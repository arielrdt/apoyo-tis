const divEditarInvitacion=document.getElementById("div-btn-editar-plie");
const formInvi=document.getElementById("div-formulario-plie");
const btnEditarInvitacion=document.getElementById("btn-editar-plie");

btnEditarInvitacion.addEventListener('click',()=>
{ divEditarInvitacion.hidden=true;
    formInvi.hidden=false;
    btnEditarInvitacion.hidden=true;
})



fetch('../backend/consultarSiExistePliego.php',{method:'GET'})
.then(res=>res.json())
.then(mensaje=>{
          if(mensaje!=null){
            console.log("hay datos")
            formInvi.hidden=true;
            divEditarInvitacion.hidden=false;
             btnEditarInvitacion.hidden=false; 
            let titulo=document.getElementById("titulo-plie");
            let semestre=document.getElementById("semestre-plie");         
            let descripcion=document.getElementById("desc-plie");

            titulo.value=mensaje.titulo;
            semestre.innerHTML=mensaje.semestre;
            descripcion.value=mensaje.descripcion;
            
                     }
         else{ console.log("no hay datos")
             formInvi.hidden=false;
            
        }
})

