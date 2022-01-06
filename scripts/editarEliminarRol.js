//Edicion de rol de un estudiante por parte del docente

/*recupera los elementos del formulario con la id formulario-modalrol
las almacena en un formData para mejor uso*/
let formularioModal=document.getElementById('formulario-modalrol');
let datosFormularioModal=new FormData(formularioModal);
//almacena los datos del formulario de forma separada en distintas variables
const ventanaModal=document.getElementById("modal-rol");
const campoCodigoSis=document.getElementById("codigoSis");
const campoNombre=document.getElementById("nombre");
const campoRol=document.getElementById("rol");
const mensaje=document.getElementById("mensaje");
//hace que el modal sea visible
const abrirModal=()=>{ventanaModal.hidden=false;}

//cierra el modal y reinicia sus campos para cuando se vuelva a abrir
const cerrarModal=()=>{
campoCodigoSis.value="";
campoNombre.value="";
ventanaModal.hidden=true;
}
//carga los datos del estudiante al modal una vez que se abre
const editarDatos=(codigoSis,nombre,rol)=>{
campoCodigoSis.value=codigoSis;
campoNombre.value=nombre;
console.log(codigoSis,nombre,rol);
abrirModal();
}
//valida que el rol tenga solo letras
const rolValida=(rol)=>{
    //let patron = new RegExp("^[a-z]^$|[A-Z]");
    //return !!patron.test(rol);
}

//controla y agrega las funciones del modal
const agregarFuncionBotones=()=>{
const botonCancelar=document.getElementById('boton-cancelar');
botonCancelar.addEventListener("click",()=>{cerrarModal();});
formularioModal.addEventListener("submit",(e)=>{
e.preventDefault();
actualizarRolAlumno();
});
}

//envia los datos del formulario al archivo php para ser almecenados en la base de datos
const actualizarRolAlumno=()=>{
formularioModal=document.getElementById('formulario-modalrol');
datosFormularioModal=new FormData(formularioModal);
fetch('../backend/cambiarRolEstudianteDocente.php',{
    method:'POST',
    body:datosFormularioModal})
    .then(res=>res.json())
    .then(data=>{console.log(data)
    window.location.reload();
    })
}



agregarFuncionBotones();