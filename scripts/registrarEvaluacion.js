let formularioModal=document.getElementById('formulario-semanal');
let datosFormularioModal=new FormData(formularioModal);
const ventanaModal=document.getElementById("modal-nota-semanal");
const campoCodigoSis=document.getElementById("codigoSis");
const campoNombre=document.getElementById("nombre");
const campoAsistencia=document.getElementById("asistencia");
const campoNota=document.getElementById("nota");

const mensaje=document.getElementById("mensaje");

const abrirModal=()=>{ventanaModal.hidden=false;}

const cerrarModal=()=>{
campoCodigoSis.value="";
campoNombre.value="";
ventanaModal.hidden=true;
}

const datosSemanal=(codigoSis,nombre)=>{
campoCodigoSis.value=codigoSis;
campoNombre.value=nombre;
console.log(codigoSis,nombre);
abrirModal();
}


const agregarFuncionBotones=()=>{
const botonCancelar=document.getElementById('boton-cancelar');
botonCancelar.addEventListener("click",()=>{cerrarModal();});
formularioModal.addEventListener("submit",(e)=>{
e.preventDefault();
actualizarNotaSemanalAlumno();
});

}

const actualizarNotaSemanalAlumno=()=>{
    console.log(codigoSis,nombre, campoAsistencia);

formularioModal=document.getElementById('formulario-semanal');
datosFormularioModal=new FormData(formularioModal);
fetch('../backend/registrarEvaluacionSemanal.php',{
    method:'POST',
    body:datosFormularioModal})
    .then(res=>res.json())
    .then(data=>{console.log(data)
    //window.location.reload();
    })
}