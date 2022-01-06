//Edicion de rol de un estudiante por parte del representante legal

/*recupera los elementos del formulario con la id formulario-cambio-rol
las almacena en un formData para mejor uso*/
let formularioModalRol=document.getElementById('formulario-cambio-rol');
let datosFormularioRol=new FormData(formularioModalRol);
//almacena los datos del formulario de forma separada en distintas variables
const ventanaModal=document.getElementById("modal-cambio-rol");
const campoCodigoSis=document.getElementById("codigoSis");
const campoNombre=document.getElementById("nombre"); 

//carga los datos del estudiante al modal una vez que se abre
function cargarDatosRol(codigo_sis,nombre){ 
    campoCodigoSis.value=codigo_sis;
    campoNombre.value=nombre;
    abrirModalSetRol();
}

//hace que el modal sea visible
const abrirModalSetRol=()=>{ventanaModal.hidden=false;}


//cierra el modal y reinicia sus campos para cuando se vuelva a abrir
const cerrarModalSetRol=()=>{
campoCodigoSis.value="";
campoNombre.value="";
ventanaModal.hidden=true;
}

//controla y agrega las funciones al modal
const agregarFuncionBotones=()=>{
const botonCerrarCambioRol=document.getElementById('boton-cerrar-cambio-rol');
botonCerrarCambioRol.addEventListener("click",()=>{cerrarModalSetRol();});
formularioModalRol.addEventListener("submit",(e)=>{
e.preventDefault();
actualizarRolAlumno();
});
}
//envia los datos del formulario al archivo php para que sean almacenados en la base de datos
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




