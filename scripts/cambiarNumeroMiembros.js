//recupera los elementos del formulario con la id formulario-modal
//las almacena en un formData para mejor uso
let formularioModal=document.getElementById('formulario-cambiar-limite-miembros');
let datosFormularioModal=new FormData(formularioModal);
//Separa los datos del formulario en distinas variables
const ventanaModal=document.getElementById("modal-rol-cant");
const campoNombreGrupo=document.getElementById("nombreGrupo");
const mensaje=document.getElementById("mensaje-cambio");

//hace que el modal sea visible
const abrirModal=()=>{ventanaModal.hidden=false;}
//cierra el modal y reinicia sus campos para cuando se vuelva a abrir
const cerrarModal=()=>{
campoNombreGrupo.value="";
ventanaModal.hidden=true;
}
//envia los datos que se mostraran en el modal
const editarDatos=(nombreGrupo)=>{
campoNombreGrupo.value=nombreGrupo;
abrirModal();
}

//controla / agrega las funciones del modal
const agregarFuncionBotones=()=>{
const botonCancelar=document.getElementById('boton-cancelar-cant');
botonCancelar.addEventListener("click",()=>{cerrarModal();});
formularioModal.addEventListener("submit",(e)=>{
e.preventDefault();
actualizarCantidad();
});

}
/*envia los datos al formulario y controla que no se pueda reducir el numero de 
integrantes del grupo no se pueda reducir a una cantidad mas peque;a del 
numero de estudiantes ya inscritos. Si ya tiene 3 integrantes la cantidad no 
se puede reducir a 2*/
const actualizarCantidad=()=>{
formularioModal=document.getElementById('formulario-cambiar-limite-miembros');
datosFormularioModal=new FormData(formularioModal);
fetch('../backend/cambiarLimiteMiembrosGrupo.php',{
    method:'POST',
    body:datosFormularioModal})
    .then(res=>res.json())
    .then(data=>{
        if(data!=null){window.location.reload();}
        else{
            mensaje.innerHTML="la nueva cantidad debe ser mayor al numero de miembros";

        }
    
    })
}



agregarFuncionBotones();