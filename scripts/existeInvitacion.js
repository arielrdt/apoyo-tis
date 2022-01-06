//Verifica si ya existe una invitacion publica ya almacenada del semestre actual
//Almecena los datos del formulario en distintas variables
const divEditarInvitacion=document.getElementById("div-btn-editar-invi");
const formInvi=document.getElementById("div-formulario-invi");
const btnEditarInvitacion=document.getElementById("btn-editar-invi");
//muestra un boton para editar la invitacion si ya existiera una
btnEditarInvitacion.addEventListener('click',()=>
{ divEditarInvitacion.hidden=true;
    formInvi.hidden=false;
    btnEditarInvitacion.hidden=true;
})

/*consulta si ya existe una invitacion
si existe una invitacion, almacena todos los datos de la invitacion actual
las carga en el formulario para su edicion*/
fetch('../backend/consultarSiExisteinvitacio.php',{method:'GET'})
.then(res=>res.json())
.then(mensaje=>{
          if(mensaje!=null){
            console.log("hay datos")
            formInvi.hidden=true;
            divEditarInvitacion.hidden=false;
             btnEditarInvitacion.hidden=false; 
             //obtiene los campos donde se cargaran los datos de la invitacion
            let titulo=document.getElementById("titulo-invi");
            let fecha=document.getElementById("limite-invi");
            let semestre=document.getElementById("semestre-invi");         
            let descripcion=document.getElementById("desc-invi");
            //envia los datos de la invitacion actual
            titulo.value=mensaje.titulo;
            fecha.value=mensaje.fecha;
            semestre.innerHTML=mensaje.semestre;
            descripcion.value=mensaje.descripcion;
            
                     }
         else{ console.log("no hay datos")
             formInvi.hidden=false;
            
        }
})


  


