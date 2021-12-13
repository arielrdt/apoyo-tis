let formularioModalRol=document.getElementById('formulario-cambio-rol');
let datosFormularioRol=new FormData(formularioModalRol);
const ventanaModal=document.getElementById("modal-cambio-rol");
const campoCodigoSis=document.getElementById("codigoSis");//////
const campoNombre=document.getElementById("nombre"); ///////

function cargarDatosRol(codigo_sis,nombre){ //cargar datos
    campoCodigoSis.value=codigo_sis;
    campoNombre.value=nombre;
    abrirModalSetRol();
}

const abrirModalSetRol=()=>{ventanaModal.hidden=false;}


const cerrarModalSetRol=()=>{
campoCodigoSis.value="";
campoNombre.value="";
ventanaModal.hidden=true;
}


const agregarFuncionBotones=()=>{
const botonCerrarCambioRol=document.getElementById('boton-cerrar-cambio-rol');
botonCerrarCambioRol.addEventListener("click",()=>{cerrarModalSetRol();});

formularioModalRol.addEventListener("submit",(e)=>{
e.preventDefault();
actualizarRolAlumno();
});
}

const actualizarRolAlumno=()=>{
    formularioModalRol=document.getElementById('formulario-cambio-rol');
    datosFormularioRol=new FormData(formularioModalRol);
fetch('../backend/cambiarRolAlumno.php',{
    method:'POST',
    body:datosFormularioRol})
    .then(res=>res.json())
    .then(()=>{
    window.location.reload();})

}



agregarFuncionBotones();




