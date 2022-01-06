//@param formularioSemanal=formulario del documento con el formulario de evaluacion semanal 
//@param datosFormularioSemanal=contenido del formulario 
//@param ventanaModal=div del documento de la ventana modal
//@param campoCodigoSis=campo con el codigo sis
//@param campoNombre=campo con el nombre del estudiante
//@param campoAsistencia=campo con el tipo de asistencia
//@param campoNota=campo con la nota de evaluacion
//@param mensaje=div del documento para agregar el mensaje

let formularioSemanal=document.getElementById('formulario-semanal');
let datosFormularioSemanal=new FormData(formularioSemanal);
const ventanaModal=document.getElementById("modal-nota-semanal");
const campoCodigoSis=document.getElementById("codigoSis");
const campoNombre=document.getElementById("nombre");
const campoAsistencia=document.getElementById("asistencia");
const campoNota=document.getElementById("nota");
const mensaje=document.getElementById("mensaje");

//funcion para mostrar la ventana modal
const abrirModal=()=>{ventanaModal.hidden=false;}

//funcion para borrar los valores de los campos
//nombre,codigosis y nota
//y esconder la ventana modal
const cerrarModal=()=>{
    campoCodigoSis.value="";
    campoNombre.value="";
    campoNota.value="";
    ventanaModal.hidden=true;

    }

//funcion para cargar el codigo sis y nombre del estudiante al modal
const datosSemanal=(codigoSis,nombre)=>{
campoCodigoSis.value=codigoSis;
campoNombre.value=nombre;
abrirModal();
}

//funcion para verificar que la nota este entre 1 y 100
const notaValida=(numero)=>{
    let patron = new RegExp("^[1-9]$|^[1-9][0-9]$|^(100)$");
    return !!patron.test(numero);}

//funcion para agregar la funcion de cerrar el modal al boton de cancelar
//y agregar la funcion  de subir la nota al boto de aceptar
const agregarFuncion=()=>{
const botonCancelar=document.getElementById('boton-cancelar');
botonCancelar.addEventListener("click",()=>{cerrarModal();});
formularioSemanal.addEventListener("submit",(e)=>{
e.preventDefault();
if(notaValida(campoNota.value)){actualizarNotaSemanalAlumno();}
else{
    mensaje.innerHTML="Ingrese una nota entre 1 y 100";
}
});
}

//funcion para subir la nota del alumno a la base de datos
const actualizarNotaSemanalAlumno=()=>{
//obtener los nuevos datos del formulario
formularioSemanal=document.getElementById('formulario-semanal');
//obtener el contenido del los datos del formuario
datosFormularioSemanal=new FormData(formularioSemanal);
//referencial al archivo de registro de evaluacion semanal
//enviar el contenido del formulario

fetch('../backend/registrarEvaluacionSemanal.php',{
    method:'POST',
    body:datosFormularioSemanal})
    .then(res=>res.json())
    .then(data=>{console.log(data)
    window.location.reload();
    })
}
agregarFuncion();