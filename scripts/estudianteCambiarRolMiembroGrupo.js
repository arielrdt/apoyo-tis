let formularioModalRol=document.getElementById('formulario-modal-rol');
let datosFormularioRol=new FormData(formularioModalRol);
const ventanaModal=document.getElementById("modal-cambiar-rol");
const campoCodigoSis=document.getElementById("codigoSis");

function abrirModalCambiarRol(codigo_sis){ //cargar datos
    campoCodigoSis.value=codigo_sis;
    abrirModal();
}


const abrirModalSetRol=()=>{ventanaModal.hidden=false;}


const cerrarModalSetRol=()=>{
campoCodigoSis.value="";
ventanaModal.hidden=true;
}


const agregarFuncionBotones=()=>{
const botonCerrarCambioRol=document.getElementById('boton-cerrar-cambio-rol');
botonCerrarCambioRol.addEventListener("click",()=>{cerrarModal();});

formularioModalRol.addEventListener("submit",(e)=>{
e.preventDefault();
actualizarRolAlumno();
});
}

const actualizarRolAlumno=()=>{
formularioModal=document.getElementById('formulario-modal');
datosFormularioModal=new FormData(formularioModal);
fetch('../backend/cambiarRolAlumno.php',{
    method:'POST',
    body:datosFormularioRol})
    .then(res=>res.json())
    .then(()=>{
    window.location.reload();})

}



agregarFuncionBotones();




