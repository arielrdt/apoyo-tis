/*verifica si existe un pliego de especificaciones ya publicado del semestre actual
carga los datos del formulario */
const divEditarInvitacion=document.getElementById("div-btn-editar-plie");
const formInvi=document.getElementById("div-formulario-plie");
const btnEditarInvitacion=document.getElementById("btn-editar-plie");
//activa las funciones de edicion del formulario
btnEditarInvitacion.addEventListener('click',()=>
{ divEditarInvitacion.hidden=true;
    formInvi.hidden=false;
    btnEditarInvitacion.hidden=true;
})


/*consulta si ya existe un pliego
si existe un pliego, almacena todos los datos del pliego actual
y los carga en el formulario para su edicion*/
fetch('../backend/consultarSiExistePliego.php',{method:'GET'})
.then(res=>res.json())
.then(mensaje=>{
          if(mensaje!=null){
            console.log("hay datos")
            formInvi.hidden=true;
            divEditarInvitacion.hidden=false;
             btnEditarInvitacion.hidden=false; 

            //obtiene los campos donde se cargaran los datos del pliego
            let titulo=document.getElementById("titulo-plie");
            let semestre=document.getElementById("semestre-plie");         
            let descripcion=document.getElementById("desc-plie");
            //envia los datos del pliego a los campos del formulario
            titulo.value=mensaje.titulo;
            semestre.innerHTML=mensaje.semestre;
            descripcion.value=mensaje.descripcion;
            
                     }
         else{ console.log("no hay datos")
             formInvi.hidden=false;
            
        }
})

