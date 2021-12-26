let formularioModal=document.getElementById('formulario-cambiar-limite-miembros');
let datosFormularioModal=new FormData(formularioModal);
const ventanaModal=document.getElementById("modal-rol-cant");
const campoNombreGrupo=document.getElementById("nombreGrupo");
const mensaje=document.getElementById("mensaje-cambio");

const abrirModal=()=>{ventanaModal.hidden=false;}

const cerrarModal=()=>{
campoNombreGrupo.value="";
ventanaModal.hidden=true;
}

const editarDatos=(nombreGrupo)=>{
campoNombreGrupo.value=nombreGrupo;
abrirModal();
}

const agregarFuncionBotones=()=>{
const botonCancelar=document.getElementById('boton-cancelar-cant');
botonCancelar.addEventListener("click",()=>{cerrarModal();});
formularioModal.addEventListener("submit",(e)=>{
e.preventDefault();
actualizarCantidad();
});

}

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