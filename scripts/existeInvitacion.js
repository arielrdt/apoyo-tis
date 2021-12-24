const divEditarInvitacion=document.getElementById("div-btn-editar-invi");
const formInvi=document.getElementById("div-formulario-invi");
const btnEditarInvitacion=document.getElementById("btn-editar-invi");

btnEditarInvitacion.addEventListener('click',()=>
{ divEditarInvitacion.hidden=true;
    formInvi.hidden=false;
    btnEditarInvitacion.hidden=true;
})


fetch('../backend/consultarSiExisteinvitacio.php',{method:'GET'})
.then(res=>res.json())
.then(mensaje=>{
          if(mensaje!=null){
            console.log("hay datos")
            formInvi.hidden=true;
            divEditarInvitacion.hidden=false;
             btnEditarInvitacion.hidden=false; 
            let titulo=document.getElementById("titulo-invi");
            let fecha=document.getElementById("limite-invi");
            let semestre=document.getElementById("semestre-invi");         
            let descripcion=document.getElementById("desc-invi");

            titulo.value=mensaje.titulo;
            fecha.value=mensaje.fecha;
            semestre.innerHTML=mensaje.semestre;
            descripcion.value=mensaje.descripcion;
            
                     }
         else{ console.log("no hay datos")
             formInvi.hidden=false;
            
        }
})


  


